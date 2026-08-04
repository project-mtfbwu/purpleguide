<?php
$sessionDriverPath = APPPATH . 'controllers/drivers/Session_files_driver.php';

class Event extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->model('User_model','um'); 
        $this->load->library('session');
        $this->load->library('Notification_service');
         if (!$this->session->userdata('user_id')) {
         redirect('Users/logout');
         }
    }

    public function preview_event()
    {
        // If opened directly (GET), redirect to the website's event page (saved events only).
        // The in-admin preview (POST) remains for unsaved "draft" previews from the form.
        $this->output->enable_profiler(FALSE);

        $websiteBase = rtrim((string) $this->config->item('website_base_url'), '/');
        if ($websiteBase === '') {
            $websiteBase = 'https://purpleguide.study/pgs';
        }

        if (strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET')) !== 'POST') {
            $id = (int) ($this->input->get('id') ?? 0);
            if ($id <= 0) {
                $id = (int) ($this->uri->segment(3) ?? 0);
            }

            if ($id > 0) {
                redirect($websiteBase . '/Purpleevents/session/' . $id);
                return;
            }

            show_error('Missing event id for preview.', 400);
            return;
        }

        $id = (int) $this->input->post('id');

        $name = ucfirst(trim((string) $this->input->post('prod_name'), " \t"));
        $sub = trim((string) $this->input->post('prod_sub_name'));
        $s_date = (string) $this->input->post('s_date');
        $e_date = (string) $this->input->post('e_date');
        $mode = trim((string) $this->input->post('mode'));

        $desc = $this->input->post('description');
        if ($desc === null) {
            $desc = $this->input->post('pro_desc'); // add_event form
        }
        $desc = (string) $desc;

        $event = [
            'id' => $id ?: null,
            'product_name' => $name,
            'prod_sub_name' => $sub,
            's_date' => $s_date,
            'e_date' => $e_date,
            'mode' => $mode,
            'host' => trim((string) $this->input->post('host')),
            'top_label' => trim((string) $this->input->post('top_label')),
            'badge' => trim((string) $this->input->post('badge')),
            'author_name' => trim((string) $this->input->post('author_name')),
            'author_bio' => (string) $this->input->post('author_bio'),
            'tags' => trim((string) $this->input->post('tags')),
            'who_is_it_for' => (string) $this->input->post('who_is_it_for'),
            'session_topics' => (string) $this->input->post('session_topics'),
            'what_we_cover' => (string) $this->input->post('what_we_cover'),
            'book_url' => trim((string) $this->input->post('book_url')),
            'location_note' => trim((string) $this->input->post('location_note')),
            'description' => $desc,
        ];

        // Prefer a newly uploaded image for preview (edit form uses prod_image1, add form uses banner_image)
        $previewImage = $this->_save_preview_image('prod_image1');
        if (!$previewImage) $previewImage = $this->_save_preview_image('banner_image');

        if (!$previewImage && $id > 0) {
            $row = $this->db->select('image1')->from('event_tbl')->where('id', $id)->limit(1)->get()->row();
            if ($row && !empty($row->image1)) {
                $previewImage = 'assets/images/' . $row->image1;
            }
        }
        $event['preview_image'] = $previewImage;

        // Facilitators
        $facilitators = [];
        $facNames = $this->input->post('facilitator_name', true);
        $facPos = $this->input->post('facilitator_position', true);
        $facDet = $this->input->post('facilitator_details', true);
        if (is_array($facNames) || is_array($facPos) || is_array($facDet)) {
            $facNames = is_array($facNames) ? $facNames : [];
            $facPos = is_array($facPos) ? $facPos : [];
            $facDet = is_array($facDet) ? $facDet : [];
            $n = max(count($facNames), count($facPos), count($facDet));
            for ($i = 0; $i < $n; $i++) {
                $nme = trim((string) ($facNames[$i] ?? ''));
                if ($nme === '') continue;
                $facilitators[] = [
                    'name' => $nme,
                    'position' => trim((string) ($facPos[$i] ?? '')),
                    'details' => trim((string) ($facDet[$i] ?? '')),
                ];
            }
        } else if ($id > 0 && $this->db->table_exists('event_facilitators')) {
            $facilitators = $this->db->order_by('sort_order', 'ASC')->order_by('id', 'ASC')
                ->get_where('event_facilitators', ['event_id' => $id])->result_array();
        }

        // Auto-fill author from first facilitator if not provided (matches add_event behavior)
        if (empty($event['author_name']) && !empty($facilitators[0]['name'])) {
            $event['author_name'] = (string) $facilitators[0]['name'];
        }
        if (empty($event['author_bio']) && !empty($facilitators[0]['details'])) {
            $event['author_bio'] = (string) $facilitators[0]['details'];
        }

        $this->load->view('event_preview', [
            'event' => $event,
            'facilitators' => $facilitators,
            'frontend_base' => $websiteBase,
        ]);
    }

    private function _save_preview_image(string $field): ?string
    {
        if (empty($_FILES[$field]['name'])) return null;
        if (!isset($_FILES[$field]['tmp_name']) || !is_uploaded_file($_FILES[$field]['tmp_name'])) return null;

        $ext = strtolower(pathinfo((string) $_FILES[$field]['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) return null;

        $dir = FCPATH . 'assets/tmp/event_preview/';
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $name = 'preview_' . date('Ymd_His') . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
        $dest = $dir . $name;
        if (@move_uploaded_file($_FILES[$field]['tmp_name'], $dest)) {
            return 'assets/tmp/event_preview/' . $name;
        }
        return null;
    }
    public function add_event(){
        $data['cate'] =  $this->db->query("SELECT * FROM `event_category_tbl` where block_status='0'")->result();
        $this->load->view('event', $data);
    }    
    public function add_event_data()
    {
        $desc = $this->input->post('pro_desc');
        $name = ucfirst(trim($this->input->post('prod_name'), " \t"));
        $product_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));

        $cat_id = $this->input->post('cat_id');

        $prod_sub_name = $this->input->post('prod_sub_name');
        $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');
        $mode = $this->input->post('mode');

        $subcat_name = $this->input->post('subcat_name');

        // Facilitators are added inline on the "Add Event" screen.
        // These values are also used to auto-fill event_tbl.author_name/author_bio from the first facilitator row.
        $facilitatorNames = $this->input->post('facilitator_name', true);
        $facilitatorPositions = $this->input->post('facilitator_position', true);
        $facilitatorDetails = $this->input->post('facilitator_details', true);
        $facilitatorSortOrders = $this->input->post('facilitator_sort_order', true);

        if (!is_array($facilitatorNames)) {
            $facilitatorNames = $facilitatorNames !== null ? [$facilitatorNames] : [];
        }
        if (!is_array($facilitatorPositions)) {
            $facilitatorPositions = $facilitatorPositions !== null ? [$facilitatorPositions] : [];
        }
        if (!is_array($facilitatorDetails)) {
            $facilitatorDetails = $facilitatorDetails !== null ? [$facilitatorDetails] : [];
        }
        if (!is_array($facilitatorSortOrders)) {
            $facilitatorSortOrders = $facilitatorSortOrders !== null ? [$facilitatorSortOrders] : [];
        }

        $firstFacName = trim($facilitatorNames[0] ?? '');
        $firstFacDetails = trim($facilitatorDetails[0] ?? '');

        $image1 = $this->um->file_upload('banner_image', 'assets/images/');
        if ($image1) {
            $prod_data['image1'] = $image1;
        }

        $image2 = $this->um->file_upload('thumb_image', 'assets/images/');
        if ($image2) {
            $prod_data['image2'] = $image2;
        }

        $prod_data['cat_id'] = $cat_id;
        $prod_data['subcat_id'] = $subcat_name;
        $prod_data['description'] = $desc;
        $prod_data['product_name'] = $name;

        $prod_data['prod_sub_name'] = $prod_sub_name;
        $prod_data['s_date'] = $s_date;
        $prod_data['e_date'] = $e_date;
        $prod_data['mode'] = $mode;


        $prod_data['product_slug'] = $product_slug;

        $this->_ensure_event_extra_columns();
        if ($this->db->field_exists('host', 'event_tbl')) {
            $prod_data['host'] = trim($this->input->post('host')) ?: null;
            $prod_data['top_label'] = trim($this->input->post('top_label')) ?: null;
            $prod_data['badge'] = trim($this->input->post('badge')) ?: null;
            // Auto-fill from the first facilitator row on the page
            $prod_data['author_name'] = $firstFacName !== '' ? $firstFacName : null;
            $prod_data['author_bio'] = $firstFacDetails !== '' ? $firstFacDetails : null;
            $prod_data['book_url'] = trim($this->input->post('book_url')) ?: null;
            $prod_data['location_note'] = trim($this->input->post('location_note')) ?: null;
            $prod_data['tags'] = trim($this->input->post('tags')) ?: null;
        }
        if ($this->db->field_exists('who_is_it_for', 'event_tbl')) $prod_data['who_is_it_for'] = trim($this->input->post('who_is_it_for')) ?: null;
        if ($this->db->field_exists('session_topics', 'event_tbl')) $prod_data['session_topics'] = trim($this->input->post('session_topics')) ?: null;
        if ($this->db->field_exists('what_we_cover', 'event_tbl')) $prod_data['what_we_cover'] = trim($this->input->post('what_we_cover')) ?: null;

        $id = $this->um->insert('event_tbl', $prod_data);

        if ($id) {
            $this->notification_service->notify_all_users(
                'top_picks_event',
                'New event added to top picks',
                $name,
                'purpleevents/session/' . (int) $id,
                'event',
                $id,
                'events'
            );

            // Save facilitators for this event.
            $this->_ensure_facilitators_table();

            $imgNames = $this->um->multi_file_upload('facilitator_image', 'assets/images/');

            $facCount = max(
                count($facilitatorNames),
                count($facilitatorPositions),
                count($facilitatorDetails),
                count($facilitatorSortOrders)
            );

            for ($i = 0; $i < $facCount; $i++) {
                $facName = trim($facilitatorNames[$i] ?? '');
                if ($facName === '') {
                    continue;
                }

                $position = trim($facilitatorPositions[$i] ?? '');
                $details = trim($facilitatorDetails[$i] ?? '');

                $sortOrder = $facilitatorSortOrders[$i] ?? '';
                $sortOrder = ($sortOrder === '' || $sortOrder === null) ? $i : (int) $sortOrder;

                $image = $imgNames[$i] ?? null;
                $image = ($image === '' || $image === null) ? null : $image;

                $this->um->insert('event_facilitators', [
                    'event_id' => (int) $id,
                    'name' => $facName,
                    'position' => $position !== '' ? $position : null,
                    'details' => $details !== '' ? $details : null,
                    'image' => $image,
                    'sort_order' => (int) $sortOrder,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }

            // Ensure author fields match the first facilitator actually saved.
            $this->_sync_event_author_from_first_facilitator($id);

            $this->session->set_flashdata('success', 'Event added successfully');
            redirect(base_url() . 'Event/event_view');
        } else {
            $this->session->set_flashdata('error', 'Event not added');
            redirect(base_url() . 'Event/add_event');
        }
    }
    public function edit_event($id)
    {

        $id = $this->uri->segment(3);
        $this->session->set_userdata('id', $id);

        $article = $this->db->get_where('event_tbl', ['id' => $id])->row();

        if (!$article) {
            redirect(base_url('Event/event_view'));
            return;
        }

        $data['product'] = $article;
        $data['cate'] =  $this->db->query("SELECT * FROM `event_category_tbl` where block_status='0'")->result();
        $this->_ensure_facilitators_table();
        $data['facilitators'] = $this->db->order_by('sort_order', 'ASC')->order_by('id', 'ASC')
            ->get_where('event_facilitators', ['event_id' => (int) $id])->result();

        $this->load->view('edit_event', $data);
    }
    public function edit_event_data()
    {
        $this->load->library('session');
        $this->load->library('Notification_service');

        $p_id = $this->input->post('id');

        //print_r($p_id);die();
        $name = ucfirst(trim($this->input->post('prod_name'), " \t"));
        $description = $this->input->post('description');
        $cat_id = $this->input->post('cat_id');

        $prod_sub_name = $this->input->post('prod_sub_name');
        $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');
        $mode = $this->input->post('mode');

        // Validate required fields
        if (empty($name)) {
            $this->session->set_flashdata('error', 'Product name is required');
            redirect(base_url('Event/edit_event/') . $p_id);
            return;
        }

        // Initialize update data
        $prod_data = [
            'product_name' => $name,
            'description' => $description,
            'cat_id' => $cat_id,
            'prod_sub_name' => $prod_sub_name,
            's_date' => $s_date,
            'e_date' => $e_date,
            'mode' => $mode,
        ];
        $this->_ensure_event_extra_columns();
        if ($this->db->field_exists('host', 'event_tbl')) {
            $prod_data['host'] = trim($this->input->post('host')) ?: null;
            $prod_data['top_label'] = trim($this->input->post('top_label')) ?: null;
            $prod_data['badge'] = trim($this->input->post('badge')) ?: null;
            $prod_data['author_name'] = trim($this->input->post('author_name')) ?: null;
            $prod_data['author_bio'] = trim($this->input->post('author_bio')) ?: null;
            $prod_data['book_url'] = trim($this->input->post('book_url')) ?: null;
            $prod_data['location_note'] = trim($this->input->post('location_note')) ?: null;
            $prod_data['tags'] = trim($this->input->post('tags')) ?: null;
        }
        if ($this->db->field_exists('who_is_it_for', 'event_tbl')) $prod_data['who_is_it_for'] = trim($this->input->post('who_is_it_for')) ?: null;
        if ($this->db->field_exists('session_topics', 'event_tbl')) $prod_data['session_topics'] = trim($this->input->post('session_topics')) ?: null;
        if ($this->db->field_exists('what_we_cover', 'event_tbl')) $prod_data['what_we_cover'] = trim($this->input->post('what_we_cover')) ?: null;

        // Handle image1 upload (only one image allowed)
        $image1 = $this->um->file_upload('prod_image1', 'assets/images/');

        if ($image1) {
            $prod_data['image1'] = $image1;
        }

        $updated = $this->um->update('event_tbl', ['id' => $p_id], $prod_data);        

        if ($updated) {
            $event_status = $this->db->select('block_status')->get_where('event_tbl', ['id' => $p_id])->row();
            if (!$event_status || (int) $event_status->block_status === 0) {
                $this->notification_service->notify_all_users(
                    'top_picks_event',
                    'Top pick event updated',
                    $name,
                    'purpleevents/session/' . (int) $p_id,
                    'event',
                    $p_id,
                    'events'
                );
            }
            $this->session->set_flashdata('success', 'Event updated successfully');
            redirect(base_url('Event/event_view'));
        } else {
            $this->session->set_flashdata('error', 'Event not updated');
            redirect(base_url('Event/edit_event/') . $p_id);
        }
    }

    /**
     * Ensure event_tbl has who_is_it_for, session_topics, what_we_cover columns.
     */
    private function _ensure_event_extra_columns() {
        $columns = ['who_is_it_for' => 'TEXT NULL', 'session_topics' => 'TEXT NULL', 'what_we_cover' => 'TEXT NULL'];
        foreach ($columns as $col => $def) {
            if (!$this->db->field_exists($col, 'event_tbl')) {
                $this->db->query("ALTER TABLE `event_tbl` ADD COLUMN `{$col}` {$def}");
            }
        }
    }

    /**
     * Ensure event_facilitators table exists (same DB as main app).
     */
    private function _ensure_facilitators_table() {
        if ($this->db->table_exists('event_facilitators')) {
            return;
        }
        $sql = "CREATE TABLE IF NOT EXISTS `event_facilitators` (
          `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
          `event_id` int(10) unsigned NOT NULL,
          `name` varchar(255) NOT NULL,
          `position` varchar(255) DEFAULT NULL,
          `details` text,
          `image` varchar(255) DEFAULT NULL,
          `sort_order` int(10) unsigned DEFAULT 0,
          `created_at` datetime DEFAULT NULL,
          PRIMARY KEY (`id`),
          KEY `event_id` (`event_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        $this->db->query($sql);
    }

    /**
     * Get the first facilitator added (lowest id) for author auto-fill.
     */
    private function _get_first_facilitator_author($event_id) {
        $event_id = (int) $event_id;
        $this->_ensure_facilitators_table();

        $facilitator = $this->db
            ->order_by('id', 'ASC')
            ->limit(1)
            ->get_where('event_facilitators', ['event_id' => $event_id])
            ->row();

        return [
            'author_name' => $facilitator ? $facilitator->name : null,
            'author_bio'  => $facilitator ? $facilitator->details : null,
        ];
    }

    /**
     * Keep event_tbl.author_name/author_bio in sync with the first facilitator.
     */
    private function _sync_event_author_from_first_facilitator($event_id) {
        $event_id = (int) $event_id;
        $this->_ensure_event_extra_columns();

        $author = $this->_get_first_facilitator_author($event_id);

        if (!$this->db->field_exists('author_name', 'event_tbl') && !$this->db->field_exists('author_bio', 'event_tbl')) {
            return;
        }

        $data = [];
        if ($this->db->field_exists('author_name', 'event_tbl')) $data['author_name'] = $author['author_name'] ?: null;
        if ($this->db->field_exists('author_bio', 'event_tbl')) $data['author_bio'] = $author['author_bio'] ?: null;

        if (!empty($data)) {
            $this->um->update('event_tbl', ['id' => $event_id], $data);
        }
    }

    /**
     * List facilitators for an event.
     */
    public function facilitators($event_id) {
        $this->_ensure_facilitators_table();
        $event = $this->db->get_where('event_tbl', ['id' => (int) $event_id])->row();
        if (!$event) {
            $this->session->set_flashdata('error', 'Event not found');
            redirect('Event/event_view');
            return;
        }
        $data['event'] = $event;
        $data['facilitators'] = $this->db->order_by('sort_order', 'ASC')->order_by('id', 'ASC')
            ->get_where('event_facilitators', ['event_id' => (int) $event_id])->result();
        $this->load->view('facilitators_list', $data);
    }

    /**
     * Form to add a facilitator.
     */
    public function add_facilitator($event_id) {
        $this->_ensure_facilitators_table();
        $event_id = (int) $event_id;
        $event = $this->db->get_where('event_tbl', ['id' => $event_id])->row();
        if (!$event) {
            $this->session->set_flashdata('error', 'Event not found');
            redirect('Event/event_view');
            return;
        }
        $data['event'] = $event;
        $data['facilitator'] = null;
        $this->load->view('facilitator_form', $data);
    }

    /**
     * Save new facilitator (POST).
     */
    public function save_facilitator() {
        $this->_ensure_facilitators_table();
        $event_id = (int) $this->input->post('event_id');
        $event = $this->db->get_where('event_tbl', ['id' => $event_id])->row();
        if (!$event) {
            $this->session->set_flashdata('error', 'Event not found');
            redirect('Event/event_view');
            return;
        }
        $img = $this->um->file_upload('facilitator_image', 'assets/images/');
        $data = [
            'event_id'   => $event_id,
            'name'       => trim($this->input->post('name', true)),
            'position'   => trim($this->input->post('position', true)) ?: null,
            'details'    => trim($this->input->post('details', true)) ?: null,
            'image'      => $img ?: null,
            'sort_order' => (int) $this->input->post('sort_order'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        if (empty($data['name'])) {
            $this->session->set_flashdata('error', 'Facilitator name is required');
            $redirect_to = trim((string) $this->input->post('redirect_to', true));
            if ($redirect_to !== '') {
                redirect($redirect_to);
            } else {
                redirect('Event/add_facilitator/' . $event_id);
            }
            return;
        }
        $this->um->insert('event_facilitators', $data);
        $this->_sync_event_author_from_first_facilitator($event_id);
        $this->session->set_flashdata('success', 'Facilitator added successfully');
        $redirect_to = trim((string) $this->input->post('redirect_to', true));
        if ($redirect_to !== '') {
            redirect($redirect_to);
        } else {
            redirect('Event/facilitators/' . $event_id);
        }
    }

    /**
     * Form to edit a facilitator.
     */
    public function edit_facilitator($event_id, $facilitator_id) {
        $this->_ensure_facilitators_table();
        $event_id = (int) $event_id;
        $facilitator_id = (int) $facilitator_id;
        $event = $this->db->get_where('event_tbl', ['id' => $event_id])->row();
        $facilitator = $this->db->get_where('event_facilitators', ['id' => $facilitator_id, 'event_id' => $event_id])->row();
        if (!$event || !$facilitator) {
            $this->session->set_flashdata('error', 'Event or facilitator not found');
            redirect('Event/event_view');
            return;
        }
        $data['event'] = $event;
        $data['facilitator'] = $facilitator;
        $this->load->view('facilitator_form', $data);
    }

    /**
     * Update facilitator (POST).
     */
    public function update_facilitator() {
        $event_id = (int) $this->input->post('event_id');
        $facilitator_id = (int) $this->input->post('facilitator_id');
        $facilitator = $this->db->get_where('event_facilitators', ['id' => $facilitator_id, 'event_id' => $event_id])->row();
        if (!$facilitator) {
            $this->session->set_flashdata('error', 'Facilitator not found');
            redirect('Event/event_view');
            return;
        }
        $img = $this->um->file_upload('facilitator_image', 'assets/images/');
        $data = [
            'name'       => trim($this->input->post('name', true)),
            'position'   => trim($this->input->post('position', true)) ?: null,
            'details'    => trim($this->input->post('details', true)) ?: null,
            'sort_order' => (int) $this->input->post('sort_order'),
        ];
        if ($img) {
            $data['image'] = $img;
        }
        if (empty($data['name'])) {
            $this->session->set_flashdata('error', 'Facilitator name is required');
            redirect('Event/edit_facilitator/' . $event_id . '/' . $facilitator_id);
            return;
        }
        $this->um->update('event_facilitators', ['id' => $facilitator_id], $data);
        $this->_sync_event_author_from_first_facilitator($event_id);
        $this->session->set_flashdata('success', 'Facilitator updated successfully');
        redirect('Event/facilitators/' . $event_id);
    }

    /**
     * Delete a facilitator.
     */
    public function delete_facilitator($event_id, $facilitator_id) {
        $event_id = (int) $event_id;
        $facilitator_id = (int) $facilitator_id;
        $this->db->where(['id' => $facilitator_id, 'event_id' => $event_id]);
        $this->db->delete('event_facilitators');
        $this->_sync_event_author_from_first_facilitator($event_id);
        $this->session->set_flashdata('success', 'Facilitator deleted');
        redirect('Event/facilitators/' . $event_id);
    }

    public function event_view()
    {
        $this->load->library('pagination');
        $per_page = 15;
        $page = max(1, (int) $this->uri->segment(3));
        $offset = ($page - 1) * $per_page;

        $total = $this->db
            ->from('event_tbl')
            ->join('event_category_tbl', 'event_category_tbl.id = event_tbl.cat_id', 'left')
            ->count_all_results();

        $config['base_url'] = base_url('Event/event_view');
        $config['total_rows'] = $total;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['cur_page'] = $page;
        $config['num_links'] = 3;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = $config['last_tag_close'] = $config['next_tag_close'] = $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();

        $data['product'] = $this->db
            ->select('event_tbl.*, event_category_tbl.category_name')
            ->from('event_tbl')
            ->join('event_category_tbl', 'event_category_tbl.id = event_tbl.cat_id', 'left')
            ->order_by('event_tbl.id', 'DESC')
            ->limit($per_page, $offset)
            ->get()
            ->result();
        $this->load->view('event_view', $data);
    }
  
  
    public function block($id)
     {
     $id = $this->uri->segment(3);
     $sql = $this->um->get_dataa('event_tbl',['id'=>$id]);
   
     $status= $sql[0]->block_status;
     if ($id) {
      
     if ($status==0) {
      
      $data= $this->um->update('event_tbl',['id'=>$id],['block_status'=>1]);
       $this->session->set_flashdata('success', 'Event Unpublished Successfully');
       redirect (base_url().'Event/event_view');die();

     }else{
      
         $data= $this->um->update('event_tbl',['id'=>$id],['block_status'=>0]);
          $this->notification_service->notify_all_users(
              'top_picks_event',
              'Event published in top picks',
              !empty($sql[0]->product_name) ? $sql[0]->product_name : 'Event update',
              'purpleevents/session/' . (int) $id,
              'event',
              $id,
              'events'
          );
          $this->session->set_flashdata('success', 'Event Published Successfully');
           redirect (base_url().'Event/event_view');die();
        }
     }else{
         
          $this->session->set_flashdata('error', 'Event id not found');
           redirect (base_url().'Event/event_view');die();
     }
    }
    public function delete_event(){
      $id = $this->uri->segment(3);
      $res = $this->um->delete('event_tbl',['id'=>$id]);
         
        if($res)                            
        {
            $this->session->set_flashdata('success', 'Event Deleted Successfully');
             redirect (base_url().'Event/event_view');die();
        }else{
            $this->session->set_flashdata('error', 'Event Not Deleted');
             redirect (base_url().'Event/event_view');die();
        }
    }

}