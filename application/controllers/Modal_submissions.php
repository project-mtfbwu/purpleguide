<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modal_submissions extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_ensure_table();
    }

    public function submit() {
        $this->output->set_content_type('application/json');

        if (strtolower($this->input->method()) !== 'post') {
            echo json_encode(['success' => false, 'message' => 'Invalid method.']);
            return;
        }

        $modal_type = $this->input->post('modal_type', true);
        if (!in_array($modal_type, ['applicant', 'investor'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid modal type.']);
            return;
        }

        $name  = trim((string) $this->input->post('name', true));
        $email = trim((string) $this->input->post('email', true));

        if (empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Name and valid email are required.']);
            return;
        }

        $checklist_raw = $this->input->post('checklist_items');
        $checklist_json = '';
        if (!empty($checklist_raw) && is_array($checklist_raw)) {
            $checklist_json = json_encode(array_map('strip_tags', $checklist_raw));
        }

        $data = [
            'modal_type'       => $modal_type,
            'name'             => substr($name, 0, 120),
            'email'            => substr($email, 0, 180),
            'phone'            => substr((string) $this->input->post('phone', true), 0, 30),
            'checklist_items'  => $checklist_json,
            'planning_to_study'=> substr((string) $this->input->post('planning_to_study', true), 0, 200),
            'preseed_round'    => substr((string) $this->input->post('preseed_round', true), 0, 100),
            'source_page'      => substr((string) $this->input->post('source_page', true), 0, 200),
            'ip_address'       => $this->input->ip_address(),
            'user_agent'       => substr((string) $this->input->user_agent(), 0, 255),
            'created_at'       => date('Y-m-d H:i:s'),
        ];

        $this->db->insert('modal_submissions', $data);

        echo json_encode(['success' => true]);
    }

    private function _ensure_table() {
        $this->load->dbforge();

        if ($this->db->table_exists('modal_submissions')) {
            $fields = $this->_modal_submission_fields();
            unset($fields['id']);

            foreach ($fields as $field => $definition) {
                if (!$this->db->field_exists($field, 'modal_submissions')) {
                    $definition['null'] = true;
                    $this->dbforge->add_column('modal_submissions', [$field => $definition]);
                }
            }

            return;
        }

        $this->dbforge->add_field($this->_modal_submission_fields());
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('modal_submissions', true);
    }

    private function _modal_submission_fields() {
        return [
            'id'               => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'modal_type'       => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => false],
            'name'             => ['type' => 'VARCHAR', 'constraint' => 120, 'null' => true],
            'email'            => ['type' => 'VARCHAR', 'constraint' => 180, 'null' => true],
            'phone'            => ['type' => 'VARCHAR', 'constraint' => 30,  'null' => true],
            'checklist_items'  => ['type' => 'TEXT', 'null' => true],
            'planning_to_study'=> ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'preseed_round'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'source_page'      => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'ip_address'       => ['type' => 'VARCHAR', 'constraint' => 45,  'null' => true],
            'user_agent'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
        ];
    }
}
