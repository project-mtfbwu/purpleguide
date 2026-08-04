<?php
Class Purpleevents extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper('events');
    }

    public function index(){
        $data['events'] = [];
        $data['featured_event'] = null;
        $data['facilitators'] = [];
        $data['testimonials'] = $this->_get_testimonials();
        $data['picks_courses'] = $this->_get_picks_courses();
        if ($this->db->table_exists('event_tbl')) {
            // Upcoming Sessions ordering: newest events first (id DESC)
            $events = $this->db
                ->select('event_tbl.*, event_category_tbl.category_name')
                ->from('event_tbl')
                ->join('event_category_tbl', 'event_category_tbl.id = event_tbl.cat_id', 'left')
                ->where('event_tbl.block_status', 0)
                ->order_by('event_tbl.id', 'DESC')
                ->get()
                ->result();
            $data['events'] = $events;
            $fe = !empty($events) ? $events[0] : null;
            $data['featured_event'] = $fe;
            if ($fe && $this->db->table_exists('event_facilitators')) {
                $data['facilitators'] = $this->db
                    ->order_by('sort_order', 'ASC')
                    ->order_by('id', 'ASC')
                    ->get_where('event_facilitators', ['event_id' => $fe->id])
                    ->result();
            }
        }
        $this->load->view('purpleevents', $data);
    }

    /**
     * Single event/session full page: details, facilitators, description, book URL.
     * URL: purpleevents/session/{id}
     */
    public function session($id) {
        $id = (int) $id;
        $data['event'] = null;
        $data['facilitators'] = [];
        $data['events'] = [];
        $data['testimonials'] = $this->_get_testimonials();
        if ($this->db->table_exists('event_tbl')) {
            $event = $this->db
                ->select('event_tbl.*, event_category_tbl.category_name')
                ->from('event_tbl')
                ->join('event_category_tbl', 'event_category_tbl.id = event_tbl.cat_id', 'left')
                ->where(['event_tbl.id' => $id, 'event_tbl.block_status' => 0])
                ->get()
                ->row();
            if (!$event) {
                show_404();
                return;
            }
            $data['event'] = $event;
            if ($this->db->table_exists('event_facilitators')) {
                $data['facilitators'] = $this->db
                    ->order_by('sort_order', 'ASC')
                    ->order_by('id', 'ASC')
                    ->get_where('event_facilitators', ['event_id' => $id])
                    ->result();
            }
            // Upcoming Sessions list on detail page: newest events first (id DESC)
            $data['events'] = $this->db
                ->select('event_tbl.*, event_category_tbl.category_name')
                ->from('event_tbl')
                ->join('event_category_tbl', 'event_category_tbl.id = event_tbl.cat_id', 'left')
                ->where('event_tbl.block_status', 0)
                ->order_by('event_tbl.id', 'DESC')
                ->get()
                ->result();
        }
        $this->load->view('purpleevents_session', $data);
    }

    /** @deprecated Use event_image_url() from events helper instead. */
    public static function event_image_url($image1, $placeholder = '', $image2 = null) {
        return event_image_url($image1, $placeholder, $image2);
    }

    /** @deprecated Use facilitator_image_url() from events helper instead. */
    public static function facilitator_image_url($image, $placeholder = '') {
        return facilitator_image_url($image, $placeholder);
    }

    /**
     * Format event date for display (day number, month abbrev, time).
     * s_date/e_date may be like "2025-12-31T12:00" or "2025-12-31 12:00:00"
     */
    public static function format_event_date($datetime) {
        if (empty($datetime)) return ['day' => '', 'month' => '', 'time' => ''];
        $ts = strtotime($datetime);
        if ($ts === false) return ['day' => '', 'month' => '', 'time' => ''];
        return [
            'day' => date('d', $ts),
            'month' => date('M y', $ts),
            'time' => date('g:i a', $ts)
        ];
    }

    /**
     * Fetch published testimonials for front-end (purpleevents, session, program pages).
     */
    private function _get_testimonials() {
        if (!$this->db->table_exists('testimonial_tbl')) return [];
        return $this->db->where('block_status', 0)
            ->order_by('id', 'DESC')
            ->get('testimonial_tbl')
            ->result();
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
}

    
