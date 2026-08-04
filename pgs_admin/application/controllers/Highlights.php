<?php
$sessionDriverPath = APPPATH . 'controllers/drivers/Session_files_driver.php';

class Highlights extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->model('User_model','um'); 
        $this->load->library('session');
         if (!$this->session->userdata('user_id')) {
         redirect('Users/logout');
         }

    }
    public function index()
    {
        $data['product'] = $this->db->order_by('id', 'desc')->get('highlights_tbl')->result();
        $this->load->view('highlight', $data);
    }
    public function add_highlight(){        
        $this->load->view('add_highlight');
    }
    
    public function add_highlight_data()
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
        $id = $this->um->insert('highlights_tbl', $prod_data);

        if ($id) {
            $this->session->set_flashdata('success', 'Highlight added successfully');
            redirect(base_url() . 'Highlights');
        } else {
            $this->session->set_flashdata('error', 'Highlight not added');
            redirect(base_url() . 'Highlights/add_highlight');
        }
    }



    public function edit_highlight($id)
    {

        $id = $this->uri->segment(3);
        $this->session->set_userdata('id', $id);

        $article = $this->db->get_where('highlights_tbl', ['id' => $id])->row();

        if (!$article) {
            redirect(base_url('Highlights'));
            return;
        }

        $data['product'] = $article;

        $this->load->view('edit_highlight', $data);
    }


    public function edit_highlight_data()
    {
        $this->load->library('session');

        $p_id = $this->input->post('id');

        //print_r($p_id);die();
        $name = ucfirst(trim($this->input->post('prod_name'), " \t"));
        $description = $this->input->post('description');

        // Validate required fields
        if (empty($name)) {
            $this->session->set_flashdata('error', 'Product name is required');
            redirect(base_url('Highlights/edit_highlight/') . $p_id);
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
        $updated = $this->um->update('highlights_tbl', ['id' => $p_id], $prod_data);
        

        if ($updated) {
            $this->session->set_flashdata('success', 'Highlight updated successfully');
            redirect(base_url('Highlights'));
        } else {
            $this->session->set_flashdata('error', 'Highlight not updated');
            redirect(base_url('Highlights/edit_highlight/') . $p_id);
        }
    }
  
   public function block($id)
    {
    $id = $this->uri->segment(3);
    $sql = $this->um->get_dataa('highlights_tbl',['id'=>$id]);
   
     $status= $sql[0]->block_status;
   if ($id) {
      
   if ($status==0) {
      
      $data= $this->um->update('highlights_tbl',['id'=>$id],['block_status'=>1]);
       $this->session->set_flashdata('success', 'Highlight Unpublished Successfully');
       redirect (base_url().'Highlights');die();

   }else{
      
         $data= $this->um->update('highlights_tbl',['id'=>$id],['block_status'=>0]);
          $this->session->set_flashdata('success', 'Highlight Published Successfully');
           redirect (base_url().'Highlights');die();
        }
    }else{
         
          $this->session->set_flashdata('error', 'Highlight id not found');
           redirect (base_url().'Highlight');die();
    }
   }
    public function delete_highlight(){
      $id = $this->uri->segment(3);
         $res = $this->um->delete('highlights_tbl',['id'=>$id]);
         
        if($res)                            
        {
            $this->session->set_flashdata('success', 'Highlight Deleted Successfully');
             redirect (base_url().'Highlights');die();
        }else{
            $this->session->set_flashdata('error', 'Highlight Not Deleted');
             redirect (base_url().'Highlight');die();
        }
    }

}