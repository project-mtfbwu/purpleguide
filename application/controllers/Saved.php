<?php
Class Saved extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['saved_programs'] = [];
        $data['saved_courses'] = [];
        $data['logged_in'] = false;
        $data['user_name'] = '';
        $data['user_email'] = '';
        $data['user_image'] = '';
        $data['user_id'] = null;
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $data['logged_in'] = true;
            $data['user_id'] = $user_id;
            $user = $this->db->select('name, email, image1')->where('id', $user_id)->get('users')->row();
            if ($user) {
                $data['user_name'] = $user->name ? $user->name : '';
                $data['user_email'] = $user->email ? $user->email : $this->session->userdata('email');
                $data['user_image'] = $user->image1 ? $user->image1 : '';
            } else {
                $data['user_email'] = $this->session->userdata('email');
            }
            if ($this->db->table_exists('user_saved_programs') && $this->db->table_exists('cv_programs')) {
                $data['saved_programs'] = $this->db
                    ->select('p.id, p.title, p.short_description, p.image, p.tags, p.top_label, p.badge_text, p.learn_more_url, p.close_date_text, s.saved_at')
                    ->from('user_saved_programs s')
                    ->join('cv_programs p', 'p.id = s.program_id')
                    ->where('s.user_id', $user_id)
                    ->order_by('s.saved_at', 'DESC')
                    ->get()
                    ->result();
            }
            if ($this->db->table_exists('user_saved_courses') && $this->db->table_exists('courses_tbl')) {
                $data['saved_courses'] = $this->db
                    ->select('c.id, c.product_name, c.prod_sub_name, c.description, c.duration, c.pekrs, c.tags, c.image1, c.file, c.s_date, c.e_date, c.mode, s.saved_at, cat.category_name')
                    ->from('user_saved_courses s')
                    ->join('courses_tbl c', 'c.id = s.course_id')
                    ->join('course_category_tbl cat', 'cat.id = c.cat_id', 'left')
                    ->where('s.user_id', $user_id)
                    ->where('c.block_status', 0)
                    ->order_by('s.saved_at', 'DESC')
                    ->get()
                    ->result();
            }
        }
        $this->load->view('saved', $data);
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
        if (!$this->db->table_exists('user_saved_programs')) {
            echo json_encode(['success' => false, 'message' => 'Feature not available.', 'saved' => false]);
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

    public function toggle_save_course() {
        $this->output->set_content_type('application/json');
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            echo json_encode(['success' => false, 'message' => 'Please login to save courses.', 'saved' => false]);
            return;
        }
        $course_id = (int) $this->input->post('course_id');
        if ($course_id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid course.', 'saved' => false]);
            return;
        }
        if (!$this->db->table_exists('user_saved_courses') || !$this->db->table_exists('courses_tbl')) {
            echo json_encode(['success' => false, 'message' => 'Feature not available.', 'saved' => false]);
            return;
        }
        $exists = $this->db->where('id', $course_id)->where('block_status', 0)->get('courses_tbl')->row();
        if (!$exists) {
            echo json_encode(['success' => false, 'message' => 'Course not found.', 'saved' => false]);
            return;
        }
        $row = $this->db->where('user_id', $user_id)->where('course_id', $course_id)->get('user_saved_courses')->row();
        if ($row) {
            $this->db->where('id', $row->id)->delete('user_saved_courses');
            echo json_encode(['success' => true, 'saved' => false, 'message' => 'Removed from saved.']);
        } else {
            $this->db->insert('user_saved_courses', ['user_id' => $user_id, 'course_id' => $course_id]);
            echo json_encode(['success' => true, 'saved' => true, 'message' => 'Added to saved.']);
        }
    }
}

    