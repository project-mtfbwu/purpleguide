<?php
Class Purplepremiumhome extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');     
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('events');
    }

    /** Public URL for profile photo (users.image1); mirrors Dashboard paths and tolerates stored variants. */
    private function resolve_user_avatar_url($user_row) {
        $fallback = base_url('assets/img/default-avatar.png');
        if (!$user_row || !isset($user_row->image1)) {
            return $fallback;
        }
        $img = trim((string) $user_row->image1);
        if ($img === '') {
            return $fallback;
        }
        if (preg_match('#^https?://#i', $img)) {
            return $img;
        }
        $img = str_replace('\\', '/', $img);
        $img = ltrim($img, '/');
        if (stripos($img, 'assets/images/') === 0) {
            return base_url($img);
        }
        return base_url('assets/images/' . $img);
    }

    /** Same user + premium_application context as Dashboard / user_dashboard. */
    private function premium_home_view_data() {
        $fallback_avatar = base_url('assets/img/default-avatar.png');
        $data = [
            'user' => null,
            'premium_status' => null,
            'user_avatar_url' => $fallback_avatar,
            'study_journey_options' => $this->study_journey_options(),
            'marquee' => $this->active_marquee(),
            'home_events' => $this->home_events(),
            'picks_courses' => $this->get_picks_courses(),
        ];
        if (!$this->session->userdata('logged_in')) {
            return $data;
        }
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            return $data;
        }
        $data['user'] = $this->db->where('id', $user_id)->get('users')->row();
        $data['user_avatar_url'] = $this->resolve_user_avatar_url($data['user']);
        $premium_app = $this->db->where('user_id', $user_id)->get('purplepremium_applications')->row();
        if ($premium_app && $premium_app->status === 'approved') {
            $data['premium_status'] = 'approved';
        } elseif ($premium_app && $premium_app->status === 'pending') {
            $data['premium_status'] = 'pending';
        } elseif ($premium_app) {
            $data['premium_status'] = 'rejected';
        } else {
            $data['premium_status'] = 'none';
        }
        return $data;
    }

    private function active_marquee(){
        if (!$this->db->table_exists('marquee_tbl')) {
            return null;
        }
        if (!$this->db->field_exists('marquee_text', 'marquee_tbl') || !$this->db->field_exists('block_status', 'marquee_tbl')) {
            return null;
        }
        return $this->db
            ->where('block_status', 0)
            ->where('marquee_text !=', '')
            ->order_by('id', 'ASC')
            ->get('marquee_tbl')
            ->row();
    }

    private function study_journey_options(){
        return [
            'youare' => ['Parent', 'Student', 'Mentor'],
            'medical1' => ['USMLE', 'AMC', 'PLAB'],
            'masters' => ['MBA', 'STEM', 'Law', 'CSE', 'Others'],
            'undergrad' => ['Business', 'STEM', 'Law', 'Others'],
            'medical2' => ['Specialities', 'Physiotherapy', 'Nursing', 'Others'],
            'country' => ['Done a bit', 'I am doing as a group', 'I am starting my journey'],
            'medicalpath' => ['1st or 2nd Year', '3rd to Final Year', 'Internship', 'Working', 'Others'],
            'masterpath' => ['Studying', 'Graduated', 'Working', 'Others'],
            'undergradpath' => ['12th', '11th', '10th or less'],
            'plan' => ['2025', '2026', '2027', 'Guide me in choosing my intake schedule'],
            'countries' => ['USA', 'UK', 'CANADA', 'AUSTRALIA', 'NEW ZEALAND', 'EUROPE', 'Not sure yet - need help deciding'],
        ];
    }

    private function home_events(){
        if (!$this->db->table_exists('event_tbl')) return [];
        $today = date('Y-m-d');
        $rows = $this->db
            ->select('event_tbl.*, event_category_tbl.category_name')
            ->from('event_tbl')
            ->join('event_category_tbl', 'event_category_tbl.id = event_tbl.cat_id', 'left')
            ->where('event_tbl.block_status', 0)
            ->where('event_tbl.s_date >=', $today)
            ->order_by('event_tbl.s_date', 'ASC')
            ->get()
            ->result();

        if (!empty($rows)) return $rows;

        return $this->db
            ->select('event_tbl.*, event_category_tbl.category_name')
            ->from('event_tbl')
            ->join('event_category_tbl', 'event_category_tbl.id = event_tbl.cat_id', 'left')
            ->where('event_tbl.block_status', 0)
            ->order_by('event_tbl.s_date', 'DESC')
            ->limit(10)
            ->get()
            ->result();
    }

    private function get_picks_courses() {
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

    public function index(){
       $this->load->view('purplepremiumhome', $this->premium_home_view_data());
    }
    public function purplepremiumhome(){
       $this->load->view('purplepremiumhome_1', $this->premium_home_view_data());
    }
}

    
