<?php

class Profile extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->model('User_model','um'); 

    }
     public function index(){
     	$this->load->library('session');
         if (!$this->session->userdata('user_id')) {
         redirect('Users/logout');
         }
       $id = $this->session->userdata('user_id');

       //print_r($id);die();
       
       $data['profile'] = $this->db->query("select * from admin where u_id = '$id'")->result();
       
       $this->load->view('profile',$data);
     }
  
       public function update_profile(){
        $config_data = array();
          $id = $this->input->post('id');
         $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');

        //print_r($mobile);die();
      
        $email = $this->input->post('email');
     

          $config_data['first_name'] =   $name;
          $config_data['phone'] = $mobile;
          $config_data['email'] =  $email;          

          $data = $this->um->update('admin',['u_id'=>$id],$config_data);
          if ($data) {
               $this->session->set_flashdata('success','Profile Updated Successfully');
                redirect (base_url('Profile/'));die();
          }
          else{
             $this->session->set_flashdata('error','Profile didnt Update');
                redirect (base_url('Profile/'));die();
          }

       }
  	function change_pass()
	{    $id = $this->input->post('id');
		$pass=$this->input->post('password');
		$change_pass=$this->input->post('new_pass');
		$confirm_pass=$this->input->post('con_pass');
		$old_pass=$this->input->post('cur_pass');
		if ($pass==$old_pass) {	

		if ($change_pass==$confirm_pass) {
         $data=$this->db->query("UPDATE admin SET password='$change_pass' WHERE u_id = '$id'");

		    if ($data) {
		    $this->session->set_flashdata('success','Your password changed successfully');
		    redirect(base_url('Profile/'));
		    }
                  else{
		    	     $this->session->set_flashdata('error','Password not changed');
		    	     redirect(base_url('Profile/'));
				}
		    }
			else
			{
				$this->session->set_flashdata('error','Password and Confirmation Password do not match.');
				redirect(base_url('Profile/'));
			}
		
    	}else
    	{
    		$this->session->set_flashdata('error','Incorrect current password ');
    		redirect(base_url('Profile/'));
    	}
    }
}