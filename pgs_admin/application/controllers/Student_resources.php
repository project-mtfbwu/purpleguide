<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_resources extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
        }
        $this->_ensure_tables();
    }

    private function _ensure_tables() {
        if (!$this->db->table_exists('key_dates')) {
            $this->db->query("CREATE TABLE `key_dates` (
                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `title` varchar(255) NOT NULL,
                `date_day` varchar(20) DEFAULT NULL,
                `date_month` varchar(50) DEFAULT NULL,
                `date_year` varchar(10) DEFAULT NULL,
                `month_label` varchar(20) NOT NULL,
                `link` varchar(500) DEFAULT NULL,
                `tags` varchar(255) DEFAULT NULL,
                `display_order` int(11) DEFAULT 0,
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
        }
        if (!$this->db->table_exists('urgent_deadlines')) {
            $this->db->query("CREATE TABLE `urgent_deadlines` (
                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `date_text` varchar(100) NOT NULL,
                `description` text NOT NULL,
                `display_order` int(11) DEFAULT 0,
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
        }
        if (!$this->db->table_exists('deadline_subscribers')) {
            $this->db->query("CREATE TABLE `deadline_subscribers` (
                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `email` varchar(255) NOT NULL,
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE KEY `email` (`email`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
        }
        if (!$this->db->table_exists('student_resources_settings')) {
            $this->db->query("CREATE TABLE `student_resources_settings` (
                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `setting_key` varchar(64) NOT NULL,
                `setting_value` text,
                `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE KEY `setting_key` (`setting_key`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
        }
        if (!$this->db->table_exists('pgs_stats')) {
            $this->db->query("CREATE TABLE `pgs_stats` (
                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `category` varchar(64) NOT NULL,
                `stat_text` text NOT NULL,
                `display_order` int(11) DEFAULT 0,
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
        }
        if (!$this->db->table_exists('study_abroad_facts')) {
            $this->db->query("CREATE TABLE `study_abroad_facts` (
                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `title` varchar(255) DEFAULT NULL,
                `fact_content` text NOT NULL,
                `display_order` int(11) NOT NULL DEFAULT 0,
                `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                KEY `display_order` (`display_order`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        }
        if ($this->db->table_exists('student_resources_settings')) {
            foreach ($this->_settings_defaults() as $key => $value) {
                $exists = $this->db->where('setting_key', $key)->get('student_resources_settings')->num_rows();
                if ($exists === 0) {
                    $this->db->insert('student_resources_settings', ['setting_key' => $key, 'setting_value' => $value]);
                }
            }
        }
    }

    private function _settings_defaults() {
        return [
            'purplepremium_video_url' => '',
            'key_dates_last_updated' => '6th June, 2025',
            'purplepremium_offer_visible' => '1',
            'purplepremium_offer_heading' => 'START YOUR USMLE JOURNEY WITH #PURPLEPREMIUM',
            'purplepremium_offer_description' => "Every student's journey takes time, attention, and real mentorship.\nThat's why we limit the number of students each batch - so our experts can actually guide, not just supervise.",
            'purplepremium_offer_label' => 'Get Started at discounted price',
            'purplepremium_offer_discount' => '35% off',
            'purplepremium_offer_price' => '65,0000',
            'purplepremium_offer_original_price' => '509,998',
            'purplepremium_offer_cta_text' => 'Enroll Now',
            'purplepremium_offer_cta_url' => '',
        ];
    }

    /**
     * Ensure unique display_order within the same month_label by shifting
     * existing items down when a conflicting order is saved.
     */
    private function _shift_key_dates_order($month_label, $start_order, $exclude_id = null) {
        $month_label = trim((string) $month_label);
        $start_order = (int) $start_order;
        $exclude_id = $exclude_id !== null ? (int) $exclude_id : null;

        if ($month_label === '') {
            return;
        }

        // Increment display_order for all items in same month_label with order >= start_order
        // so the new/edited item can take start_order uniquely.
        $this->db->set('display_order', 'display_order + 1', false);
        $this->db->where('month_label', $month_label);
        $this->db->where('display_order >=', $start_order);
        if ($exclude_id !== null) {
            $this->db->where('id !=', $exclude_id);
        }
        $this->db->update('key_dates');
    }

    public function index() {
        redirect('Student_resources/key_dates');
    }

    // ---------- Key Dates ----------
    public function key_dates() {
        $data['items'] = $this->db->order_by('month_label ASC, display_order ASC, id ASC')->get('key_dates')->result();
        $data['title'] = 'Upcoming Key Dates';
        $this->load->view('header');
        $this->load->view('student_resources/key_dates_list', $data);
        $this->load->view('footer');
    }

    public function key_date_add() {
        if ($this->input->method() === 'post') {
            $month_label = $this->input->post('month_label');
            $display_order = (int) $this->input->post('display_order');

            $this->db->trans_start();
            $this->_shift_key_dates_order($month_label, $display_order);
            $this->db->insert('key_dates', [
                'title' => $this->input->post('title'),
                'date_day' => $this->input->post('date_day'),
                'date_month' => $this->input->post('date_month'),
                'date_year' => $this->input->post('date_year'),
                'month_label' => $month_label,
                'link' => $this->input->post('link'),
                'tags' => $this->input->post('tags'),
                'display_order' => $display_order,
            ]);
            $this->db->trans_complete();
            $this->session->set_flashdata('success', 'Key date added.');
            redirect('Student_resources/key_dates');
            return;
        }
        $data['item'] = null;
        $data['title'] = 'Add Key Date';
        $this->load->view('header');
        $this->load->view('student_resources/key_date_form', $data);
        $this->load->view('footer');
    }

    public function key_date_edit($id) {
        $item = $this->db->where('id', (int)$id)->get('key_dates')->row();
        if (!$item) { redirect('Student_resources/key_dates'); return; }
        if ($this->input->method() === 'post') {
            $month_label = $this->input->post('month_label');
            $display_order = (int) $this->input->post('display_order');

            $this->db->trans_start();
            $this->_shift_key_dates_order($month_label, $display_order, (int)$id);
            $this->db->where('id', (int)$id)->update('key_dates', [
                'title' => $this->input->post('title'),
                'date_day' => $this->input->post('date_day'),
                'date_month' => $this->input->post('date_month'),
                'date_year' => $this->input->post('date_year'),
                'month_label' => $month_label,
                'link' => $this->input->post('link'),
                'tags' => $this->input->post('tags'),
                'display_order' => $display_order,
            ]);
            $this->db->trans_complete();
            $this->session->set_flashdata('success', 'Key date updated.');
            redirect('Student_resources/key_dates');
            return;
        }
        $data['item'] = $item;
        $data['title'] = 'Edit Key Date';
        $this->load->view('header');
        $this->load->view('student_resources/key_date_form', $data);
        $this->load->view('footer');
    }

    public function key_date_delete($id) {
        $this->db->where('id', (int)$id)->delete('key_dates');
        $this->session->set_flashdata('success', 'Key date deleted.');
        redirect('Student_resources/key_dates');
    }

    // ---------- Urgent Deadlines ----------
    public function urgent_deadlines() {
        $data['items'] = $this->db->order_by('display_order ASC, id ASC')->get('urgent_deadlines')->result();
        $data['title'] = 'Urgent Deadlines & Updates';
        $this->load->view('header');
        $this->load->view('student_resources/urgent_deadlines_list', $data);
        $this->load->view('footer');
    }

    public function urgent_add() {
        if ($this->input->method() === 'post') {
            $this->db->insert('urgent_deadlines', [
                'date_text' => $this->input->post('date_text'),
                'description' => $this->input->post('description'),
                'display_order' => (int) $this->input->post('display_order'),
            ]);
            $this->session->set_flashdata('success', 'Deadline added.');
            redirect('Student_resources/urgent_deadlines');
            return;
        }
        $data['item'] = null;
        $data['title'] = 'Add Urgent Deadline';
        $this->load->view('header');
        $this->load->view('student_resources/urgent_deadline_form', $data);
        $this->load->view('footer');
    }

    public function urgent_edit($id) {
        $item = $this->db->where('id', (int)$id)->get('urgent_deadlines')->row();
        if (!$item) { redirect('Student_resources/urgent_deadlines'); return; }
        if ($this->input->method() === 'post') {
            $this->db->where('id', (int)$id)->update('urgent_deadlines', [
                'date_text' => $this->input->post('date_text'),
                'description' => $this->input->post('description'),
                'display_order' => (int) $this->input->post('display_order'),
            ]);
            $this->session->set_flashdata('success', 'Deadline updated.');
            redirect('Student_resources/urgent_deadlines');
            return;
        }
        $data['item'] = $item;
        $data['title'] = 'Edit Urgent Deadline';
        $this->load->view('header');
        $this->load->view('student_resources/urgent_deadline_form', $data);
        $this->load->view('footer');
    }

    public function urgent_delete($id) {
        $this->db->where('id', (int)$id)->delete('urgent_deadlines');
        $this->session->set_flashdata('success', 'Deadline deleted.');
        redirect('Student_resources/urgent_deadlines');
    }

    // ---------- Subscribers ----------
    public function subscribers() {
        $data['items'] = [];
        if ($this->db->table_exists('deadline_subscribers')) {
            $data['items'] = $this->db->order_by('created_at', 'DESC')->get('deadline_subscribers')->result();
        }
        $data['title'] = 'Deadline Alert Subscribers';
        $this->load->view('header');
        $this->load->view('student_resources/subscribers_list', $data);
        $this->load->view('footer');
    }

    // ---------- Settings (video + last updated + purplepremium offer) ----------
    public function settings() {
        $rows = $this->db->get('student_resources_settings')->result();
        $settings = $this->_settings_defaults();
        foreach ($rows as $r) {
            $settings[$r->setting_key] = $r->setting_value;
        }
        if ($this->input->method() === 'post') {
            foreach (array_keys($this->_settings_defaults()) as $key) {
                $val = $key === 'purplepremium_offer_visible'
                    ? ($this->input->post($key) ? '1' : '0')
                    : $this->input->post($key);
                if ($this->db->where('setting_key', $key)->get('student_resources_settings')->num_rows() > 0) {
                    $this->db->where('setting_key', $key)->update('student_resources_settings', ['setting_value' => $val]);
                } else {
                    $this->db->insert('student_resources_settings', ['setting_key' => $key, 'setting_value' => $val]);
                }
            }
            $this->session->set_flashdata('success', 'Settings saved.');
            redirect('Student_resources/settings');
            return;
        }
        $data['settings'] = $settings;
        $data['title'] = 'Student Resources Settings';
        $this->load->view('header');
        $this->load->view('student_resources/settings_form', $data);
        $this->load->view('footer');
    }

    // ---------- PGS Stats ----------
    public function pgs_stats() {
        $data['items'] = $this->db->order_by('category ASC, display_order ASC, id ASC')->get('pgs_stats')->result();
        $data['title'] = 'PGS Data and Stats';
        $this->load->view('header');
        $this->load->view('student_resources/pgs_stats_list', $data);
        $this->load->view('footer');
    }

    public function pgs_stat_add() {
        if ($this->input->method() === 'post') {
            $this->db->insert('pgs_stats', [
                'category' => $this->input->post('category'),
                'stat_text' => $this->input->post('stat_text'),
                'display_order' => (int) $this->input->post('display_order'),
            ]);
            $this->session->set_flashdata('success', 'Stat added.');
            redirect('Student_resources/pgs_stats');
            return;
        }
        $data['item'] = null;
        $data['title'] = 'Add PGS Stat';
        $this->load->view('header');
        $this->load->view('student_resources/pgs_stat_form', $data);
        $this->load->view('footer');
    }

    public function pgs_stat_edit($id) {
        $item = $this->db->where('id', (int)$id)->get('pgs_stats')->row();
        if (!$item) { redirect('Student_resources/pgs_stats'); return; }
        if ($this->input->method() === 'post') {
            $this->db->where('id', (int)$id)->update('pgs_stats', [
                'category' => $this->input->post('category'),
                'stat_text' => $this->input->post('stat_text'),
                'display_order' => (int) $this->input->post('display_order'),
            ]);
            $this->session->set_flashdata('success', 'Stat updated.');
            redirect('Student_resources/pgs_stats');
            return;
        }
        $data['item'] = $item;
        $data['title'] = 'Edit PGS Stat';
        $this->load->view('header');
        $this->load->view('student_resources/pgs_stat_form', $data);
        $this->load->view('footer');
    }

    public function pgs_stat_delete($id) {
        $this->db->where('id', (int)$id)->delete('pgs_stats');
        $this->session->set_flashdata('success', 'Stat deleted.');
        redirect('Student_resources/pgs_stats');
    }

    // ---------- Study Abroad Facts (yellow carousel section on studentresources) ----------
    public function study_abroad_facts() {
        $data['items'] = $this->db->order_by('display_order ASC, id ASC')->get('study_abroad_facts')->result();
        $data['title'] = 'Study Abroad Facts';
        $this->load->view('header');
        $this->load->view('student_resources/study_abroad_facts_list', $data);
        $this->load->view('footer');
    }

    public function study_abroad_fact_add() {
        if ($this->input->method() === 'post') {
            $content = trim((string) $this->input->post('fact_content'));
            if ($content === '' || trim(strip_tags($content)) === '') {
                $this->session->set_flashdata('error', 'Fact content is required.');
                redirect('Student_resources/study_abroad_fact_add');
                return;
            }
            $this->db->insert('study_abroad_facts', [
                'title' => trim((string) $this->input->post('title')) ?: null,
                'fact_content' => $content,
                'display_order' => (int) $this->input->post('display_order'),
            ]);
            $this->session->set_flashdata('success', 'Fact added.');
            redirect('Student_resources/study_abroad_facts');
            return;
        }
        $data['item'] = null;
        $data['title'] = 'Add Study Abroad Fact';
        $this->load->view('header');
        $this->load->view('student_resources/study_abroad_fact_form', $data);
        $this->load->view('footer');
    }

    public function study_abroad_fact_edit($id) {
        $item = $this->db->where('id', (int)$id)->get('study_abroad_facts')->row();
        if (!$item) {
            redirect('Student_resources/study_abroad_facts');
            return;
        }
        if ($this->input->method() === 'post') {
            $content = trim((string) $this->input->post('fact_content'));
            if ($content === '' || trim(strip_tags($content)) === '') {
                $this->session->set_flashdata('error', 'Fact content is required.');
                redirect('Student_resources/study_abroad_fact_edit/' . (int)$id);
                return;
            }
            $this->db->where('id', (int)$id)->update('study_abroad_facts', [
                'title' => trim((string) $this->input->post('title')) ?: null,
                'fact_content' => $content,
                'display_order' => (int) $this->input->post('display_order'),
            ]);
            $this->session->set_flashdata('success', 'Fact updated.');
            redirect('Student_resources/study_abroad_facts');
            return;
        }
        $data['item'] = $item;
        $data['title'] = 'Edit Study Abroad Fact';
        $this->load->view('header');
        $this->load->view('student_resources/study_abroad_fact_form', $data);
        $this->load->view('footer');
    }

    public function study_abroad_fact_delete($id) {
        $this->db->where('id', (int)$id)->delete('study_abroad_facts');
        $this->session->set_flashdata('success', 'Fact deleted.');
        redirect('Student_resources/study_abroad_facts');
    }
}
