<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Premium_meetup extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model', 'um');
        $this->load->library('session');

        // Memory optimization
        ini_set('memory_limit', '256M');

        // Disable query storage
        $this->db->save_queries = false;

        // Disable profiler
        $this->output->enable_profiler(false);

        // Auth check
        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
        }
    }

    public function index()
    {
        $this->_ensure_table();
        $row = $this->_first_row();

        if (!$row) {

            $this->_insert_row($this->_default_data());

            $row = $this->_first_row();
        }

        $data['meetup'] = $row;

        $this->load->view('premium_meetup', $data);
    }

    public function update()
    {
        $this->_ensure_table();
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

        $title = $this->_post_text('title', 255);

        if ($title === '') {

            $this->session->set_flashdata('error', 'Title is required');

            redirect(base_url('Premium_meetup'));

            return;
        }

        $data = [

            'title' => $title,

            'date1_day' => $this->_post_text('date1_day', 20),
            'date1_month' => $this->_post_text('date1_month', 40),
            'date1_time1' => $this->_post_text('date1_time1', 80),
            'date1_time2' => $this->_post_text('date1_time2', 80),

            'date2_day' => $this->_post_text('date2_day', 20),
            'date2_month' => $this->_post_text('date2_month', 40),
            'date2_time1' => $this->_post_text('date2_time1', 80),
            'date2_time2' => $this->_post_text('date2_time2', 80),

            'who_heading' => $this->_post_text('who_heading', 120),
            'who_text' => $this->_post_text('who_text', 2000),

            'topics_heading' => $this->_post_text('topics_heading', 120),

            'topic1' => $this->_post_text('topic1', 255),
            'topic2' => $this->_post_text('topic2', 255),

            'button_text' => $this->_post_text('button_text', 80),
            'button_link' => $this->_post_text('button_link', 500),

            'block_status' => isset($_POST['block_status']) ? 0 : 1,
        ];

        /*
        |--------------------------------------------------------------------------
        | Image Upload
        |--------------------------------------------------------------------------
        */

        if (!empty($_FILES['image']['name'])) {

            // 5MB max size
            if ($_FILES['image']['size'] > 5242880) {

                $this->session->set_flashdata(
                    'error',
                    'Image size must be less than 5MB'
                );

                redirect(base_url('Premium_meetup'));

                return;
            }

            $image = $this->um->file_upload('image', 'assets/images/');

            if ($image) {
                $data['image'] = $image;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Get Existing Row
        |--------------------------------------------------------------------------
        */

        $row = null;

        if ($id > 0) {

            $row = $this->_row_by_id($id);
        }

        /*
        |--------------------------------------------------------------------------
        | Keep old image
        |--------------------------------------------------------------------------
        */

        if ($row && !isset($data['image'])) {
            $data['image'] = $row->image;
        }

        /*
        |--------------------------------------------------------------------------
        | Update / Insert
        |--------------------------------------------------------------------------
        */

        if ($row) {

            $this->_update_row($row->id, $data);

        } else {

            $this->_insert_row($data);
        }

        $this->session->set_flashdata(
            'success',
            'Premium meetup card updated successfully'
        );

        redirect(base_url('Premium_meetup'));
    }

    /*
    |--------------------------------------------------------------------------
    | Default Data
    |--------------------------------------------------------------------------
    */

    private function _default_data()
    {
        return [

            'title' => 'Online study abroad plan meetup.',

            'date1_day' => '31',
            'date1_month' => 'Dec 25',
            'date1_time1' => '12pm to 2 pm',
            'date1_time2' => '12pm to 2 pm',

            'date2_day' => '31',
            'date2_month' => 'Dec 25',
            'date2_time1' => '12pm to 2 pm',
            'date2_time2' => '12pm to 2 pm',

            'who_heading' => "Who's It For?",

            'who_text' => "Final-year student? Recent grad? Researching for masters?\nThis session's made for you.",

            'topics_heading' => 'Topics Covered',

            'topic1' => 'Masters in USA UK for graduates',
            'topic2' => 'How to prepare your finances',

            'button_text' => 'Learn More',

            'button_link' => '',

            'image' => '',

            'block_status' => 0,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Clean Post Input
    |--------------------------------------------------------------------------
    */

    private function _post_text($key, $max_length)
    {
        $value = isset($_POST[$key]) ? $_POST[$key] : '';

        if (is_array($value)) {
            return '';
        }

        $value = trim((string) $value);

        if (strlen($value) > $max_length) {
            $value = substr($value, 0, $max_length);
        }

        return $value;
    }

    /*
    |--------------------------------------------------------------------------
    | Insert
    |--------------------------------------------------------------------------
    */

    private function _insert_row($data)
    {
        $sql = "INSERT INTO `premium_meetup_card`
            (`title`, `date1_day`, `date1_month`, `date1_time1`, `date1_time2`, `date2_day`, `date2_month`, `date2_time1`, `date2_time2`, `who_heading`, `who_text`, `topics_heading`, `topic1`, `topic2`, `button_text`, `button_link`, `image`, `block_status`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        return $this->_execute_stmt($sql, $this->_bind_values($data));
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    private function _update_row($id, $data)
    {
        $values = $this->_bind_values($data);
        $values[] = (int) $id;

        $sql = "UPDATE `premium_meetup_card` SET
            `title` = ?, `date1_day` = ?, `date1_month` = ?, `date1_time1` = ?, `date1_time2` = ?,
            `date2_day` = ?, `date2_month` = ?, `date2_time1` = ?, `date2_time2` = ?,
            `who_heading` = ?, `who_text` = ?, `topics_heading` = ?, `topic1` = ?, `topic2` = ?,
            `button_text` = ?, `button_link` = ?, `image` = ?, `block_status` = ?
            WHERE `id` = ?";

        return $this->_execute_stmt($sql, $values);
    }

    private function _first_row()
    {
        $result = $this->db->conn_id->query("SELECT * FROM `premium_meetup_card` ORDER BY `id` ASC LIMIT 1");
        return ($result && $result->num_rows) ? (object) $result->fetch_assoc() : null;
    }

    private function _row_by_id($id)
    {
        $id = (int) $id;
        $result = $this->db->conn_id->query("SELECT `id`, `image` FROM `premium_meetup_card` WHERE `id` = {$id} LIMIT 1");
        return ($result && $result->num_rows) ? (object) $result->fetch_assoc() : null;
    }

    private function _ensure_table()
    {
        $this->db->conn_id->query("CREATE TABLE IF NOT EXISTS `premium_meetup_card` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `title` varchar(255) NOT NULL,
            `date1_day` varchar(20) DEFAULT NULL,
            `date1_month` varchar(40) DEFAULT NULL,
            `date1_time1` varchar(80) DEFAULT NULL,
            `date1_time2` varchar(80) DEFAULT NULL,
            `date2_day` varchar(20) DEFAULT NULL,
            `date2_month` varchar(40) DEFAULT NULL,
            `date2_time1` varchar(80) DEFAULT NULL,
            `date2_time2` varchar(80) DEFAULT NULL,
            `who_heading` varchar(120) DEFAULT NULL,
            `who_text` text NULL,
            `topics_heading` varchar(120) DEFAULT NULL,
            `topic1` varchar(255) DEFAULT NULL,
            `topic2` varchar(255) DEFAULT NULL,
            `button_text` varchar(80) DEFAULT NULL,
            `button_link` varchar(500) DEFAULT NULL,
            `image` varchar(255) DEFAULT NULL,
            `block_status` tinyint(1) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    private function _bind_values($data)
    {
        return [
            $data['title'],
            $data['date1_day'],
            $data['date1_month'],
            $data['date1_time1'],
            $data['date1_time2'],
            $data['date2_day'],
            $data['date2_month'],
            $data['date2_time1'],
            $data['date2_time2'],
            $data['who_heading'],
            $data['who_text'],
            $data['topics_heading'],
            $data['topic1'],
            $data['topic2'],
            $data['button_text'],
            $data['button_link'],
            isset($data['image']) ? $data['image'] : '',
            (int) $data['block_status'],
        ];
    }

    private function _execute_stmt($sql, $values)
    {
        $stmt = $this->db->conn_id->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $types = str_repeat('s', count($values) - 1) . 'i';
        if (count($values) === 19) {
            $types = str_repeat('s', 17) . 'ii';
        }

        $refs = [];
        $refs[] = $types;
        foreach ($values as $key => $value) {
            $refs[] = &$values[$key];
        }

        call_user_func_array([$stmt, 'bind_param'], $refs);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}
