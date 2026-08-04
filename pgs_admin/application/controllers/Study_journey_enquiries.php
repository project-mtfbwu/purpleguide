<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Study_journey_enquiries extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
        }
    }

    public function index() {
        $data['missing_table'] = !$this->db->table_exists('study_journey_enquiries');
        $data['product']          = [];
        $data['pagination_links'] = '';
        $data['total']            = 0;

        if ($data['missing_table']) {
            $this->load->view('study_journey_enquiries', $data);
            return;
        }

        $this->load->library('pagination');

        $per_page = 15;
        $page     = max(1, (int) $this->uri->segment(3));
        $offset   = ($page - 1) * $per_page;

        $data['total'] = (int) $this->db->count_all('study_journey_enquiries');

        $config['base_url']         = base_url('Study_journey_enquiries/index');
        $config['total_rows']       = $data['total'];
        $config['per_page']         = $per_page;
        $config['uri_segment']      = 3;
        $config['use_page_numbers'] = TRUE;
        $config['cur_page']         = $page;
        $config['num_links']        = 3;

        $config['full_tag_open']  = '<ul class="pagination pagination-sm justify-content-center">';
        $config['full_tag_close'] = '</ul>';

        foreach (['first','last','next','prev'] as $t) {
            $config[$t.'_tag_open']  = '<li class="page-item">';
            $config[$t.'_tag_close'] = '</li>';
        }

        $config['cur_tag_open']  = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open']  = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes']    = ['class' => 'page-link'];

        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();

        $data['product'] = $this->db
            ->from('study_journey_enquiries')
            ->order_by('id', 'DESC')
            ->limit($per_page, $offset)
            ->get()
            ->result();

        $this->load->view('study_journey_enquiries', $data);
    }
}