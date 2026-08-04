<?php
Class Purplenonmedical extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');     
        $this->load->library('form_validation');   
    }
    public function index(){
       $this->load->view('purplenonmedical');
    }
}

    