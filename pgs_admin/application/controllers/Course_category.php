<?php

class Course_category extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->model('User_model','um'); 
        $this->load->library('form_validation');
        if (!$this->session->userdata('user_id')) {
         redirect('Users/logout');
         }

    }
    public function index()
    {
        $this->load->library('pagination');
        $per_page = 15;
        $page = max(1, (int) $this->uri->segment(2));
        $offset = ($page - 1) * $per_page;
        $total = $this->db->count_all('course_category_tbl');
        $config['base_url'] = base_url('Course_category/index');
        $config['total_rows'] = $total;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['cur_page'] = $page;
        $config['num_links'] = 3;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();
        $data['product'] = $this->db->order_by('id', 'desc')->limit($per_page, $offset)->get('course_category_tbl')->result();
        $this->load->view('course_category_view', $data);
    }
    public function add_course_category(){

      $this->load->view('course_category');
   }
    
    public function add_course_category_data()
    {

        $category_name = $this->input->post('category_name');
        
        $prod_data = [
            'category_name' => $category_name,
            'block_status'          => 0
        ];

        $id = $this->um->insert('course_category_tbl', $prod_data);

        if ($id) {
            $this->session->set_flashdata('success', 'Course Category added successfully');
            redirect(base_url() . 'Course_category');
        } else {
            $this->session->set_flashdata('error', 'Course Category not added');
            redirect(base_url() . 'Course_category/add_course_category');
        }
    }




    public function edit_course_category($id)
    {

        $id = $this->uri->segment(3);
        $this->session->set_userdata('id', $id);

        $article = $this->db->get_where('course_category_tbl', ['id' => $id])->row();

        // If not found, redirect
        if (!$article) {
            redirect(base_url('Course_category'));
            return;
        }

        $data['product'] = $article;

        //print_r($data['product']);die();

        $this->load->view('edit_course_category', $data);
    }


    public function edit_course_category_data()
    {
        $this->load->library('session');

        $p_id = $this->input->post('id');

        $category_name = $this->input->post('category_name');

        if (empty($category_name)) {
            $this->session->set_flashdata('error', 'Course Category Name is required');
            redirect(base_url('Course_category/edit_course_category/' . $p_id));
            return;
        }

        $prod_data = [
            'category_name' => $category_name,
        ];

        $updated = $this->um->update('course_category_tbl', ['id' => $p_id], $prod_data);

        if ($updated) {
            $this->session->set_flashdata('success', 'Course Category updated successfully');
            redirect(base_url('Course_category'));
        } else {
            $this->session->set_flashdata('error', 'Event not updated');
            redirect(base_url('Course_category/edit_course_category') . $p_id);
        }
    }

    

   public function delete_course_category(){
      $id = $this->uri->segment(3);
         $res = $this->um->delete('course_category_tbl',['id'=>$id]);
         
        if($res)                            
        {
            $this->session->set_flashdata('success', 'Course Category Deleted Successfully');
             redirect (base_url().'Course_category');die();
        }else{
            $this->session->set_flashdata('error', 'Course Category Not Deleted');
             redirect (base_url().'Course_category');die();
        }
    }

    public function block($id)
    {
        $id = $this->uri->segment(3);
        $sql = $this->um->get_dataa('course_category_tbl', ['id' => $id]);
    
        if ($id && !empty($sql)) {
            $status = $sql[0]->block_status;
    
            if ($status == 0) {
                // Unpublish Event
                $this->um->update('course_category_tbl', ['id' => $id], ['block_status' => 1]);
    
                $this->session->set_flashdata('success', 'Course Category Unpublished Successfully');
                redirect(base_url('Course_category'));
            } else {
                // Publish Event
                $this->um->update('course_category_tbl', ['id' => $id], ['block_status' => 0]);
                $this->session->set_flashdata('success', 'Course Category Published Successfully');
                redirect(base_url('Course_category'));
            }
        } else {
            $this->session->set_flashdata('error', 'Course Category ID not found');
            redirect(base_url('Course_category'));
        }
    }
 
   
    

}