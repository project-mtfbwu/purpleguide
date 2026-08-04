<?php
$sessionDriverPath = APPPATH . 'controllers/drivers/Session_files_driver.php';


class Dashboard extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->model('User_model','um'); 
        $this->load->library('session');
         if (!$this->session->userdata('user_id')) {
         redirect('Users/logout');
         }
         $this->load->library('form_validation'); 
    }
    public function index(){   
        $data['admin_count'] = $this->db->count_all('admin');

        $data['enquiries_count'] = $this->db->count_all('enquiries_tbl');
    
        $data['users_count'] = $this->db->count_all('users');
        
        $this->load->view('dashboard', $data);
    }
    
}