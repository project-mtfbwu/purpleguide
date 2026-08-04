<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show_error($heading, $message, $template = 'error_general', $status_code = 500)
    {
        // Safe logging
        $this->log_error_to_db($heading, $message);

        // Get CI instance
        $CI =& get_instance();

        if ($CI && isset($CI->load)) {
            echo $CI->load->view('header', [], true);
            echo $CI->load->view('errors/html/' . $template, [
                'heading' => $heading,
                'message' => $message
            ], true);
            echo $CI->load->view('footer', [], true);
        } else {
            // Fallback if CI not ready
            echo "<h1>{$heading}</h1>";
            echo "<p>{$message}</p>";
        }

        exit;
    }

    private function log_error_to_db($heading, $message)
    {
        $CI =& get_instance();

        // If CI not ready, stop
        if (!$CI || !isset($CI->load)) {
            return;
        }

        // Load DB safely
        $CI->load->database();

        if (!isset($CI->db)) {
            return;
        }

        $data = [
            'error_heading' => $heading,
            'error_message' => is_array($message) ? json_encode($message) : $message,
            'created_at'    => date('Y-m-d H:i:s')
        ];

        $CI->db->insert('error_logs', $data);
    }
}