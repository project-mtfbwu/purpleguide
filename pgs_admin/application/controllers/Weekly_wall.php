<?php
$sessionDriverPath = APPPATH . 'controllers/drivers/Session_files_driver.php';

class Weekly_wall extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->model('User_model','um'); 
        $this->load->library('session');
        $this->load->library('Notification_service');
         if (!$this->session->userdata('user_id')) {
         redirect('Users/logout');
         }

    }
    public function index()
    {
        $data['product'] = $this->db->order_by('id', 'desc')->get('weekly_wall_tbl')->result();
        $this->load->view('weekly_wall', $data);
    }
    public function add_weekly_wall(){        
        $this->load->view('add_weekly_wall');
    }
    
    public function add_weekly_wall_data()
    {
        $desc = $this->input->post('pro_desc');

        //print_r($view_home);die();
        $name = ucfirst(trim($this->input->post('prod_name'), " \t"));
        $product_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));

        // Get category and subcategory from POST
        $cat_name = $this->input->post('cat_name');
        $subcat_name = $this->input->post('subcat_name');

        // Image upload for banner
        $image1 = $this->um->file_upload('banner_image', 'assets/images/');
        if ($image1) {
            $prod_data['image1'] = $image1;
        }

        // Image upload for thumbnail
        $image2 = $this->um->file_upload('thumb_image', 'assets/images/');
        if ($image2) {
            $prod_data['image2'] = $image2;
        }

        // Prepare data for insert
        $prod_data['cat_id'] = $cat_name;
        $prod_data['subcat_id'] = $subcat_name;
        $prod_data['description'] = $desc;
        $prod_data['product_name'] = $name;
        $prod_data['product_slug'] = $product_slug;

        // Insert into article_tbl
        $id = $this->um->insert('weekly_wall_tbl', $prod_data);

        if ($id) {
            $this->notification_service->notify_section_all_users(
                'weekly_wall',
                'New update on the weekly wall',
                $name,
                'weekly_wall',
                $id
            );
            $this->session->set_flashdata('success', 'Weekly wall added successfully');
            redirect(base_url() . 'Weekly_wall');
        } else {
            $this->session->set_flashdata('error', 'Weekly wall not added');
            redirect(base_url() . 'Weekly_wall/add_weekly_wall');
        }
    }



    public function edit_weekly_wall($id)
    {

        $id = $this->uri->segment(3);
        $this->session->set_userdata('id', $id);

        $article = $this->db->get_where('weekly_wall_tbl', ['id' => $id])->row();

        if (!$article) {
            redirect(base_url('Weekly_wall'));
            return;
        }

        $data['product'] = $article;

        $this->load->view('edit_weekly_wall', $data);
    }


    public function edit_weekly_wall_data()
    {
        $this->load->library('session');

        $p_id = $this->input->post('id');

        //print_r($p_id);die();
        $name = ucfirst(trim($this->input->post('prod_name'), " \t"));
        $description = $this->input->post('description');

        // Validate required fields
        if (empty($name)) {
            $this->session->set_flashdata('error', 'Weekly wall name is required');
            redirect(base_url('Weekly_wall/edit_weekly_wall/') . $p_id);
            return;
        }

        // Initialize update data
        $prod_data = [
            'product_name' => $name,
            'description' => $description,
        ];

        // Handle image1 upload (only one image allowed)
        $image1 = $this->um->file_upload('prod_image1', 'assets/images/');


        if ($image1) {
            $prod_data['image1'] = $image1;
        }

        //print_r($prod_data['image1']);die();

        // Update only these fields in article_tbl
        $updated = $this->um->update('weekly_wall_tbl', ['id' => $p_id], $prod_data);
        

        if ($updated) {
            $this->notification_service->notify_section_all_users(
                'weekly_wall',
                'Weekly wall updated',
                $name,
                'weekly_wall',
                $p_id
            );
            $this->session->set_flashdata('success', 'Weekly wall updated successfully');
            redirect(base_url('Weekly_wall'));
        } else {
            $this->session->set_flashdata('error', 'Weekly wall not updated');
            redirect(base_url('Weekly_wall/edit_weekly_wall/') . $p_id);
        }
    }

    
  
  
   public function block($id)
    {
    $id = $this->uri->segment(3);
    $sql = $this->um->get_dataa('weekly_wall_tbl',['id'=>$id]);
   
     $status= $sql[0]->block_status;
   if ($id) {
      
   if ($status==0) {
      
      $data= $this->um->update('weekly_wall_tbl',['id'=>$id],['block_status'=>1]);
       $this->session->set_flashdata('success', 'Weekly wall Unpublished Successfully');
       redirect (base_url().'Weekly_wall');die();

   }else{
      
         $data= $this->um->update('weekly_wall_tbl',['id'=>$id],['block_status'=>0]);
          $this->notification_service->notify_section_all_users(
              'weekly_wall',
              'Weekly wall published',
              !empty($sql[0]->product_name) ? $sql[0]->product_name : 'Weekly wall update',
              'weekly_wall',
              $id
          );
          $this->session->set_flashdata('success', 'Weekly wall Published Successfully');
           redirect (base_url().'Weekly_wall');die();
        }
    }else{
         
          $this->session->set_flashdata('error', 'Weekly wall id not found');
           redirect (base_url().'Weekly_wall');die();
    }
   }
   public function delete_weekly_wall(){
      $id = $this->uri->segment(3);
         $res = $this->um->delete('weekly_wall_tbl',['id'=>$id]);
         
        if($res)                            
        {
            $this->session->set_flashdata('success', 'Weekly wall Deleted Successfully');
             redirect (base_url().'Weekly_wall');die();
        }else{
            $this->session->set_flashdata('error', 'Weekly wall Not Deleted');
             redirect (base_url().'Weekly_wall');die();
        }
    }

}
