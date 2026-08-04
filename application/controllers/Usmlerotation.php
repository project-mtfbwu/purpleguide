<?php
Class Usmlerotation extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper('events');
    }
    public function index(){
        $data['upcoming_events'] = $this->_get_upcoming_events();
        $data['picks_courses'] = $this->_get_picks_courses();
        $data['courses'] = $this->_get_courses();
        $data['saved_course_ids'] = $this->_get_saved_course_ids();
        $data['logged_in'] = (bool) $this->session->userdata('user_id');
        $this->load->view('usmlerotation', $data);
    }
    private function _get_courses() {
        if (!$this->db->table_exists('courses_tbl')) return [];
        return $this->db
            ->select('courses_tbl.*, course_category_tbl.category_name')
            ->from('courses_tbl')
            ->join('course_category_tbl', 'course_category_tbl.id = courses_tbl.cat_id', 'left')
            ->where('courses_tbl.block_status', 0)
            ->order_by('courses_tbl.id', 'DESC')
            ->get()
            ->result();
    }
    private function _get_saved_course_ids() {
        $ids = [];
        $user_id = $this->session->userdata('user_id');
        if (!$user_id || !$this->db->table_exists('user_saved_courses')) return $ids;
        $saved = $this->db->select('course_id')->where('user_id', $user_id)->get('user_saved_courses')->result();
        foreach ($saved as $s) {
            $ids[] = (int) $s->course_id;
        }
        return $ids;
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
    private function _get_upcoming_events() {
        if (!$this->db->table_exists('event_tbl')) return [];
        return $this->db
            ->select('event_tbl.*, event_category_tbl.category_name')
            ->from('event_tbl')
            ->join('event_category_tbl', 'event_category_tbl.id = event_tbl.cat_id', 'left')
            ->where('event_tbl.block_status', 0)
            ->where('event_tbl.s_date >=', date('Y-m-d'))
            ->order_by('event_tbl.s_date', 'ASC')
            ->get()
            ->result();
    }
}

    
