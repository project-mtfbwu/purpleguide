<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Autocomplete endpoint.
     * GET /Search/autocomplete?q=term&limit=10
     *
     * Returns JSON: { "results": [ { "type": "program"|"event"|"course", "id": 1, "label": "...", "detail": "...", "url": "..." } ] }
     */
    public function autocomplete()
    {
        $this->output->set_content_type('application/json');

        $q = trim((string) $this->input->get('q', true));
        $limit = (int) $this->input->get('limit', true);
        if ($limit <= 0) $limit = 8;
        if ($limit > 15) $limit = 15;

        if ($q === '' || mb_strlen($q) < 2) {
            $this->output->set_output(json_encode(['results' => []]));
            return;
        }

        $results = [];

        // Programs: search title, tags, headings and details.
        if ($this->db->table_exists('cv_programs')) {
            $program_fields = $this->_existing_fields('cv_programs', [
                'title',
                'tags',
                'short_description',
                'top_label',
                'badge_text',
                'who_is_it_for',
                'session_topics',
            ]);
            $rows = $this->_search_rows(
                'cv_programs',
                $this->_select_fields('cv_programs', ['id', 'title', 'short_description', 'tags']),
                $program_fields,
                $q,
                $limit
            );

            foreach ($rows as $r) {
                $id = (int) ($r->id ?? 0);
                $label = (string) ($r->title ?? '');
                if ($id <= 0 || $label === '') continue;
                $results[] = [
                    'type' => 'program',
                    'id' => $id,
                    'label' => $label,
                    'detail' => $this->_result_detail($r, ['tags', 'short_description']),
                    'url' => base_url('Programsfull/program/' . $id),
                ];
            }
        }

        // Courses: search course heading, tags and details.
        if (count($results) < $limit && $this->db->table_exists('courses_tbl')) {
            $course_fields = $this->_existing_fields('courses_tbl', [
                'product_name',
                'prod_sub_name',
                'tags',
                'description',
                'duration',
                'pekrs',
                'mode',
            ]);
            $rows = $this->_search_rows(
                'courses_tbl',
                $this->_select_fields('courses_tbl', ['id', 'product_name', 'prod_sub_name', 'tags', 'description']),
                $course_fields,
                $q,
                $limit
            );

            foreach ($rows as $r) {
                $id = (int) ($r->id ?? 0);
                $label = (string) ($r->product_name ?? '');
                if ($id <= 0 || $label === '') continue;
                $results[] = [
                    'type' => 'course',
                    'id' => $id,
                    'label' => $label,
                    'detail' => $this->_result_detail($r, ['tags', 'prod_sub_name', 'description']),
                    'url' => base_url('Programsfull/program/' . $id),
                ];
            }
        }

        // Events: search heading, tags and details.
        if ($this->db->table_exists('event_tbl')) {
            $event_fields = $this->_existing_fields('event_tbl', [
                'product_name',
                'prod_sub_name',
                'tags',
                'description',
                'top_label',
                'badge',
                'author_name',
                'author_bio',
                'who_is_it_for',
                'session_topics',
                'what_we_cover',
            ]);
            $rows = $this->_search_rows(
                'event_tbl',
                $this->_select_fields('event_tbl', ['id', 'product_name', 'prod_sub_name', 'tags', 'description']),
                $event_fields,
                $q,
                $limit,
                ['block_status' => 0]
            );

            foreach ($rows as $r) {
                $id = (int) ($r->id ?? 0);
                $label = (string) ($r->product_name ?? '');
                if ($id <= 0 || $label === '') continue;
                $results[] = [
                    'type' => 'event',
                    'id' => $id,
                    'label' => $label,
                    'detail' => $this->_result_detail($r, ['tags', 'prod_sub_name', 'description']),
                    'url' => base_url('purpleevents/session/' . $id),
                ];
            }
        }

        // Mix + cap total results
        $results = array_slice($results, 0, $limit);

        $this->output->set_output(json_encode(['results' => $results]));
    }

    private function _existing_fields($table, $fields)
    {
        $existing = [];
        foreach ($fields as $field) {
            if ($this->db->field_exists($field, $table)) {
                $existing[] = $field;
            }
        }
        return $existing;
    }

    private function _select_fields($table, $fields)
    {
        $select = [];
        foreach ($fields as $field) {
            if ($field === 'id' || $this->db->field_exists($field, $table)) {
                $select[] = $field;
            }
        }
        return implode(', ', $select ?: ['id']);
    }

    private function _search_rows($table, $select, $fields, $q, $limit, $where = [])
    {
        if (!$fields) {
            return [];
        }

        $this->db->select($select)->from($table);
        foreach ($where as $field => $value) {
            if ($this->db->field_exists($field, $table)) {
                $this->db->where($field, $value);
            }
        }

        $this->db->group_start();
        foreach ($fields as $i => $field) {
            if ($i === 0) {
                $this->db->like($field, $q);
            } else {
                $this->db->or_like($field, $q);
            }
        }
        $this->db->group_end();

        return $this->db
            ->order_by('id', 'DESC')
            ->limit($limit)
            ->get()
            ->result();
    }

    private function _result_detail($row, $fields)
    {
        foreach ($fields as $field) {
            if (!empty($row->$field)) {
                $text = trim(strip_tags((string) $row->$field));
                $text = preg_replace('/\s+/', ' ', $text);
                if ($text !== '') {
                    return mb_strlen($text) > 90 ? mb_substr($text, 0, 90) . '...' : $text;
                }
            }
        }
        return '';
    }
}
