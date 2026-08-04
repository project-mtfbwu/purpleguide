<?php
Class Forgot_password extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');   
        $this->load->library('encryption');
    }
    public function index(){
        $this->load->view('forgot_password');
    }
    // public function forgot_password(){
        
    //     $email = $this->input->post('email');
        
    //     print_r($email);die();
        
        
    //     $this->load->view('forgot_password');
    // }
    // public function forgot_password() {
    //     $email = $this->input->post('email', TRUE);
        
    //     if (!$email) {
    //         echo "Email is required";
    //         return;
    //     }
    
    //     $this->db->select('u_id');
    //     $this->db->from('users');
    //     $this->db->where('email', $email);
    //     $query = $this->db->get();
    
    //     if ($query->num_rows() > 0) {
    //         $row = $query->row();
    //         $u_id = $row->u_id;
    
    //         echo "User ID found: " . $u_id;
    //     } else {
    //         echo "Email not found in our records.";
    //     }
    // }
    
        // public function forgot_password()
        // {
        //     $email = $this->input->post('email', TRUE);
            
        //     if (!$email) {
        //         echo "Email is required";
        //         return;
        //     }
        
        //     // Check if email exists in database
        //     $this->db->select('u_id');
        //     $this->db->from('users');
        //     $this->db->where('email', $email);
        //     $query = $this->db->get();
        
        //     if ($query->num_rows() > 0) {
        //         $row = $query->row();
        //         $u_id = $row->u_id;
        
        //         // Create reset link
        //         $encrypted_id = urlencode($this->encryption->encrypt($u_id));

        // // Create reset link with encrypted ID
        // $reset_link = base_url("Reset_password/reset_passwords/{$encrypted_id}");
        
        //         // Load email library
        //         $this->load->library('email');
        
        //         // Email configuration (adjust according to your SMTP settings)
        //         $config = array(
        //             'protocol'  => 'smtp',
        //             'smtp_host' => 'ssl://smtp.gmail.com', // e.g. smtp.gmail.com
        //             'smtp_port' => 465,
        //             'smtp_user' => 'sumit.hariyani3@gmail.com',
        //             'smtp_pass' => 'jvubwcjgeiufiyhh',
        //             'mailtype'  => 'html',
        //             'charset'   => 'utf-8',
        //             'newline'   => "\r\n"
        //         );
        
        //         $this->email->initialize($config);
        
        //         // Set email parameters
        //         $this->email->from('sumit.hariyani3@gmail.com', 'PGS');
        //         $this->email->to($email);
        //         $this->email->subject('Reset Password');
        //         $this->email->message("
        //             <p>Please reset your password from this link:</p>
        //             <p><a href='{$reset_link}'>{$reset_link}</a></p>
        //         ");
        
        //         // Send email
        //         if ($this->email->send()) {
        //             $this->session->set_flashdata('success', 'A reset password link has been sent to your email.');
        //             redirect(base_url());
        //         } else {
        //             $this->session->set_flashdata('error', 'Failed to send email. Please try again.');
        //             redirect('Forgot_password');
        //         }
        
        //     } else {
        //         $this->session->set_flashdata('error', 'Email not found in our records.');
        //         redirect('Forgot_password');
        //     }
        // }
        
        public function forgot_password()
        {
            $email = $this->input->post('email', TRUE);
        
            if (!$email) {
                $this->session->set_flashdata('error', 'Email is required');
                redirect('Forgot_password');
                return;
            }
        
            // Check if email exists
            $this->db->select('u_id');
            $this->db->from('admin');
            $this->db->where('email', $email);
            $query = $this->db->get();
        
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $u_id = $row->u_id;
            
                $encrypted_id = md5($u_id);
                
                // Save the hash in a reset_tokens table or even in the admin table
                $this->db->where('u_id', $u_id)->update('admin', ['reset_token' => $encrypted_id]);
                
                $reset_link = base_url("Reset_password/reset_passwords/{$encrypted_id}");
        
                // Email config
                $this->load->library('email');

                // $config = [
                //     'protocol'     => 'smtp',
                //     'smtp_host'    => 'smtp.gmail.com',   // remove ssl://
                //     'smtp_port'    => 587,                // use TLS
                //     'smtp_user'    => 'sumit.hariyani3@gmail.com',
                //     'smtp_pass'    => 'jvubwcjgeiufiyhh', // Gmail App Password
                //     'smtp_crypto'  => 'tls',              // use TLS instead of ssl
                //     'mailtype'     => 'html',
                //     'charset'      => 'utf-8',
                //     'newline'      => "\r\n",
                //     'wordwrap'     => TRUE
                // ];
                $config = [
                    'protocol'     => 'smtp',
                    'smtp_host'    => 'smtp.gmail.com',
                    'smtp_port'    => 465,
                    'smtp_user'    => 'sumit.hariyani3@gmail.com',
                    'smtp_pass'    => 'gjkznewdietpqowr',
                    'smtp_crypto'  => 'ssl',
                    'mailtype'     => 'html',
                    'charset'      => 'utf-8',
                    'newline'      => "\r\n",
                    'wordwrap'     => TRUE,
                ];
                
                $this->email->initialize($config);

        
                // Send email
                $this->email->from('sumit.hariyani3@gmail.com', 'PGS');
                $this->email->to($email);
                $this->email->subject('Reset Password Link');
                
                $this->email->from('sumit.hariyani3@gmail.com', 'PGS');
                $this->email->to($email);
                $this->email->subject('Reset Password Link');
                
                $message = "
                <html>
                  <head>
                    <style>
                      .btn {
                        display: inline-block;
                        padding: 12px 24px;
                        font-size: 16px;
                        font-weight: bold;
                        color: #ffffff !important;
                        background-color: #007bff;
                        text-decoration: none;
                        border-radius: 6px;
                      }
                      .btn:hover {
                        background-color: #0056b3;
                      }
                      .email-container {
                        font-family: Arial, sans-serif;
                        line-height: 1.6;
                        color: #333333;
                        padding: 20px;
                        border: 1px solid #eaeaea;
                        border-radius: 8px;
                        max-width: 600px;
                        margin: auto;
                        background-color: #ffffff;
                        text-align: center; /* ✅ everything centered */
                      }
                      .email-header {
                        background-color: #f2f2f2;
                        padding: 20px;
                        border-radius: 8px 8px 0 0;
                      }
                      .email-header h2 {
                        margin: 0;
                        color: #333333;
                      }
                      hr {
                        border: 0;
                        border-top: 2px solid #007bff;
                        width: 60%;
                        margin: 15px auto;
                      }
                    </style>
                  </head>
                  <body>
                    <div class='email-container'>
                      <div class='email-header'>
                        <h2>Password Reset Request</h2>
                      </div>
                      <hr>
                      <p>Hello,</p>
                      <p>Click the button below to reset your password:</p>
                      <p>
                        <a href='{$reset_link}' class='btn'>Reset Password</a>
                      </p>
                      <p>If you didn’t request this, you can safely ignore this email.</p>
                      <br>
                      <p>Thanks,<br><strong>PGS Team</strong></p>
                    </div>
                  </body>
                </html>
                ";
                
                $this->email->message($message);
        
                if ($this->email->send()) {
                    $this->session->set_flashdata('success', 'A reset password link has been sent to your email.');
                    redirect(base_url());
                } else {
                    $this->session->set_flashdata('error', 'Failed to send email. Please try again.');
                    redirect('Forgot_password');
                }
            } else {
                $this->session->set_flashdata('error', 'Email not found in our records.');
                redirect('Forgot_password');
            }
        }




}