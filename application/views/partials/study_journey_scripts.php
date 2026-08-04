<?php
Class Home extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');     
        $this->load->library('form_validation');   
        $this->load->helper('events');
    }

    private function resolve_user_avatar_url($user_row) {
        $fallback = base_url('assets/img/default-avatar.png');
        if (!$user_row || !isset($user_row->image1)) {
            return $fallback;
        }

        $img = trim((string) $user_row->image1);
        if ($img === '') {
            return $fallback;
        }
        if (preg_match('#^https?://#i', $img)) {
            return $img;
        }

        $img = str_replace('\\', '/', $img);
        $img = ltrim($img, '/');
        if (stripos($img, 'assets/images/') === 0) {
            return base_url($img);
        }
        return base_url('assets/images/' . $img);
    }

    private function home_view_data() {
        $data = [
            'study_journey_options' => $this->_study_journey_options(),
            'home_events' => $this->_get_home_events(),
            'picks_courses' => $this->_get_picks_courses(),
            'user' => null,
            'premium_status' => null,
            'user_avatar_url' => base_url('assets/img/default-avatar.png'),
        ];

        if (!$this->session->userdata('logged_in')) {
            return $data;
        }

        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            return $data;
        }

        $data['user'] = $this->db->where('id', $user_id)->get('users')->row();
        $data['user_avatar_url'] = $this->resolve_user_avatar_url($data['user']);

        $premium_app = $this->db->where('user_id', $user_id)->get('purplepremium_applications')->row();
        if ($premium_app && $premium_app->status === 'approved') {
            $data['premium_status'] = 'approved';
        } elseif ($premium_app && $premium_app->status === 'pending') {
            $data['premium_status'] = 'pending';
        } elseif ($premium_app) {
            $data['premium_status'] = 'rejected';
        } else {
            $data['premium_status'] = 'none';
        }

        return $data;
    }

    public function index(){
       $data = $this->home_view_data();
       $this->load->view('home', $data);
    }

    private function _get_home_events() {
        if (!$this->db->table_exists('event_tbl')) return [];
        $today = date('Y-m-d');
        $rows = $this->db
            ->select('event_tbl.*, event_category_tbl.category_name')
            ->from('event_tbl')
            ->join('event_category_tbl', 'event_category_tbl.id = event_tbl.cat_id', 'left')
            ->where('event_tbl.block_status', 0)
            ->where('event_tbl.s_date >=', $today)
            ->order_by('event_tbl.s_date', 'ASC')
            ->get()
            ->result();

        if (!empty($rows)) return $rows;

        return $this->db
            ->select('event_tbl.*, event_category_tbl.category_name')
            ->from('event_tbl')
            ->join('event_category_tbl', 'event_category_tbl.id = event_tbl.cat_id', 'left')
            ->where('event_tbl.block_status', 0)
            ->order_by('event_tbl.s_date', 'DESC')
            ->limit(10)
            ->get()
            ->result();
    }

    private function _get_picks_courses() {
        if (!$this->db->table_exists('courses_tbl')) return [];
        $col = $this->db->query("SHOW COLUMNS FROM `courses_tbl` LIKE 'show_in_picks'")->num_rows();
        if (!$col) return [];
        return $this->db
            ->select('id, product_name, prod_sub_name, description, image1, product_slug')
            ->where('show_in_picks', 1)
            ->where('block_status', 0)
            ->get('courses_tbl')
            ->result();
    }

    private function _study_journey_options(){
        return [
            'youare' => ['Parent', 'Student', 'Mentor'],
            'medical1' => ['USMLE', 'AMC', 'PLAB'],
            'masters' => ['MBA', 'STEM', 'Law', 'CSE', 'Others'],
            'undergrad' => ['Business', 'STEM', 'Law', 'Others'],
            'medical2' => ['Specialities', 'Physiotherapy', 'Nursing', 'Others'],
            'country' => ['Done a bit', 'I am doing as a group', 'I am starting my journey'],
            'medicalpath' => ['1st or 2nd Year', '3rd to Final Year', 'Internship', 'Working', 'Others'],
            'masterpath' => ['Studying', 'Graduated', 'Working', 'Others'],
            'undergradpath' => ['12th', '11th', '10th or less'],
            'plan' => ['2025', '2026', '2027', 'Guide me in choosing my intake schedule'],
            'countries' => ['USA', 'UK', 'CANADA', 'AUSTRALIA', 'NEW ZEALAND', 'EUROPE', 'Not sure yet - need help deciding'],
        ];
    }

    public function submit_study_journey(){
        $this->output->set_content_type('application/json');

        if (strtolower($this->input->method()) !== 'post') {
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Invalid request method.'
            ]));
            return;
        }

        if (!$this->_ensure_study_journey_table()) {
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => 'Form submission is temporarily unavailable. Please try again later.'
            ]));
            return;
        }

        $this->form_validation->set_error_delimiters('', "\n");
        $this->form_validation->set_rules('youare', 'You are', 'required|trim|callback_valid_study_journey_choice[youare]');
        $this->form_validation->set_rules('medical1', 'Medical Path', 'required|trim|callback_valid_study_journey_choice[medical1]');
        $this->form_validation->set_rules('masters', 'Masters Path', 'required|trim|callback_valid_study_journey_choice[masters]');
        $this->form_validation->set_rules('undergrad', 'Undergrad Path', 'required|trim|callback_valid_study_journey_choice[undergrad]');
        $this->form_validation->set_rules('medical2', 'Medical Path 2', 'required|trim|callback_valid_study_journey_choice[medical2]');
        $this->form_validation->set_rules('country', 'Current Journey Step', 'required|trim|callback_valid_study_journey_choice[country]');
        $this->form_validation->set_rules('medicalpath', 'Current Medical Path', 'required|trim|callback_valid_study_journey_choice[medicalpath]');
        $this->form_validation->set_rules('masterpath', 'Current Masters Path', 'required|trim|callback_valid_study_journey_choice[masterpath]');
        $this->form_validation->set_rules('undergradpath', 'Current Undergrad Path', 'required|trim|callback_valid_study_journey_choice[undergradpath]');
        $this->form_validation->set_rules('plan', 'Intake Year', 'required|trim|callback_valid_study_journey_choice[plan]');
        $this->form_validation->set_rules('countries', 'Country', 'required|trim|callback_valid_study_journey_choice[countries]');
        $this->form_validation->set_rules('name', 'Your Name', 'required|trim|min_length[2]|max_length[120]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|max_length[180]');
        $this->form_validation->set_rules('number', 'Phone No.', 'required|trim|regex_match[/^[0-9]{7,15}$/]', [
            'regex_match' => 'Please enter a valid phone number.'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode([
                'success' => false,
                'message' => trim(strip_tags(validation_errors()))
            ]));
            return;
        }

        $data = [
            'you_are' => $this->input->post('youare', true),
            'medical_path' => $this->input->post('medical1', true),
            'masters_path' => $this->input->post('masters', true),
            'undergrad_path' => $this->input->post('undergrad', true),
            'medical_path_2' => $this->input->post('medical2', true),
            'current_journey_step' => $this->input->post('country', true),
            'current_medical_path' => $this->input->post('medicalpath', true),
            'current_masters_path' => $this->input->post('masterpath', true),
            'current_undergrad_path' => $this->input->post('undergradpath', true),
            'intake_year' => $this->input->post('plan', true),
            'preferred_country' => $this->input->post('countries', true),
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'phone' => $this->input->post('number', true),
            'ip_address' => $this->input->ip_address(),
            'user_agent' => substr((string) $this->input->user_agent(), 0, 255),
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->db->insert('study_journey_enquiries', $data)) {
            $this->output->set_output(json_encode([
                'success' => true,
                'message' => 'Thank you! Your study abroad journey details have been submitted successfully.'
            ]));
            return;
        }

        $this->output->set_output(json_encode([
            'success' => false,
            'message' => 'Unable to submit your details right now. Please try again.'
        ]));
    }

    public function valid_study_journey_choice($value, $field){
        $options = $this->_study_journey_options();
        if (!isset($options[$field]) || !in_array($value, $options[$field], true)) {
            $this->form_validation->set_message('valid_study_journey_choice', 'Please select a valid {field}.');
            return false;
        }
        return true;
    }

    private function _ensure_study_journey_table(){
        if ($this->db->table_exists('study_journey_enquiries')) {
            return true;
        }

        $table = $this->db->dbprefix('study_journey_enquiries');
        $sql = "CREATE TABLE IF NOT EXISTS `{$table}` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `you_are` varchar(30) NOT NULL,
            `medical_path` varchar(60) NOT NULL,
            `masters_path` varchar(60) NOT NULL,
            `undergrad_path` varchar(60) NOT NULL,
            `medical_path_2` varchar(80) NOT NULL,
            `current_journey_step` varchar(120) NOT NULL,
            `current_medical_path` varchar(80) NOT NULL,
            `current_masters_path` varchar(80) NOT NULL,
            `current_undergrad_path` varchar(80) NOT NULL,
            `intake_year` varchar(80) NOT NULL,
            `preferred_country` varchar(120) NOT NULL,
            `name` varchar(120) NOT NULL,
            `email` varchar(180) NOT NULL,
            `phone` varchar(20) NOT NULL,
            `ip_address` varchar(45) DEFAULT NULL,
            `user_agent` varchar(255) DEFAULT NULL,
            `created_at` datetime NOT NULL,
            PRIMARY KEY (`id`),
            KEY `email` (`email`),
            KEY `phone` (`phone`),
            KEY `created_at` (`created_at`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

        @$this->db->query($sql);
        return $this->db->table_exists('study_journey_enquiries');
    }

    public function user_dashboard(){
        if (!$this->session->userdata('logged_in')) {
            redirect('Login');
        }
        
        $user_id = $this->session->userdata('user_id');
        
        $premium_app = $this->db->where('user_id', $user_id)->get('purplepremium_applications')->row();
        
        if ($premium_app && $premium_app->status == 'approved') {
            redirect('Dashboard');
        }
        
        $data['user'] = $this->db->where('id', $user_id)->get('users')->row();
        
        if ($premium_app) {
            if ($premium_app->status == 'pending') {
                $data['premium_status'] = 'pending';
            } else {
                $data['premium_status'] = 'rejected';
            }
        } else {
            $data['premium_status'] = 'none';
        }
        
        $this->load->view('user_dashboard', $data);
    }
    
    public function user_profile(){
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Please log in to view your profile.');
            redirect('Login');
        }

        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->where('id', $user_id)->get('users')->row();

        if (!$data['user']) {
            $this->session->set_flashdata('error', 'User not found.');
            redirect('Home/user_dashboard');
        }

        $premium_app = $this->db->where('user_id', $user_id)->get('purplepremium_applications')->row();

        if ($premium_app && $premium_app->status == 'approved') {
            $data['premium_status'] = 'approved';
        } elseif ($premium_app && $premium_app->status == 'pending') {
            $data['premium_status'] = 'pending';
        } elseif ($premium_app) {
            $data['premium_status'] = 'rejected';
        } else {
            $data['premium_status'] = 'none';
        }

        $data['dial_codes'] = $this->db->table_exists('dial_code') ? $this->db->get('dial_code')->result() : [];
        $data['countries'] = $this->db->table_exists('country_list') ? $this->db->get('country_list')->result() : [];

        $this->load->view('userprofile', $data);
    }

    public function update_profile(){
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Please log in to update your profile.');
            redirect('Login');
        }

        $user_id = (int) $this->session->userdata('user_id');

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim|max_length[255]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|max_length[255]');
        $this->form_validation->set_rules('dial_code', 'Dial Code', 'trim');
        $this->form_validation->set_rules('number', 'Phone Number', 'trim|max_length[20]');
        $this->form_validation->set_rules('whatsapp', 'WhatsApp', 'trim');
        $this->form_validation->set_rules('country_code', 'Country of Citizenship', 'trim');
        $this->form_validation->set_rules('preferred_country_code', 'Preferred Study Country', 'trim');
        $this->form_validation->set_rules('study_level', 'Study Level', 'trim');
        $this->form_validation->set_rules('field_interest', 'Field of Interest', 'trim');
        $this->form_validation->set_rules('work_experience', 'Work Experience', 'trim');
        $this->form_validation->set_rules('referral_code', 'Referral Code', 'trim');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Home/user_profile');
            return;
        }

        $email = $this->input->post('email');
        $existing = $this->db->where('email', $email)->where('id !=', $user_id)->get('users')->row();

        if ($existing) {
            $this->session->set_flashdata('error', 'This email is already used by another account.');
            redirect('Home/user_profile');
            return;
        }

        $update_data = [
            'name' => $this->input->post('name'),
            'email' => $email,
            'dial_code' => $this->input->post('dial_code') ?: null,
            'number' => $this->input->post('number') ?: null,
            'whatsapp' => $this->input->post('whatsapp') ?: null,
            'country_code' => $this->input->post('country_code') ?: null,
            'preferred_country_code' => $this->input->post('preferred_country_code') ?: null,
            'study_level' => $this->input->post('study_level') ?: null,
            'field_interest' => $this->input->post('field_interest') ?: null,
            'work_experience' => $this->input->post('work_experience') ?: null,
            'referral_code' => $this->input->post('referral_code') ?: null,
        ];

        $image1 = $this->User_model->file_upload('profile_image', 'assets/images/');

        if ($image1) {
            $update_data['image1'] = $image1;
        }

        $this->db->where('id', $user_id)->update('users', $update_data);
        $this->session->set_userdata('name', $update_data['name']);
        $this->session->set_flashdata('success', 'Profile updated successfully.');

        redirect('Home/user_profile');
    }
    
    public function apply_purplepremium() {
        $this->output->enable_profiler(FALSE);
        
        if (!$this->session->userdata('logged_in')) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Please login first']));
            return;
        }
        
        $user_id = $this->session->userdata('user_id');
        
        $existing_app = $this->db->where('user_id', $user_id)->get('purplepremium_applications')->row();
        
        if ($existing_app) {
            if ($existing_app->status == 'approved') {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['success' => false, 'message' => 'You already have full access']));
                return;
            } else if ($existing_app->status == 'pending') {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['success' => false, 'message' => 'Your application is already pending']));
                return;
            } else {
                $update_result = $this->db->where('id', $existing_app->id)->update('purplepremium_applications', [
                    'status' => 'pending',
                    'applied_at' => date('Y-m-d H:i:s')
                ]);
                
                if ($update_result) {
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(['success' => true, 'message' => 'Application submitted successfully']));
                } else {
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(['success' => false, 'message' => 'Failed to update application']));
                }

                return;
            }
        }
        
        $application_data = [
            'user_id' => $user_id,
            'status' => 'pending',
            'applied_at' => date('Y-m-d H:i:s')
        ];
        
        $result = $this->db->insert('purplepremium_applications', $application_data);
        
        if ($result) {
            $insert_id = $this->db->insert_id();

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => true, 
                    'message' => 'Application submitted successfully',
                    'application_id' => $insert_id
                ]));
        } else {
            $error = $this->db->error();
            $error_msg = 'Failed to submit application';
            
            if (!empty($error['code']) && $error['code'] == 1146) {
                $error_msg = 'Database table not found. Please contact administrator.';
            } else if (!empty($error['message'])) {
                $error_msg .= ': ' . $error['message'];
            }
            
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => $error_msg]));
        }
    }

    public function purplepremium_overview()
    {
        $data = $this->home_view_data();

        // Dynamic hero video managed from admin (Premium_video).
        $data['premium_video'] = null;
        if ($this->db->table_exists('premium_video')) {
            $data['premium_video'] = $this->db
                ->order_by('id', 'ASC')
                ->limit(1)
                ->get('premium_video')
                ->row();
        }

        $this->load->view('purplepremiumhome_1', $data);
    }
    
    public function defaultDashboard(){
       $data = $this->home_view_data();
       $this->load->view('user_dashboard', $data);
    }
}