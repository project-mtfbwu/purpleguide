<?php
$sessionDriverPath = APPPATH . 'controllers/drivers/Session_files_driver.php';

class Privacy_policy extends CI_Controller {
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
        $article = $this->db->order_by('id', 'ASC')->get('privacy_policy_tbl')->row();

        // If not found, create a blank row first
        if (!$article) {
            $blank = [
                'title' => '',
                'description'  => ''
            ];
            $this->db->insert('privacy_policy_tbl', $blank);

            // Get newly inserted row
            $article = $this->db->order_by('id', 'ASC')->get('privacy_policy_tbl')->row();
        }

        $data['product'] = $article;
        $this->load->view('privacy_policy', $data);
    }

    public function update_privacy_policy()
    {
        $title = ucfirst(trim($this->input->post('title')));
        $description = $this->input->post('description');

        if (empty($title)) {
            $this->session->set_flashdata('error', 'Title is required');
            redirect(base_url('Privacy_policy'));
            return;
        }

        // Get first row (only one row exists)
        $row = $this->db->order_by('id', 'ASC')->get('privacy_policy_tbl')->row();

        if (!$row) {
            // If table empty → create one
            $this->db->insert('privacy_policy_tbl', [
                'title' => $title,
                'description'  => $description
            ]);
        } else {
            // Update the single row
            $this->db->where('id', $row->id)->update('privacy_policy_tbl', [
                'title' => $title,
                'description'  => $description
            ]);
        }

        $this->session->set_flashdata('success', 'Privacy Policy updated successfully');
        redirect(base_url('Privacy_policy'));
    }

}