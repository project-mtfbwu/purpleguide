<?php
Class Simplehome extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('events');
        
    }
    public function index(){
        $data = ['premium_status' => null];
        if ($this->session->userdata('logged_in')) {
            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->db->where('id', $user_id)->get('users')->row();
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
        }
        $data['study_journey_options'] = $this->_study_journey_options();
        $data['upcoming_events'] = $this->_get_upcoming_events();
        $data['picks_courses'] = $this->_get_picks_courses();
        $this->load->view('simplehome', $data);
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
    /**
     * Upcoming events (s_date >= today). If none, fall back to latest events so at least 1 shows from table.
     */
    private function _get_upcoming_events() {
        if (!$this->db->table_exists('event_tbl')) return [];
        $today = date('Y-m-d');
        $query = $this->db
            ->select('event_tbl.*, event_category_tbl.category_name')
            ->from('event_tbl')
            ->join('event_category_tbl', 'event_category_tbl.id = event_tbl.cat_id', 'left')
            ->where('event_tbl.block_status', 0)
            ->where('event_tbl.s_date >=', $today)
            ->order_by('event_tbl.s_date', 'ASC')
            ->get();
        $rows = $query->result();
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
}

    
