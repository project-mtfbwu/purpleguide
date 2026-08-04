<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_audit_log_model extends CI_Model
{
    private string $table = 'admin_audit_logs';

    public function table_exists(): bool
    {
        return $this->db->table_exists($this->table);
    }

    /**
     * Insert a log row. Returns insert id or 0 if table missing / insert failed.
     *
     * Expected keys (subset ok):
     * - admin_id (int, required)
     * - admin_role (string|null)
     * - target_user_id (int|null)
     * - entity (string, required)
     * - entity_id (int|null)
     * - action (string, required)
     * - description (string|null)
     * - changes_json (string|null)
     * - ip_address (string|null)
     * - user_agent (string|null)
     * - created_at (Y-m-d H:i:s|null)
     */
    public function insert(array $row): int
    {
        if (!$this->table_exists()) {
            return 0;
        }

        if (empty($row['admin_id']) || empty($row['entity']) || empty($row['action'])) {
            return 0;
        }

        if (!isset($row['created_at']) || !$row['created_at']) {
            $row['created_at'] = date('Y-m-d H:i:s');
        }

        $ok = $this->db->insert($this->table, $row);
        if (!$ok) return 0;
        return (int) $this->db->insert_id();
    }
}

