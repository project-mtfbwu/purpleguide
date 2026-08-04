<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_service
{
    private $CI;
    private $table = 'student_notifications';

    /**
     * The student-facing sections an admin edit can belong to.
     *
     * Keyed by section slug. `label` is what the student sees on the
     * notification so they know which part of their dashboard changed, and
     * `url` is the exact page + anchor that section lives at on the frontend.
     *
     * Several sections deliberately share a `type` (all the premium dashboard
     * blocks are 'quick_dashboard'): type groups them for filtering, the slug
     * is what distinguishes them.
     *
     * An empty `url` means the section has no single landing spot — courses and
     * events link to one item, so those callers pass their own deep link and
     * only borrow the label.
     */
    private static $sections = [
        'quick_dashboard_overview' => ['type' => 'quick_dashboard', 'label' => 'Quick Dashboard Overview', 'url' => 'Dashboard#quick-dashboard-overview'],
        'finalized_universities'   => ['type' => 'quick_dashboard', 'label' => 'Finalized Universities', 'url' => 'Dashboard#finalized-universities'],
        'currently_working_on'     => ['type' => 'quick_dashboard', 'label' => 'You Are Currently Working On', 'url' => 'Dashboard#currently-working-on'],
        'future_tasks'             => ['type' => 'quick_dashboard', 'label' => 'Future Task Preview', 'url' => 'Dashboard#future-tasks'],
        'where_you_stand'          => ['type' => 'quick_dashboard', 'label' => 'Where You Stand', 'url' => 'Dashboard#where-you-stand'],
        'comments'                 => ['type' => 'comment_reply', 'label' => 'Comments', 'url' => 'Dashboard#commentsList'],
        'documents'                => ['type' => 'document_update', 'label' => 'Documents', 'url' => 'Upload_your_doc#documents'],
        'review_queue'             => ['type' => 'review_queue_update', 'label' => 'Review Queue', 'url' => 'Feed_track_progress#review-notes'],
        'counselor_notes'          => ['type' => 'counselor_note', 'label' => 'Counsellor Notes', 'url' => 'Feed_track_progress#review-notes'],
        'important_alerts'         => ['type' => 'important_alert', 'label' => 'Important Alerts', 'url' => 'Feed_track_progress#important-alerts'],
        'kanban'                   => ['type' => 'kanban_update', 'label' => 'Kanban Board', 'url' => 'Feed_track_progress#kanban-board'],
        'weekly_wall'              => ['type' => 'weekly_wall', 'label' => 'Weekly Wall', 'url' => 'Purpleboard#weeklywall'],
        'courses'                  => ['type' => 'top_picks_course', 'label' => 'Courses', 'url' => ''],
        'events'                   => ['type' => 'top_picks_event', 'label' => 'Events', 'url' => ''],
    ];

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public static function sections()
    {
        return self::$sections;
    }

    /**
     * Notify one student that a named section of their dashboard changed.
     *
     * Preferred over notify_user(): the section slug resolves the type, the
     * student-visible section label and the deep link in one place, so a
     * notification can never point at the wrong part of the dashboard.
     */
    public function notify_section($user_id, $section, $title, $message, $reference_type = null, $reference_id = null)
    {
        // Sections with no fixed url (courses, events) deep-link per item and
        // must go through notify_user() with their own url.
        if (empty(self::$sections[$section]['url'])) {
            return false;
        }

        $meta = self::$sections[$section];

        return $this->notify_user(
            $user_id,
            $meta['type'],
            $title,
            $message,
            $meta['url'],
            $reference_type,
            $reference_id,
            $section
        );
    }

    /**
     * Notify every student that a named section changed (public content).
     */
    public function notify_section_all_users($section, $title, $message, $reference_type = null, $reference_id = null)
    {
        if (empty(self::$sections[$section]['url'])) {
            return 0;
        }

        $meta = self::$sections[$section];

        return $this->notify_all_users(
            $meta['type'],
            $title,
            $message,
            $meta['url'],
            $reference_type,
            $reference_id,
            $section
        );
    }

    public function notify_user($user_id, $type, $title, $message, $url, $reference_type = null, $reference_id = null, $section = null)
    {
        $user_id = (int) $user_id;
        if ($user_id <= 0 || !$this->ensure_table()) {
            return false;
        }

        $row = [
            'user_id' => $user_id,
            'type' => (string) $type,
            'title' => (string) $title,
            'message' => (string) $message,
            'url' => (string) $url,
            'reference_type' => $reference_type,
            'reference_id' => $reference_id !== null ? (int) $reference_id : null,
            'created_by' => (int) $this->CI->session->userdata('user_id'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if ($section !== null && $this->CI->db->field_exists('section', $this->table)) {
            $row['section'] = (string) $section;
        }

        return $this->CI->db->insert($this->table, $row);
    }

    public function notify_premium_users($type, $title, $message, $url, $reference_type = null, $reference_id = null, $section = null)
    {
        if (!$this->ensure_table() || !$this->CI->db->table_exists('purplepremium_applications')) {
            return 0;
        }

        $rows = $this->CI->db
            ->select('user_id')
            ->where('status', 'approved')
            ->group_by('user_id')
            ->get('purplepremium_applications')
            ->result();

        $count = 0;
        foreach ($rows as $row) {
            if ($this->notify_user((int) $row->user_id, $type, $title, $message, $url, $reference_type, $reference_id, $section)) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Notify every registered student.
     *
     * Use this for public functionality such as courses, events and the weekly
     * wall, where PurplePremium approval is not required to view the content.
     */
    public function notify_all_users($type, $title, $message, $url, $reference_type = null, $reference_id = null, $section = null)
    {
        if (!$this->ensure_table() || !$this->CI->db->table_exists('users')) {
            return 0;
        }

        $rows = $this->CI->db
            ->select('id AS user_id')
            ->where('id >', 0)
            ->get('users')
            ->result();

        $count = 0;
        foreach ($rows as $row) {
            if ($this->notify_user((int) $row->user_id, $type, $title, $message, $url, $reference_type, $reference_id, $section)) {
                $count++;
            }
        }

        return $count;
    }

    public function ensure_table()
    {
        if ($this->CI->db->table_exists($this->table)) {
            $this->ensure_section_column();
            return true;
        }

        $table = $this->CI->db->dbprefix($this->table);
        $sql = "CREATE TABLE IF NOT EXISTS `{$table}` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `user_id` int(11) unsigned NOT NULL,
            `type` varchar(60) NOT NULL,
            `section` varchar(60) DEFAULT NULL,
            `title` varchar(180) NOT NULL,
            `message` text,
            `url` varchar(255) DEFAULT NULL,
            `reference_type` varchar(60) DEFAULT NULL,
            `reference_id` int(11) unsigned DEFAULT NULL,
            `is_read` tinyint(1) NOT NULL DEFAULT 0,
            `created_by` int(11) unsigned DEFAULT NULL,
            `created_at` datetime NOT NULL,
            `read_at` datetime DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `user_read_created` (`user_id`, `is_read`, `created_at`),
            KEY `reference_lookup` (`reference_type`, `reference_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

        @$this->CI->db->query($sql);
        return $this->CI->db->table_exists($this->table);
    }

    /**
     * Add `section` to installs whose table predates section-aware notifications.
     */
    private function ensure_section_column()
    {
        if ($this->CI->db->field_exists('section', $this->table)) {
            return;
        }

        $table = $this->CI->db->dbprefix($this->table);
        @$this->CI->db->query("ALTER TABLE `{$table}` ADD `section` varchar(60) DEFAULT NULL AFTER `type`");

        // field_exists() above cached the pre-ALTER column list; drop it so the
        // insert that follows can see the new column on this same request.
        $this->CI->db->data_cache = [];
    }
}
