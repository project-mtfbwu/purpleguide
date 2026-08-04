<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cv_programs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
        }
    }

    public function index() {
        $this->_ensure_program_extra_columns();
        $this->load->library('pagination');
        $per_page = 15;
        $page = max(1, (int) $this->uri->segment(2));
        $offset = ($page - 1) * $per_page;

        $total = $this->db->count_all('cv_programs');
        $config['base_url'] = base_url('Cv_programs/index');
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
        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();

        $data['programs'] = $this->db->order_by('id', 'DESC')->limit($per_page, $offset)->get('cv_programs')->result();
        $this->load->view('cv_programs', $data);
    }

    public function add() {
        $this->_ensure_program_extra_columns();
        $this->load->view('add_cv_program');
    }

    public function add_save() {
        $this->_ensure_program_extra_columns();
        $title = trim($this->input->post('title'));
        if (empty($title)) {
            $this->session->set_flashdata('error', 'Title is required.');
            redirect('Cv_programs/add');
            return;
        }
        $image_path = $this->_upload_image('image');
        $brochure_path = $this->_upload_file('brochure', ['pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg']);
        $qr_path = $this->_upload_image('qr_code');
        $data = [
            'title' => $title,
            'short_description' => trim($this->input->post('short_description')) ?: null,
            'image' => $image_path,
            'tags' => trim($this->input->post('tags')) ?: null,
            'top_label' => trim($this->input->post('top_label')) ?: null,
            'badge_text' => trim($this->input->post('badge_text')) ?: null,
            'learn_more_url' => trim($this->input->post('learn_more_url')) ?: null,
            'close_date_text' => trim($this->input->post('close_date_text')) ?: null,
            'display_order' => (int) $this->input->post('display_order'),
            'is_active' => 1,
            'most_wanted' => $this->input->post('most_wanted') ? 1 : 0,
        ];
        $data['who_is_it_for'] = trim($this->input->post('who_is_it_for')) ?: null;
        $data['session_topics'] = trim($this->input->post('session_topics')) ?: null;
        $data['highlight_1'] = trim($this->input->post('highlight_1')) ?: null;
        $data['highlight_2'] = trim($this->input->post('highlight_2')) ?: null;
        $data['highlight_3'] = trim($this->input->post('highlight_3')) ?: null;
        $data['highlight_4'] = trim($this->input->post('highlight_4')) ?: null;
        $data['brochure'] = $brochure_path ?: null;
        $data['qr_code'] = $qr_path ?: null;
        $this->db->insert('cv_programs', $data);
        $this->session->set_flashdata('success', 'Program added successfully.');
        redirect('Cv_programs');
    }

    public function edit($id) {
        $this->_ensure_program_extra_columns();
        $id = (int) $id;
        $data['program'] = $this->db->where('id', $id)->get('cv_programs')->row();
        if (!$data['program']) {
            $this->session->set_flashdata('error', 'Program not found.');
            redirect('Cv_programs');
            return;
        }
        $this->load->view('edit_cv_program', $data);
    }

    public function edit_save() {
        $this->_ensure_program_extra_columns();
        $id = (int) $this->input->post('id');
        $title = trim($this->input->post('title'));
        if (empty($title)) {
            $this->session->set_flashdata('error', 'Title is required.');
            redirect('Cv_programs/edit/' . $id);
            return;
        }
        $row = $this->db->where('id', $id)->get('cv_programs')->row();
        if (!$row) {
            redirect('Cv_programs');
            return;
        }
        $update = [
            'title' => $title,
            'short_description' => trim($this->input->post('short_description')) ?: null,
            'tags' => trim($this->input->post('tags')) ?: null,
            'top_label' => trim($this->input->post('top_label')) ?: null,
            'badge_text' => trim($this->input->post('badge_text')) ?: null,
            'learn_more_url' => trim($this->input->post('learn_more_url')) ?: null,
            'close_date_text' => trim($this->input->post('close_date_text')) ?: null,
            'display_order' => (int) $this->input->post('display_order'),
            'who_is_it_for' => trim($this->input->post('who_is_it_for')) ?: null,
            'session_topics' => trim($this->input->post('session_topics')) ?: null,
            'highlight_1' => trim($this->input->post('highlight_1')) ?: null,
            'highlight_2' => trim($this->input->post('highlight_2')) ?: null,
            'highlight_3' => trim($this->input->post('highlight_3')) ?: null,
            'highlight_4' => trim($this->input->post('highlight_4')) ?: null,
            'most_wanted' => $this->input->post('most_wanted') ? 1 : 0,
        ];
        $image_path = $this->_upload_image('image');
        if ($image_path) $update['image'] = $image_path;
        $brochure_path = $this->_upload_file('brochure', ['pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg']);
        if ($brochure_path) $update['brochure'] = $brochure_path;
        $qr_path = $this->_upload_image('qr_code');
        if ($qr_path) $update['qr_code'] = $qr_path;
        $this->db->where('id', $id)->update('cv_programs', $update);
        $this->session->set_flashdata('success', 'Program updated successfully.');
        redirect('Cv_programs');
    }

    public function delete($id) {
        $id = (int) $id;
        $this->db->where('program_id', $id)->delete('user_saved_programs');
        $this->db->where('id', $id)->delete('cv_programs');
        $this->session->set_flashdata('success', 'Program deleted.');
        redirect('Cv_programs');
    }

    private function _ensure_program_extra_columns() {
        if (!$this->db->table_exists('cv_programs')) return;
        $cols = ['who_is_it_for' => 'TEXT NULL', 'session_topics' => 'TEXT NULL',
            'highlight_1' => 'VARCHAR(500) NULL', 'highlight_2' => 'VARCHAR(500) NULL',
            'highlight_3' => 'VARCHAR(500) NULL', 'highlight_4' => 'VARCHAR(500) NULL',
            'brochure' => 'VARCHAR(255) NULL', 'qr_code' => 'VARCHAR(255) NULL',
            'most_wanted' => 'TINYINT(1) NOT NULL DEFAULT 0'];
        foreach ($cols as $col => $def) {
            if (!$this->db->field_exists($col, 'cv_programs')) {
                $this->db->query("ALTER TABLE cv_programs ADD COLUMN {$col} {$def}");
            }
        }
    }

    /**
     * Upload to pgs_admin/assets/images/ (same as Events/Courses). DB stores filename only.
     */
    private function _upload_image($field) {
        if (!isset($_FILES[$field]) || $_FILES[$field]['error'] != 0 || empty($_FILES[$field]['name'])) {
            return '';
        }
        $upload_path = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }
        $ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            return '';
        }
        $filename = 'cvprog_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
        if (move_uploaded_file($_FILES[$field]['tmp_name'], $upload_path . $filename)) {
            return $filename;
        }
        return '';
    }

    private function _upload_file($field, $allowed_ext = ['pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg']) {
        if (!isset($_FILES[$field]) || $_FILES[$field]['error'] != 0 || empty($_FILES[$field]['name'])) {
            return '';
        }
        $upload_path = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }
        $ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed_ext)) {
            return '';
        }
        $filename = 'cv_' . preg_replace('/[^a-z0-9_]/i', '', $field) . '_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
        if (move_uploaded_file($_FILES[$field]['tmp_name'], $upload_path . $filename)) {
            return $filename;
        }
        return '';
    }
}
