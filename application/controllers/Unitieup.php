<?php
Class Unitieup extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper('events');
    }
    public function index(){
        $data['upcoming_events'] = $this->_get_upcoming_events();

        // Load active courses for the course cards.
        $data['courses'] = [];

        if ($this->db->table_exists('courses_tbl')) {
            $all_courses = $this->db
                ->select('courses_tbl.*, course_category_tbl.category_name')
                ->from('courses_tbl')
                ->join('course_category_tbl', 'course_category_tbl.id = courses_tbl.cat_id', 'left')
                ->where('courses_tbl.block_status', 0)
                ->order_by('courses_tbl.id', 'DESC')
                ->get()
                ->result();

            // Show only active courses: drop any whose closing date (e_date) has passed.
            $data['courses'] = array_values(array_filter($all_courses, function ($c) {
                $e_ts = !empty($c->e_date) ? strtotime($c->e_date) : 0;
                return !($e_ts > 0 && $e_ts < time());
            }));
        }

        $this->load->view('unitieup', $data);
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

    
