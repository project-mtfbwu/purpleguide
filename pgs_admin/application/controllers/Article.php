<?php

class Article extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->model('User_model','um'); 
        $this->load->library('form_validation');
        
        if (!$this->session->userdata('user_id')) {
         redirect('Users/logout');
         }

    }
    public function add_article(){
        $data['cate'] =  $this->db->query("SELECT * FROM `article_category_tbl` where block_status='0'")->result();

        $this->load->view('article', $data);
   }
    
    // public function add_article_data()
    // {
    //     $this->load->library('form_validation');

    //     $this->form_validation->set_rules('prod_name', 'Blog Title', 'required|trim');
    //     $this->form_validation->set_rules('pro_desc', 'Blog Description', 'required|trim');

    //     if (empty($_FILES['banner_image']['name'])) {
    //         $this->form_validation->set_rules('banner_image', 'Blog Image', 'required');
    //     }

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->session->set_flashdata('error', validation_errors());
    //         redirect(base_url() . 'Article/add_article');
    //     }

    //     $desc = $this->input->post('pro_desc');
    //     $view_home = $this->input->post('view_home');

    //     $name = ucfirst(trim($this->input->post('prod_name'), " \t"));
    //     $product_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));

    //     $cat_id = $this->input->post('cat_id');
        
    //     $subcat_name = $this->input->post('subcat_name');

    //     $image1 = $this->um->file_upload('banner_image', 'assets/images/');
    //     $image2 = $this->um->file_upload('thumb_image', 'assets/images/');

    //     $prod_data = [
    //         'cat_id' => $cat_id,
    //         'subcat_id' => $subcat_name,
    //         'description' => $desc,
    //         'product_name' => $name,
    //         // 'view_home' => $view_home,
    //         'product_slug' => $product_slug,
    //         'date'          => date('Y-m-d H:i:s')
    //     ];

    //     if ($image1) {
    //         $prod_data['image1'] = $image1;
    //     }

    //     if ($image2) {
    //         $prod_data['image2'] = $image2;
    //     }

    //     $id = $this->um->insert('article_tbl', $prod_data);

    //     if ($id) {
    //         $this->session->set_flashdata('success', 'Blog added successfully');
    //         redirect(base_url() . 'Article/article_view');
    //     } else {
    //         $this->session->set_flashdata('error', 'Blog not added');
    //         redirect(base_url() . 'Article/add_article');
    //     }
    // }
    
    public function add_article_data()
    {
        $this->load->library('form_validation');
    
        $this->form_validation->set_rules('prod_name', 'Blog Title', 'required|trim');
        $this->form_validation->set_rules('pro_desc', 'Blog Description', 'required|trim');
    
        if (empty($_FILES['banner_image']['name'])) {
            $this->form_validation->set_rules('banner_image', 'Blog Image', 'required');
        }
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect(base_url() . 'Article/add_article');
        }
    
        $desc = $this->input->post('pro_desc');
        $view_home = $this->input->post('view_home');
    
        $name = ucfirst(trim($this->input->post('prod_name'), " \t"));
        $base_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
    
        // --- Check if slug already exists ---
        $product_slug = $base_slug;
        $count = 1;
        while (true) {
            $this->db->where('product_slug', $product_slug);
            $exists = $this->db->get('article_tbl')->num_rows();
            if ($exists > 0) {
                // If slug exists, append number
                $product_slug = $base_slug . '-' . $count;
                $count++;
            } else {
                break;
            }
        }
        // ------------------------------------
    
        $cat_id = $this->input->post('cat_id');
        $subcat_name = $this->input->post('subcat_name');
    
        $image1 = $this->um->file_upload('banner_image', 'assets/images/');
        $image2 = $this->um->file_upload('thumb_image', 'assets/images/');
    
        $prod_data = [
            'cat_id'       => $cat_id,
            'subcat_id'    => $subcat_name,
            'description'  => $desc,
            'product_name' => $name,
            'product_slug' => $product_slug,
            'date'         => date('Y-m-d H:i:s')
        ];
    
        if ($image1) {
            $prod_data['image1'] = $image1;
        }
    
        if ($image2) {
            $prod_data['image2'] = $image2;
        }
    
        $id = $this->um->insert('article_tbl', $prod_data);
    
        if ($id) {
            $this->session->set_flashdata('success', 'Blog added successfully');
            redirect(base_url() . 'Article/article_view');
        } else {
            $this->session->set_flashdata('error', 'Blog not added');
            redirect(base_url() . 'Article/add_article');
        }
    }





    public function edit_article($id)
    {
        $this->load->library('session');

        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
        }

        $id = $this->uri->segment(3);
        $this->session->set_userdata('id', $id);

        $article = $this->db->get_where('article_tbl', ['id' => $id])->row();
        
        $category = $this->db->where('block_status', 0)->get('article_category_tbl')->result();

        if (!$article) {
            redirect(base_url('Article/article_view'));
            return;
        }

        $data['product'] = $article;
        
        $data['category'] = $category;

        $this->load->view('edit_article', $data);
    }


    // public function edit_article_data()
    // {
    //     $this->load->library('session');

    //     $p_id = $this->input->post('id');

    //     $name = ucfirst(trim($this->input->post('prod_name'), " \t"));
        
    //     $product_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
        
        
    //     $description = $this->input->post('description');
    //     $cat_id = $this->input->post('cat_id');

    //     if (empty($name)) {
    //         $this->session->set_flashdata('error', 'Blog Title is required');
    //         redirect(base_url('Article/edit_article/' . $p_id));
    //         return;
    //     }

    //     if (empty($description)) {
    //         $this->session->set_flashdata('error', 'Blog Description is required');
    //         redirect(base_url('Article/edit_article/' . $p_id));
    //         return;
    //     }

    //     if (empty($name)) {
    //         $this->session->set_flashdata('error', 'Product name is required');
    //         redirect(base_url('Article/edit_article/') . $p_id);
    //         return;
    //     }

    //     $prod_data = [
    //         'product_name' => $name,
    //         'description' => $description,
    //         'cat_id' => $cat_id,
    //         'product_slug' => $product_slug,
    //         //'view_home' => $view_home
    //     ];

    //     $image1 = $this->um->file_upload('prod_image1', 'assets/images/');
    //     if ($image1) {
    //         $prod_data['image1'] = $image1;
    //     }

    //     $updated = $this->um->update('article_tbl', ['id' => $p_id], $prod_data);

    //     if ($updated) {
    //         $this->session->set_flashdata('success', 'Blog updated successfully');
    //         redirect(base_url('Article/article_view'));
    //     } else {
    //         $this->session->set_flashdata('error', 'Blog not updated');
    //         redirect(base_url('Article/edit_article/') . $p_id);
    //     }
    // }
    
    public function edit_article_data()
    {
        $this->load->library('session');
    
        $p_id = $this->input->post('id');
        $name = ucfirst(trim($this->input->post('prod_name'), " \t"));
        $base_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
    
        // --- Check for unique slug (exclude current record) ---
        $product_slug = $base_slug;
        $count = 1;
        while (true) {
            $this->db->where('product_slug', $product_slug);
            $this->db->where('id !=', $p_id); // exclude current blog
            $exists = $this->db->get('article_tbl')->num_rows();
            if ($exists > 0) {
                $product_slug = $base_slug . '-' . $count;
                $count++;
            } else {
                break;
            }
        }
        // ------------------------------------------------------
    
        $description = $this->input->post('description');
        $cat_id = $this->input->post('cat_id');
    
        if (empty($name)) {
            $this->session->set_flashdata('error', 'Blog Title is required');
            redirect(base_url('Article/edit_article/' . $p_id));
            return;
        }
    
        if (empty($description)) {
            $this->session->set_flashdata('error', 'Blog Description is required');
            redirect(base_url('Article/edit_article/' . $p_id));
            return;
        }
    
        $prod_data = [
            'product_name' => $name,
            'description'  => $description,
            'cat_id'       => $cat_id,
            'product_slug' => $product_slug,
            //'view_home'  => $view_home
        ];
    
        $image1 = $this->um->file_upload('prod_image1', 'assets/images/');
        if ($image1) {
            $prod_data['image1'] = $image1;
        }
    
        $updated = $this->um->update('article_tbl', ['id' => $p_id], $prod_data);
    
        if ($updated) {
            $this->session->set_flashdata('success', 'Blog updated successfully');
            redirect(base_url('Article/article_view'));
        } else {
            $this->session->set_flashdata('error', 'Blog not updated');
            redirect(base_url('Article/edit_article/' . $p_id));
        }
    }


    // public function article_view()
    // {
    //     $this->load->library('session');
    //     if (!$this->session->userdata('user_id')) {
    //         redirect('Users/logout');
    //     }
        
    //     $cat_id = $this->input->post('cat_id');

    //     $data['product'] = $this->db
    //     ->select('article_tbl.*, article_category_tbl.category_name AS category_name')
    //     ->from('article_tbl')
    //     ->join('article_category_tbl', 'article_tbl.cat_id = article_category_tbl.id', 'left')
    //     ->order_by('article_tbl.id', 'desc')
    //     ->get()
    //     ->result();
    //     //print_r($data['product']);die();
        
    //     if (!empty($cat_id)) {
    //         $this->db->where('article_tbl.cat_id', $cat_id);
    //     }
        
    //     $data['cate'] =  $this->db->query("SELECT * FROM `article_category_tbl` where block_status='0'")->result();

    //     $this->load->view('article_view', $data);
    // }
    
    public function article_view()
    {
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
        }
        $cat_id = $this->input->post('cat_id');  
    
        $this->db->select('article_tbl.*, article_category_tbl.category_name AS category_name')
                 ->from('article_tbl')
                 ->join('article_category_tbl', 'article_tbl.cat_id = article_category_tbl.id', 'left')
                 ->order_by('article_tbl.id', 'desc');
    
        if (!empty($cat_id)) {
            $this->db->where('article_tbl.cat_id', $cat_id);
        }
    
        $data['product'] = $this->db->get()->result();
    
        $data['cate'] = $this->db->query("SELECT * FROM `article_category_tbl` WHERE block_status='0'")->result();
    
        $this->load->view('article_view', $data);
    }



    public function block($id)
    {
        $id = $this->uri->segment(3);
        $sql = $this->um->get_dataa('article_tbl', ['id' => $id]);
    
        if ($id && !empty($sql)) {
            $status = $sql[0]->block_status;
    
            if ($status == 0) {
                $this->um->update('article_tbl', ['id' => $id], ['block_status' => 1]);
    
                $this->um->update('article_tbl', ['id' => $id], ['view_home' => 0]);
    
                $this->session->set_flashdata('success', 'Blog Unpublished Successfully');
                redirect(base_url('Article/article_view'));
            } else {
                $this->um->update('article_tbl', ['id' => $id], ['block_status' => 0]);
                $this->session->set_flashdata('success', 'Blog Published Successfully');
                redirect(base_url('Article/article_view'));
            }
        } else {
            $this->session->set_flashdata('error', 'Blog ID not found');
            redirect(base_url('Article/article_view'));
        }
    }

   public function delete_article(){
      $id = $this->uri->segment(3);
         $res = $this->um->delete('article_tbl',['id'=>$id]);
         
        if($res)                            
        {
            $this->session->set_flashdata('success', 'Blog Deleted Successfully');
             redirect (base_url().'Article/article_view');die();
        }else{
            $this->session->set_flashdata('error', 'Blog Not Deleted');
             redirect (base_url().'Article/article_view');die();
        }
    }

    public function get_subcategories() {
        $category_id = $this->input->post('categoryId');
        $query = $this->db->get_where('subcategory_tbl', array('category_id' => $category_id));
              
        echo json_encode($query->result_array());
    }
 public function dlt_lays(){
       $p_id = $this->uri->segment(4);
       $id=$this->uri->segment(3);
       //print_r($p_id);print_r($id);die();
       $sql = $this->um->delete('article_layouts',['id'=>$id]);
       if($sql){
           redirect(base_url('Article/edit_article/'.$p_id));
       }
       else{
            redirect(base_url('Article/edit_article/'.$p_id));
       }
   }
   
    public function toggle_view_home($id)
    {
        $this->load->database();

        $query = $this->db->get_where('article_tbl', ['id' => $id]);
        $row = $query->row();
    
        if ($row) {
            if ($row->view_home == 1) {
                $this->db->where('id', $id);
                $this->db->update('article_tbl', ['view_home' => 0]);
                $this->session->set_flashdata('success', 'Blog removed from homepage.');
            } else {
                if ($row->block_status == 1) {
                    $this->session->set_flashdata('error', 'Only published blogs can be made visible on the homepage.');
                } else {
                    $this->db->where('id', $id);
                    $this->db->update('article_tbl', ['view_home' => 1]);
                    $this->session->set_flashdata('success', 'Blog is now visible on the homepage.');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Blog not found.');
        }
    
        redirect(base_url('Article/article_view'));
    }


}