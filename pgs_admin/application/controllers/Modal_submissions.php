<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modal_submissions extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
        }
    }

    public function index() {
        // Disable DB debug output to avoid memory overhead on error display
        $this->db->db_debug = FALSE;

        $data['submissions']      = [];
        $data['pagination_links'] = '';
        $data['total']            = 0;
        $data['name_filter']      = substr((string) $this->input->get('name', true), 0, 120);
        $data['type_filter']      = $this->input->get('type', true) ?: '';

        // Table check via information_schema — no QB, no list_tables()
        $tc = $this->db->query(
            "SELECT COUNT(*) AS n FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'modal_submissions'"
        );
        $data['missing_table'] = !($tc && (int) $tc->row()->n > 0);
        if ($tc) { $tc->free_result(); }

        if ($data['missing_table']) {
            $this->load->view('Modal_submissions', $data);
            return;
        }

        $this->load->library('pagination');

        $per_page = 20;
        $page     = max(1, (int) $this->input->get('page'));
        $offset   = ($page - 1) * $per_page;

        // Build WHERE clause — raw SQL with ? binds (no query builder)
        $binds = [];
        $where = 'WHERE 1=1';
        if ($data['name_filter'] !== '') {
            $where   .= ' AND name LIKE ?';
            $binds[]  = '%' . $data['name_filter'] . '%';
        }
        if (in_array($data['type_filter'], ['applicant', 'investor'], true)) {
            $where   .= ' AND modal_type = ?';
            $binds[]  = $data['type_filter'];
        }

        // COUNT — raw SQL, no QB
        $cr = $this->db->query("SELECT COUNT(*) AS n FROM modal_submissions $where", $binds);
        $data['total'] = $cr ? (int) $cr->row()->n : 0;
        if ($cr) { $cr->free_result(); }

        // Pagination config
        $filter_qs = http_build_query(array_filter([
            'name' => $data['name_filter'],
            'type' => $data['type_filter'],
        ]));

        $config['base_url']             = base_url('Modal_submissions/index') . ($filter_qs ? '?' . $filter_qs . '&' : '?');
        $config['total_rows']           = $data['total'];
        $config['per_page']             = $per_page;
        $config['page_query_string']    = TRUE;
        $config['query_string_segment'] = 'page';
        $config['use_page_numbers']     = TRUE;
        $config['cur_page']             = $page;
        $config['num_links']            = 3;
        $config['full_tag_open']        = '<ul class="pagination pagination-sm justify-content-center mb-0">';
        $config['full_tag_close']       = '</ul>';

        foreach (['first', 'last', 'next', 'prev'] as $t) {
            $config[$t . '_tag_open']  = '<li class="page-item">';
            $config[$t . '_tag_close'] = '</li>';
        }

        $config['cur_tag_open']  = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open']  = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes']    = ['class' => 'page-link'];
        $config['first_link']    = '«';
        $config['last_link']     = '»';
        $config['next_link']     = '›';
        $config['prev_link']     = '‹';

        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();

        // DATA — raw SQL, no QB; LIMIT/OFFSET are integers, not bound params
        $limit_int  = (int) $per_page;
        $offset_int = (int) $offset;
        $dr = $this->db->query(
            "SELECT id, modal_type, name, email, phone,
                    LEFT(checklist_items, 2000) AS checklist_items,
                    planning_to_study, preseed_round, source_page, created_at
             FROM modal_submissions
             $where
             ORDER BY id DESC
             LIMIT $limit_int OFFSET $offset_int",
            $binds
        );
        $data['submissions'] = $dr ? $dr->result() : [];
        if ($dr) { $dr->free_result(); }

        $this->load->view('Modal_submissions', $data);
    }
}
