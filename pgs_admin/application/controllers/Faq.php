<?php
$sessionDriverPath = APPPATH . 'controllers/drivers/Session_files_driver.php';

class Faq extends CI_Controller {
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
        $data['product'] = $this->db->order_by('id', 'desc')->get('faq_tbl')->result();
        $this->load->view('faq', $data);
    }
    public function add_faq(){        
        $this->load->view('add_faq');
    }
    
    public function add_faq_data()
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
        $id = $this->um->insert('faq_tbl', $prod_data);

        if ($id) {
            $this->session->set_flashdata('success', 'Faq added successfully');
            redirect(base_url() . 'Faq');
        } else {
            $this->session->set_flashdata('error', 'Faq not added');
            redirect(base_url() . 'Faq/add_faq');
        }
    }



    public function edit_faq($id)
    {

        $id = $this->uri->segment(3);
        $this->session->set_userdata('id', $id);

        $article = $this->db->get_where('faq_tbl', ['id' => $id])->row();

        if (!$article) {
            redirect(base_url('Faq'));
            return;
        }

        $data['product'] = $article;

        $this->load->view('edit_faq', $data);
    }


    public function edit_faq_data()
    {
        $this->load->library('session');

        $p_id = $this->input->post('id');

        //print_r($p_id);die();
        $name = ucfirst(trim($this->input->post('prod_name'), " \t"));
        $description = $this->input->post('description');

        // Validate required fields
        if (empty($name)) {
            $this->session->set_flashdata('error', 'Product name is required');
            redirect(base_url('Faq/edit_faq/') . $p_id);
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
        $updated = $this->um->update('faq_tbl', ['id' => $p_id], $prod_data);
        

        if ($updated) {
            $this->session->set_flashdata('success', 'Faq updated successfully');
            redirect(base_url('Faq'));
        } else {
            $this->session->set_flashdata('error', 'Faq not updated');
            redirect(base_url('Faq/edit_faq/') . $p_id);
        }
    }

    
  
  
   public function block($id)
    {
    $id = $this->uri->segment(3);
    $sql = $this->um->get_dataa('faq_tbl',['id'=>$id]);
   
     $status= $sql[0]->block_status;
   if ($id) {
      
   if ($status==0) {
      
      $data= $this->um->update('faq_tbl',['id'=>$id],['block_status'=>1]);
       $this->session->set_flashdata('success', 'Faq Unpublished Successfully');
       redirect (base_url().'Faq');die();

   }else{
      
         $data= $this->um->update('faq_tbl',['id'=>$id],['block_status'=>0]);
          $this->session->set_flashdata('success', 'Faq Published Successfully');
           redirect (base_url().'Faq');die();
        }
    }else{
         
          $this->session->set_flashdata('error', 'Faq id not found');
           redirect (base_url().'Faq');die();
    }
   }
   public function delete_faq(){
      $id = $this->uri->segment(3);
         $res = $this->um->delete('faq_tbl',['id'=>$id]);
         
        if($res)                            
        {
            $this->session->set_flashdata('success', 'Faq Deleted Successfully');
             redirect (base_url().'Faq');die();
        }else{
            $this->session->set_flashdata('error', 'Faq Not Deleted');
             redirect (base_url().'Faq');die();
        }
    }

}