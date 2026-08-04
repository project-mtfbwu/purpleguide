<?php
Class Users extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');     
        $this->load->model('Admin_audit_log_model');
        $this->load->library('form_validation');
        $this->load->library('Notification_service');
    }

    private function require_admin_login()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
            return;
        }
    }

    private function get_admin_role(): string
    {
        $role = strtolower(trim((string) $this->session->userdata('admin_role')));
        if ($role === 'superadmin') return 'super_admin';
        if ($role === '') return 'admin';
        return $role;
    }

    private function require_allotted_user_access(int $userId): void
    {
        $this->require_admin_login();

        $adminRole = $this->get_admin_role();
        if ($adminRole !== 'mentor') return;

        $adminId = (int) $this->session->userdata('user_id');
        $mentorFieldExists = $this->db->field_exists('mentor_admin_id', 'users');

        if (!$mentorFieldExists) {
            show_error('Mentor filtering requires users.mentor_admin_id column in database.', 500);
            exit;
        }

        $allowed = $this->db
            ->select('id')
            ->from('users')
            ->where('id', (int) $userId)
            ->where('mentor_admin_id', $adminId)
            ->limit(1)
            ->get()
            ->row();

        if (!$allowed) {
            show_error('Unauthorized', 403);
            exit;
        }
    }

    /**
     * Timestamps when a card enters In Progress, Draft Phase, or Completed (drag/edit section change).
     */
    private function kanban_stage_timestamp_columns_exist(): bool
    {
        static $cached = null;
        if ($cached !== null) {
            return $cached;
        }
        $cached = $this->db->field_exists('entered_in_progress_at', 'kanban_cards')
            && $this->db->field_exists('entered_draft_phase_at', 'kanban_cards')
            && $this->db->field_exists('entered_completed_at', 'kanban_cards');
        return $cached;
    }

    /** @return array<string,string> */
    private function kanban_stage_timestamp_updates(string $newSection): array
    {
        if (!$this->kanban_stage_timestamp_columns_exist()) {
            return [];
        }
        // Store timestamps in IST regardless of server timezone.
        $now = (new DateTime('now', new DateTimeZone('Asia/Kolkata')))->format('Y-m-d H:i:s');
        switch ($newSection) {
            case 'in_progress':
                return ['entered_in_progress_at' => $now];
            case 'draft_phase':
                return ['entered_draft_phase_at' => $now];
            case 'completed':
                return ['entered_completed_at' => $now];
            default:
                return [];
        }
    }

    private function audit_log(int $targetUserId, string $action, string $entity, $entityId = null, ?string $description = null, $changes = null): void
    {
        // Logging is best-effort; never block admin actions because of logging.
        try {
            if (!$this->Admin_audit_log_model || !$this->Admin_audit_log_model->table_exists()) {
                return;
            }

            $adminId = (int) $this->session->userdata('user_id');
            if ($adminId <= 0) return;

            $changesJson = null;
            if ($changes !== null) {
                $changesJson = is_string($changes) ? $changes : json_encode($changes);
            }

            $this->Admin_audit_log_model->insert([
                'admin_id' => $adminId,
                'admin_role' => $this->get_admin_role(),
                'target_user_id' => $targetUserId > 0 ? $targetUserId : null,
                'entity' => $entity,
                'entity_id' => $entityId !== null ? (int) $entityId : null,
                'action' => $action,
                'description' => $description,
                'changes_json' => $changesJson,
                'ip_address' => $this->input->ip_address(),
                'user_agent' => substr((string) $this->input->user_agent(), 0, 255),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (Throwable $e) {
            // ignore
        }
    }
    public function index(){
        //print_r('test');die();
       $this->load->view('login');
    }
   
    public function login(){
        $post=  $this->input->post();
        $this->load->model('User_model');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required');
        $password = $this->input->post('password'); 
        $email = $this->input->post('email');
        $data = $this->db->query("select * from admin where email = '$email' and password = '$password'")->result();
        $user = $this->User_model->checkuser($email,$password);
            
        if($user)
        {  
            $this->session->set_userdata('name',$data[0]->first_name);
            $this->session->set_userdata('user_id',$data[0]->u_id);
            $this->session->set_userdata('admin_role', isset($data[0]->user_role) && $data[0]->user_role ? $data[0]->user_role : 'admin');
            $this->session->set_flashdata('success','Logged in Successfully');  
            redirect (base_url('Dashboard'));
            }else{
             $this->session->set_flashdata('error','Login failed');
            redirect (base_url());
        }
    }               
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url()); 
    }
    public function users_list()
    {
        $this->require_admin_login();

        $adminRole = $this->get_admin_role();
        $adminId = (int) $this->session->userdata('user_id');
        $q = trim((string) $this->input->get('q', true));

        $mentorFieldExists = $this->db->field_exists('mentor_admin_id', 'users');
        $tagFieldExists = $this->db->field_exists('tag', 'users');

        // Mentors must only see allotted users (requires mentor_admin_id column)
        if ($adminRole === 'mentor' && !$mentorFieldExists) {
            $this->session->set_flashdata('error', 'Mentor filtering requires users.mentor_admin_id column in database.');
            redirect(base_url('Dashboard'));
            return;
        }

        $this->load->library('pagination');
        $per_page = 15;
        $page = max(1, (int) $this->uri->segment(3));
        $offset = ($page - 1) * $per_page;

        // Total rows (with role-based filtering + search)
        $this->db->from('users');
        if ($adminRole === 'mentor' && $mentorFieldExists) {
            $this->db->where('users.mentor_admin_id', $adminId);
        }
        if ($q !== '') {
            $this->db->group_start();
            $this->db->like('users.name', $q);
            $this->db->or_like('users.id', $q);
            $this->db->or_like('users.email', $q);
            if ($tagFieldExists) {
                $this->db->or_like('users.tag', $q);
            }
            $this->db->group_end();
        }
        $total = (int) $this->db->count_all_results();

        $config['base_url'] = base_url('Users/users_list');
        $config['total_rows'] = $total;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['cur_page'] = $page;
        $config['num_links'] = 3;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();

        // Data rows
        $this->db->select('users.*, country_list.country_name');
        if ($mentorFieldExists) {
            $this->db->select('admin.first_name AS mentor_name');
        }
        $this->db->from('users');
        $this->db->join('country_list', 'users.country_code = country_list.country_code', 'left');
        if ($mentorFieldExists) {
            $this->db->join('admin', 'admin.u_id = users.mentor_admin_id', 'left');
        }
        if ($adminRole === 'mentor' && $mentorFieldExists) {
            $this->db->where('users.mentor_admin_id', $adminId);
        }
        if ($q !== '') {
            $this->db->group_start();
            $this->db->like('users.name', $q);
            $this->db->or_like('users.id', $q);
            $this->db->or_like('users.email', $q);
            if ($tagFieldExists) {
                $this->db->or_like('users.tag', $q);
            }
            $this->db->group_end();
        }
        $this->db->order_by('users.id', 'DESC');
        $this->db->limit((int) $per_page, (int) $offset);
        $data['product'] = $this->db->get()->result();

        $data['admin_role'] = $adminRole;
        $data['search_q'] = $q;
        $data['mentor_field_exists'] = $mentorFieldExists;

        // For super admin: load mentors list to assign
        $data['mentors'] = [];
        if ($adminRole === 'super_admin') {
            $roleFieldExists = $this->db->field_exists('user_role', 'admin');
            if ($roleFieldExists) {
                $data['mentors'] = $this->db
                    ->select('u_id, first_name, email')
                    ->from('admin')
                    ->where('user_role', 'mentor')
                    ->order_by('first_name', 'ASC')
                    ->get()
                    ->result();
            } else {
                $data['mentors'] = $this->db
                    ->select('u_id, first_name, email')
                    ->from('admin')
                    ->order_by('first_name', 'ASC')
                    ->get()
                    ->result();
            }
        }

        $this->load->view('users', $data);
    }

    public function assign_mentor()
    {
        $this->require_admin_login();

        if ($this->get_admin_role() !== 'super_admin') {
            show_error('Unauthorized', 403);
            return;
        }

        if (!$this->db->field_exists('mentor_admin_id', 'users')) {
            $this->session->set_flashdata('error', 'Mentor assignment requires users.mentor_admin_id column in database.');
            redirect(base_url('Users/users_list'));
            return;
        }

        $userId = (int) $this->input->post('user_id');
        $mentorIdRaw = $this->input->post('mentor_id');
        $mentorId = ($mentorIdRaw === '' || $mentorIdRaw === null) ? null : (int) $mentorIdRaw;

        if ($userId <= 0) {
            $this->session->set_flashdata('error', 'Invalid user.');
            redirect(base_url('Users/users_list'));
            return;
        }

        if ($mentorId !== null) {
            $mentorExists = $this->db->select('u_id')->from('admin')->where('u_id', $mentorId)->limit(1)->get()->row();
            if (!$mentorExists) {
                $this->session->set_flashdata('error', 'Invalid mentor.');
                redirect(base_url('Users/users_list'));
                return;
            }
        }

        $before = $this->db->select('mentor_admin_id')->from('users')->where('id', $userId)->limit(1)->get()->row_array();
        $this->db->where('id', $userId)->update('users', ['mentor_admin_id' => $mentorId]);
        $this->audit_log(
            $userId,
            'update',
            'user_profile',
            $userId,
            'Updated mentor assignment',
            ['mentor_admin_id' => ['before' => $before['mentor_admin_id'] ?? null, 'after' => $mentorId]]
        );
        $this->session->set_flashdata('success', 'Mentor assignment updated.');
        redirect(base_url('Users/users_list'));
    }
    
    public function premium_applications()
    {
        $this->require_admin_login();

        // Mentors should not be able to access this page.
        if ($this->get_admin_role() === 'mentor') {
            $this->session->set_flashdata('error', 'Unauthorized');
            redirect(base_url('Dashboard'));
            return;
        }

        // Fetch premium applications with user details
        $data['premium_applications'] = $this->db->query("
            SELECT 
                purplepremium_applications.*,
                users.name,
                users.email,
                users.number,
                users.dial_code
            FROM purplepremium_applications
            LEFT JOIN users ON purplepremium_applications.user_id = users.id
            ORDER BY purplepremium_applications.applied_at DESC
        ")->result();
        
        $this->load->view('premium_applications', $data);
    }

    public function logs()
    {
        $this->require_admin_login();

        if (!$this->Admin_audit_log_model || !$this->Admin_audit_log_model->table_exists()) {
            $this->session->set_flashdata('error', 'Audit log table is missing. Run admin_audit_logs_table.sql.');
            $this->load->view('users_logs', [
                'rows' => [],
                'pagination_links' => '',
                'filters' => ['q' => '', 'admin_id' => '', 'user_id' => '', 'admin_q' => '', 'user_q' => '', 'action' => ''],
                'table_missing' => true,
            ]);
            return;
        }

        $role = $this->get_admin_role();
        $currentAdminId = (int) $this->session->userdata('user_id');

        $q = trim((string) $this->input->get('q', true));
        $adminId = trim((string) $this->input->get('admin_id', true));
        $userId = trim((string) $this->input->get('user_id', true));
        $adminQ = trim((string) $this->input->get('admin_q', true));
        $userQ = trim((string) $this->input->get('user_q', true));
        $action = trim((string) $this->input->get('action', true));

        // Restrict visibility:
        // - super_admin can see all logs
        // - mentor/admin can see only their own logs (regardless of filters)
        if ($role !== 'super_admin') {
            $adminId = (string) $currentAdminId;
            $adminQ = '';
        }

        $this->load->library('pagination');
        $per_page = 25;
        $page = max(1, (int) $this->uri->segment(3));
        $offset = ($page - 1) * $per_page;

        // Total
        $this->db->from('admin_audit_logs l');
        $this->db->join('admin a', 'a.u_id = l.admin_id', 'left');
        $this->db->join('users u', 'u.id = l.target_user_id', 'left');
        if ($adminId !== '') $this->db->where('l.admin_id', (int) $adminId);
        if ($userId !== '') $this->db->where('l.target_user_id', (int) $userId);
        if ($action !== '') $this->db->where('l.action', $action);
        if ($adminId === '' && $adminQ !== '') {
            $this->db->group_start();
            $this->db->like('a.first_name', $adminQ);
            $this->db->or_like('a.email', $adminQ);
            $this->db->group_end();
        }
        if ($userId === '' && $userQ !== '') {
            $this->db->group_start();
            $this->db->like('u.name', $userQ);
            $this->db->or_like('u.email', $userQ);
            $this->db->group_end();
        }
        if ($q !== '') {
            $this->db->group_start();
            $this->db->like('l.description', $q);
            $this->db->or_like('l.entity', $q);
            $this->db->or_like('l.action', $q);
            $this->db->or_like('a.first_name', $q);
            $this->db->or_like('a.email', $q);
            $this->db->or_like('u.name', $q);
            $this->db->or_like('u.email', $q);
            $this->db->group_end();
        }
        $total = (int) $this->db->count_all_results();

        $config['base_url'] = base_url('Users/logs');
        $config['total_rows'] = $total;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['cur_page'] = $page;
        $config['num_links'] = 3;
        $config['reuse_query_string'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);

        // Rows
        $this->db->select('l.*, a.first_name AS admin_name, a.email AS admin_email, u.name AS user_name, u.email AS user_email');
        $this->db->from('admin_audit_logs l');
        $this->db->join('admin a', 'a.u_id = l.admin_id', 'left');
        $this->db->join('users u', 'u.id = l.target_user_id', 'left');
        if ($adminId !== '') $this->db->where('l.admin_id', (int) $adminId);
        if ($userId !== '') $this->db->where('l.target_user_id', (int) $userId);
        if ($action !== '') $this->db->where('l.action', $action);
        if ($adminId === '' && $adminQ !== '') {
            $this->db->group_start();
            $this->db->like('a.first_name', $adminQ);
            $this->db->or_like('a.email', $adminQ);
            $this->db->group_end();
        }
        if ($userId === '' && $userQ !== '') {
            $this->db->group_start();
            $this->db->like('u.name', $userQ);
            $this->db->or_like('u.email', $userQ);
            $this->db->group_end();
        }
        if ($q !== '') {
            $this->db->group_start();
            $this->db->like('l.description', $q);
            $this->db->or_like('l.entity', $q);
            $this->db->or_like('l.action', $q);
            $this->db->or_like('a.first_name', $q);
            $this->db->or_like('a.email', $q);
            $this->db->or_like('u.name', $q);
            $this->db->or_like('u.email', $q);
            $this->db->group_end();
        }
        $this->db->order_by('l.created_at', 'DESC');
        $this->db->limit((int) $per_page, (int) $offset);
        $rows = $this->db->get()->result();

        $this->load->view('users_logs', [
            'rows' => $rows,
            'pagination_links' => $this->pagination->create_links(),
            'filters' => ['q' => $q, 'admin_id' => $adminId, 'user_id' => $userId, 'admin_q' => $adminQ, 'user_q' => $userQ, 'action' => $action],
            'table_missing' => false,
        ]);
    }

    public function ajax_admin_autocomplete()
    {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) ob_clean();
        $this->output->set_content_type('application/json');

        if (!$this->session->userdata('user_id')) {
            $this->output->set_output(json_encode(['success' => false, 'items' => []]));
            return;
        }

        $term = trim((string) $this->input->get('q', true));
        if (strlen($term) < 2) {
            $this->output->set_output(json_encode(['success' => true, 'items' => []]));
            return;
        }

        $rows = $this->db
            ->select('u_id, first_name, email')
            ->from('admin')
            ->group_start()
            ->like('first_name', $term)
            ->or_like('email', $term)
            ->group_end()
            ->order_by('first_name', 'ASC')
            ->limit(10)
            ->get()
            ->result();

        $items = [];
        foreach ($rows as $r) {
            $items[] = [
                'id' => (int) $r->u_id,
                'name' => (string) $r->first_name,
                'email' => (string) $r->email,
                'label' => trim((string) $r->first_name) . ' (' . trim((string) $r->email) . ')',
            ];
        }

        $this->output->set_output(json_encode(['success' => true, 'items' => $items]));
    }

    public function ajax_user_autocomplete()
    {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) ob_clean();
        $this->output->set_content_type('application/json');

        if (!$this->session->userdata('user_id')) {
            $this->output->set_output(json_encode(['success' => false, 'items' => []]));
            return;
        }

        $term = trim((string) $this->input->get('q', true));
        if (strlen($term) < 2) {
            $this->output->set_output(json_encode(['success' => true, 'items' => []]));
            return;
        }

        $rows = $this->db
            ->select('id, name, email')
            ->from('users')
            ->group_start()
            ->like('name', $term)
            ->or_like('email', $term)
            ->group_end()
            ->order_by('name', 'ASC')
            ->limit(10)
            ->get()
            ->result();

        $items = [];
        foreach ($rows as $r) {
            $items[] = [
                'id' => (int) $r->id,
                'name' => (string) $r->name,
                'email' => (string) $r->email,
                'label' => trim((string) $r->name) . ' (' . trim((string) $r->email) . ')',
            ];
        }

        $this->output->set_output(json_encode(['success' => true, 'items' => $items]));
    }
    public function user_details()
    {
        $id = (int) $this->uri->segment(3);

        $data['product'] = $this->db->query("
            SELECT 
                users.*, 
                c1.country_name AS country_name, 
                c2.country_name AS preferred_country_name
            FROM users
            LEFT JOIN country_list c1 ON users.country_code = c1.country_code
            LEFT JOIN country_list c2 ON users.preferred_country_code = c2.country_code
            WHERE users.id = " . (int)$id
        )->row();

        //print_r($data['product']);die();

        $this->load->view('users_details', $data);
    }
    public function user_documents()
    {
        $id = (int) $this->uri->segment(3);

        $data['product'] = $this->db->query("
            SELECT 
                users.*, 
                c1.country_name AS country_name, 
                c2.country_name AS preferred_country_name
            FROM users
            LEFT JOIN country_list c1 ON users.country_code = c1.country_code
            LEFT JOIN country_list c2 ON users.preferred_country_code = c2.country_code
            WHERE users.id = " . (int)$id
        )->row();

        // Get all uploaded documents for this user
        $data['documents'] = $this->db->where('user_id', $id)
            ->order_by('document_type', 'ASC')
            ->order_by('uploaded_at', 'DESC')
            ->get('user_documents')
            ->result();
        
        // Standard document types
        $data['standard_documents'] = [
            'Passport Front',
            'Passport Back',
            'CV',
            'LoR',
            'UG Marksheet - 1',
            'UG Provisional Certificate',
            'UG Degree Certificate',
            'SOP',
            '12th Marksheet',
            '10th Marksheet',
            'PG Marksheet - 1',
            'PG Consolidated Marksheet',
            'PG Provisional Certificate',
            'PG Degree Certificate',
            'pre-journey checklist'
        ];

        // Admin-added document types for this user (shown on frontend upload_your_doc page)
        $data['additional_doc_types'] = [];
        if ($this->db->table_exists('user_additional_doc_types')) {
            $data['additional_doc_types'] = $this->db->where('user_id', $id)
                ->order_by('display_order', 'ASC')
                ->order_by('id', 'ASC')
                ->get('user_additional_doc_types')
                ->result();
        }

        $this->load->view('user_documents', $data);
    }

    public function download_user_docs_zip($userId = null)
    {
        $this->require_admin_login();

        $userId = (int) $userId;
        if ($userId <= 0) {
            show_404();
            return;
        }

        $adminRole = $this->get_admin_role();
        $adminId = (int) $this->session->userdata('user_id');

        // Mentors can only download docs for allotted users
        if ($adminRole === 'mentor' && $this->db->field_exists('mentor_admin_id', 'users')) {
            $allowed = $this->db->select('id')->from('users')->where('id', $userId)->where('mentor_admin_id', $adminId)->limit(1)->get()->row();
            if (!$allowed) {
                show_error('Unauthorized', 403);
                return;
            }
        }

        $user = $this->db->select('id, name')->from('users')->where('id', $userId)->limit(1)->get()->row();
        if (!$user) {
            show_404();
            return;
        }

        $docs = $this->db->where('user_id', $userId)->order_by('uploaded_at', 'DESC')->get('user_documents')->result();
        if (empty($docs)) {
            $this->session->set_flashdata('error', 'No documents found for this user.');
            redirect(base_url('Users/user_documents/'.$userId));
            return;
        }

        if (!class_exists('ZipArchive')) {
            show_error('Zip support is not available on this server (ZipArchive missing).', 500);
            return;
        }

        $zip = new ZipArchive();
        $tmpZipPath = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'user_docs_' . $userId . '_' . uniqid('', true) . '.zip';
        if ($zip->open($tmpZipPath, ZipArchive::CREATE) !== TRUE) {
            show_error('Unable to create zip file.', 500);
            return;
        }

        $added = 0;
        $seenNames = [];

        foreach ($docs as $doc) {
            $relPath = (string) ($doc->file_path ?? '');
            if ($relPath === '') continue;

            $relPath = ltrim($relPath, '/');
            $absPath = FCPATH . $relPath;
            $real = realpath($absPath);
            if ($real === false) continue;

            // Prevent zipping files outside webroot
            $webrootReal = realpath(FCPATH);
            if ($webrootReal && strpos($real, $webrootReal) !== 0) continue;
            if (!is_file($real) || !is_readable($real)) continue;

            $baseName = basename($real);
            $folder = trim((string) ($doc->document_type ?? 'Documents'));
            $folder = preg_replace('/[^a-zA-Z0-9 _\\-]/', '_', $folder);
            if ($folder === '') $folder = 'Documents';

            $zipName = $folder . '/' . $baseName;
            $key = strtolower($zipName);
            if (isset($seenNames[$key])) {
                $ext = pathinfo($baseName, PATHINFO_EXTENSION);
                $stem = pathinfo($baseName, PATHINFO_FILENAME);
                $n = $seenNames[$key] + 1;
                $seenNames[$key] = $n;
                $baseName2 = $stem . '_' . $n . ($ext ? '.' . $ext : '');
                $zipName = $folder . '/' . $baseName2;
            } else {
                $seenNames[$key] = 1;
            }

            if ($zip->addFile($real, $zipName)) {
                $added++;
            }
        }

        $zip->close();

        if ($added <= 0) {
            @unlink($tmpZipPath);
            $this->session->set_flashdata('error', 'No readable files found to zip for this user.');
            redirect(base_url('Users/user_documents/'.$userId));
            return;
        }

        $safeUserName = preg_replace('/[^a-zA-Z0-9 _\\-]/', '_', (string) $user->name);
        $safeUserName = trim(preg_replace('/\\s+/', ' ', $safeUserName));
        if ($safeUserName === '') $safeUserName = 'user_' . $userId;
        $downloadName = $safeUserName . '.zip';

        if (ob_get_level()) { @ob_end_clean(); }
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $downloadName . '"');
        header('Content-Length: ' . filesize($tmpZipPath));
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Pragma: no-cache');
        readfile($tmpZipPath);
        @unlink($tmpZipPath);
        exit;
    }
    
    /**
     * Add an additional document type for a user (appears on frontend upload_your_doc list).
     */
    public function add_user_document_type() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) ob_clean();
        $this->output->set_content_type('application/json');
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            return;
        }
        $user_id = (int) $this->input->post('user_id');
        $doc_name = trim($this->input->post('doc_name'));
        if (!$user_id || $doc_name === '') {
            echo json_encode(['success' => false, 'message' => 'User ID and document name are required']);
            return;
        }
        if (!$this->db->table_exists('user_additional_doc_types')) {
            echo json_encode(['success' => false, 'message' => 'Table user_additional_doc_types does not exist. Run user_additional_doc_types_table.sql']);
            return;
        }
        $this->db->insert('user_additional_doc_types', [
            'user_id' => $user_id,
            'doc_name' => $doc_name,
            'display_order' => 0
        ]);
        $id = $this->db->insert_id();
        if ($id) {
            $this->notification_service->notify_section($user_id, 'documents', 'Document checklist updated', 'A new required document was added: ' . $doc_name . '.', 'user_document_type', $id);
            echo json_encode(['success' => true, 'message' => 'Document type added', 'id' => $id]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add document type']);
        }
    }
    
    /**
     * Delete an additional document type for a user.
     */
    public function delete_user_document_type() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) ob_clean();
        $this->output->set_content_type('application/json');
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            return;
        }
        $id = (int) $this->input->post('id');
        if (!$id || !$this->db->table_exists('user_additional_doc_types')) {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            return;
        }
        $deleted = $this->db->where('id', $id)->delete('user_additional_doc_types');
        echo json_encode($deleted ? ['success' => true, 'message' => 'Removed'] : ['success' => false, 'message' => 'Failed to remove']);
    }
    
    public function update_document_status()
    {
        $this->output->enable_profiler(FALSE);
        
        if (!$this->session->userdata('user_id')) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Please login first']));
            return;
        }
        
        $document_id = (int) $this->input->post('document_id');
        $status = $this->input->post('status');
        
        if (!$document_id || !in_array($status, ['pending', 'approved', 'rejected', 'indraft'])) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Invalid request']));
            return;
        }

        $docRow = $this->db->select('id, user_id, qc_status, document_type')->from('user_documents')->where('id', $document_id)->limit(1)->get()->row();
        if (!$docRow) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Document not found']));
            return;
        }
        
        $result = $this->db->where('id', $document_id)
            ->update('user_documents', ['qc_status' => $status]);
        
        if ($result) {
            $docLabel = trim((string) ($docRow->document_type ?? ''));
            $this->notification_service->notify_section(
                (int) $docRow->user_id,
                'documents',
                'Document status updated',
                ($docLabel !== '' ? '"' . $docLabel . '" is now ' : 'Your document status is now ') . ucfirst($status) . '.',
                'user_document',
                (int) $docRow->id
            );
            $this->audit_log(
                (int) $docRow->user_id,
                'update',
                'user_document',
                (int) $docRow->id,
                'Updated document QC status',
                ['qc_status' => ['before' => (string) ($docRow->qc_status ?? ''), 'after' => $status]]
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => true, 'message' => 'Status updated successfully']));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Failed to update status']));
        }
    }
    
    public function accept_premium()
    {
        // Disable profiler and any output
        $this->output->enable_profiler(FALSE);
        
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Please login first']));
            return;
        }
        
        $application_id = (int) $this->input->post('application_id');
        $admin_id = $this->session->userdata('user_id');
        
        if (!$application_id || !$admin_id) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Invalid request']));
            return;
        }
        
        $app = $this->db->select('id, user_id, status')->from('purplepremium_applications')->where('id', $application_id)->limit(1)->get()->row();
        if (!$app) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Application not found']));
            return;
        }

        // Update application status
        $update_data = [
            'status' => 'approved',
            'approved_at' => date('Y-m-d H:i:s'),
            'approved_by' => $admin_id
        ];
        
        $result = $this->db->where('id', $application_id)->update('purplepremium_applications', $update_data);
        
        if ($result) {
            $this->audit_log(
                (int) $app->user_id,
                'approve',
                'premium_application',
                (int) $app->id,
                'Approved PurplePremium application',
                ['status' => ['before' => (string) ($app->status ?? ''), 'after' => 'approved']]
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => true, 'message' => 'Application approved successfully']));
        } else {
            $error = $this->db->error();
            $error_msg = 'Failed to approve application';
            if (!empty($error['message'])) {
                $error_msg .= ': ' . $error['message'];
            }
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => $error_msg]));
        }
    }
    
    public function reject_premium()
    {
        // Disable profiler and any output
        $this->output->enable_profiler(FALSE);
        
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Please login first']));
            return;
        }
        
        $application_id = (int) $this->input->post('application_id');
        $admin_id = $this->session->userdata('user_id');
        
        if (!$application_id || !$admin_id) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Invalid request']));
            return;
        }
        
        $app = $this->db->select('id, user_id, status')->from('purplepremium_applications')->where('id', $application_id)->limit(1)->get()->row();
        if (!$app) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Application not found']));
            return;
        }

        // Update application status
        $update_data = [
            'status' => 'rejected',
            'approved_by' => $admin_id
        ];
        
        $result = $this->db->where('id', $application_id)->update('purplepremium_applications', $update_data);
        
        if ($result) {
            $this->audit_log(
                (int) $app->user_id,
                'reject',
                'premium_application',
                (int) $app->id,
                'Rejected PurplePremium application',
                ['status' => ['before' => (string) ($app->status ?? ''), 'after' => 'rejected']]
            );
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => true, 'message' => 'Application rejected successfully']));
        } else {
            $error = $this->db->error();
            $error_msg = 'Failed to reject application';
            if (!empty($error['message'])) {
                $error_msg .= ': ' . $error['message'];
            }
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => $error_msg]));
        }
    }
    
    // Premium Dashboard Management
    public function premium_dashboard_list()
    {
        $this->require_admin_login();

        $adminRole = $this->get_admin_role();
        $adminId = (int) $this->session->userdata('user_id');
        $mentorFieldExists = $this->db->field_exists('mentor_admin_id', 'users');

        if ($adminRole === 'mentor' && !$mentorFieldExists) {
            $this->session->set_flashdata('error', 'Mentor filtering requires users.mentor_admin_id column in database.');
            redirect(base_url('Dashboard'));
            return;
        }

        // Get all approved premium users (mentors: only allotted users)
        $this->db->select('users.id, users.name, users.email, purplepremium_applications.status, premium_dashboard_data.id as dashboard_id');
        $this->db->from('users');
        $this->db->join('purplepremium_applications', 'users.id = purplepremium_applications.user_id', 'inner');
        $this->db->join('premium_dashboard_data', 'users.id = premium_dashboard_data.user_id', 'left');
        $this->db->where('purplepremium_applications.status', 'approved');
        if ($adminRole === 'mentor' && $mentorFieldExists) {
            $this->db->where('users.mentor_admin_id', $adminId);
        }
        $this->db->order_by('users.name', 'ASC');
        $data['premium_users'] = $this->db->get()->result();
        
        $this->load->view('premium_dashboard_list', $data);
    }
    
    public function manage_premium_dashboard()
    {
        $this->require_admin_login();

        $user_id = (int) $this->uri->segment(3);
        
        if (!$user_id) {
            $this->session->set_flashdata('error', 'Invalid user ID');
            redirect('Users/premium_dashboard_list');
        }

        // Mentors can manage dashboards only for their allotted users
        $this->require_allotted_user_access($user_id);
        
        // Check if user has approved premium
        $premium_check = $this->db->where('user_id', $user_id)
            ->where('status', 'approved')
            ->get('purplepremium_applications')
            ->row();
            
        if (!$premium_check) {
            $this->session->set_flashdata('error', 'User does not have approved premium access');
            redirect('Users/premium_dashboard_list');
        }
        
        // Get user info
        $data['user'] = $this->db->where('id', $user_id)->get('users')->row();
        
        // Get existing dashboard data
        $data['dashboard'] = $this->db->where('user_id', $user_id)->get('premium_dashboard_data')->row();
        
        // Get finalized universities (user's shortlist)
        $data['universities'] = $this->db->where('user_id', $user_id)
            ->order_by('display_order', 'ASC')
            ->get('premium_finalized_universities')
            ->result();
        // Master list for dropdown (choose from this only)
        $data['universities_list'] = [];
        if ($this->db->table_exists('universities')) {
            $data['universities_list'] = $this->db->order_by('name', 'ASC')->get('universities')->result();
        }
        
        // Comments and Review/Notes are loaded via AJAX when admin clicks the tab
        $data['comments'] = [];
        $data['review_queue_items'] = [];
        $data['counselor_notes'] = [];

        // Load Kanban cards once on initial page load so the board is immediately usable
        $kanban_cards = $this->db->where('user_id', $user_id)
            ->order_by('section', 'ASC')
            ->order_by('display_order', 'ASC')
            ->order_by('id', 'ASC')
            ->get('kanban_cards')
            ->result();

        $data['kanban_cards'] = [];
        foreach ($kanban_cards as $card) {
            $data['kanban_cards'][$card->section][] = $card;
        }
        
        $this->load->view('manage_premium_dashboard', $data);
    }
    
    /**
     * AJAX: Load Comments tab content (lazy-loaded when tab is shown).
     */
    public function ajax_tab_comments() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) ob_clean();
        
        if (!$this->session->userdata('user_id')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        $user_id = (int) $this->input->get_post('user_id');
        if (!$user_id) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid user ID']);
            exit;
        }
        
        $data['user'] = $this->db->where('id', $user_id)->get('users')->row();
        $data['comments'] = $this->db->where('user_id', $user_id)
            ->order_by('created_at', 'DESC')
            ->get('dashboard_comments')
            ->result();
        
        $html = $this->load->view('manage_premium_dashboard_tab_comments', $data, TRUE);
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'html' => $html,
            'comments_count' => count($data['comments'])
        ]);
        exit;
    }
    
    /**
     * AJAX: Load Review & Notes tab content (lazy-loaded when tab is shown).
     */
    public function ajax_tab_review_notes() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) ob_clean();
        
        if (!$this->session->userdata('user_id')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        $user_id = (int) $this->input->get_post('user_id');
        if (!$user_id) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid user ID']);
            exit;
        }
        
        $data['user'] = $this->db->where('id', $user_id)->get('users')->row();
        $data['review_queue_items'] = $this->db->where('user_id', $user_id)
            ->order_by('display_order', 'ASC')
            ->order_by('id', 'ASC')
            ->get('review_queue_items')
            ->result();
        $data['counselor_notes'] = $this->db->where('user_id', $user_id)
            ->order_by('display_order', 'ASC')
            ->order_by('created_at', 'DESC')
            ->get('counselor_notes')
            ->result();

        $data['important_alerts'] = [];
        if ($this->ensure_important_alerts_table()) {
            $data['important_alerts'] = $this->db->where('user_id', $user_id)
                ->order_by('display_order', 'ASC')
                ->order_by('id', 'ASC')
                ->limit(self::IMPORTANT_ALERTS_MAX)
                ->get('important_alerts')
                ->result();
        }
        $data['important_alerts_max'] = self::IMPORTANT_ALERTS_MAX;
        $data['important_alerts_max_words'] = self::IMPORTANT_ALERTS_MAX_WORDS;

        $html = $this->load->view('manage_premium_dashboard_tab_review_notes', $data, TRUE);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'html' => $html]);
        exit;
    }
    
    public function reply_to_comment() {
        $this->output->enable_profiler(FALSE);
        
        // Clear any previous output
        if (ob_get_level()) {
            ob_clean();
        }
        
        if (!$this->session->userdata('user_id')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        $comment_id = (int) $this->input->post('comment_id');
        $reply_text = trim($this->input->post('reply_text'));
        
        if (!$comment_id || empty($reply_text)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }
        
        // Check if comment exists
        $comment = $this->db->where('id', $comment_id)->get('dashboard_comments')->row();
        if (!$comment) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Comment not found']);
            exit;
        }
        
        // Update comment with admin reply
        $update_data = [
            'admin_reply' => $reply_text,
            'replied_by' => $this->session->userdata('user_id'),
            'replied_at' => date('Y-m-d H:i:s')
        ];
        
        $result = $this->db->where('id', $comment_id)->update('dashboard_comments', $update_data);
        
        if ($result) {
            $this->notification_service->notify_section((int) $comment->user_id, 'comments', 'Your comment has a new reply', $reply_text, 'dashboard_comment', $comment_id);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Reply added successfully']);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to add reply']);
            exit;
        }
    }
    
    public function save_premium_dashboard()
    {
        $user_id = (int) $this->input->post('user_id');
        
        if (!$user_id) {
            $this->session->set_flashdata('error', 'Invalid user ID');
            redirect('Users/premium_dashboard_list');
        }
        
        // Prepare onboarding checklist
        $checklist_items = $this->input->post('checklist_item') ?: [];
        $checklist_checks = $this->input->post('checklist_checkbox') ?: [];
        $onboarding_checklist = [];
        foreach($checklist_items as $index => $item) {
            // Check if this index has value "1" (checked)
            $is_checked = (isset($checklist_checks[$index]) && $checklist_checks[$index] == '1');
            $onboarding_checklist[] = [
                'text' => $item,
                'checked' => $is_checked
            ];
        }
        
        // Prepare feedback session items
        $feedback_texts = $this->input->post('feedback_item_text') ?: [];
        $feedback_checks = $this->input->post('feedback_checkbox') ?: [];
        $feedback_items = [];
        foreach($feedback_texts as $index => $text) {
            if(!empty(trim($text))) {
                // Check if this index has value "1" (checked)
                $is_checked = (isset($feedback_checks[$index]) && $feedback_checks[$index] == '1');
                $feedback_items[] = [
                    'text' => trim($text),
                    'checked' => $is_checked
                ];
            }
        }
        
        // Prepare documents tracker
        $doc_names = $this->input->post('doc_name') ?: [];
        $doc_counts = $this->input->post('doc_count') ?: [];
        $documents_tracker = [];
        foreach($doc_names as $index => $doc_name) {
            $doc_name_trimmed = trim($doc_name);
            if(!empty($doc_name_trimmed)) {
                $documents_tracker[$doc_name_trimmed] = [
                    'count' => isset($doc_counts[$index]) ? (int)$doc_counts[$index] : 0,
                    'is_red' => false // Always false since we removed the red toggle
                ];
            }
        }
        
        // Prepare uni shortlist
        $shortlist_names = $this->input->post('shortlist_name') ?: [];
        $shortlist_counts = $this->input->post('shortlist_count') ?: [];
        $uni_shortlist = [];
        foreach($shortlist_names as $index => $name) {
            if(!empty(trim($name))) {
                $uni_shortlist[] = [
                    'name' => trim($name),
                    'count' => isset($shortlist_counts[$index]) ? (int)$shortlist_counts[$index] : 0
                ];
            }
        }
        
        $beforeDashboard = $this->db->where('user_id', $user_id)->get('premium_dashboard_data')->row_array();
        // Snapshot the finalized list before it is deleted and rebuilt below, so
        // we can tell whether that section actually changed.
        $beforeUniversities = $this->premium_universities_snapshot($user_id);

        // Prepare dashboard data
        $dashboard_data = [
            'user_id' => $user_id,
            'uni_applied' => (int) $this->input->post('uni_applied'),
            'offers_received' => (int) $this->input->post('offers_received'),
            'tuition_receipt_uploaded' => $this->input->post('tuition_receipt_uploaded') ? 1 : 0,
            'visa_applied' => $this->input->post('visa_applied') ? 1 : 0,
            'finalized_uni_count' => (int) $this->input->post('finalized_uni_count'),
            'currently_working_on' => json_encode($this->input->post('currently_working_on') ?: []),
            'future_tasks' => json_encode($this->input->post('future_tasks') ?: []),
            'onboarding_percentage' => (int) $this->input->post('onboarding_percentage'),
            'onboarding_checklist' => json_encode($onboarding_checklist),
            'feedback_session_title' => $this->input->post('feedback_session_title') ?: 'June feedback session',
            'feedback_session_items' => json_encode($feedback_items),
            'documents_tracker' => json_encode($documents_tracker),
            'uni_shortlist' => json_encode($uni_shortlist)
        ];
        
        // Check if dashboard data exists
        $existing = $this->db->where('user_id', $user_id)->get('premium_dashboard_data')->row();
        
        if ($existing) {
            // Update
            $this->db->where('user_id', $user_id)->update('premium_dashboard_data', $dashboard_data);
        } else {
            // Insert
            $this->db->insert('premium_dashboard_data', $dashboard_data);
        }

        $afterDashboard = $this->db->where('user_id', $user_id)->get('premium_dashboard_data')->row_array();
        $dashboardChangeKeys = [
            'uni_applied',
            'offers_received',
            'tuition_receipt_uploaded',
            'visa_applied',
            'finalized_uni_count',
            'onboarding_percentage',
            'feedback_session_title',
        ];
        $dashboardChanges = [];
        foreach ($dashboardChangeKeys as $k) {
            $beforeVal = $beforeDashboard[$k] ?? null;
            $afterVal = $afterDashboard[$k] ?? null;
            if ((string) $beforeVal !== (string) $afterVal) {
                $dashboardChanges[$k] = ['before' => $beforeVal, 'after' => $afterVal];
            }
        }
        $this->audit_log(
            $user_id,
            'update',
            'premium_dashboard',
            $user_id,
            'Saved premium dashboard',
            ['premium_dashboard_data' => $dashboardChanges]
        );

        // Handle finalized universities: choose from master list (uni_id[]), optional image override
        $uni_ids = $this->input->post('uni_id');
        $existing_images = $this->input->post('existing_uni_image');
        
        $this->db->where('user_id', $user_id)->delete('premium_finalized_universities');
        
        if ($uni_ids && is_array($uni_ids) && $this->db->table_exists('universities')) {
            $upload_path = dirname(FCPATH) . '/assets/images/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, true);
            }
            
            foreach ($uni_ids as $index => $uni_id) {
                $uni_id = (int) $uni_id;
                if ($uni_id <= 0) continue;
                
                $master = $this->db->where('id', $uni_id)->get('universities')->row();
                if (!$master) continue;
                
                $image_filename = '';
                if (isset($_FILES['uni_image']['name'][$index]) && !empty($_FILES['uni_image']['name'][$index]) && $_FILES['uni_image']['error'][$index] == 0) {
                    $file_name = $_FILES['uni_image']['name'][$index];
                    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        $image_filename = rand(100, 10000) . time() . '.' . $extension;
                        $target_path = $upload_path . $image_filename;
                        if (move_uploaded_file($_FILES['uni_image']['tmp_name'][$index], $target_path)) {
                            // ok
                        } else {
                            $image_filename = '';
                        }
                    }
                }
                if (empty($image_filename) && isset($existing_images[$index]) && !empty($existing_images[$index])) {
                    $image_filename = $existing_images[$index];
                }
                if (empty($image_filename) && !empty($master->image)) {
                    $image_filename = $master->image;
                }
                
                $insert_data = [
                    'user_id' => $user_id,
                    'university_name' => $master->name,
                    'country' => $master->location ?: '',
                    'image' => $image_filename,
                    'display_order' => $index
                ];
                if ($this->db->field_exists('university_id', 'premium_finalized_universities')) {
                    $insert_data['university_id'] = $uni_id;
                }
                $this->db->insert('premium_finalized_universities', $insert_data);
            }
        }

        $this->notify_premium_dashboard_sections(
            $user_id,
            $beforeDashboard,
            $afterDashboard,
            $beforeUniversities,
            $this->premium_universities_snapshot($user_id)
        );

        $this->session->set_flashdata('success', 'Dashboard data saved successfully');
        redirect('Users/manage_premium_dashboard/' . $user_id);
    }

    /**
     * Comparable snapshot of a user's finalized university list.
     */
    private function premium_universities_snapshot($user_id)
    {
        if (!$this->db->table_exists('premium_finalized_universities')) {
            return [];
        }

        $rows = $this->db
            ->select('university_name, country, image')
            ->where('user_id', (int) $user_id)
            ->order_by('display_order', 'ASC')
            ->order_by('id', 'ASC')
            ->get('premium_finalized_universities')
            ->result_array();

        return $rows ?: [];
    }

    /**
     * Send one notification per premium dashboard section the admin actually
     * changed, so the student sees which part of their dashboard moved instead
     * of a single catch-all "dashboard updated" message.
     */
    private function notify_premium_dashboard_sections($user_id, $before, $after, $beforeUniversities, $afterUniversities)
    {
        // A first-time save has no "before" to diff against; announce the whole
        // dashboard once rather than every section at once.
        if (empty($before)) {
            $this->notification_service->notify_section(
                $user_id,
                'quick_dashboard_overview',
                'Your dashboard is ready',
                'Your counsellor has set up your dashboard.',
                'premium_dashboard',
                $user_id
            );
            return;
        }

        $changed = function (array $keys) use ($before, $after) {
            foreach ($keys as $key) {
                if ((string) ($before[$key] ?? '') !== (string) ($after[$key] ?? '')) {
                    return true;
                }
            }
            return false;
        };

        $sections = [
            [
                'section' => 'quick_dashboard_overview',
                'keys' => ['uni_applied', 'offers_received', 'tuition_receipt_uploaded', 'visa_applied'],
                'title' => 'Quick Dashboard Overview updated',
                'message' => 'Your applications, offers and visa status have new updates.',
            ],
            [
                'section' => 'currently_working_on',
                'keys' => ['currently_working_on'],
                'title' => 'Currently Working On updated',
                'message' => 'Your counsellor changed what you are working on right now.',
            ],
            [
                'section' => 'future_tasks',
                'keys' => ['future_tasks'],
                'title' => 'Future Task Preview updated',
                'message' => 'Your upcoming tasks have been updated.',
            ],
            [
                'section' => 'where_you_stand',
                'keys' => [
                    'onboarding_percentage',
                    'onboarding_checklist',
                    'feedback_session_title',
                    'feedback_session_items',
                    'documents_tracker',
                    'uni_shortlist',
                ],
                'title' => 'Where You Stand updated',
                'message' => 'Your onboarding progress, documents tracker or shortlist has been updated.',
            ],
        ];

        foreach ($sections as $section) {
            if ($changed($section['keys'])) {
                $this->notification_service->notify_section(
                    $user_id,
                    $section['section'],
                    $section['title'],
                    $section['message'],
                    'premium_dashboard',
                    $user_id
                );
            }
        }

        if ($beforeUniversities !== $afterUniversities) {
            $count = count($afterUniversities);
            $this->notification_service->notify_section(
                $user_id,
                'finalized_universities',
                'Finalized Universities updated',
                'Your finalized university list now has ' . $count . ' ' . ($count === 1 ? 'university' : 'universities') . '.',
                'premium_dashboard',
                $user_id
            );
        }
    }
    
    // Review Queue Management
    public function add_review_queue_item() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) {
            ob_clean();
        }
        
        if (!$this->session->userdata('user_id')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        $user_id = (int) $this->input->post('user_id');
        $item_text = trim($this->input->post('item_text'));
        
        if (!$user_id || empty($item_text)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }
        
        // Get max display_order
        $max_order = $this->db->select_max('display_order')
            ->where('user_id', $user_id)
            ->get('review_queue_items')
            ->row()->display_order;
        
        $data = [
            'user_id' => $user_id,
            'item_text' => $item_text,
            'is_checked' => 0,
            'display_order' => ($max_order ? $max_order + 1 : 0)
        ];
        
        $result = $this->db->insert('review_queue_items', $data);
        
        if ($result) {
            $reviewId = (int) $this->db->insert_id();
            $this->notification_service->notify_section($user_id, 'review_queue', 'Review queue updated', '"' . $item_text . '" was added to your review queue.', 'review_queue', $reviewId);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Item added successfully', 'id' => $reviewId]);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to add item']);
            exit;
        }
    }
    
    public function update_review_queue_item() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) {
            ob_clean();
        }
        
        if (!$this->session->userdata('user_id')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        $item_id = (int) $this->input->post('item_id');
        $item_text = trim($this->input->post('item_text'));
        $is_checked = (int) $this->input->post('is_checked');
        
        if (!$item_id) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }
        
        $update_data = [];
        if ($item_text !== null && $item_text !== '') {
            $update_data['item_text'] = $item_text;
        }
        if ($is_checked !== null) {
            $update_data['is_checked'] = $is_checked ? 1 : 0;
        }
        
        if (empty($update_data)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'No data to update']);
            exit;
        }
        
        $reviewItem = $this->db->select('user_id, item_text')->where('id', $item_id)->get('review_queue_items')->row();
        $result = $this->db->where('id', $item_id)->update('review_queue_items', $update_data);

        if ($result) {
            if ($reviewItem) {
                $label = $item_text !== '' ? $item_text : trim((string) $reviewItem->item_text);
                $this->notification_service->notify_section(
                    (int) $reviewItem->user_id,
                    'review_queue',
                    'Review queue updated',
                    $label !== '' ? '"' . $label . '" was updated in your review queue.' : 'An item in your review queue was updated.',
                    'review_queue',
                    $item_id
                );
            }
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Item updated successfully']);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to update item']);
            exit;
        }
    }
    
    public function delete_review_queue_item() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) {
            ob_clean();
        }
        
        if (!$this->session->userdata('user_id')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        $item_id = (int) $this->input->post('item_id');
        
        if (!$item_id) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }
        
        $reviewItem = $this->db->select('user_id, item_text')->where('id', $item_id)->get('review_queue_items')->row();
        $result = $this->db->where('id', $item_id)->delete('review_queue_items');

        if ($result) {
            if ($reviewItem) {
                $label = trim((string) $reviewItem->item_text);
                $this->notification_service->notify_section(
                    (int) $reviewItem->user_id,
                    'review_queue',
                    'Review queue updated',
                    $label !== '' ? '"' . $label . '" was removed from your review queue.' : 'An item was removed from your review queue.',
                    'review_queue',
                    $item_id
                );
            }
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Item deleted successfully']);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to delete item']);
            exit;
        }
    }
    
    // Important Alerts Management
    // Shown on the user's "Feed Track Progress" board. Capped at 3 alerts,
    // 12 words each, so the yellow alert box never overflows its fixed layout.
    const IMPORTANT_ALERTS_MAX      = 3;
    const IMPORTANT_ALERTS_MAX_WORDS = 12;

    private function ensure_important_alerts_table() {
        if ($this->db->table_exists('important_alerts')) {
            return true;
        }

        $table = $this->db->dbprefix('important_alerts');
        $sql = "CREATE TABLE IF NOT EXISTS `{$table}` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `user_id` int(11) unsigned NOT NULL,
            `alert_text` varchar(255) NOT NULL,
            `display_order` int(11) NOT NULL DEFAULT 0,
            `created_by` int(11) unsigned DEFAULT NULL,
            `created_at` datetime DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `user_order` (`user_id`, `display_order`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

        @$this->db->query($sql);
        return $this->db->table_exists('important_alerts');
    }

    private function important_alert_word_count($text) {
        return count(preg_split('/\s+/', trim($text), -1, PREG_SPLIT_NO_EMPTY));
    }

    public function add_important_alert() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) {
            ob_clean();
        }

        header('Content-Type: application/json');

        if (!$this->session->userdata('user_id')) {
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }

        $user_id    = (int) $this->input->post('user_id');
        $alert_text = trim($this->input->post('alert_text'));

        if (!$user_id || $alert_text === '') {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }

        if ($this->important_alert_word_count($alert_text) > self::IMPORTANT_ALERTS_MAX_WORDS) {
            echo json_encode(['success' => false, 'message' => 'Alert must be ' . self::IMPORTANT_ALERTS_MAX_WORDS . ' words or fewer']);
            exit;
        }

        if (!$this->ensure_important_alerts_table()) {
            echo json_encode(['success' => false, 'message' => 'Alerts storage unavailable']);
            exit;
        }

        $existing = $this->db->where('user_id', $user_id)->count_all_results('important_alerts');
        if ($existing >= self::IMPORTANT_ALERTS_MAX) {
            echo json_encode(['success' => false, 'message' => 'Only ' . self::IMPORTANT_ALERTS_MAX . ' alerts allowed. Delete one first.']);
            exit;
        }

        $max_order = $this->db->select_max('display_order')
            ->where('user_id', $user_id)
            ->get('important_alerts')
            ->row()->display_order;

        $data = [
            'user_id'       => $user_id,
            'alert_text'    => $alert_text,
            'display_order' => ($max_order === null ? 0 : $max_order + 1),
            'created_by'    => $this->session->userdata('user_id'),
            'created_at'    => date('Y-m-d H:i:s')
        ];

        if ($this->db->insert('important_alerts', $data)) {
            $alertId = (int) $this->db->insert_id();
            $this->notification_service->notify_section($user_id, 'important_alerts', 'Important alert added', 'A new important alert was added to your progress board.', 'important_alert', $alertId);
            echo json_encode([
                'success'   => true,
                'message'   => 'Alert added successfully',
                'id'        => $alertId,
                'remaining' => self::IMPORTANT_ALERTS_MAX - ($existing + 1)
            ]);
            exit;
        }

        echo json_encode(['success' => false, 'message' => 'Failed to add alert']);
        exit;
    }

    public function update_important_alert() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) {
            ob_clean();
        }

        header('Content-Type: application/json');

        if (!$this->session->userdata('user_id')) {
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }

        $alert_id   = (int) $this->input->post('alert_id');
        $alert_text = trim($this->input->post('alert_text'));

        if (!$alert_id || $alert_text === '') {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }

        if ($this->important_alert_word_count($alert_text) > self::IMPORTANT_ALERTS_MAX_WORDS) {
            echo json_encode(['success' => false, 'message' => 'Alert must be ' . self::IMPORTANT_ALERTS_MAX_WORDS . ' words or fewer']);
            exit;
        }

        if (!$this->ensure_important_alerts_table()) {
            echo json_encode(['success' => false, 'message' => 'Alerts storage unavailable']);
            exit;
        }

        $alert = $this->db->select('user_id')->where('id', $alert_id)->get('important_alerts')->row();

        if ($this->db->where('id', $alert_id)->update('important_alerts', ['alert_text' => $alert_text])) {
            if ($alert) {
                $this->notification_service->notify_section((int) $alert->user_id, 'important_alerts', 'Important alert updated', 'An important alert on your progress board was updated.', 'important_alert', $alert_id);
            }
            echo json_encode(['success' => true, 'message' => 'Alert updated successfully']);
            exit;
        }

        echo json_encode(['success' => false, 'message' => 'Failed to update alert']);
        exit;
    }

    public function delete_important_alert() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) {
            ob_clean();
        }

        header('Content-Type: application/json');

        if (!$this->session->userdata('user_id')) {
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }

        $alert_id = (int) $this->input->post('alert_id');

        if (!$alert_id) {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }

        if (!$this->ensure_important_alerts_table()) {
            echo json_encode(['success' => false, 'message' => 'Alerts storage unavailable']);
            exit;
        }

        $alert = $this->db->select('user_id')->where('id', $alert_id)->get('important_alerts')->row();

        if ($this->db->where('id', $alert_id)->delete('important_alerts')) {
            if ($alert) {
                $this->notification_service->notify_section((int) $alert->user_id, 'important_alerts', 'Important alert removed', 'An important alert was removed from your progress board.', 'important_alert', $alert_id);
            }
            echo json_encode(['success' => true, 'message' => 'Alert deleted successfully']);
            exit;
        }

        echo json_encode(['success' => false, 'message' => 'Failed to delete alert']);
        exit;
    }

    // Counselor Notes Management
    public function add_counselor_note() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) {
            ob_clean();
        }
        
        if (!$this->session->userdata('user_id')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        $user_id = (int) $this->input->post('user_id');
        $note_text = trim($this->input->post('note_text'));
        
        if (!$user_id || empty($note_text)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }
        
        // Get max display_order
        $max_order = $this->db->select_max('display_order')
            ->where('user_id', $user_id)
            ->get('counselor_notes')
            ->row()->display_order;
        
        $data = [
            'user_id' => $user_id,
            'note_text' => $note_text,
            'created_by' => $this->session->userdata('user_id'),
            'display_order' => ($max_order ? $max_order + 1 : 0)
        ];
        
        $result = $this->db->insert('counselor_notes', $data);
        
        if ($result) {
            $noteId = (int) $this->db->insert_id();
            $this->notification_service->notify_section($user_id, 'counselor_notes', 'Counsellor notes updated', 'A new counsellor note was added to your dashboard.', 'counselor_note', $noteId);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Note added successfully', 'id' => $noteId]);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to add note']);
            exit;
        }
    }
    
    public function update_counselor_note() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) {
            ob_clean();
        }
        
        if (!$this->session->userdata('user_id')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        $note_id = (int) $this->input->post('note_id');
        $note_text = trim($this->input->post('note_text'));
        
        if (!$note_id || empty($note_text)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }
        
        $note = $this->db->select('user_id')->where('id', $note_id)->get('counselor_notes')->row();
        $result = $this->db->where('id', $note_id)->update('counselor_notes', ['note_text' => $note_text]);
        
        if ($result) {
            if ($note) $this->notification_service->notify_section((int) $note->user_id, 'counselor_notes', 'Counsellor notes updated', 'A counsellor note on your dashboard was updated.', 'counselor_note', $note_id);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Note updated successfully']);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to update note']);
            exit;
        }
    }
    
    public function delete_counselor_note() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) {
            ob_clean();
        }
        
        if (!$this->session->userdata('user_id')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        $note_id = (int) $this->input->post('note_id');
        
        if (!$note_id) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }
        
        $note = $this->db->select('user_id')->where('id', $note_id)->get('counselor_notes')->row();
        $result = $this->db->where('id', $note_id)->delete('counselor_notes');
        
        if ($result) {
            if ($note) $this->notification_service->notify_section((int) $note->user_id, 'counselor_notes', 'Counsellor notes updated', 'A counsellor note was removed from your dashboard.', 'counselor_note', $note_id);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Note deleted successfully']);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to delete note']);
            exit;
        }
    }
    
    // Kanban Board Management
    public function add_kanban_card() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) {
            ob_clean();
        }
        
        if (!$this->session->userdata('user_id')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        $user_id = (int) $this->input->post('user_id');
        $section = trim($this->input->post('section'));
        $card_type = trim($this->input->post('card_type')) ?: '#4a90d9';
        $title = trim($this->input->post('title'));
        $description = trim($this->input->post('description'));
        $description_type = trim($this->input->post('description_type')) ?: 'text';
        $tag = trim($this->input->post('tag'));
        $image_url = trim($this->input->post('image_url'));
        
        if (!$user_id || !$section) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }
        
        // Get max display_order for this section
        $max_order = $this->db->select_max('display_order')
            ->where('user_id', $user_id)
            ->where('section', $section)
            ->get('kanban_cards')
            ->row()->display_order;
        
        $data = [
            'user_id' => $user_id,
            'section' => $section,
            'card_type' => $card_type,
            'title' => $title ?: null,
            'description' => $description ?: null,
            'description_type' => $description_type,
            'tag' => $tag ?: null,
            'image_url' => $image_url ?: null,
            'display_order' => ($max_order ? $max_order + 1 : 0)
        ];
        $data = array_merge($data, $this->kanban_stage_timestamp_updates($section));

        $result = $this->db->insert('kanban_cards', $data);
        
        if ($result) {
            $cardId = (int) $this->db->insert_id();
            $this->notification_service->notify_section($user_id, 'kanban', 'Kanban board updated', 'A new task was added to your Kanban board.', 'kanban_card', $cardId);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Card added successfully', 'id' => $cardId]);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to add card']);
            exit;
        }
    }
    
    public function update_kanban_card() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) {
            ob_clean();
        }
        
        if (!$this->session->userdata('user_id')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        $card_id = (int) $this->input->post('card_id');
        $section = trim($this->input->post('section'));
        $card_type = trim($this->input->post('card_type'));
        $title = trim($this->input->post('title'));
        $description = trim($this->input->post('description'));
        $description_type = trim($this->input->post('description_type'));
        $tag = trim($this->input->post('tag'));
        $image_url = trim($this->input->post('image_url'));
        
        if (!$card_id) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }
        
        $update_data = [];
        if ($section !== null && $section !== '') $update_data['section'] = $section;
        if ($card_type !== null && $card_type !== '') $update_data['card_type'] = $card_type;
        if ($title !== null) $update_data['title'] = $title ?: null;
        if ($description !== null) $update_data['description'] = $description ?: null;
        if ($description_type !== null && $description_type !== '') $update_data['description_type'] = $description_type;
        if ($tag !== null) $update_data['tag'] = $tag ?: null;
        if ($image_url !== null) $update_data['image_url'] = $image_url ?: null;

        $existing = $this->db->select('user_id, section, title')->from('kanban_cards')->where('id', $card_id)->limit(1)->get()->row();
        if (
            $existing
            && isset($update_data['section'])
            && (string) $existing->section !== (string) $update_data['section']
        ) {
            $update_data = array_merge($update_data, $this->kanban_stage_timestamp_updates((string) $update_data['section']));
        }
        
        if (empty($update_data)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'No data to update']);
            exit;
        }
        
        $result = $this->db->where('id', $card_id)->update('kanban_cards', $update_data);
        
        if ($result) {
            if ($existing) $this->notification_service->notify_section((int) $existing->user_id, 'kanban', 'Kanban board updated', 'A task on your Kanban board was updated.', 'kanban_card', $card_id);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Card updated successfully']);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to update card']);
            exit;
        }
    }
    
    public function delete_kanban_card() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) {
            ob_clean();
        }
        
        if (!$this->session->userdata('user_id')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        $card_id = (int) $this->input->post('card_id');
        
        if (!$card_id) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }
        
        $card = $this->db->select('user_id, title')->from('kanban_cards')->where('id', $card_id)->limit(1)->get()->row();
        $result = $this->db->where('id', $card_id)->delete('kanban_cards');
        
        if ($result) {
            if ($card) $this->notification_service->notify_section((int) $card->user_id, 'kanban', 'Kanban board updated', 'A task was removed from your Kanban board.', 'kanban_card', $card_id);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Card deleted successfully']);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to delete card']);
            exit;
        }
    }
    
    public function update_kanban_card_order() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) {
            ob_clean();
        }
        
        if (!$this->session->userdata('user_id')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        $card_id = (int) $this->input->post('card_id');
        $section = trim($this->input->post('section'));
        $display_order = (int) $this->input->post('display_order');
        
        if (!$card_id || !$section) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }

        $row = $this->db->select('id, user_id, section')->from('kanban_cards')->where('id', $card_id)->limit(1)->get()->row();
        if (!$row) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Card not found']);
            exit;
        }

        $update = [
            'section' => $section,
            'display_order' => $display_order,
        ];
        if ((string) $row->section !== (string) $section) {
            $update = array_merge($update, $this->kanban_stage_timestamp_updates($section));
        }

        $result = $this->db->where('id', $card_id)->update('kanban_cards', $update);
        
        if ($result) {
            $this->notification_service->notify_section((int) $row->user_id, 'kanban', 'Kanban board updated', 'A task was moved on your Kanban board.', 'kanban_card', $card_id);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Card order updated successfully']);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to update card order']);
            exit;
        }
    }
    
    // Fetch Kanban Board HTML for AJAX reload
    public function fetch_kanban_board() {
        $this->output->enable_profiler(FALSE);
        if (ob_get_level()) {
            ob_clean();
        }
        
        if (!$this->session->userdata('user_id')) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        $user_id = (int) $this->input->post('user_id');
        
        if (!$user_id) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid user ID']);
            exit;
        }
        
        // Get kanban cards grouped by section
        $kanban_cards = $this->db->where('user_id', $user_id)
            ->order_by('section', 'ASC')
            ->order_by('display_order', 'ASC')
            ->order_by('id', 'ASC')
            ->get('kanban_cards')
            ->result();
        
        $data['kanban_cards'] = [];
        foreach($kanban_cards as $card) {
            $data['kanban_cards'][$card->section][] = $card;
        }
        
        // Load the kanban board partial view
        $html = $this->load->view('kanban_board_partial', $data, TRUE);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'html' => $html]);
        exit;
    }
}

    
