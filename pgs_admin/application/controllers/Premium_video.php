<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Manages the single "Step into #purplepremium" hero video shown on the
 * frontend purplepremium_overview page. Single-row settings table that
 * self-creates on first access (mirrors the Premium_meetup pattern).
 */
class Premium_video extends CI_Controller {

    const MAX_VIDEO_BYTES = 5242880; // 5 MB

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'um');
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
        }
    }

    public function index()
    {
        $this->_ensure_table();
        $data['video'] = $this->_first_row();
        $this->load->view('premium_video', $data);
    }

    public function update()
    {
        $this->_ensure_table();

        $row = $this->_first_row();
        $save = [
            'block_status' => isset($_POST['block_status']) ? 0 : 1,
        ];

        // ----- Video upload (max 5 MB) -----
        if (!empty($_FILES['video']['name'])) {

            if (!empty($_FILES['video']['error'])) {
                $this->session->set_flashdata('error', 'Video upload failed. Please try again.');
                redirect(base_url('Premium_video'));
                return;
            }

            if ($_FILES['video']['size'] > self::MAX_VIDEO_BYTES) {
                $this->session->set_flashdata('error', 'Video size must be less than 5MB');
                redirect(base_url('Premium_video'));
                return;
            }

            $ext = strtolower(pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION));
            $allowed = ['mp4', 'webm', 'ogg', 'mov', 'm4v'];
            if (!in_array($ext, $allowed)) {
                $this->session->set_flashdata('error', 'Invalid video format. Allowed: mp4, webm, ogg, mov.');
                redirect(base_url('Premium_video'));
                return;
            }

            $video = $this->um->file_upload('video', 'assets/images/');
            if ($video) {
                $save['video'] = $video;
            }
        }

        // ----- Optional poster image -----
        if (!empty($_FILES['poster']['name'])) {
            if ($_FILES['poster']['size'] > self::MAX_VIDEO_BYTES) {
                $this->session->set_flashdata('error', 'Poster image must be less than 5MB');
                redirect(base_url('Premium_video'));
                return;
            }
            $poster = $this->um->file_upload('poster', 'assets/images/');
            if ($poster) {
                $save['poster'] = $poster;
            }
        }

        if ($row) {
            // keep existing files when not re-uploaded
            if (!isset($save['video']))  { $save['video']  = $row->video; }
            if (!isset($save['poster'])) { $save['poster'] = $row->poster; }
            $this->db->where('id', $row->id)->update('premium_video', $save);
        } else {
            if (!isset($save['video']))  { $save['video']  = ''; }
            if (!isset($save['poster'])) { $save['poster'] = ''; }
            $this->db->insert('premium_video', $save);
        }

        $this->session->set_flashdata('success', 'Premium video updated successfully');
        redirect(base_url('Premium_video'));
    }

    private function _first_row()
    {
        return $this->db->order_by('id', 'ASC')->limit(1)->get('premium_video')->row();
    }

    private function _ensure_table()
    {
        $this->db->query("CREATE TABLE IF NOT EXISTS `premium_video` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `video` varchar(255) DEFAULT NULL,
            `poster` varchar(255) DEFAULT NULL,
            `block_status` tinyint(1) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }
}
