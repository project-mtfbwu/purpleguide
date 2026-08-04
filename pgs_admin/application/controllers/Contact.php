<?php

class Contact extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->model('User_model','um');
    }
    public function index(){
        $sql = "SELECT * FROM contact_tbl ORDER BY id DESC";
        $data['contact'] = $this->db->query($sql)->result();
        $this->load->view('view_contact',$data);
    }
   public function delete_contact()
   {
        $id = $this->uri->segment(3);
        $res = $this->um->delete('contact_tbl',['id'=>$id]);         
        if($res)                            
        {                
            $this->session->set_flashdata('success', 'Contact Deleted Successfully');
             redirect (base_url().'Contact/');die();
        }else{
            $this->session->set_flashdata('error', 'Contact Not Deleted');
             redirect (base_url().'Contact/');die();
        }
   }


 }