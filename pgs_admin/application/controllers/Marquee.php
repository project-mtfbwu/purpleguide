<?php
$sessionDriverPath = APPPATH . 'controllers/drivers/Session_files_driver.php';

class Marquee extends CI_Controller {
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
        $this->_ensure_marquee_table();
        $article = $this->db->order_by('id', 'ASC')->get('marquee_tbl')->row();
        if (!$article) {
            $blank = [
                'marquee_text' => '',
                'marquee_link' => '',
                'block_status' => 0
            ];
            $this->db->insert('marquee_tbl', $blank);
            $article = $this->db->order_by('id', 'ASC')->get('marquee_tbl')->row();
        }
        $data['product'] = $article;
        $this->load->view('marquee', $data);
    }

    public function update_marquee()
    {
        $this->_ensure_marquee_table();
        $id = (int) $this->input->post('id');
        $marquee_text = trim($this->input->post('marquee_text', true));
        $marquee_link = trim($this->input->post('marquee_link', true));

        if ($marquee_text === '') {
            $this->session->set_flashdata('error', 'Marquee text is required');
            redirect(base_url('Marquee'));
            return;
        }

        if ($marquee_link !== '' && !filter_var($marquee_link, FILTER_VALIDATE_URL) && strpos($marquee_link, '/') !== 0) {
            $this->session->set_flashdata('error', 'Please enter a valid marquee link');
            redirect(base_url('Marquee'));
            return;
        }

        $data = [
            'marquee_text' => $marquee_text,
            'marquee_link' => $marquee_link
        ];

        $row = $id ? $this->db->where('id', $id)->get('marquee_tbl')->row() : null;
        if ($row) {
            $this->db->where('id', $row->id)->update('marquee_tbl', $data);
        } else {
            $data['block_status'] = 0;
            $this->db->insert('marquee_tbl', $data);
        }

        $this->session->set_flashdata('success', 'Marquee updated successfully');
        redirect(base_url('Marquee'));
    }

    public function update()
    {
        $this->_ensure_marquee_table();
        $id = $this->uri->segment(3);
        if (!$id) {
            $this->session->set_flashdata('error', 'ID not found');
            redirect(base_url('Marquee')); 
            return;
        }
        $row = $this->um->get_dataa('marquee_tbl', ['id' => $id]);
        if (!$row) {
            $this->session->set_flashdata('error', 'Record not found');
            redirect(base_url('Marquee'));
            return;
        }
        $current_status = $row[0]->block_status;
        $new_status = ($current_status == 0) ? 1 : 0;
        $this->um->update('marquee_tbl', ['id' => $id], ['block_status' => $new_status]);
        if ($new_status == 1) {
            $this->session->set_flashdata('success', 'Visibility Off Successfully');
        } else {
            $this->session->set_flashdata('success', 'Visibility On Successfully');
        }
        redirect(base_url('Marquee'));
    }

    private function _ensure_marquee_table()
    {
        if (!$this->db->table_exists('marquee_tbl')) {
            $table = $this->db->dbprefix('marquee_tbl');
            $this->db->query("CREATE TABLE IF NOT EXISTS `{$table}` (
                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `marquee_text` text NULL,
                `marquee_link` varchar(500) NULL,
                `block_status` tinyint(1) NOT NULL DEFAULT 0,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
            return;
        }

        $cols = [
            'marquee_text' => 'TEXT NULL',
            'marquee_link' => 'VARCHAR(500) NULL',
            'block_status' => 'TINYINT(1) NOT NULL DEFAULT 0'
        ];
        foreach ($cols as $col => $def) {
            if (!$this->db->field_exists($col, 'marquee_tbl')) {
                $this->db->query("ALTER TABLE marquee_tbl ADD COLUMN {$col} {$def}");
            }
        }
    }

}
