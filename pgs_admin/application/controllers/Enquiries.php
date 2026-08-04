<?php
ob_start();
?>

<?php
$sessionDriverPath = APPPATH . 'controllers/drivers/Session_files_driver.php';


class Enquiries extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->model('User_model','um'); 
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
        redirect('Users/logout');
        }

    }

    public function enquiry_view()
    {
        $start_date = $this->input->post('sdate');
        $end_date   = $this->input->post('edate');

        $this->db->select('*');
        $this->db->from('enquiries_tbl');
        $this->db->order_by('id', 'desc');
        
        if (!empty($start_date) && !empty($end_date)) {
            $this->db->where('DATE(created_at) >=', $start_date);
            $this->db->where('DATE(created_at) <=', $end_date);
        }

        $sql['product'] = $this->db->get()->result();


        $this->load->view('enquiries', $sql);
    }
    public function send_reply()
    {
        $enquiry_id    = $this->input->post('enquiry_id', TRUE);
        $email         = $this->input->post('email', TRUE);
        $reply_message = $this->input->post('reply_message', TRUE);

        $enquiry = $this->db->get_where('enquiries_tbl', ['id' => $enquiry_id])->row();

        if ($enquiry) {
            $subject = "Reply to your Enquiry";
            $message = "
                Hello {$enquiry->name},<br><br>
                <strong>Your enquiry:</strong><br>{$enquiry->message}<br><br>
                <strong>Our reply:</strong><br>{$reply_message}
            ";

            $config = [
    'protocol'     => 'smtp',
    'smtp_host'    => 'smtp.gmail.com',
    'smtp_port'    => 465,
    'smtp_user'    => 'sumit.hariyani3@gmail.com',
    'smtp_pass'    => 'gjkznewdietpqowr',
    'smtp_crypto'  => 'ssl',
    'mailtype'     => 'html',
    'charset'      => 'utf-8',
    'newline'      => "\r\n",
    'wordwrap'     => TRUE,
];



            $this->load->library('email');
            $this->email->initialize($config);

            $this->email->from('sumit.hariyani3@gmail.com', 'PGS');
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($message);

            if ($this->email->send()) {

                $this->db->where('id', $enquiry_id)->update('enquiries_tbl', ['reply' => 1]);
                $this->session->set_flashdata('success', 'Reply sent successfully.');
            
            } else {
                $this->session->set_flashdata('error', $this->email->print_debugger());
            }
        } else {
          $this->session->set_flashdata('error', 'Enquiry not found.');
        }
        redirect('Enquiries/enquiry_view');
    }
}