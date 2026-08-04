<?php
Class Dashboard extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');     
        $this->load->library('form_validation');
        $this->load->helper('events');
        
        // Ensure session is loaded
        $this->load->library('session');
        
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            // Clear any partial session data
            $this->session->set_flashdata('error', 'Please login to continue');
            redirect('Login');
        }
        
        // Update last activity to keep session alive
        $this->session->set_userdata('last_activity', time());
    }
    public function index(){
        // Ensure session is still valid
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Your session has expired. Please login again.');
            redirect('Login');
        }
        
        // Get user data from session
        $user_id = $this->session->userdata('user_id');
        
        if (!$user_id) {
            $this->session->set_flashdata('error', 'Session data missing. Please login again.');
            redirect('Login');
        }
        
        // Fetch complete user data from database
        $data['user'] = $this->db->where('id', $user_id)->get('users')->row();
        
        if (!$data['user']) {
            $this->session->set_flashdata('error', 'User not found.');
            redirect('Login');
        }
        
        // Update last activity to keep session alive
        $this->session->set_userdata('last_activity', time());
        
        // Check if user has premium access (approved status)
        $premium_app = $this->db->where('user_id', $user_id)->get('purplepremium_applications')->row();
        if (!$premium_app || $premium_app->status != 'approved') {
            // User doesn't have full access - redirect to user_dashboard
            $this->session->set_flashdata('error', 'Full access not allotted. Please apply for PurplePremium.');
            redirect('Home/user_dashboard');
        }
        
        // Fetch dashboard data
        $data['dashboard'] = $this->db->where('user_id', $user_id)->get('premium_dashboard_data')->row();
        
        // Fetch finalized universities. Join the master universities table (when linked)
        // so the latest admin-managed logo/image is reflected here dynamically, even if the
        // university was finalized before an image was uploaded.
        $this->db->select('premium_finalized_universities.*');
        if ($this->db->table_exists('universities')
            && $this->db->field_exists('university_id', 'premium_finalized_universities')) {
            $this->db->select('uni_master.image AS master_image');
            $this->db->join('universities uni_master', 'uni_master.id = premium_finalized_universities.university_id', 'left');
        }
        $data['universities'] = $this->db->where('premium_finalized_universities.user_id', $user_id)
            ->order_by('premium_finalized_universities.display_order', 'ASC')
            ->get('premium_finalized_universities')
            ->result();
        
        // Parse JSON arrays for tasks and Where You Stand data
        if ($data['dashboard']) {
            $data['currently_working_on'] = json_decode($data['dashboard']->currently_working_on, true) ?: [];
            $data['future_tasks'] = json_decode($data['dashboard']->future_tasks, true) ?: [];
            $data['onboarding_checklist'] = json_decode($data['dashboard']->onboarding_checklist, true) ?: [];
            $data['feedback_session_items'] = json_decode($data['dashboard']->feedback_session_items, true) ?: [];
            $data['documents_tracker'] = json_decode($data['dashboard']->documents_tracker, true) ?: [];
            $data['uni_shortlist'] = json_decode($data['dashboard']->uni_shortlist, true) ?: [];
        } else {
            $data['currently_working_on'] = [];
            $data['future_tasks'] = [];
            $data['onboarding_checklist'] = [];
            $data['feedback_session_items'] = [];
            $data['documents_tracker'] = [];
            $data['uni_shortlist'] = [];
        }
        
        // Fetch comments for this user
        $data['comments'] = $this->db->where('user_id', $user_id)
            ->order_by('created_at', 'DESC')
            ->get('dashboard_comments')
            ->result();

        $data['events'] = $this->_get_upcoming_events();
        $data['top_pick_courses'] = $this->_get_top_pick_courses();
        
        $this->load->view('dashboard', $data);
    }

    private function _get_upcoming_events() {
        if (!$this->db->table_exists('event_tbl')) return [];

        $today = date('Y-m-d');
        $events = $this->db
            ->select('event_tbl.*, event_category_tbl.category_name')
            ->from('event_tbl')
            ->join('event_category_tbl', 'event_category_tbl.id = event_tbl.cat_id', 'left')
            ->where('event_tbl.block_status', 0)
            ->where('event_tbl.s_date >=', $today)
            ->order_by('event_tbl.s_date', 'ASC')
            ->get()
            ->result();

        if (!empty($events)) return $events;

        return $this->db
            ->select('event_tbl.*, event_category_tbl.category_name')
            ->from('event_tbl')
            ->join('event_category_tbl', 'event_category_tbl.id = event_tbl.cat_id', 'left')
            ->where('event_tbl.block_status', 0)
            ->order_by('event_tbl.s_date', 'DESC')
            ->get()
            ->result();
    }

    private function _get_top_pick_courses() {
        if (!$this->db->table_exists('courses_tbl')) return [];

        if ($this->db->field_exists('show_in_picks', 'courses_tbl')) {
            $picked_rows = $this->db
                ->select('courses_tbl.*, course_category_tbl.category_name')
                ->from('courses_tbl')
                ->join('course_category_tbl', 'course_category_tbl.id = courses_tbl.cat_id', 'left')
                ->where('courses_tbl.block_status', 0)
                ->where('courses_tbl.show_in_picks', 1)
                ->order_by('courses_tbl.id', 'DESC')
                ->limit(5)
                ->get()
                ->result();

            if (!empty($picked_rows)) {
                return $picked_rows;
            }
        }

        return $this->db
            ->select('courses_tbl.*, course_category_tbl.category_name')
            ->from('courses_tbl')
            ->join('course_category_tbl', 'course_category_tbl.id = courses_tbl.cat_id', 'left')
            ->where('courses_tbl.block_status', 0)
            ->order_by('courses_tbl.id', 'DESC')
            ->limit(5)
            ->get()
            ->result();
    }
    
    public function add_comment() {
        $this->output->enable_profiler(FALSE);
        
        // Clear any previous output
        if (ob_get_level()) {
            ob_clean();
        }
        
        $user_id = $this->session->userdata('user_id');
        
        if (!$user_id) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        $comment_text = trim($this->input->post('comment_text'));
        
        if (empty($comment_text)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Comment cannot be empty']);
            exit;
        }
        
        // Insert comment
        $comment_data = [
            'user_id' => $user_id,
            'comment_text' => $comment_text
        ];
        
        $insert_result = $this->db->insert('dashboard_comments', $comment_data);
        
        if ($insert_result) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true, 
                'message' => 'Comment added successfully',
                'comment_id' => $this->db->insert_id()
            ]);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to add comment']);
            exit;
        }
    }
    
    public function get_comments() {
        $this->output->enable_profiler(FALSE);
        
        // Clear any previous output
        if (ob_get_level()) {
            ob_clean();
        }
        
        $user_id = $this->session->userdata('user_id');
        
        if (!$user_id) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Please login first']);
            exit;
        }
        
        // Fetch comments
        $comments = $this->db->where('user_id', $user_id)
            ->order_by('created_at', 'DESC')
            ->get('dashboard_comments')
            ->result();
        
        // Format comments for JSON response
        $formatted_comments = [];
        foreach ($comments as $comment) {
            $formatted_comments[] = [
                'id' => $comment->id,
                'comment_text' => $comment->comment_text,
                'admin_reply' => $comment->admin_reply,
                'created_at' => $comment->created_at,
                'replied_at' => $comment->replied_at,
                'has_reply' => !empty($comment->admin_reply)
            ];
        }
        
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'comments' => $formatted_comments]);
        exit;
    }
}

    
