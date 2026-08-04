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
    
        public function reset_password($token = null) {
            if (!$token) {
                show_error('Invalid reset token.', 400);
            }
        
            $user = $this->db->get_where('users', ['reset_token' => $token])->row();

            if (!$user) {

                $this->session->set_flashdata('error', 'Invalid or expired reset link.');
                redirect('/');
            }
        
            $new_password = $this->input->post('password');
            if (empty($new_password)) {
                $this->session->set_flashdata('error', 'Password is required');
                return redirect('Reset_password/reset_passwords/'.$token);
            }
        
            $hashed_password = $new_password;
        
            $this->db->where('id', $user->id)
                     ->update('users', [
                         'password' => $hashed_password,
                         'reset_token' => null // clear the token
                     ]);
        
            $this->session->set_flashdata('success', 'Password reset successfully');
            redirect('/login');
        }


}