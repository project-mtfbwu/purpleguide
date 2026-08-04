<?php
Class Cvreadyprogram extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['programs'] = [];
        $data['featured_programs'] = [];
        $data['featured_courses'] = [];
        $data['unique_tags'] = [];
        $data['saved_program_ids'] = [];
        $data['saved_course_ids'] = [];
        $data['programs_count'] = 0;

        if ($this->db->table_exists('cv_programs')) {
            $data['programs'] = $this->db->where('is_active', 1)
                ->order_by('display_order', 'ASC')
                ->order_by('id', 'ASC')
                ->get('cv_programs')
                ->result();
            $data['programs_count'] = count($data['programs']);
            // “#purpleSelected” — only rows with most_wanted = 1 (set in DB / your admin)
            $data['featured_programs'] = $this->db->where('is_active', 1)
                ->where('most_wanted', 1)
                ->order_by('display_order', 'ASC')
                ->order_by('id', 'ASC')
                ->get('cv_programs')
                ->result();
            $tag_set = [];
            foreach ($data['programs'] as $p) {
                if (!empty($p->tags)) {
                    $arr = preg_split('/[\s,#]+/', trim($p->tags), -1, PREG_SPLIT_NO_EMPTY);
                    foreach ($arr as $t) {
                        $t = trim($t);
                        if ($t !== '') $tag_set[$t] = true;
                    }
                }
            }
            $data['unique_tags'] = array_keys($tag_set);
            sort($data['unique_tags']);
        }

        // “#purpleSelected” Most Wanted Courses — courses flagged in admin (show_in_picks = 1)
        if ($this->db->table_exists('courses_tbl')) {
            $has_picks = $this->db->query("SHOW COLUMNS FROM `courses_tbl` LIKE 'show_in_picks'")->num_rows();
            if ($has_picks) {
                $data['featured_courses'] = $this->db
                    ->select('courses_tbl.*, course_category_tbl.category_name')
                    ->from('courses_tbl')
                    ->join('course_category_tbl', 'course_category_tbl.id = courses_tbl.cat_id', 'left')
                    ->where('courses_tbl.show_in_picks', 1)
                    ->where('courses_tbl.block_status', 0)
                    ->order_by('courses_tbl.id', 'DESC')
                    ->get()
                    ->result();
            }
        }

        $user_id = $this->session->userdata('user_id');
        if ($user_id && $this->db->table_exists('user_saved_programs')) {
            $saved = $this->db->select('program_id')->where('user_id', $user_id)->get('user_saved_programs')->result();
            foreach ($saved as $s) {
                $data['saved_program_ids'][] = (int) $s->program_id;
            }
        }
        if ($user_id && $this->db->table_exists('user_saved_courses')) {
            $saved_c = $this->db->select('course_id')->where('user_id', $user_id)->get('user_saved_courses')->result();
            foreach ($saved_c as $s) {
                $data['saved_course_ids'][] = (int) $s->course_id;
            }
        }
        $this->load->view('cvreadyprogram', $data);
    }

    public function toggle_save() {
        $this->output->set_content_type('application/json');
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            echo json_encode(['success' => false, 'message' => 'Please login to save programs.', 'saved' => false]);
            return;
        }
        $program_id = (int) $this->input->post('program_id');
        if ($program_id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid program.', 'saved' => false]);
            return;
        }
        if (!$this->db->table_exists('cv_programs') || !$this->db->table_exists('user_saved_programs')) {
            echo json_encode(['success' => false, 'message' => 'Feature not available.', 'saved' => false]);
            return;
        }
        $exists = $this->db->where('id', $program_id)->get('cv_programs')->row();
        if (!$exists) {
            echo json_encode(['success' => false, 'message' => 'Program not found.', 'saved' => false]);
            return;
        }
        $row = $this->db->where('user_id', $user_id)->where('program_id', $program_id)->get('user_saved_programs')->row();
        if ($row) {
            $this->db->where('id', $row->id)->delete('user_saved_programs');
            echo json_encode(['success' => true, 'saved' => false, 'message' => 'Removed from saved.']);
        } else {
            $this->db->insert('user_saved_programs', ['user_id' => $user_id, 'program_id' => $program_id]);
            echo json_encode(['success' => true, 'saved' => true, 'message' => 'Added to saved.']);
        }
    }
}

    