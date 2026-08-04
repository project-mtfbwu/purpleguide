<?php
$sessionDriverPath = APPPATH . 'controllers/drivers/Session_files_driver.php';

class Social_media extends CI_Controller {
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
        $article = $this->db->order_by('id', 'ASC')->get('social_media_tbl')->row();
        if (!$article) {
            $blank = [
                'instagram' => '',
                'facebook'  => '',
                'youtube' => '',
                'twitter'  => '',
                'linkedin' => ''
            ];
            $this->db->insert('social_media_tbl', $blank);
            $article = $this->db->order_by('id', 'ASC')->get('social_media_tbl')->row();
        }
        $data['product'] = $article;
        $this->load->view('social_media', $data);
    }
    public function update_social_media()
    {
        $instagram = $this->input->post('instagram');
        $facebook = $this->input->post('facebook');
        $youtube = $this->input->post('youtube');
        $twitter = $this->input->post('twitter');
        $linkedin = $this->input->post('linkedin');
        

        $row = $this->db->order_by('id', 'ASC')->get('social_media_tbl')->row();
        if (!$row) {
            $this->db->insert('social_media_tbl', [
                'instagram' => $instagram,
                'facebook'  => $facebook,
                'youtube' => $youtube,
                'twitter'  => $twitter,
                'linkedin' => $linkedin,
            ]);
        } else {
            $this->db->where('id', $row->id)->update('social_media_tbl', [
                'instagram' => $instagram,
                'facebook'  => $facebook,
                'youtube' => $youtube,
                'twitter'  => $twitter,
                'linkedin' => $linkedin,
            ]);
        }
        $this->session->set_flashdata('success', 'Social Media Links updated successfully');
        redirect(base_url('Social_media'));
    }

}