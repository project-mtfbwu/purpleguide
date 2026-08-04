<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Manages the dynamic content of the public About page:
 *  - Founder block ("Meet The Founder") — single record.
 *  - Advisory team ("Our Advisory Team") — multiple records.
 */
class About_page extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model', 'um');
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
        }
        $this->_ensure_tables();
    }

    private function _ensure_tables() {
        if (!$this->db->table_exists('advisory_team_tbl')) {
            $this->db->query("CREATE TABLE `advisory_team_tbl` (
                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `name` varchar(255) NOT NULL,
                `designation` varchar(500) DEFAULT NULL,
                `image` varchar(255) DEFAULT NULL,
                `display_order` int(11) DEFAULT 0,
                `block_status` tinyint(1) DEFAULT 0,
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        }
        if (!$this->db->table_exists('founder_tbl')) {
            $this->db->query("CREATE TABLE `founder_tbl` (
                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `name` varchar(255) DEFAULT NULL,
                `title` varchar(500) DEFAULT NULL,
                `email` varchar(255) DEFAULT NULL,
                `image` varchar(255) DEFAULT NULL,
                `bio` text,
                `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        }
    }

    public function index() {
        redirect('About_page/advisory');
    }

    /* ----------------------------- Advisory team ----------------------------- */

    public function advisory() {
        $data['members'] = $this->db->order_by('display_order', 'ASC')->order_by('id', 'ASC')
            ->get('advisory_team_tbl')->result();
        $this->load->view('about_advisory', $data);
    }

    public function advisory_add() {
        $data['member'] = null;
        $this->load->view('about_advisory_form', $data);
    }

    public function advisory_edit($id) {
        $member = $this->db->get_where('advisory_team_tbl', ['id' => (int) $id])->row();
        if (!$member) {
            $this->session->set_flashdata('error', 'Advisory member not found');
            redirect('About_page/advisory');
            return;
        }
        $this->load->view('about_advisory_form', ['member' => $member]);
    }

    public function advisory_save() {
        $id = (int) $this->input->post('id');
        $name = trim((string) $this->input->post('name'));
        if ($name === '') {
            $this->session->set_flashdata('error', 'Name is required');
            redirect($id ? 'About_page/advisory_edit/' . $id : 'About_page/advisory_add');
            return;
        }

        $payload = [
            'name'          => $name,
            'designation'   => trim((string) $this->input->post('designation')),
            'display_order' => (int) $this->input->post('display_order'),
        ];

        $image = $this->um->file_upload('image', 'assets/images/');
        if ($image) {
            $payload['image'] = $image;
        }

        if ($id) {
            $this->um->update('advisory_team_tbl', ['id' => $id], $payload);
            $this->session->set_flashdata('success', 'Advisory member updated successfully');
        } else {
            $this->um->insert('advisory_team_tbl', $payload);
            $this->session->set_flashdata('success', 'Advisory member added successfully');
        }
        redirect('About_page/advisory');
    }

    public function advisory_block($id) {
        $id = (int) $id;
        $row = $this->db->get_where('advisory_team_tbl', ['id' => $id])->row();
        if (!$row) {
            $this->session->set_flashdata('error', 'Advisory member not found');
            redirect('About_page/advisory');
            return;
        }
        $new_status = $row->block_status ? 0 : 1;
        $this->um->update('advisory_team_tbl', ['id' => $id], ['block_status' => $new_status]);
        $this->session->set_flashdata('success', $new_status ? 'Advisory member unpublished' : 'Advisory member published');
        redirect('About_page/advisory');
    }

    public function advisory_delete($id) {
        $res = $this->um->delete('advisory_team_tbl', ['id' => (int) $id]);
        $this->session->set_flashdata($res ? 'success' : 'error', $res ? 'Advisory member deleted' : 'Advisory member not deleted');
        redirect('About_page/advisory');
    }

    /* -------------------------------- Founder -------------------------------- */

    public function founder() {
        $data['founder'] = $this->db->order_by('id', 'ASC')->get('founder_tbl')->row();
        $this->load->view('about_founder', $data);
    }

    public function founder_save() {
        $payload = [
            'name'  => trim((string) $this->input->post('name')),
            'title' => trim((string) $this->input->post('title')),
            'email' => trim((string) $this->input->post('email')),
            'bio'   => (string) $this->input->post('bio'),
        ];

        $image = $this->um->file_upload('image', 'assets/images/');
        if ($image) {
            $payload['image'] = $image;
        }

        $existing = $this->db->order_by('id', 'ASC')->get('founder_tbl')->row();
        if ($existing) {
            $this->um->update('founder_tbl', ['id' => $existing->id], $payload);
        } else {
            $this->um->insert('founder_tbl', $payload);
        }
        $this->session->set_flashdata('success', 'Founder details saved successfully');
        redirect('About_page/founder');
    }
}
