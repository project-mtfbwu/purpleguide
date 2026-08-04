<?php
Class Countriesfrance extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }
    public function index(){
       $data['premium_status'] = 'none';
       $user_id = $this->session->userdata('user_id');

       if ($this->session->userdata('logged_in') && $user_id) {
           $premium_app = $this->db
               ->where('user_id', $user_id)
               ->get('purplepremium_applications')
               ->row();

           if ($premium_app && $premium_app->status === 'approved') {
               $data['premium_status'] = 'approved';
           } elseif ($premium_app && $premium_app->status === 'pending') {
               $data['premium_status'] = 'pending';
           } elseif ($premium_app) {
               $data['premium_status'] = 'rejected';
           }
       }

       $this->load->view('countriesfrance', $data);
    }
}
