<?php
Class About extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }
    public function index(){
        $data = [
            'founder'        => null,
            'advisory_team'  => [],
        ];

        if ($this->db->table_exists('founder_tbl')) {
            $data['founder'] = $this->db->order_by('id', 'ASC')->get('founder_tbl')->row();
        }

        if ($this->db->table_exists('advisory_team_tbl')) {
            $data['advisory_team'] = $this->db->where('block_status', 0)
                ->order_by('display_order', 'ASC')
                ->order_by('id', 'ASC')
                ->get('advisory_team_tbl')
                ->result();
        }

        $this->load->view('about', $data);
    }
}
