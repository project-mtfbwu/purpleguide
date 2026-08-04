<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Universities extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
        }
    }

    public function index() {
        $this->load->library('pagination');
        $q = trim((string) $this->input->get('q', true));
        $per_page = 15;
        $page = max(1, (int) $this->uri->segment(2));
        $offset = ($page - 1) * $per_page;

        $countQuery = $this->db->from('universities');
        if ($q !== '') {
            $countQuery->like('name', $q);
        }
        $total = (int) $countQuery->count_all_results();

        $config['base_url'] = base_url('Universities/index');
        $config['total_rows'] = $total;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 2;
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

        if ($q !== '') {
            $config['suffix'] = '?' . http_build_query(['q' => $q]);
            $config['first_url'] = $config['base_url'] . '/1' . $config['suffix'];
        }
        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();

        $listQuery = $this->db->from('universities')->order_by('id', 'DESC')->limit($per_page, $offset);
        if ($q !== '') {
            $listQuery->like('name', $q);
        }
        $data['universities'] = $listQuery->get()->result();
        $data['q'] = $q;
        $data['offset'] = $offset;
        $this->load->view('universities', $data);
    }

    public function add() {
        $this->load->view('add_university');
    }

    public function add_save() {
        $name = trim($this->input->post('name'));
        $location = trim($this->input->post('location'));
        if (empty($name)) {
            $this->session->set_flashdata('error', 'University name is required.');
            redirect('Universities/add');
            return;
        }
        $image_path = $this->_upload_image('image');
        $this->db->insert('universities', [
            'name' => $name,
            'location' => $location ?: null,
            'image' => $image_path
        ]);
        $this->session->set_flashdata('success', 'University added successfully.');
        redirect('Universities');
    }

    public function edit($id) {
        $id = (int) $id;
        $data['university'] = $this->db->where('id', $id)->get('universities')->row();
        if (!$data['university']) {
            $this->session->set_flashdata('error', 'University not found.');
            redirect('Universities');
            return;
        }
        $this->load->view('edit_university', $data);
    }

    public function edit_save() {
        $id = (int) $this->input->post('id');
        $name = trim($this->input->post('name'));
        $location = trim($this->input->post('location'));
        if (empty($name)) {
            $this->session->set_flashdata('error', 'University name is required.');
            redirect('Universities/edit/' . $id);
            return;
        }
        $row = $this->db->where('id', $id)->get('universities')->row();
        if (!$row) {
            redirect('Universities');
            return;
        }
        $update = ['name' => $name, 'location' => $location ?: null];
        $image_path = $this->_upload_image('image');
        if ($image_path) {
            $update['image'] = $image_path;
        }
        $this->db->where('id', $id)->update('universities', $update);
        $this->session->set_flashdata('success', 'University updated successfully.');
        redirect('Universities');
    }

    public function delete($id) {
        $id = (int) $id;
        $this->db->where('id', $id)->delete('universities');
        $this->session->set_flashdata('success', 'University deleted.');
        redirect('Universities');
    }

    private function _upload_image($field) {
        if (!isset($_FILES[$field]) || $_FILES[$field]['error'] != 0 || empty($_FILES[$field]['name'])) {
            return '';
        }
        $upload_path = dirname(FCPATH) . '/assets/images/universities/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }
        $ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            return '';
        }
        $filename = 'uni_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
        if (move_uploaded_file($_FILES[$field]['tmp_name'], $upload_path . $filename)) {
            return 'universities/' . $filename;
        }
        return '';
    }
}
