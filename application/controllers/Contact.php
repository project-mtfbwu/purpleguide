<?php
Class Contact extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');     
        $this->load->library('form_validation');   
    }
    public function index(){

        $query = $this->db->get_where('enquiry_category_tbl', array('block_status' => 0));
        $data['categories'] = $query->result();

        $this->load->view('contact', $data);
    }
    // public function submit_form()
    // {
    //     $name    = $this->input->post('name');
    //     $email   = $this->input->post('email');
    //     $mobile  = $this->input->post('number');        
    //     $message = $this->input->post('comment');

    //     $data = [
    //         'name'       => $name,
    //         'email'      => $email,
    //         'mobile'     => $mobile,
    //         'message'    => $message,
    //         'created_at' => date('Y-m-d H:i:s') 
    //     ];
    //     $this->db->insert('enquiries_tbl', $data);

    //     echo json_encode(['status' => 'success', 'message' => 'Your enquiry has been submitted successfully!']);

    // }

    public function submit_form()
    {
        $name    = $this->input->post('name');
        $email   = $this->input->post('email');
        $mobile  = $this->input->post('number');        
        $message = $this->input->post('comment');
        $cat_id = $this->input->post('cat_id');
        


        $data = [
            'name'       => $name,
            'email'      => $email,
            'mobile'     => $mobile,
            'message'    => $message,
            'cat_id'    => $cat_id,
            'created_at' => date('Y-m-d') 
        ];

        $this->db->insert('enquiries_tbl', $data);

        echo json_encode([
            'status'  => 'success',
            'message' => 'Your enquiry has been submitted successfully!'
        ]);
    }


}

    