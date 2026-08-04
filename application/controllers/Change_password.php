<?php
Class Change_password extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');     
        $this->load->library('form_validation');
        
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('Login');
        }
    }
    public function index(){
        // Get user data
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->db->where('id', $user_id)->get('users')->row();
        
        if (!$data['user']) {
            $this->session->set_flashdata('error', 'User not found.');
            redirect('Login');
        }
        
        $this->load->view('changepassword', $data);
    }
    public function change_password()
    {            
        $user_id = $this->session->userdata('user_id');
        
        if (!$user_id) {
            $this->session->set_flashdata('error', 'Please login to change password.');
            redirect('Login');
        }
        
        // Validation rules
        $this->form_validation->set_rules('old_password', 'Old Password', 'required|trim');
        $this->form_validation->set_rules('password', 'New Password', 'required|trim|min_length[6]|max_length[20]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Change_password');
        } else {
            $old_password = $this->input->post('old_password');
            $new_password = $this->input->post('password');
            $cpassword    = $this->input->post('cpassword');

            // Verify old password
            $user = $this->db->get_where('users', [
                'id'       => $user_id, 
                'password' => $old_password
            ])->row();

            if (!$user) {
                $this->session->set_flashdata('error', 'Old password is incorrect.');
                redirect('Change_password');
            }

            // Check if new password matches confirmation
            if ($new_password !== $cpassword) {
                $this->session->set_flashdata('error', 'New password and confirm password do not match.');
                redirect('Change_password');
            }

            // Check if new password is same as old password
            if ($old_password === $new_password) {
                $this->session->set_flashdata('error', 'New password must be different from old password.');
                redirect('Change_password');
            }

            // Update password
            $this->db->where('id', $user_id);
            $updated = $this->db->update('users', ['password' => $new_password]);

            if ($updated) {
                $this->session->set_flashdata('success', 'Password updated successfully!');
                redirect('Change_password');
            } else {
                $this->session->set_flashdata('error', 'Failed to update password. Please try again.');
                redirect('Change_password');
            }
        }        
    }
}

    