<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->require_super_admin();
    }

    private function require_super_admin()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
            return;
        }

        $role = strtolower(trim((string) $this->session->userdata('admin_role')));
        if ($role === 'superadmin') $role = 'super_admin';
        if ($role !== 'super_admin') {
            show_error('Unauthorized', 403);
            return;
        }
    }

    public function index()
    {
        $this->load->library('pagination');

        $per_page = 15;
        $page = max(1, (int) $this->uri->segment(3));
        $offset = ($page - 1) * $per_page;
        $q = trim((string) $this->input->get('q', true));

        $this->db->from('admin');
        if ($q !== '') {
            $this->db->group_start();
            $this->db->like('first_name', $q);
            $this->db->or_like('last_name', $q);
            $this->db->or_like('email', $q);
            $this->db->or_like('u_id', $q);
            $this->db->or_like('user_role', $q);
            $this->db->group_end();
        }
        $total = (int) $this->db->count_all_results();

        $config['base_url'] = base_url('Admins/index');
        $config['total_rows'] = $total;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['cur_page'] = $page;
        $config['num_links'] = 3;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);

        $this->db->select('u_id, first_name, last_name, email, phone, user_role');
        $this->db->from('admin');
        if ($q !== '') {
            $this->db->group_start();
            $this->db->like('first_name', $q);
            $this->db->or_like('last_name', $q);
            $this->db->or_like('email', $q);
            $this->db->or_like('u_id', $q);
            $this->db->or_like('user_role', $q);
            $this->db->group_end();
        }
        $this->db->order_by('u_id', 'DESC');
        $this->db->limit((int) $per_page, (int) $offset);

        $data = [
            'admins' => $this->db->get()->result(),
            'pagination_links' => $this->pagination->create_links(),
            'search_q' => $q,
        ];

        $this->load->view('admins_list', $data);
    }

    public function create()
    {
        $data = [
            'mode' => 'create',
            'admin' => null,
        ];
        $this->load->view('admins_form', $data);
    }

    public function edit($id = null)
    {
        $id = (int) $id;
        $admin = $this->db->where('u_id', $id)->get('admin')->row();
        if (!$admin) {
            show_404();
            return;
        }
        $data = [
            'mode' => 'edit',
            'admin' => $admin,
        ];
        $this->load->view('admins_form', $data);
    }

    public function save()
    {
        $mode = (string) $this->input->post('mode');
        $id = (int) $this->input->post('u_id');

        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('user_role', 'Role', 'required|trim');
        if ($mode === 'create') {
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
        }

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            redirect($mode === 'edit' ? base_url('Admins/edit/'.$id) : base_url('Admins/create'));
            return;
        }

        $first = trim((string) $this->input->post('first_name'));
        $last = trim((string) $this->input->post('last_name'));
        $email = trim((string) $this->input->post('email'));
        $phone = trim((string) $this->input->post('phone'));
        $role = trim((string) $this->input->post('user_role'));
        if ($role === 'superadmin') $role = 'super_admin';

        $allowedRoles = ['super_admin', 'admin', 'mentor'];
        if (!in_array($role, $allowedRoles, true)) {
            $this->session->set_flashdata('error', 'Invalid role.');
            redirect($mode === 'edit' ? base_url('Admins/edit/'.$id) : base_url('Admins/create'));
            return;
        }

        // Prevent duplicate email (basic check)
        $this->db->from('admin')->where('email', $email);
        if ($mode === 'edit') $this->db->where('u_id !=', $id);
        $exists = $this->db->count_all_results() > 0;
        if ($exists) {
            $this->session->set_flashdata('error', 'Email already exists.');
            redirect($mode === 'edit' ? base_url('Admins/edit/'.$id) : base_url('Admins/create'));
            return;
        }

        $payload = [
            'first_name' => $first,
            'last_name' => $last ?: '',
            'email' => $email,
            'phone' => $phone ?: null,
            'user_role' => $role,
        ];

        $password = (string) $this->input->post('password');
        if ($password !== '') {
            // Note: existing app stores admin passwords in plaintext (kept consistent).
            $payload['password'] = $password;
        }

        if ($mode === 'edit') {
            $this->db->where('u_id', $id)->update('admin', $payload);
            $this->session->set_flashdata('success', 'Admin updated.');
        } else {
            $this->db->insert('admin', $payload);
            $this->session->set_flashdata('success', 'Admin created.');
        }

        redirect(base_url('Admins'));
    }

    public function delete($id = null)
    {
        $id = (int) $id;
        if ($id <= 0) {
            show_404();
            return;
        }

        // Don't allow deleting self
        $currentId = (int) $this->session->userdata('user_id');
        if ($id === $currentId) {
            $this->session->set_flashdata('error', 'You cannot delete your own admin account.');
            redirect(base_url('Admins'));
            return;
        }

        $this->db->where('u_id', $id)->delete('admin');
        $this->session->set_flashdata('success', 'Admin deleted.');
        redirect(base_url('Admins'));
    }
}

