<?php
Class Singup extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model','um'); 
        $this->load->library('form_validation');   
    }
    public function index(){
        // Check if user is coming from registration
        $temp_user_id = $this->session->userdata('temp_user_id');
        $temp_email = $this->session->userdata('temp_email');
        
        if (!$temp_user_id || !$temp_email) {
            $this->session->set_flashdata('error', 'Please register first to complete your profile.');
            redirect('Login');
        }
        
        // Get existing user data
        $data['user'] = $this->db->where('id', $temp_user_id)->get('users')->row();
        
        if (!$data['user']) {
            $this->session->set_flashdata('error', 'User account not found.');
            redirect('Login');
        }
        
        $data['dial_codes'] = $this->db->get('dial_code')->result();
        $data['countries'] = $this->db->get('country_list')->result();

       $this->load->view('singup', $data);
    }

    public function singup()
    {
        // Get user ID from session
        $user_id = $this->session->userdata('temp_user_id');
        
        if (!$user_id) {
            $this->session->set_flashdata('error', 'Session expired. Please register again.');
            redirect('Login');
        }
        
        // Validation rules
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim|max_length[255]');
        $this->form_validation->set_rules('dial_code', 'Dial Code', 'required|trim');
        $this->form_validation->set_rules('number', 'Phone Number', 'required|trim|max_length[20]');
        $this->form_validation->set_rules('whatsapp', 'WhatsApp', 'required|trim');
        $this->form_validation->set_rules('country_code', 'Country of Citizenship', 'required|trim');
        $this->form_validation->set_rules('preferred_country_code', 'Preferred Study Country', 'required|trim');
        $this->form_validation->set_rules('study_level', 'Study Level', 'required|trim');
        $this->form_validation->set_rules('field_interest', 'Field of Interest', 'trim');
        $this->form_validation->set_rules('work_experience', 'Work Experience', 'trim');
        $this->form_validation->set_rules('referral_code', 'Referral Code', 'trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[20]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Singup');
        } else {
            $name = $this->input->post('name');
            $dial_code = $this->input->post('dial_code');    
            $number = $this->input->post('number');
            $whatsapp = $this->input->post('whatsapp');
            $country_code = $this->input->post('country_code');    
            $preferred_country_code = $this->input->post('preferred_country_code');
            $study_level = $this->input->post('study_level');
            $field_interest = $this->input->post('field_interest');    
            $work_experience = $this->input->post('work_experience');
            $referral_code = $this->input->post('referral_code');    
            $password = $this->input->post('password');

            // Handle image upload
            $image1 = $this->um->file_upload('profile_image', 'assets/images/');      
        
            $update_data = [
                'name' => $name,
                'dial_code' => $dial_code,
                'number' => $number,
                'whatsapp' => $whatsapp,
                'country_code' => $country_code,            
                'preferred_country_code' => $preferred_country_code,
                'study_level' => $study_level,
                'field_interest' => $field_interest,
                'work_experience' => $work_experience,
                'referral_code' => $referral_code,
                'password' => $password // Note: Should hash password in production
            ];
        
            if ($image1) {
                $update_data['image1'] = $image1;
            }
        
            // Update existing user record
            $this->db->where('id', $user_id);
            $updated = $this->db->update('users', $update_data);
        
            if ($updated) {
                // Clear temp session data
                $this->session->unset_userdata('temp_user_id');
                $this->session->unset_userdata('temp_email');
                
                // Set proper session for logged in user
                $user = $this->db->where('id', $user_id)->get('users')->row();
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'logged_in' => TRUE,
                    'last_activity' => time()
                ]);
                
                redirect('Home/user_dashboard');
            } else {
                $this->session->set_flashdata('error', 'Failed to update profile. Please try again.');
                redirect('Singup');
            }
        }
    }
}

    