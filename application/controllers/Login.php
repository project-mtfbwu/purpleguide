<?php
Class Login extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');     
        $this->load->library('form_validation');   
    }

    /**
     * Allow redirects only within this site.
     * Accepts relative paths like "purplepremiumhome" or "/purplepremiumhome".
     * Also tolerates full URLs that match base_url() host.
     */
    private function safe_redirect_target($raw) {
        $raw = trim((string) $raw);
        if ($raw === '') return null;

        // Disallow protocol-relative URLs.
        if (strpos($raw, '//') === 0) return null;

        // Full URL case: only allow same host as base_url().
        if (preg_match('#^https?://#i', $raw)) {
            $base = parse_url(base_url());
            $u = parse_url($raw);
            if (!$base || !$u) return null;
            if (!isset($base['host'], $u['host']) || strcasecmp($base['host'], $u['host']) !== 0) return null;
            $path = isset($u['path']) ? ltrim($u['path'], '/') : '';
            $query = isset($u['query']) && $u['query'] !== '' ? ('?' . $u['query']) : '';
            $raw = $path . $query;
        }

        // Relative path / query only.
        if (preg_match('#^[a-z][a-z0-9+.-]*:#i', $raw)) return null; // any remaining scheme
        if (strpos($raw, "\n") !== false || strpos($raw, "\r") !== false) return null;

        return ltrim($raw, '/');
    }

    /** Build redirect URL without losing query string. Empty fallback → site root. */
    private function redirect_to_target($target, $fallback = '') {
        $t = ($target !== null && $target !== '') ? $target : $fallback;
        if ($t === '') {
            redirect(base_url());
            return;
        }
        // If it contains a query string, redirect using a full URL so CI doesn't encode '?'.
        if (is_string($t) && strpos($t, '?') !== false) {
            redirect(base_url($t));
            return;
        }
        redirect($t);
    }

    public function index(){
        $redirect = $this->safe_redirect_target($this->input->get('redirect', true));

        $signupRaw = $this->input->get('signup', true);
        $signup_open = ($signupRaw === '1' || strtolower((string) $signupRaw) === 'true' || strtolower((string) $signupRaw) === 'yes');
        $signup_email = trim((string) $this->input->get('email', true));
        if ($signup_email !== '' && !filter_var($signup_email, FILTER_VALIDATE_EMAIL)) {
            $signup_email = '';
        }

        // Check if user is already logged in
        if ($this->session->userdata('logged_in')) {
            $this->redirect_to_target($redirect, '');
        }
        $this->load->view('login', [
            'redirect' => $redirect,
            'signup_open' => $signup_open,
            'signup_email' => $signup_email,
        ]);
    }
    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $redirect = $this->safe_redirect_target($this->input->post('redirect', true));
            $this->load->view('login', [
                'redirect' => $redirect,
                'signup_open' => false,
                'signup_email' => '',
            ]);
        } else {
            $email    = $this->input->post('email');
            $password = $this->input->post('password');
            $redirect = $this->safe_redirect_target($this->input->post('redirect', true));

            $this->db->where(['email' => $email, 'password' => $password]);
            $query = $this->db->get('users');

            if ($query->num_rows() == 1) {
                $user = $query->row();

                $this->session->set_userdata([
                    'user_id'   => $user->id,   // adjust column name
                    'name'=> $user->name,
                    'email'     => $user->email,
                    'logged_in' => TRUE,
                    'last_activity' => time()
                ]);

                // If user came from a page that asked to auto-open the premium modal, remember it for 1 redirect.
                if (is_string($redirect) && strpos($redirect, 'openPremium=1') !== false) {
                    $this->session->set_flashdata('openPremium', '1');
                }

                $this->redirect_to_target($redirect, '/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password');
                $url = 'Login';
                if ($redirect) {
                    $url .= '?redirect=' . rawurlencode($redirect);
                }
                redirect($url);
            }
        }
    }
    public function register()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[255]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[20]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $em = trim((string) $this->input->post('email', true));
            $q = 'signup=1';
            if ($em !== '' && filter_var($em, FILTER_VALIDATE_EMAIL)) {
                $q .= '&email=' . rawurlencode($em);
            }
            redirect('Login?' . $q);
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // Check if email already exists
            $existing_user = $this->db->where('email', $email)->get('users')->row();
            
            if ($existing_user) {
                $this->session->set_flashdata('error', 'This email is already registered. Please login instead.');
                redirect('Login?signup=1&email=' . rawurlencode($email));
            }

            // Create basic user account
            $user_data = [
                'email' => $email,
                'password' => $password, // Note: Should hash password in production
                'number' => '', // Placeholder
                'dial_code' => '', // Placeholder
                'whatsapp' => '', // Placeholder
                'country_code' => '', // Placeholder
                'preferred_country_code' => '', // Placeholder
                'study_level' => '', // Placeholder
                'created_at' => date('Y-m-d H:i:s')
            ];

            $user_id = $this->User_model->insert('users', $user_data);

            if ($user_id) {
                // Store user ID in session for signup completion
                $this->session->set_userdata([
                    'temp_user_id' => $user_id,
                    'temp_email' => $email
                ]);
                
                $this->session->set_flashdata('success', 'Account created successfully! Please complete your profile.');
                redirect('Singup');
            } else {
                $this->session->set_flashdata('error', 'Failed to create account. Please try again.');
                redirect('Login');
            }
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url()); 
    }


}

    