<?php
// Start output buffering
ob_start();
?>

<?php
$sessionDriverPath = APPPATH . 'controllers/drivers/Session_files_driver.php';


class Rating extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->model('User_model','um'); 
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
        redirect('Users/logout');
        }

    }

    public function rating_view()
    {
        $start_date = $this->input->post('sdate');
        $end_date   = $this->input->post('edate');
    
        // Build query
        $this->db->select('r.*');
        $this->db->from('rating r');
        $this->db->order_by('r.id', 'desc');
    
        if (!empty($start_date) && !empty($end_date)) {
            $this->db->where('DATE(r.created_at) >=', $start_date);
            $this->db->where('DATE(r.created_at) <=', $end_date);
        } elseif (!empty($start_date)) {
            $this->db->where('DATE(r.created_at) >=', $start_date);
        } elseif (!empty($end_date)) {
            $this->db->where('DATE(r.created_at) <=', $end_date);
        }
    
        $data['product'] = $this->db->get()->result();
    
        $this->load->view('rating', $data);
    }
    public function add_rating(){

        $this->load->view('add_rating');
    }
    
    public function add_rating_data()
    {
        $desc = $this->input->post('pro_desc');
        $name = $this->input->post('prod_name');
        $image1 = $this->um->file_upload('banner_image', 'assets/images/');

        $prod_data = [
            'description'  => $desc,
            'name' => $name,
            'stars'         => 5,
            'block_status'         => 0,
            'created_at'         => date('Y-m-d H:i:s')
        ];
        if ($image1) {
            $prod_data['image1'] = $image1;
        }
    
        $id = $this->um->insert('rating', $prod_data);
    
        if ($id) {
            $this->session->set_flashdata('success', 'Rating added successfully');
            redirect(base_url() . 'Rating/rating_view');
        } else {
            $this->session->set_flashdata('error', 'Rating not added');
            redirect(base_url() . 'Rating/add_rating');
        }
    }
    public function edit_rating($id)
    {
        $this->load->library('session');

        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
        }

        $id = $this->uri->segment(3);
        $this->session->set_userdata('id', $id);

        $article = $this->db->get_where('rating', ['id' => $id])->row();
        
        if (!$article) {
            redirect(base_url('Rating/rating_view'));
            return;
        }

        $data['product'] = $article;

        $this->load->view('edit_rating', $data);
    }
    
    public function delete_rating(){
      $id = $this->uri->segment(3);
         $res = $this->um->delete('rating',['id'=>$id]);
         
        if($res)                            
        {
            $this->session->set_flashdata('success', 'Rating Deleted Successfully');
             redirect (base_url().'Rating/rating_view');die();
        }else{
            $this->session->set_flashdata('error', 'Blog Not Deleted');
             redirect (base_url().'Rating/rating_view');die();
        }
    }
    
    public function edit_rating_data()
    {
        $this->load->library('session');
    
        $p_id = $this->input->post('id');
        $name = $this->input->post('prod_name');
        $description = $this->input->post('description');

        if (empty($name)) {
            $this->session->set_flashdata('error', 'Rating Name is required');
            redirect(base_url('Rating/edit_rating/' . $p_id));
            return;
        }
    
        if (empty($description)) {
            $this->session->set_flashdata('error', 'Rating Description is required');
            redirect(base_url('Rating/edit_rating/' . $p_id));
            return;
        }
    
        $prod_data = [
            'name' => $name,
            'description'  => $description,
        ];
        
        $image1 = $this->um->file_upload('prod_image1', 'assets/images/');
        if ($image1) {
            $prod_data['image1'] = $image1;
        }
        
        
        $updated = $this->um->update('rating', ['id' => $p_id], $prod_data);
    
        if ($updated) {
            $this->session->set_flashdata('success', 'Rating updated successfully');
            redirect(base_url('Rating/rating_view'));
        } else {
            $this->session->set_flashdata('error', 'Rating not updated');
            redirect(base_url('Rating/edit_rating/' . $p_id));
        }
    }
    
    public function block($id)
    {
        $id = $this->uri->segment(3);
        $sql = $this->um->get_dataa('rating', ['id' => $id]);
    
        if ($id && !empty($sql)) {
            $status = $sql[0]->block_status;
    
            if ($status == 0) {
                $this->um->update('rating', ['id' => $id], ['block_status' => 1]);

                $this->session->set_flashdata('success', 'Rating Unpublished Successfully');
                redirect(base_url('Rating/rating_view'));
            } else {
                $this->um->update('rating', ['id' => $id], ['block_status' => 0]);
                $this->session->set_flashdata('success', 'Rating Published Successfully');
                redirect(base_url('Rating/rating_view'));
            }
        } else {
            $this->session->set_flashdata('error', 'Rating ID not found');
            redirect(base_url('Rating/rating_view'));
        }
    }





}