<?php
Class Purpleboard extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['courses'] = [];
        $data['saved_course_ids'] = [];
        $data['weekly_wall'] = [];
        $data['logged_in'] = (bool) $this->session->userdata('user_id');

        if ($this->db->table_exists('courses_tbl')) {
            $data['courses'] = $this->db
                ->select('courses_tbl.*, course_category_tbl.category_name')
                ->from('courses_tbl')
                ->join('course_category_tbl', 'course_category_tbl.id = courses_tbl.cat_id', 'left')
                ->where('courses_tbl.block_status', 0)
                ->order_by('courses_tbl.id', 'DESC')
                ->get()
                ->result();
        }

        if ($this->db->table_exists('weekly_wall_tbl')) {
            $data['weekly_wall'] = $this->db
                ->select('id, product_name, description, image1')
                ->from('weekly_wall_tbl')
                ->where('block_status', 0)
                ->order_by('id', 'DESC')
                ->get()
                ->result();
        }
        $user_id = $this->session->userdata('user_id');
        if ($user_id && $this->db->table_exists('user_saved_courses')) {
            $saved = $this->db->select('course_id')->where('user_id', $user_id)->get('user_saved_courses')->result();
            foreach ($saved as $s) {
                $data['saved_course_ids'][] = (int) $s->course_id;
            }
        }

        $this->load->view('purpleboard', $data);
    }

}

    