<?php

class Category extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->model('User_model','um'); 

    }
    public function add_category(){
        $this->load->library('session');
         if (!$this->session->userdata('user_id')) {
         redirect('Users/logout');
         }
    //   $data['parent_cat']=$this->um->get_dataa('category_tbl',['block_status'=>0]);
    $sql = "SELECT * FROM `category_tbl` where category_id='0' and block_status='0' ";
         $data['parent_cat']=$this->db->query($sql)->result();
      $this->load->view('category',$data);
   }
   public function add_category_data(){
        $select_cat = $this->input->post('category');
        $cat_name  = $this->input->post('cat_name');
      $title_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cat_name), '-'));
       $randomNumber = rand(1, 100);
        $image = $this->um->file_upload('cat_image','assets/images/');
        $desc = $this->input->post('cat_desc');
        if (empty($cat_name)) {
          $this->session->set_flashdata('error','All field required');
                redirect (base_url().'/Category/add_category');die();
        }
         $data = $this->um->add_data('category_tbl',['category_id'=>$select_cat,'category_name'=>$cat_name,'slug_name'=>$title_slug.'-'.$randomNumber,'description'=>$desc,'cat_image'=>$image]);
         if ($data) {
                 $this->session->set_flashdata('success','Category Added Successfully');
                redirect (base_url().'/Category/category_view');die();
         }else{
            $this->session->set_flashdata('error','Category didnt add');
                redirect (base_url().'/Category/add_category');die();
         }
   }
   
    public function category_view(){
        $this->load->library('session');
         if (!$this->session->userdata('user_id')) {
         redirect('Users/logout');
         } 
   $data['category'] = $this->db->query("SELECT * FROM `category_tbl` ORDER BY CASE WHEN `category_id` = '0' THEN `id` ELSE `category_id` END, `category_id`")->result();
      $this->load->view('category_view',$data);
   }
   public function delete_category(){
      $id = $this->uri->segment(3);

      $ress = $this->um->get_dataa('subcategory_tbl',['category_id'=>$id]);
      if($ress){
         $this->session->set_flashdata('error', 'This Category already has a Sub category');
         redirect (base_url().'Category/category_view');die();
      }
           
             $resss = $this->um->get_dataa('product_tbl',['cat_id'=>$id]);
        if($resss){
            $this->session->set_flashdata('error', 'This Category has a Product ');
            redirect (base_url().'Category/category_view');die();
        }

         $res = $this->um->delete('category_tbl',['id'=>$id]);
         
        if($res)                            
        {
            $this->session->set_flashdata('success', 'category deleted successfully');
             redirect (base_url().'Category/category_view');die();
        }else{
            $this->session->set_flashdata('error', 'something went wrong please try again..');
             redirect (base_url().'Category/category_view');die();
        }
    }
    public function edit_category(){
      $id = $this->uri->segment(3);
      $data = array();     

         $res = $this->um->get_dataa('category_tbl',['id'=>$id]);
         if (!$res) {
              $this->session->set_flashdata('error', 'Invalid category id');
             redirect (base_url().'/Category/category_view');die();
         }



            $data['category'] = $res;
          if($data['category'][0]->category_id != 0)                                      
        {
         $sql = "SELECT * FROM `category_tbl` ORDER BY CASE WHEN `category_id` = '0' THEN `id` ELSE `category_id` END, `category_id` ";
         $data['parent_cat']=$this->db->query($sql)->result();
         $data['cat'] = $this->um->get_dataa('category_tbl',['id'=>$id]);

         $data['catt'] = $this->um->get_dataa('category_tbl',['id'=>$data['cat'][0]->category_id]);
         $this->load->view('edit_category',$data);

        }
        else{
         $data['category']  = $this->um->get_dataa('category_tbl',['id'=>$id]);
         $this->load->view('edit_category',$data);
        }
    }
    public function update_category(){
        $prod_data = array();
        
      $id = $this->uri->segment(3);
      $category = $this->um->get_dataa('category_tbl',['id'=>$id]);
      
        $select_cat = $this->input->post('category_id');
         //print_r($select_cat);
         //die();
        if($select_cat){
             $prod_data['category_id']       = $select_cat;
        }
        
        $cat_name  = $this->input->post('cat_name');
            $title_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cat_name), '-'));
       $randomNumber = rand(1, 100);
        if (empty($cat_name)) {
          $this->session->set_flashdata('error','All field required');
                redirect (base_url().'Category/category_view');die();
        }
                $img=  $this->um->file_upload('cat_image','assets/images/');
           if($img){
           $cat_image = $img;
              $prod_data['cat_image']       = $cat_image; 
           }
          $prod_data['category_name']       = $cat_name;
          $prod_data['slug_name']            = $title_slug.'-'.$randomNumber;  
          
         $data = $this->um->update('category_tbl',['id'=>$id],$prod_data);
         if ($data) {
                 $this->session->set_flashdata('success','Category Updated Successfully');
                redirect (base_url().'Category/category_view');die();
         }else{
            $this->session->set_flashdata('error','Data Not Updated');
                redirect (base_url().'Category/edit_category');die();
         }
    }
     function block_category($id)
    {
    $id = $this->uri->segment(3);
    $sql = $this->um->get_dataa('category_tbl',['id'=>$id]);
   $status= $sql[0]->block_status;
 
   if ($id) {
      
   if ($status==0) {
       $this->session->set_flashdata('success', 'Category locked Successfully');
      $data= $this->um->update('category_tbl',['id'=>$id],['block_status'=>1]);
    $get = $this->db->query("select * from category_tbl where id = '$id'")->result();
     $dd = $get[0]->category_id;
     if($dd == 0){
        $data= $this->um->update('category_tbl',['category_id'=>$id],['block_status'=>1]);
     }
     
       redirect (base_url().'Category/category_view');die();

   }else{
      
         $data= $this->um->update('category_tbl',['id'=>$id],['block_status'=>0]);
          $this->session->set_flashdata('success', 'Category Unlocked  Successfully');
           redirect (base_url().'Category/category_view');die();
        }
    }else{
         
         
           redirect (base_url().'Category/category_view');die();
    }
   }
        public function news_event(){
        $data['category'] = $this->db->query("select * from news_event_cat order by category_name asc")->result();
        $this->load->view('news_event',$data);
      }
         public function view_news_event(){
            $sql = "SELECT b.*, a.category_id, a.category_name 
              FROM news_event AS b 
              JOIN news_event_cat AS a ON a.category_id = b.category_id";

            $data['news'] = $this->db->query($sql)->result(); 
                    $this->load->view('view_news_event',$data);
        }
        public function add_news_event(){
        $category_id = $this->input->post('category_id');
        $title = $this->input->post('title');
        $thumbnail = $this->um->file_upload('thumbnail','assets/images/');
        $banner = $this->um->file_upload('banner','assets/images/');
        $content = $this->input->post('content');
         if (empty($category_id )||empty($content)) {
          $this->session->set_flashdata('error','All field required');
                redirect (base_url().'/Category/news_event');die();
        }
         $data = $this->um->add_data('news_event',['category_id'=>$category_id,'news_content'=>$content,'news_thumbnail'=>$thumbnail,'news_banner'=>$banner,'news_title'=>$title]);
         if ($data) {
                 $this->session->set_flashdata('success','News Added Successfully');
                redirect (base_url().'/Category/view_news_event');die();
         }else{
            $this->session->set_flashdata('error','News didnt add');
                redirect (base_url().'/Category/news_event');die();
         }
      }
           public function delete_news(){
        $id = $this->uri->segment(3);
          $res = $this->um->delete('news_event',['id'=>$id]);
         
        if($res)                            
        {
            $this->session->set_flashdata('success', 'category deleted successfully');
             redirect (base_url().'Category/view_news_event');die();
        }else{
            $this->session->set_flashdata('error', 'something went wrong please try again..');
             redirect (base_url().'/Category/view_news_event');die();
        }
       }
       public function edit_news_event(){
        $id = $this->uri->segment(3);
         $data['category'] = $this->db->query("select * from news_event_cat order by category_name asc")->result();
         if($id){
        $sql = "SELECT b.*, a.category_id, a.category_name 
        FROM news_event AS b 
        JOIN news_event_cat AS a ON a.category_id = b.category_id where b.id = '$id'";

        $data['news'] = $this->db->query($sql)->result(); 
        $this->load->view('edit_news_event',$data);
    }else{
         $this->session->set_flashdata('error', 'Not Found');
             redirect (base_url().'/Category/view_news_event');die();
        }
    }
       
       public function update_news_event(){
        $config_data = array();
          $id = $this->input->post('id');
         $category_id = $this->input->post('category_id');
        $title = $this->input->post('title');
        $thumbnail = $this->um->file_upload('thumbnail','assets/images/');
        $banner = $this->um->file_upload('banner','assets/images/');
        $content = $this->input->post('content');
         if (empty($category_id )||empty($content)) {
          $this->session->set_flashdata('error','All field required');
                redirect (base_url('Category/edit_news_event/').$id);die();
        }

        if ($thumbnail) {
               $config_data['news_thumbnail'] = $thumbnail;
        }
        if ($banner) {
            $config_data['news_banner'] = $banner;
        }
          $config_data['news_title'] =   $title;
          $config_data['news_content'] = $content;
          $config_data['category_id'] =  $category_id;
          $data = $this->um->update('news_event',['id'=>$id],$config_data);
          if ($data) {
               $this->session->set_flashdata('success','News Updated Successfully');
                redirect (base_url('Category/edit_news_event/').$id);die();
          }
          else{
             $this->session->set_flashdata('error','News didnt Update');
                redirect (base_url('Category/edit_news_event/').$id);die();
          }

       }
      public function delete_multi_news(){
           $id = $this->input->post('multi_id');
        if (!$id) {
            $this->session->set_flashdata('error', 'Please Select First');
            redirect(base_url('Category/view_news_event'));
            die();
        }

        $success = true; // A flag to track if all deletions were successful.

        foreach ($id as $g_id) {
            $sql = $this->um->delete('news_event',['id'=>$g_id]);

            if (!$sql) {
                // If a deletion fails, set the $success flag to false.
                $success = false;
            }
        }

        if ($success) {
            $this->session->set_flashdata('success', 'All selected News and Events have been deleted');
        } else {
            $this->session->set_flashdata('error', 'Some News and Events could not be deleted');
        }

        redirect(base_url('Category/view_news_event'));
        die();
          }

    public function add_subcategory(){
        $this->load->library('session');
         if (!$this->session->userdata('user_id')) {
         redirect('Users/logout');
         }
    //   $data['parent_cat']=$this->um->get_dataa('category_tbl',['block_status'=>0]);
    $sql = "SELECT * FROM `category_tbl` where block_status='0'";
         $data['parent_cat']=$this->db->query($sql)->result();
         //print_r($data);die();
      $this->load->view('subcategory',$data);
   }

      public function add_subcategory_data(){
        $select_cat = $this->input->post('category');
        $cat_name  = $this->input->post('cat_name');
      $title_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cat_name), '-'));
       $randomNumber = rand(1, 100);
        $image = $this->um->file_upload('cat_image','assets/images/');
        $desc = $this->input->post('cat_desc');
        if (empty($cat_name)) {
          $this->session->set_flashdata('error','All field required');
                redirect (base_url().'/Category/add_subcategory');die();
        }
         $data = $this->um->add_data('subcategory_tbl',['category_id'=>$select_cat,'category_name'=>$cat_name,'slug_name'=>$title_slug.'-'.$randomNumber,'description'=>$desc,'cat_image'=>$image]);
         if ($data) {
                 $this->session->set_flashdata('success','Category Added Successfully');
                redirect (base_url().'Category/subcategory_view');die();
         }else{
            $this->session->set_flashdata('error','Category didnt add');
                redirect (base_url().'/Category/add_subcategory');die();
         }
   }

   public function subcategory_view(){
    $this->load->library('session');
         if (!$this->session->userdata('user_id')) {
         redirect('Users/logout');
         }

    $whr = '';
          $category_name = $this->input->post('cat_name');
     if($category_name){
         $whr =" where cat.id = '$category_name' OR cat.category_id = '$category_name'";
       //print_r ($whr);die();
     }


   $data['category'] = $this->db->query("SELECT sub.*, cat.*,sub.category_name as category_name,sub.block_status as block_status,sub.id as id,sub.cat_image as cat_images ,cat.category_name as category_names FROM subcategory_tbl AS sub JOIN category_tbl AS cat ON sub.category_id = cat.id $whr ;
")->result();
   //print_r($data);die();
   $data['cate'] = $this->db->query("SELECT * FROM `category_tbl` where block_status='0'")->result();

      $this->load->view('subcategory_view',$data);
   }

       public function edit_subcategory(){
      $id = $this->uri->segment(3);
      $data = array();     

         $res = $this->um->get_dataa('subcategory_tbl',['id'=>$id]);
         if (!$res) {
              $this->session->set_flashdata('error', 'Invalid category id');
             redirect (base_url().'/Category/category_view');die();
         }



            $data['category'] = $res;
          if($data['category'][0]->category_id != 0)                                      
        {
         $sql = "SELECT sub.*, cat.* FROM subcategory_tbl AS sub JOIN category_tbl AS cat ON sub.category_id = cat.id WHERE sub.id = $id;

";
         $data['parent_cat']=$this->db->query($sql)->result();
         //print_r($data['parent_cat']);die();
         $data['cat'] = $this->um->get_dataa('subcategory_tbl',['id'=>$id]);

         $data['catt'] = $this->um->get_dataa('category_tbl',['category_id'=>'Article Type']);
         
         $this->load->view('edit_subcategory',$data);

        }
        else{
         $data['category']  = $this->um->get_dataa('category_tbl',['id'=>$id]);
         $this->load->view('edit_subcategory',$data);
        }
    }

    public function update_subcategory(){
        $prod_data = array();
        
      $id = $this->uri->segment(3);
      $category = $this->um->get_dataa('subcategory_tbl',['id'=>$id]);

      //print_r($category);die();
      
        $select_cat = $this->input->post('select');
         //print_r($select_cat);die();
        if($select_cat){
             $prod_data['category_id']       = $select_cat;
        }
        
        $cat_name  = $this->input->post('cat_name');
            $title_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cat_name), '-'));
       $randomNumber = rand(1, 100);
        if (empty($cat_name)) {
          $this->session->set_flashdata('error','All field required');
                redirect (base_url().'Category/category_view');die();
        }
                $img=  $this->um->file_upload('cat_image','assets/images/');
           if($img){
           $cat_image = $img;
              $prod_data['cat_image']       = $cat_image; 
           }
          $prod_data['category_name']       = $cat_name;
          $prod_data['slug_name']            = $title_slug.'-'.$randomNumber;  
          
         $data = $this->um->update('subcategory_tbl',['id'=>$id],$prod_data);
         if ($data) {
                 $this->session->set_flashdata('success','Sub Category Updated Successfully');
                redirect (base_url().'Category/subcategory_view');die();
         }else{
            $this->session->set_flashdata('error','Data Not Updated');
                redirect (base_url().'Category/edit_subcategory');die();
         }
    }
       public function delete_subcategory(){
      $id = $this->uri->segment(3);

      $ress = $this->um->get_dataa('category_tbl',['category_id'=>$id]);
      if($ress){
         $this->session->set_flashdata('error', 'This Category already has a child category');
         redirect (base_url().'Category/subcategory_view');die();
      }
           
             $resss = $this->um->get_dataa('product_tbl',['cat_id'=>$id]);
        if($resss){
            $this->session->set_flashdata('error', 'This Sub Category has a Product ');
            redirect (base_url().'Category/subcategory_view');die();
        }
        $resss = $this->um->get_dataa('gallery_tbl',['cat_id'=>$id]);
        if($resss){
            $this->session->set_flashdata('error', 'This Sub Category has a Gallery ');
            redirect (base_url().'Category/subcategory_view');die();
        }
        $resss = $this->um->get_dataa('article_tbl',['cat_id'=>$id]);
        if($resss){
            $this->session->set_flashdata('error', 'This Sub Category has a Article ');
            redirect (base_url().'Category/subcategory_view');die();
        }

         $res = $this->um->delete('subcategory_tbl',['id'=>$id]);
         
        if($res)                            
        {
            $this->session->set_flashdata('success', 'Sub category deleted successfully');
             redirect (base_url().'Category/subcategory_view');die();
        }else{
            $this->session->set_flashdata('error', 'something went wrong please try again..');
             redirect (base_url().'Category/subcategory_view');die();
        }
    }
         function block_subcategory($id)
    {
    $id = $this->uri->segment(3);
    $sql = $this->um->get_dataa('subcategory_tbl',['id'=>$id]);
   $status= $sql[0]->block_status;
 
   if ($id) {
      
   if ($status==0) {
       $this->session->set_flashdata('success', 'Sub Category locked Successfully');
      $data= $this->um->update('subcategory_tbl',['id'=>$id],['block_status'=>1]);
    $get = $this->db->query("select * from subcategory_tbl where id = '$id'")->result();
     $dd = $get[0]->category_id;
     if($dd == 0){
        $data= $this->um->update('subcategory_tbl',['category_id'=>$id],['block_status'=>1]);
     }
     
       redirect (base_url().'Category/subcategory_view');die();

   }else{
      
         $data= $this->um->update('subcategory_tbl',['id'=>$id],['block_status'=>0]);
          $this->session->set_flashdata('success', 'Sub Category Unlocked  Successfully');
           redirect (base_url().'Category/subcategory_view');die();
        }
    }else{
         
         
           redirect (base_url().'Category/subcategory_view');die();
    }
   }




 }