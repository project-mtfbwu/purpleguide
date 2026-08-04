<?php
// Start output buffering
ob_start();
?>

<?php
$sessionDriverPath = APPPATH . 'controllers/drivers/Session_files_driver.php';


class Enquiry_category extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->model('User_model','um'); 
        $this->load->library('form_validation');

    }
    public function enquiry_category()
    {
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
        }

        $data['product'] = $this->db->order_by('id', 'desc')->get('enquiry_category_tbl')->result();
        //print_r($data['product']);die();

        $this->load->view('enquiry_category_view', $data);
    }
    public function add_enquiry_category(){
        $this->load->library('session');
         if (!$this->session->userdata('user_id')) {
         redirect('Users/logout');
         }

      $this->load->view('enquiry_category');
   }
    
    public function add_enquiry_category_data()
    {

        $category_name = $this->input->post('category_name');
        
        $prod_data = [
            'category_name' => $category_name,
            'block_status'          => 0
        ];

        $id = $this->um->insert('enquiry_category_tbl', $prod_data);

        if ($id) {
            $this->session->set_flashdata('success', 'Enquiry Category added successfully');
            redirect(base_url() . 'Enquiry_category/enquiry_category');
        } else {
            $this->session->set_flashdata('error', 'Enquiry Category not added');
            redirect(base_url() . 'Enquiry_category/add_enquiry_category');
        }
    }




    public function edit_enquiry_category($id)
    {
        $this->load->library('session');

        // Optional: Session check
        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
        }

        // Get the enquiry ID from URI (just in case it's passed via URL)
        $id = $this->uri->segment(3);
        $this->session->set_userdata('id', $id);

        // Fetch enquiry only from article_tbl
        $article = $this->db->get_where('enquiry_category_tbl', ['id' => $id])->row();

        // If not found, redirect
        if (!$article) {
            redirect(base_url('Enquiry_category/enquiry_category'));
            return;
        }

        $data['product'] = $article;

        //print_r($data['product']);die();

        $this->load->view('edit_enquiry_category', $data);
    }


    public function edit_enquiry_category_data()
    {
        $this->load->library('session');

        $p_id = $this->input->post('id');

        $category_name = $this->input->post('category_name');

        if (empty($category_name)) {
            $this->session->set_flashdata('error', 'Enquiry Category Name is required');
            redirect(base_url('Enquiry_category/edit_enquiry_category' . $p_id));
            return;
        }

        $prod_data = [
            'category_name' => $category_name,
        ];

        $updated = $this->um->update('enquiry_category_tbl', ['id' => $p_id], $prod_data);

        if ($updated) {
            $this->session->set_flashdata('success', 'Enquiry Category updated successfully');
            redirect(base_url('Enquiry_category/enquiry_category'));
        } else {
            $this->session->set_flashdata('error', 'Blog not updated');
            redirect(base_url('Enquiry_category/edit_enquiry_category') . $p_id);
        }
    }

    

   public function delete_enquiry_category(){
      $id = $this->uri->segment(3);
         $res = $this->um->delete('enquiry_category_tbl',['id'=>$id]);
         
        if($res)                            
        {
            $this->session->set_flashdata('success', 'Enquiry Category Deleted Successfully');
             redirect (base_url().'Enquiry_category/enquiry_category');die();
        }else{
            $this->session->set_flashdata('error', 'Enquiry Category Not Deleted');
             redirect (base_url().'Enquiry_category/enquiry_category');die();
        }
    }

    public function block($id)
    {
        $id = $this->uri->segment(3);
        $sql = $this->um->get_dataa('enquiry_category_tbl', ['id' => $id]);
    
        if ($id && !empty($sql)) {
            $status = $sql[0]->block_status;
    
            if ($status == 0) {
                // Unpublish blog
                $this->um->update('enquiry_category_tbl', ['id' => $id], ['block_status' => 1]);
    
                $this->session->set_flashdata('success', 'Enquiry Category Unpublished Successfully');
                redirect(base_url('Enquiry_category/enquiry_category'));
            } else {
                // Publish blog
                $this->um->update('enquiry_category_tbl', ['id' => $id], ['block_status' => 0]);
                $this->session->set_flashdata('success', 'Enquiry Category Published Successfully');
                redirect(base_url('Enquiry_category/enquiry_category'));
            }
        } else {
            $this->session->set_flashdata('error', 'Enquiry Category ID not found');
            redirect(base_url('Enquiry_category/enquiry_category'));
        }
    }
 
   
    

}