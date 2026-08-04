<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller
{
    private $table = 'student_notifications';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        // Loaded by hand rather than via autoload or load->helper(), both of
        // which are fatal when the file is absent. A missing helper should cost
        // the section fallback, never the redirect itself.
        if (!function_exists('notification_section_key') && file_exists(APPPATH . 'helpers/notification_helper.php')) {
            require_once APPPATH . 'helpers/notification_helper.php';
        }
    }

    public function open($id = 0)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('Login');
            return;
        }

        $id = (int) $id;
        $user_id = (int) $this->session->userdata('user_id');

        if ($id <= 0 || $user_id <= 0 || !$this->db->table_exists($this->table)) {
            redirect('Dashboard');
            return;
        }

        $notification = $this->db
            ->where('id', $id)
            ->where('user_id', $user_id)
            ->get($this->table)
            ->row();

        if (!$notification) {
            redirect('Dashboard');
            return;
        }

        $this->db
            ->where('id', $id)
            ->where('user_id', $user_id)
            ->update($this->table, [
                'is_read' => 1,
                'read_at' => date('Y-m-d H:i:s'),
            ]);

        // The stored url points at the exact section that changed, so it wins.
        // The registry fills in for rows with no url, and upgrades legacy rows
        // whose url predates section anchors (e.g. plain 'Dashboard').
        $url = trim((string) $notification->url);
        $section_url = '';
        if (function_exists('notification_section_key')) {
            $section = notification_section_key($notification);
            $section_url = $section !== null ? notification_sections()[$section]['url'] : '';
        }

        if ($url === '' || (strpos($url, '#') === false && $section_url !== '')) {
            $url = $section_url !== '' ? $section_url : 'Dashboard';
        }

        if (preg_match('#^https?://#i', $url)) {
            redirect($url);
            return;
        }

        redirect(base_url(ltrim($url, '/')));
    }
    public function delete($id = 0)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('Login');
            return;
        }

        $id = (int) $id;
        $user_id = (int) $this->session->userdata('user_id');

        if ($id > 0 && $user_id > 0 && $this->db->table_exists($this->table)) {
            $this->db
                ->where('id', $id)
                ->where('user_id', $user_id)
                ->delete($this->table);
        }

        $this->go_back();
    }

    public function clear_all()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('Login');
            return;
        }

        $user_id = (int) $this->session->userdata('user_id');

        if ($user_id > 0 && $this->db->table_exists($this->table)) {
            $this->db
                ->where('user_id', $user_id)
                ->delete($this->table);
        }

        $this->go_back();
    }

    private function go_back()
    {
        $back = $this->input->server('HTTP_REFERER');
        if (!empty($back) && preg_match('#^https?://#i', $back)) {
            redirect($back);
            return;
        }

        redirect('Dashboard');
    }
}