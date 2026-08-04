<?php
$sessionDriverPath = APPPATH . 'controllers/drivers/Session_files_driver.php';

class Courses extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->model('User_model','um'); 
        $this->load->library('session');
        $this->load->library('Notification_service');
         if (!$this->session->userdata('user_id')) {
         redirect('Users/logout');
         }
    }
    public function add_course(){
        $data['cate'] =  $this->db->query("SELECT * FROM `course_category_tbl` where block_status='0'")->result();
        $this->load->view('course', $data);
    }    
    public function add_course_data()
    {
        $desc = $this->input->post('pro_desc');
        $name = ucfirst(trim($this->input->post('prod_name'), " \t"));
        $product_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));

        $cat_id = $this->input->post('cat_id');

        $prod_sub_name = $this->input->post('prod_sub_name');
        $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');
        $mode = $this->input->post('mode');

        $duration = $this->input->post('duration');
        $pekrs = $this->input->post('pekrs');
        $tags = $this->input->post('tags');


        $subcat_name = $this->input->post('subcat_name');

        $image1 = $this->um->file_upload('banner_image', 'assets/images/');
        if ($image1) {
            $prod_data['image1'] = $image1;
        }

        $file = $this->um->file_upload('file', 'assets/images/');
        if ($file) {
            $prod_data['file'] = $file;
        }

        $prod_data['cat_id'] = $cat_id;
        $prod_data['subcat_id'] = $subcat_name;
        $prod_data['description'] = $desc;
        $prod_data['product_name'] = $name;

        $prod_data['prod_sub_name'] = $prod_sub_name;
        $prod_data['s_date'] = $s_date;
        $prod_data['e_date'] = $e_date;

        $prod_data['duration'] = $duration;
        $prod_data['pekrs'] = $pekrs;
        $prod_data['tags'] = $tags;
        $prod_data['mode'] = $mode;


        $prod_data['product_slug'] = $product_slug;

        $id = $this->um->insert('courses_tbl', $prod_data);

        if ($id) {
            $this->notification_service->notify_all_users(
                    'top_picks_course',
                    'New course added',
                    $name,
                    'Programsfull/program/' . (int) $id,
                    'course',
                    $id,
                    'courses'
                );
            $this->session->set_flashdata('success', 'Course added successfully');
            redirect(base_url() . 'Courses/course_view');
        } else {
            $this->session->set_flashdata('error', 'Course not added');
            redirect(base_url() . 'Courses/add_course');
        }
    }
    public function edit_course($id)
    {

        $id = $this->uri->segment(3);
        $this->session->set_userdata('id', $id);

        $article = $this->db->get_where('courses_tbl', ['id' => $id])->row();

        if (!$article) {
            redirect(base_url('Courses/course_view'));
            return;
        }

        $data['product'] = $article;
        $data['cate'] =  $this->db->query("SELECT * FROM `course_category_tbl` where block_status='0'")->result();

        $this->load->view('edit_course', $data);
    }
    public function edit_course_data()
    {
        $this->load->library('session');
        $this->load->library('Notification_service');

        $p_id = $this->input->post('id');

        //print_r($p_id);die();
        $name = ucfirst(trim($this->input->post('prod_name'), " \t"));
        $description = $this->input->post('description');
        $cat_id = $this->input->post('cat_id');

        $prod_sub_name = $this->input->post('prod_sub_name');
        $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');
        $mode = $this->input->post('mode');

        $duration = $this->input->post('duration');
        $pekrs = $this->input->post('pekrs');
        $tags = $this->input->post('tags');

        // Validate required fields
        if (empty($name)) {
            $this->session->set_flashdata('error', 'Product name is required');
            redirect(base_url('Courses/edit_course/') . $p_id);
            return;
        }

        // Initialize update data
        $prod_data = [
            'product_name' => $name,
            'description' => $description,
            'cat_id' => $cat_id,
            'prod_sub_name' => $prod_sub_name,
            's_date' => $s_date,
            'e_date' => $e_date,

            'duration' => $duration,
            'pekrs' => $pekrs,
            'tags' => $tags,
            'mode' => $mode,
        ];

        // Handle image1 upload (only one image allowed)
        $image1 = $this->um->file_upload('prod_image1', 'assets/images/');

        if ($image1) {
            $prod_data['image1'] = $image1;
        }

        $file = $this->um->file_upload('file', 'assets/images/');

        if ($file) {
            $prod_data['file'] = $file;
        }

        $updated = $this->um->update('courses_tbl', ['id' => $p_id], $prod_data);        

        if ($updated) {
            if ($this->course_is_visible_in_top_picks($p_id)) {
                $this->notification_service->notify_all_users(
                    'top_picks_course',
                    'Top pick course updated',
                    $name,
                    'Programsfull/program/' . (int) $p_id,
                    'course',
                    $p_id,
                    'courses'
                );
            }
            $this->session->set_flashdata('success', 'Course updated successfully');
            redirect(base_url('Courses/course_view'));
        } else {
            $this->session->set_flashdata('error', 'Course not updated');
            redirect(base_url('Courses/edit_course/') . $p_id);
        }
    }

    public function course_view()
    {
        $col = $this->db->query("SHOW COLUMNS FROM `courses_tbl` LIKE 'show_in_picks'")->num_rows();
        if (!$col) {
            $this->db->query("ALTER TABLE `courses_tbl` ADD COLUMN `show_in_picks` TINYINT(1) NOT NULL DEFAULT 0");
        }

        $data['product'] = $this->db
        ->select('courses_tbl.*, course_category_tbl.category_name')
        ->from('courses_tbl')
        ->join('course_category_tbl', 'course_category_tbl.id = courses_tbl.cat_id', 'left')
        ->get()
        ->result();
        $this->load->view('course_view', $data);
    }

    public function toggle_picks()
    {
        $this->output->set_content_type('application/json');
        $id = (int) $this->uri->segment(3);
        if (!$id) {
            $this->output->set_output(json_encode(['success' => false]));
            return;
        }
        $row = $this->db->select('show_in_picks, product_name, block_status')->get_where('courses_tbl', ['id' => $id])->row();
        if (!$row) {
            $this->output->set_output(json_encode(['success' => false]));
            return;
        }
        $new_val = $row->show_in_picks ? 0 : 1;
        $this->db->where('id', $id)->update('courses_tbl', ['show_in_picks' => $new_val]);
        if ($new_val && (int) $row->block_status === 0) {
            $this->notification_service->notify_all_users(
                'top_picks_course',
                'Course added to top picks',
                $row->product_name ?: 'Course update',
                'Programsfull/program/' . (int) $id,
                'course',
                $id,
                'courses'
            );
        }
        $this->output->set_output(json_encode(['success' => true, 'picks' => $new_val]));
    }
  
  
    public function block($id)
     {
     $id = $this->uri->segment(3);
     $sql = $this->um->get_dataa('courses_tbl',['id'=>$id]);
   
     $status= $sql[0]->block_status;
     if ($id) {
      
     if ($status==0) {
      
      $data= $this->um->update('courses_tbl',['id'=>$id],['block_status'=>1]);
       $this->session->set_flashdata('success', 'Course Unpublished Successfully');
       redirect (base_url().'Courses/course_view');die();

     }else{
      
         $data= $this->um->update('courses_tbl',['id'=>$id],['block_status'=>0]);
          if ($this->course_is_visible_in_top_picks($id)) {
              $this->notification_service->notify_all_users(
                  'top_picks_course',
                  'Course published in top picks',
                  !empty($sql[0]->product_name) ? $sql[0]->product_name : 'Course update',
                  'Programsfull/program/' . (int) $id,
                  'course',
                  $id,
                  'courses'
              );
          }
          $this->session->set_flashdata('success', 'Course Published Successfully');
           redirect (base_url().'Courses/course_view');die();
        }
     }else{
         
          $this->session->set_flashdata('error', 'Course id not found');
           redirect (base_url().'Courses/course_view');die();
     }
    }
    private function course_is_visible_in_top_picks($course_id)
    {
        $course_id = (int) $course_id;
        if ($course_id <= 0) return false;

        if (!$this->db->field_exists('show_in_picks', 'courses_tbl')) {
            $course = $this->db->select('block_status')->get_where('courses_tbl', ['id' => $course_id])->row();
            return $course && (int) $course->block_status === 0;
        }

        $course = $this->db->select('show_in_picks, block_status')->get_where('courses_tbl', ['id' => $course_id])->row();
        if (!$course || (int) $course->block_status !== 0) return false;
        if ((int) $course->show_in_picks === 1) return true;

        $picked_count = (int) $this->db
            ->where('block_status', 0)
            ->where('show_in_picks', 1)
            ->count_all_results('courses_tbl');

        return $picked_count === 0;
    }
    public function delete_course(){
      $id = $this->uri->segment(3);
      if ($this->db->table_exists('user_saved_courses')) {
          $this->db->where('course_id', $id)->delete('user_saved_courses');
      }
      $res = $this->um->delete('courses_tbl',['id'=>$id]);
         
        if($res)                            
        {
            $this->session->set_flashdata('success', 'Course Deleted Successfully');
             redirect (base_url().'Courses/course_view');die();
        }else{
            $this->session->set_flashdata('error', 'Course Not Deleted');
             redirect (base_url().'Courses/course_view');die();
        }
    }

}
