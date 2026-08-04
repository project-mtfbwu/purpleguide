<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Univmeet_model extends CI_Model
{
    protected $table = 'univ_meet_dates';

    /**
     * Return the current #univMeet configuration.
     *
     * Expected table structure (create this once in MySQL):
     *
     * CREATE TABLE `univ_meet_dates` (
     *   `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     *   `slot1_date`  VARCHAR(10)  NOT NULL,
     *   `slot1_month` VARCHAR(20)  NOT NULL,
     *   `slot2_date`  VARCHAR(10)  NOT NULL,
     *   `slot2_month` VARCHAR(20)  NOT NULL,
     *   `updated_at`  DATETIME     NOT NULL,
     *   PRIMARY KEY (`id`)
     * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
     */
    public function get_current()
    {
        $row = $this->db->order_by('id', 'DESC')->limit(1)->get($this->table)->row_array();

        if (!$row) {
            // Sensible defaults matching current design
            return array(
                'slot1_date'  => '15',
                'slot1_month' => 'Aug 26',
                'slot2_date'  => '31',
                'slot2_month' => 'Aug 26',
            );
        }

        return $row;
    }
}

