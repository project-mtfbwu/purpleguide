<?php
$sessionDriverPath = APPPATH . 'controllers/drivers/Session_files_driver.php';

class Terms_conditions extends CI_Controller {
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
        // Always fetch first row only (id ASC)
        $article = $this->db->order_by('id', 'ASC')->get('terms_conditions_tbl')->row();

        // If not found, create a blank row first
        if (!$article) {
            $blank = [
                'title' => '',
                'description'  => ''
            ];
            $this->db->insert('terms_conditions_tbl', $blank);

            // Get newly inserted row
            $article = $this->db->order_by('id', 'ASC')->get('terms_conditions_tbl')->row();
        }

        $data['product'] = $article;
        $this->load->view('terms_conditions', $data);
    }

    public function update_terms_conditions()
    {
        $title = ucfirst(trim($this->input->post('title')));
        $description = $this->input->post('description');

        if (empty($title)) {
            $this->session->set_flashdata('error', 'Title is required');
            redirect(base_url('Terms_conditions'));
            return;
        }

        // Get first row (only one row exists)
        $row = $this->db->order_by('id', 'ASC')->get('terms_conditions_tbl')->row();

        if (!$row) {
            // If table empty → create one
            $this->db->insert('terms_conditions_tbl', [
                'title' => $title,
                'description'  => $description
            ]);
        } else {
            // Update the single row
            $this->db->where('id', $row->id)->update('terms_conditions_tbl', [
                'title' => $title,
                'description'  => $description
            ]);
        }

        $this->session->set_flashdata('success', 'Terms Conditions updated successfully');
        redirect(base_url('Terms_conditions'));
    }

}