<?php
Class Reset_password extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');   
    }
    public function reset_passwords($user_id = null){
        $data = [];
        $data['user_id'] = $user_id;
        $this->load->view('reset_password', $data);
    }
    // public function reset_password($user_id = null){
    //     if (!$user_id) {
    //         show_error('Invalid user ID.', 400);
    //     }
    
    //     $new_password = $this->input->post('password');
    //     if (empty($new_password)) {
    //         $this->session->set_flashdata('error', 'Password is required');
    //         return redirect('Reset_password/'.$user_id);
    //     }
    //     $hashed = $new_password;
    
    //     $this->db->where('u_id', $user_id)
    //              ->update('users', ['password' => $hashed]);
    
    //     $this->session->set_flashdata('success', 'Password Reset successfully');
    //     redirect('/'); 
    // }
    
        public function reset_password($token = null) {
            if (!$token) {
                show_error('Invalid reset token.', 400);
            }
        
            // Find the user by token
            $user = $this->db->get_where('admin', ['reset_token' => $token])->row();
        
            if (!$user) {
                //show_error('Invalid or expired reset link.', 400);
                
                $this->session->set_flashdata('error', 'Invalid or expired reset link.');
                redirect('/');
            }
        
            $new_password = $this->input->post('password');
            if (empty($new_password)) {
                $this->session->set_flashdata('error', 'Password is required');
                return redirect('Reset_password/reset_passwords/'.$token);
            }
        
            // Hash password properly (never store plain text)
            $hashed_password = $new_password;
        
            $this->db->where('u_id', $user->u_id)
                     ->update('admin', [
                         'password' => $hashed_password,
                         'reset_token' => null // clear the token
                     ]);
        
            $this->session->set_flashdata('success', 'Password reset successfully');
            redirect('/');
        }


}