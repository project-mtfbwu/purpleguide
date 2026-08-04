<?php
$sessionDriverPath = APPPATH . 'controllers/drivers/Session_files_driver.php';

class Refund_policy extends CI_Controller {
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
        $article = $this->db->order_by('id', 'ASC')->get('refund_policy_tbl')->row();

        if (!$article) {
            $blank = [
                'title' => '',
                'description'  => ''
            ];
            $this->db->insert('refund_policy_tbl', $blank);

            $article = $this->db->order_by('id', 'ASC')->get('refund_policy_tbl')->row();
        }

        $data['product'] = $article;
        $this->load->view('refund_policy', $data);
    }

    public function update_refund_policy()
    {
        $title = ucfirst(trim($this->input->post('title')));
        $description = $this->input->post('description');

        if (empty($title)) {
            $this->session->set_flashdata('error', 'Title is required');
            redirect(base_url('Refund_policy'));
            return;
        }

        $row = $this->db->order_by('id', 'ASC')->get('refund_policy_tbl')->row();

        if (!$row) {
            $this->db->insert('refund_policy_tbl', [
                'title' => $title,
                'description'  => $description
            ]);
        } else {
            $this->db->where('id', $row->id)->update('refund_policy_tbl', [
                'title' => $title,
                'description'  => $description
            ]);
        }

        $this->session->set_flashdata('success', 'Refund Policy updated successfully');
        redirect(base_url('Refund_policy'));
    }

}