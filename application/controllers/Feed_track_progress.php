<?php
Class Feed_track_progress extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {

        $data = $this->default_progress_data();

        $user_id = $this->session->userdata('user_id');

        // User not logged in
        if (!$user_id) {
            $this->load->view('lock_feed_track_progress', $data);
            return;
        }

        // Check premium membership explicitly. A user can have historical
        // application rows, so do not let an older pending/rejected row hide
        // a valid approved application.
        $premium_app = $this->db
            ->where('user_id', $user_id)
            ->where('status', 'approved')
            ->order_by('id', 'DESC')
            ->get('purplepremium_applications')
            ->row();

        // User logged in but not premium approved
        if (!$premium_app) {
            $this->load->view('lock_feed_track_progress', $data);
            return;
        }

        // ==========================
        // PREMIUM USERS ONLY BELOW
        // ==========================

        // Get review queue items
        $data['review_queue_items'] = $this->db
            ->where('user_id', $user_id)
            ->order_by('display_order', 'ASC')
            ->order_by('id', 'ASC')
            ->get('review_queue_items')
            ->result();

        // Calculate completed count
        $data['review_queue_completed'] = $this->db
            ->where('user_id', $user_id)
            ->where('is_checked', 1)
            ->count_all_results('review_queue_items');

        // Important alerts (admin-managed, capped at 3 by the admin panel)
        $data['important_alerts'] = [];
        if ($this->db->table_exists('important_alerts')) {
            $data['important_alerts'] = $this->db
                ->where('user_id', $user_id)
                ->order_by('display_order', 'ASC')
                ->order_by('id', 'ASC')
                ->limit(3)
                ->get('important_alerts')
                ->result();
        }

        // Get counselor notes
        $data['counselor_notes'] = $this->db
            ->where('user_id', $user_id)
            ->order_by('display_order', 'ASC')
            ->order_by('created_at', 'DESC')
            ->get('counselor_notes')
            ->result();

        // Get kanban cards grouped by section
        $kanban_cards = $this->db
            ->where('user_id', $user_id)
            ->order_by('section', 'ASC')
            ->order_by('display_order', 'ASC')
            ->order_by('id', 'ASC')
            ->get('kanban_cards')
            ->result();

        $data['kanban_cards'] = [];

        foreach ($kanban_cards as $card) {
            $data['kanban_cards'][$card->section][] = $card;
        }

        // Draft meter documents
        $standard_documents = [
            'Passport Front',
            'Passport Back',
            'CV',
            'LoR',
            'UG Marksheet - 1',
            'UG Provisional Certificate',
            'UG Degree Certificate',
            'SOP',
            '12th Marksheet',
            '10th Marksheet',
            'PG Marksheet - 1',
            'PG Consolidated Marksheet',
            'PG Provisional Certificate',
            'PG Degree Certificate',
            'pre-journey checklist'
        ];

        $doc_types_for_upload = $standard_documents;

        if ($this->db->table_exists('user_additional_doc_types')) {
            $add_rows = $this->db
                ->where('user_id', $user_id)
                ->order_by('display_order', 'ASC')
                ->order_by('id', 'ASC')
                ->get('user_additional_doc_types')
                ->result();

            foreach ($add_rows as $r) {
                $doc_types_for_upload[] = $r->doc_name;
            }
        }

        $type_approved = [];
        $type_uploaded = [];

        $user_docs = $this->db
            ->select('document_type, qc_status')
            ->where('user_id', $user_id)
            ->get('user_documents')
            ->result();

        foreach ($user_docs as $d) {

            if (empty($d->document_type)) {
                continue;
            }

            $type_uploaded[$d->document_type] = true;

            if ($d->qc_status === 'approved') {
                $type_approved[$d->document_type] = true;
            }
        }

        $data['draft_doc_completed'] = count(
            array_intersect_key(
                $type_approved,
                array_flip($doc_types_for_upload)
            )
        );

        $pending_list = [];

        foreach ($doc_types_for_upload as $doc_type) {

            if (!empty($type_approved[$doc_type])) {
                continue;
            }

            $pending_list[] = (object)[
                'doc_type'  => $doc_type,
                'uploaded'  => !empty($type_uploaded[$doc_type]),
                'approved'  => !empty($type_approved[$doc_type])
            ];
        }

        $data['draft_doc_items'] = array_slice($pending_list, 0, 3);

        // User data
        $data['user'] = $this->db
            ->where('id', $user_id)
            ->get('users')
            ->row();

        $this->load->view('feed_track_progress', $data);
    }

    private function default_progress_data() {

        $standard_documents = [
            'Passport Front',
            'Passport Back',
            'CV'
        ];

        $draft_doc_items = [];

        foreach ($standard_documents as $doc_type) {
            $draft_doc_items[] = (object)[
                'doc_type'  => $doc_type,
                'uploaded'  => false,
                'approved'  => false
            ];
        }

        return [
            'important_alerts'         => [],
            'review_queue_items'       => [],
            'review_queue_completed'   => 0,
            'counselor_notes'          => [],
            'kanban_cards'             => [],
            'draft_doc_completed'      => 0,
            'draft_doc_items'          => $draft_doc_items,
            'user'                     => null
        ];
    }
}
