<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Univmeet_model extends CI_Model
{
    protected $table = 'univ_meet_dates';

    /** Only fetch needed columns to avoid loading huge BLOB/TEXT if any were added to the table. */
    protected $select_cols = 'id, slot1_date, slot1_month, slot2_date, slot2_month, updated_at';

    public function __construct()
    {
        parent::__construct();
        $this->ensure_course_id_column();
    }

    public function get_current()
    {
        if (!$this->db->table_exists($this->table)) {
            return array();
        }
        return $this->db
            ->select($this->get_select_cols())
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get($this->table)
            ->row_array();
    }

    public function get_courses()
    {
        if (!$this->db->table_exists('courses_tbl')) {
            return array();
        }

        return $this->db
            ->select('id, product_name')
            ->where('block_status', 0)
            ->order_by('product_name', 'ASC')
            ->get('courses_tbl')
            ->result();
    }

    public function save($data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!$this->has_course_id_column()) {
            unset($data['course_id']);
        }

        $current = $this->get_current();
        if ($current) {
            $this->db->where('id', $current['id']);
            return $this->db->update($this->table, $data);
        }

        return $this->db->insert($this->table, $data);
    }

    private function get_select_cols()
    {
        if ($this->has_course_id_column()) {
            return 'id, course_id, slot1_date, slot1_month, slot2_date, slot2_month, updated_at';
        }

        return $this->select_cols;
    }

    private function has_course_id_column()
    {
        return $this->db->table_exists($this->table) && $this->db->field_exists('course_id', $this->table);
    }

    private function ensure_course_id_column()
    {
        if (!$this->db->table_exists($this->table) || $this->has_course_id_column()) {
            return;
        }

        $this->load->dbforge();
        $this->dbforge->add_column($this->table, array(
            'course_id' => array(
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ),
        ));
    }
}
