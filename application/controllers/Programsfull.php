<?php
Class Programsfull extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper('events');
    }

    public function index() {
        redirect('cvreadyprogram');
    }

    /**
     * Program detail by ID. URL: Programsfull/program/{id}
     */
    public function program($id) {
        $id = (int) $id;
        $data['program'] = null;
        $data['testimonials'] = [];
        $data['picks_courses'] = $this->_get_picks_courses();
        if ($this->db->table_exists('cv_programs')) {
            $data['program'] = $this->db->where('id', $id)->get('cv_programs')->row();
        }
        // Fallback: allow opening Programsfull detail from purpleboard courses IDs too.
        // Maps courses_tbl fields to the program view shape expected by programsfull.php.
        if (!$data['program'] && $this->db->table_exists('courses_tbl')) {
            $course = $this->db->where('id', $id)->where('block_status', 0)->get('courses_tbl')->row();
            if ($course) {
                $fallback = new stdClass();
                $fallback->id = (int) $course->id;
                $fallback->title = (string) ($course->product_name ?? '');
                $fallback->image = (string) ($course->image1 ?? '');
                $fallback->brochure = (string) ($course->file ?? '');
                $fallback->qr_code = '';
                $fallback->tags = (string) ($course->tags ?? '');
                $fallback->who_is_it_for = '';
                $fallback->session_topics = '';
                $fallback->highlight_1 = '';
                $fallback->highlight_2 = '';
                $fallback->highlight_3 = '';
                $fallback->highlight_4 = '';
                $fallback->top_label = '';
                $fallback->badge_text = '';
                $fallback->short_description = (string) ($course->prod_sub_name ?? '');
                $fallback->learn_more_url = '';
                $fallback->description = (string) ($course->description ?? '');
                $data['program'] = $fallback;
            }
        }
        if (!$data['program']) {
            show_404();
            return;
        }
        if ($this->db->table_exists('testimonial_tbl')) {
            $data['testimonials'] = $this->db->where('block_status', 0)
                ->order_by('id', 'DESC')
                ->get('testimonial_tbl')
                ->result();
        }
        $this->load->view('programsfull', $data);
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

    
