<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Googlelogins extends CI_Controller {

    private $client_id     = "612475588086-6tofo2acmvss367g3gv6ju8la6e37fu4.apps.googleusercontent.com";
    private $client_secret = "REDACTED_CREDENTIAL";

    /**
     * OAuth redirect URI must match Google Cloud Console "Authorized redirect URIs" exactly
     * (character-for-character) or Google returns Error 400: redirect_uri_mismatch.
     *
     * Priority: config google_oauth_redirect_uri (from GOOGLE_OAUTH_REDIRECT_URI or production default)
     *           then site_url('Googlelogins/googleCallback') from base_url.
     */
    private function get_google_redirect_uri(): string
    {
        $configured = $this->config->item('google_oauth_redirect_uri');
        if (is_string($configured) && trim($configured) !== '') {
            return rtrim(trim($configured), '/');
        }
        return rtrim(site_url('Googlelogins/googleCallback'), '/');
    }

    public function index() {
        $this->load->view('login', [
            'signup_open' => false,
            'signup_email' => '',
        ]);
    }

    public function googleLogin() {
        $redirect_uri = $this->get_google_redirect_uri();
        $google_url = "https://accounts.google.com/o/oauth2/v2/auth?client_id=" . $this->client_id .
                      "&redirect_uri=" . urlencode($redirect_uri) .
                      "&response_type=code&scope=email%20profile";

        redirect($google_url);
    }

    public function googleCallback() {
        $code = $this->input->get('code');
        if (!$code) {
            $this->session->set_flashdata('error', 'Google login failed!');
            redirect('Login');
        }

        $token_data = $this->exchangeCodeForToken($code);
        if (!isset($token_data['access_token'])) {
            $this->session->set_flashdata('error', 'Error getting access token.');
            redirect('Login');
        }

        $user_info = $this->fetchUserInfo($token_data['access_token']);
        if (!isset($user_info['email'])) {
            $this->session->set_flashdata('error', 'Error fetching user info.');
            redirect('Login');
        }

        $this->db->where('email', $user_info['email']);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            // User exists - log them in
            $user = $query->row();

            $this->session->set_userdata([
                'user_id'   => $user->id,
                'name'=> $user->name,
                'email'     => $user->email,
                'logged_in' => TRUE,
                'last_activity' => time()
            ]);

            $this->session->set_flashdata('success', 'Google login successful');
            redirect(base_url());
        } else {
            // User doesn't exist - create new account
            $this->load->model('User_model');
            
            // Generate a temporary password for Google signup (user will set their own during profile completion)
            $temp_password = bin2hex(random_bytes(8)); // Random 16-character password
            
            $user_data = [
                'email' => $user_info['email'],
                'name' => isset($user_info['name']) ? $user_info['name'] : '',
                'password' => substr($temp_password, 0, 20), // Limit to 20 chars for varchar(20)
                'number' => '0', // Placeholder - required NOT NULL field
                'dial_code' => '', // Empty string should work for TEXT NOT NULL
                'whatsapp' => '', // Empty string should work for TEXT NOT NULL
                'country_code' => '', // Empty string should work for TEXT NOT NULL
                'preferred_country_code' => '', // Empty string should work for TEXT NOT NULL
                'study_level' => '', // Empty string should work for TEXT NOT NULL
                'created_at' => date('Y-m-d H:i:s')
            ];

            $user_id = $this->User_model->insert('users', $user_data);

            if ($user_id) {
                // Store user ID in session for signup completion
                $this->session->set_userdata([
                    'temp_user_id' => $user_id,
                    'temp_email' => $user_info['email']
                ]);
                
                $this->session->set_flashdata('success', 'Account created successfully! Please complete your profile.');
                redirect(site_url('Singup'));
            } else {
                // Log the error for debugging
                $error = $this->db->error();
                log_message('error', 'Google signup failed: ' . print_r($error, true));
                // Show more detailed error in development
                $error_msg = 'Failed to create account. ';
                if (!empty($error['message'])) {
                    $error_msg .= 'Error: ' . $error['message'];
                }
                $this->session->set_flashdata('error', $error_msg);
                redirect('Login');
            }
        }
    }

    // Exchange code for token
    private function exchangeCodeForToken($code) {
        $token_url = "https://oauth2.googleapis.com/token";
        $data = [
            'code' => $code,
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri' => $this->get_google_redirect_uri(),
            'grant_type' => 'authorization_code'
        ];
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $token_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // optional if SSL issue
        $response = curl_exec($ch);
        curl_close($ch);
    
        return json_decode($response, true);
    }
    
    // Fetch user info from Google
    private function fetchUserInfo($access_token) {
        $user_info_url = "https://www.googleapis.com/oauth2/v3/userinfo";
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $user_info_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $access_token"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
    
        return json_decode($response, true);
    }

}
