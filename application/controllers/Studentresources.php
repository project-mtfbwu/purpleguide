<?php
Class Studentresources extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Univmeet_model');
        $this->load->library('form_validation');
        $this->load->helper('events');
    }

    public function index() {
        $data = [];
        $data['univmeet'] = $this->Univmeet_model->get_current();

        // Upcoming Key Dates (grouped by month_label)
        $data['key_dates'] = [];
        if ($this->db->table_exists('key_dates')) {
            $data['key_dates'] = $this->db->order_by('month_label ASC, display_order ASC, id ASC')->get('key_dates')->result();
        }

        // Urgent Deadlines & Updates
        $data['urgent_deadlines'] = [];
        if ($this->db->table_exists('urgent_deadlines')) {
            $data['urgent_deadlines'] = $this->db->order_by('display_order ASC, id ASC')->get('urgent_deadlines')->result();
        }

        // Settings: video URL + key_dates last updated text
        $data['purplepremium_video_url'] = '';
        $data['key_dates_last_updated'] = '6th June, 2025';
        if ($this->db->table_exists('student_resources_settings')) {
            $rows = $this->db->get('student_resources_settings')->result();
            foreach ($rows as $r) {
                if ($r->setting_key === 'purplepremium_video_url') $data['purplepremium_video_url'] = $r->setting_value;
                if ($r->setting_key === 'key_dates_last_updated') $data['key_dates_last_updated'] = $r->setting_value ?: $data['key_dates_last_updated'];
            }
        }

        // PGS stats (grouped by category)
        $data['pgs_stats'] = [];
        if ($this->db->table_exists('pgs_stats')) {
            $data['pgs_stats'] = $this->db->order_by('category ASC, display_order ASC, id ASC')->get('pgs_stats')->result();
        }

        // #Purple Events & Other Programs: upcoming events (s_date >= today)
        $data['upcoming_events'] = [];
        if ($this->db->table_exists('event_tbl')) {
            $today = date('Y-m-d');
            $upcoming = $this->db
                ->select('event_tbl.*, event_category_tbl.category_name')
                ->from('event_tbl')
                ->join('event_category_tbl', 'event_category_tbl.id = event_tbl.cat_id', 'left')
                ->where('event_tbl.block_status', 0)
                ->where('event_tbl.s_date >=', $today)
                ->order_by('event_tbl.s_date', 'ASC')
                ->get()
                ->result();
            // If no upcoming events exist, show latest events so cards/links don't disappear.
            if (!empty($upcoming)) {
                $data['upcoming_events'] = $upcoming;
            } else {
                $data['upcoming_events'] = $this->db
                    ->select('event_tbl.*, event_category_tbl.category_name')
                    ->from('event_tbl')
                    ->join('event_category_tbl', 'event_category_tbl.id = event_tbl.cat_id', 'left')
                    ->where('event_tbl.block_status', 0)
                    ->order_by('event_tbl.s_date', 'DESC')
                    ->limit(10)
                    ->get()
                    ->result();
            }
        }

        // Study Abroad Facts swiper — reads existing `study_abroad_facts` table only (no schema changes here).
        $data['study_abroad_facts_slides'] = $this->_build_study_abroad_facts_slides();
        $data['picks_courses'] = $this->_get_picks_courses();

        $this->load->view('studentresources', $data);
    }

    private function _get_picks_courses() {
        if (!$this->db->table_exists('courses_tbl')) return [];
        $col = $this->db->query("SHOW COLUMNS FROM `courses_tbl` LIKE 'show_in_picks'")->num_rows();
        if (!$col) return [];
        return $this->db
            ->select('id, product_name, prod_sub_name, description, image1, product_slug')
            ->where('show_in_picks', 1)
            ->where('block_status', 0)
            ->get('courses_tbl')
            ->result();
    }

    /**
     * Facts for /studentresources — uses your existing `study_abroad_facts` table.
     * Resets query builder first (avoids leaked JOIN/WHERE from earlier queries on this page).
     * Text column: known names, else first varchar/text column (skips id, order, slide, flags, timestamps).
     * slide_index / slide_group / group_id / slide: ORDER BY only (row order → slide order).
     * One DB row = one swiper slide (so row 2 appears on slide 2).
     * (We do not filter by is_active — many DBs use 0/NULL inconsistently; show all rows.)
     *
     * @return array<int, string> ready-to-print HTML per slide
     */
    private function _build_study_abroad_facts_slides() {
        $slides = [];
        if (!$this->db->table_exists('study_abroad_facts')) {
            return $slides;
        }

        // Critical: index() runs event_tbl JOIN queries above; without reset, this get() can be wrong/empty.
        $this->db->reset_query();

        $fields = $this->db->list_fields('study_abroad_facts');
        if (!is_array($fields) || $fields === []) {
            return $slides;
        }
        $map = [];
        foreach ($fields as $f) {
            $map[strtolower((string) $f)] = $f;
        }

        $text_col = null;
        $preferred = [
            'fact_text', 'fact_content', 'body', 'content', 'fact', 'description', 'text', 'title',
            'statement', 'message', 'details', 'detail', 'info', 'value', 'name', 'label', 'heading',
        ];
        foreach ($preferred as $c) {
            if (isset($map[$c])) {
                $text_col = $map[$c];
                break;
            }
        }
        if ($text_col === null) {
            $skip = [
                'id', 'display_order', 'sort_order', 'is_active', 'status', 'slide_index', 'slide_group',
                'group_id', 'slide', 'created_at', 'updated_at', 'deleted_at',
            ];
            $fd = $this->db->field_data('study_abroad_facts');
            if (is_array($fd)) {
                foreach ($fd as $col) {
                    $name = isset($col->name) ? strtolower((string) $col->name) : '';
                    if ($name === '' || in_array($name, $skip, true)) {
                        continue;
                    }
                    $type = isset($col->type) ? strtolower((string) $col->type) : '';
                    if ($type !== '' && (strpos($type, 'char') !== false || strpos($type, 'text') !== false || strpos($type, 'blob') !== false)) {
                        $text_col = $col->name;
                        break;
                    }
                }
            }
        }
        if ($text_col === null) {
            return $slides;
        }

        foreach (['slide_index', 'slide_group', 'group_id', 'slide'] as $sf) {
            if (isset($map[$sf])) {
                $this->db->order_by($map[$sf], 'ASC');
                break;
            }
        }
        if (isset($map['display_order'])) {
            $this->db->order_by($map['display_order'], 'ASC');
        }
        if (isset($map['sort_order'])) {
            $this->db->order_by($map['sort_order'], 'ASC');
        }
        if (isset($map['id'])) {
            $this->db->order_by($map['id'], 'ASC');
        }

        $rows = $this->db->get('study_abroad_facts')->result();
        if (empty($rows)) {
            return $slides;
        }

        foreach ($rows as $row) {
            $t = $this->_study_abroad_fact_cell($row, $text_col);
            if ($t !== '') {
                $slides[] = $this->_format_study_abroad_fact_html($t);
            }
        }
        return $slides;
    }

    /**
     * If content looks like HTML, allow a small tag whitelist; otherwise plain text with nl2br + escaped.
     */
    private function _format_study_abroad_fact_html($raw) {
        $raw = trim((string) $raw);
        if ($raw === '') {
            return '';
        }
        if (preg_match('/<\s*[a-z][\s\S]*>/i', $raw)) {
            $allow = '<p><a><br><br/><strong><b><em><i><u><span><div><h2><h3><h4><h5><h6><blockquote><ul><ol><li>';

            return strip_tags($raw, $allow);
        }

        return nl2br(htmlspecialchars($raw, ENT_QUOTES, 'UTF-8'));
    }

    /**
     * Read fact string from row (object or array) using actual DB column name.
     */
    private function _study_abroad_fact_cell($row, $text_col) {
        if (is_array($row)) {
            if (!array_key_exists($text_col, $row) && array_key_exists(strtolower($text_col), $row)) {
                $text_col = strtolower($text_col);
            }
            return trim((string) ($row[$text_col] ?? ''));
        }
        if (is_object($row)) {
            if (property_exists($row, $text_col)) {
                return trim((string) $row->{$text_col});
            }
            $lc = strtolower($text_col);
            foreach (get_object_vars($row) as $k => $v) {
                if (strtolower((string) $k) === $lc) {
                    return trim((string) $v);
                }
            }
        }
        return '';
    }

    /**
     * Ensure deadline_subscribers table exists (create if not).
     * Called from subscribe() so subscription works even if admin was never opened.
     */
    private function _ensure_deadline_subscribers_table() {
        if ($this->db->table_exists('deadline_subscribers')) {
            return true;
        }
        $tbl = $this->db->dbprefix('deadline_subscribers');
        $sql = "CREATE TABLE IF NOT EXISTS `{$tbl}` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `email` varchar(255) NOT NULL,
            `created_at` datetime DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `email` (`email`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        @$this->db->query($sql);
        if (!$this->db->table_exists('deadline_subscribers')) {
            $this->load->dbforge();
            $this->dbforge->add_field(array(
                'id' => array('type' => 'INT', 'unsigned' => true, 'auto_increment' => true),
                'email' => array('type' => 'VARCHAR', 'constraint' => 255),
                'created_at' => array('type' => 'DATETIME', 'null' => true)
            ));
            $this->dbforge->add_key('id', true);
            $this->dbforge->add_key('email', false, true);
            $this->dbforge->create_table('deadline_subscribers', true);
        }
        return $this->db->table_exists('deadline_subscribers');
    }

    /**
     * Subscribe to deadline alerts – store email (unique).
     * Expects POST email or JSON body.
     * Table is created automatically if missing. Only unique emails are stored.
     */
    public function subscribe() {
        $this->output->set_content_type('application/json');
        $email = '';
        if ($this->input->method() === 'post') {
            $email = trim($this->input->post('email') ?: $this->input->get_post('email'));
            if (empty($email) && $this->input->raw_input_stream) {
                $json = json_decode($this->input->raw_input_stream, true);
                if (!empty($json['email'])) $email = trim($json['email']);
            }
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->output->set_output(json_encode(['success' => false, 'message' => 'Please enter a valid email address.']));
            return;
        }
        $this->_ensure_deadline_subscribers_table();
        if (!$this->db->table_exists('deadline_subscribers')) {
            $this->output->set_output(json_encode(['success' => false, 'message' => 'Subscription is temporarily unavailable.']));
            return;
        }
        $exists = $this->db->where('email', $email)->get('deadline_subscribers')->row();
        if ($exists) {
            $this->output->set_output(json_encode(['success' => true, 'message' => 'You are already subscribed.']));
            return;
        }
        $this->db->insert('deadline_subscribers', [
            'email' => $email,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $this->output->set_output(json_encode(['success' => true, 'message' => 'Thank you for subscribing to deadline alerts.']));
    }
}
