<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purplepremium_offer extends CI_Controller {
    private function defaults() {
        return [
            'purplepremium_offer_visible' => '1',
            'purplepremium_offer_heading' => 'START YOUR USMLE JOURNEY WITH #PURPLEPREMIUM',
            'purplepremium_offer_description' => "Every student's journey takes time, attention, and real mentorship.\nThat's why we limit the number of students each batch - so our experts can actually guide, not just supervise.",
            'purplepremium_offer_label' => 'Get Started at discounted price',
            'purplepremium_offer_discount' => '35% off',
            'purplepremium_offer_price' => '65,0000',
            'purplepremium_offer_original_price' => '509,998',
            'purplepremium_offer_cta_text' => 'Enroll Now',
            'purplepremium_offer_cta_url' => '',
        ];
    }

    public function data() {
        $settings = $this->defaults();

        if ($this->db->table_exists('student_resources_settings')) {
            $rows = $this->db
                ->where_in('setting_key', array_keys($settings))
                ->get('student_resources_settings')
                ->result();

            foreach ($rows as $row) {
                if (isset($settings[$row->setting_key])) {
                    $settings[$row->setting_key] = (string) $row->setting_value;
                }
            }
        }

        $payload = [
            'visible' => (string) $settings['purplepremium_offer_visible'] !== '0',
            'heading' => $settings['purplepremium_offer_heading'],
            'description' => $settings['purplepremium_offer_description'],
            'label' => $settings['purplepremium_offer_label'],
            'discount' => $settings['purplepremium_offer_discount'],
            'price' => $settings['purplepremium_offer_price'],
            'original_price' => $settings['purplepremium_offer_original_price'],
            'cta_text' => $settings['purplepremium_offer_cta_text'],
            'cta_url' => $settings['purplepremium_offer_cta_url'],
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($payload));
    }
}
