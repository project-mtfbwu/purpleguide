<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preview extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('events');
        $this->load->library('session');
    }

    /**
     * Render a frontend (website) preview of an event before saving it.
     * This endpoint is designed to receive the admin "Add/Edit Event" form POST,
     * including uploaded images, and then render using website UI.
     *
     * URL: /preview/event
     */
    public function event()
    {
        if (strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET')) !== 'POST') {
            show_error('Method Not Allowed', 405);
            return;
        }

        $event = new stdClass();
        $event->id = null; // unsaved

        $event->product_name = ucfirst(trim((string) $this->input->post('prod_name'), " \t"));
        $event->prod_sub_name = trim((string) $this->input->post('prod_sub_name'));
        $event->s_date = (string) $this->input->post('s_date');
        $event->e_date = (string) $this->input->post('e_date');
        $event->mode = trim((string) $this->input->post('mode'));
        $event->host = trim((string) $this->input->post('host'));
        $event->top_label = trim((string) $this->input->post('top_label'));
        $event->badge = trim((string) $this->input->post('badge'));
        $event->author_name = trim((string) $this->input->post('author_name'));
        $event->author_bio = (string) $this->input->post('author_bio');
        $event->tags = trim((string) $this->input->post('tags'));
        $event->who_is_it_for = (string) $this->input->post('who_is_it_for');
        $event->session_topics = (string) $this->input->post('session_topics');
        $event->what_we_cover = (string) $this->input->post('what_we_cover');
        $event->book_url = trim((string) $this->input->post('book_url'));
        $event->location_note = trim((string) $this->input->post('location_note'));

        $desc = $this->input->post('description');
        if ($desc === null) $desc = $this->input->post('pro_desc'); // add_event form
        $event->description = (string) $desc;

        // Banner / primary image: edit form uses prod_image1, add form uses banner_image.
        $previewImage = $this->_save_preview_image('prod_image1');
        if (!$previewImage) {
            $previewImage = $this->_save_preview_image('banner_image');
        }

        $eventPostId = (int) $this->input->post('event_id');
        if ($eventPostId <= 0) {
            $eventPostId = (int) $this->input->post('id');
        }

        if ($previewImage) {
            $event->preview_image = $previewImage;
            $event->image1 = (string) $previewImage;
        } else {
            // Edit preview often sends no new file; reuse DB hero image (same as admin Event::preview_event fallback).
            $existingPosted = trim((string) $this->input->post('existing_image1'));
            if ($existingPosted !== '') {
                $event->image1 = $existingPosted;
            } elseif ($eventPostId > 0 && $this->db->table_exists('event_tbl')) {
                $row = $this->db->select('image1')->from('event_tbl')->where('id', $eventPostId)->limit(1)->get()->row();
                if ($row && !empty(trim((string) $row->image1))) {
                    $event->image1 = trim((string) $row->image1);
                }
            }
        }

        // Facilitators (inline on add-event form)
        $facilitators = [];
        $names = $this->input->post('facilitator_name', true);
        $pos = $this->input->post('facilitator_position', true);
        $det = $this->input->post('facilitator_details', true);

        $names = is_array($names) ? $names : ($names !== null ? [$names] : []);
        $pos = is_array($pos) ? $pos : ($pos !== null ? [$pos] : []);
        $det = is_array($det) ? $det : ($det !== null ? [$det] : []);

        $uploadedFacImages = $this->_save_preview_multi_images('facilitator_image');

        $n = max(count($names), count($pos), count($det), count($uploadedFacImages));
        for ($i = 0; $i < $n; $i++) {
            $nm = trim((string) ($names[$i] ?? ''));
            if ($nm === '') continue;
            $f = new stdClass();
            $f->name = $nm;
            $f->position = trim((string) ($pos[$i] ?? ''));
            $f->details = trim((string) ($det[$i] ?? ''));
            $f->image = $uploadedFacImages[$i] ?? null; // preview path
            $facilitators[] = $f;
        }

        // Auto-fill author from first facilitator if not provided (matches admin behavior)
        if (empty($event->author_name) && !empty($facilitators[0]->name)) {
            $event->author_name = (string) $facilitators[0]->name;
        }
        if (empty($event->author_bio) && !empty($facilitators[0]->details)) {
            $event->author_bio = (string) $facilitators[0]->details;
        }

        // Ensure the Purpleevents controller class is loaded because the view
        // calls Purpleevents::format_event_date() statically.
        // (CI doesn't autoload controller classes when rendering views.)
        if (!class_exists('Purpleevents', false)) {
            require_once APPPATH . 'controllers/Purpleevents.php';
        }

        $this->load->view('purpleevents_session', [
            'event' => $event,
            'facilitators' => $facilitators,
            'events' => [],
            'testimonials' => [],
            'is_preview' => true,
        ]);
    }

    private function _preview_dir(): string
    {
        return FCPATH . 'assets/tmp/event_preview/';
    }

    private function _ensure_preview_dir(): void
    {
        $dir = $this->_preview_dir();
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }

    private function _save_preview_image(string $field): ?string
    {
        if (!isset($_FILES[$field]) || !isset($_FILES[$field]['name']) || $_FILES[$field]['name'] === '' || $_FILES[$field]['name'] === null) {
            return null;
        }
        if (!isset($_FILES[$field]['tmp_name']) || !is_uploaded_file($_FILES[$field]['tmp_name'])) return null;

        $ext = strtolower(pathinfo((string) $_FILES[$field]['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) return null;

        $this->_ensure_preview_dir();

        $name = 'preview_' . date('Ymd_His') . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
        $dest = $this->_preview_dir() . $name;
        if (@move_uploaded_file($_FILES[$field]['tmp_name'], $dest)) {
            return 'assets/tmp/event_preview/' . $name;
        }
        return null;
    }

    /**
     * Save multi-upload images (e.g. facilitator_image[]) into preview tmp.
     * Returns array indexed by upload slot (0..n-1) of relative paths or null.
     */
    private function _save_preview_multi_images(string $field): array
    {
        if (empty($_FILES[$field]) || !is_array($_FILES[$field])) return [];
        if (empty($_FILES[$field]['name']) || !is_array($_FILES[$field]['name'])) return [];

        $this->_ensure_preview_dir();

        $names = $_FILES[$field]['name'];
        $tmp = $_FILES[$field]['tmp_name'] ?? [];
        $out = [];
        $count = count($names);
        for ($i = 0; $i < $count; $i++) {
            $orig = (string) ($names[$i] ?? '');
            $tmpName = $tmp[$i] ?? null;
            if ($orig === '' || !$tmpName || !is_uploaded_file($tmpName)) {
                $out[$i] = null;
                continue;
            }

            $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                $out[$i] = null;
                continue;
            }

            $name = 'fac_' . date('Ymd_His') . '_' . $i . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            $dest = $this->_preview_dir() . $name;
            if (@move_uploaded_file($tmpName, $dest)) {
                $out[$i] = 'assets/tmp/event_preview/' . $name;
            } else {
                $out[$i] = null;
            }
        }
        return $out;
    }

    /**
     * Render programsfull-style preview for admin Courses add/edit forms (courses_tbl).
     * POST fields mirror Courses::add_course_data / edit_course_data.
     *
     * URL: /preview/course
     */
    public function course()
    {
        if (strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET')) !== 'POST') {
            show_error('Method Not Allowed', 405);
            return;
        }

        $program = new stdClass();
        $program->id = 0;
        $program->title = ucfirst(trim((string) $this->input->post('prod_name'), " \t"));
        $program->short_description = trim((string) $this->input->post('prod_sub_name'));
        $program->tags = trim((string) $this->input->post('tags'));
        $program->top_label = '';
        $program->badge_text = '';
        $program->learn_more_url = '';
        $program->qr_code = '';

        $desc = $this->input->post('description');
        if ($desc === null) {
            $desc = $this->input->post('pro_desc');
        }
        $program->description = (string) $desc;

        $duration = trim((string) $this->input->post('duration'));
        $pekrs = trim((string) $this->input->post('pekrs'));
        $mode = trim((string) $this->input->post('mode'));
        $topic_lines = [];
        if ($duration !== '') {
            $topic_lines[] = 'Duration: ' . $duration;
        }
        if ($pekrs !== '') {
            $topic_lines[] = 'Perks: ' . $pekrs;
        }
        if ($mode !== '') {
            $topic_lines[] = 'Mode: ' . $mode;
        }
        $program->session_topics = implode("\n", $topic_lines);
        $program->who_is_it_for = !empty($topic_lines)
            ? implode("\n\n", $topic_lines)
            : "This program is for you.";
        $program->highlight_1 = $pekrs;
        $program->highlight_2 = $duration;
        $program->highlight_3 = $mode;
        $program->highlight_4 = '';

        $heroTmp = $this->_save_course_preview_upload('prod_image1', ['jpg', 'jpeg', 'png', 'webp', 'gif']);
        if (!$heroTmp) {
            $heroTmp = $this->_save_course_preview_upload('banner_image', ['jpg', 'jpeg', 'png', 'webp', 'gif']);
        }

        $coursePostId = (int) $this->input->post('course_id');
        if ($coursePostId <= 0) {
            $coursePostId = (int) $this->input->post('id');
        }

        if ($heroTmp) {
            $program->image = $heroTmp;
        } else {
            $existingImg = trim((string) $this->input->post('existing_image1'));
            if ($existingImg !== '') {
                $program->image = $existingImg;
            } elseif ($coursePostId > 0 && $this->db->table_exists('courses_tbl')) {
                $row = $this->db->select('image1')->from('courses_tbl')->where('id', $coursePostId)->limit(1)->get()->row();
                if ($row && !empty(trim((string) $row->image1))) {
                    $program->image = trim((string) $row->image1);
                }
            } else {
                $program->image = '';
            }
        }

        $brochureTmp = $this->_save_course_preview_upload('file', ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png', 'webp', 'gif']);
        if ($brochureTmp) {
            $program->brochure = $brochureTmp;
        } else {
            $existingFile = trim((string) $this->input->post('existing_file'));
            if ($existingFile !== '') {
                $program->brochure = $existingFile;
            } elseif ($coursePostId > 0 && $this->db->table_exists('courses_tbl')) {
                $row = $this->db->select('file')->from('courses_tbl')->where('id', $coursePostId)->limit(1)->get()->row();
                if ($row && !empty(trim((string) $row->file))) {
                    $program->brochure = trim((string) $row->file);
                }
            } else {
                $program->brochure = '';
            }
        }

        $testimonials = [];
        if ($this->db->table_exists('testimonial_tbl')) {
            $testimonials = $this->db->where('block_status', 0)
                ->order_by('id', 'DESC')
                ->get('testimonial_tbl')
                ->result();
        }

        $this->load->view('programsfull', [
            'program' => $program,
            'testimonials' => $testimonials,
            'is_preview' => true,
        ]);
    }

    private function _course_preview_dir(): string
    {
        return FCPATH . 'assets/tmp/course_preview/';
    }

    private function _ensure_course_preview_dir(): void
    {
        $dir = $this->_course_preview_dir();
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }

    /**
     * @param string[] $allowedExt lowercase extensions without dot
     */
    private function _save_course_preview_upload(string $field, array $allowedExt): ?string
    {
        if (!isset($_FILES[$field]) || !isset($_FILES[$field]['name']) || $_FILES[$field]['name'] === '' || $_FILES[$field]['name'] === null) {
            return null;
        }
        if (!isset($_FILES[$field]['tmp_name']) || !is_uploaded_file($_FILES[$field]['tmp_name'])) {
            return null;
        }
        $ext = strtolower(pathinfo((string) $_FILES[$field]['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExt, true)) {
            return null;
        }
        $this->_ensure_course_preview_dir();
        $name = 'course_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $dest = $this->_course_preview_dir() . $name;
        if (@move_uploaded_file($_FILES[$field]['tmp_name'], $dest)) {
            return 'assets/tmp/course_preview/' . $name;
        }
        return null;
    }
}

