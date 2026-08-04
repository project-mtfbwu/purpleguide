<?php
Class Explorecountries extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');     
        $this->load->library('form_validation');   
        $this->load->helper('events');
    }
    public function index(){
       $data['picks_courses'] = $this->_get_picks_courses();
       $this->load->view('explorecountries', $data);
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
}

    
