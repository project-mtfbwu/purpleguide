<?php

class Event_category extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'um');
        $this->load->library('form_validation');

        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
        }
    }

    public function index()
    {
        $data['product'] = $this->db
            ->order_by('id', 'desc')
            ->get('event_category_tbl')
            ->result();

        $this->load->view('event_category_view', $data);
    }

    public function add_event_category()
    {
        $this->load->view('event_category');
    }

    public function add_event_category_data()
    {
        $category_name = $this->input->post('category_name');

        $prod_data = [
            'category_name' => $category_name,
            'block_status'  => 0
        ];

        $id = $this->um->insert('event_category_tbl', $prod_data);

        if ($id) {
            $this->session->set_flashdata('success', 'Event Category added successfully');
            redirect(base_url('Event_category'));
        } else {
            $this->session->set_flashdata('error', 'Event Category not added');
            redirect(base_url('Event_category/add_event_category'));
        }
    }

    public function edit_event_category($id)
    {
        $article = $this->db
            ->get_where('event_category_tbl', ['id' => $id])
            ->row();

        if (!$article) {
            redirect(base_url('Event_category'));
            return;
        }

        $data['product'] = $article;
        $this->load->view('edit_event_category', $data);
    }

    public function edit_event_category_data()
    {
        $p_id = $this->input->post('id');
        $category_name = $this->input->post('category_name');

        if (empty($category_name)) {
            $this->session->set_flashdata('error', 'Event Category Name is required');
            redirect(base_url('Event_category/edit_event_category/' . $p_id));
            return;
        }

        $prod_data = [
            'category_name' => $category_name
        ];

        $updated = $this->um->update(
            'event_category_tbl',
            ['id' => $p_id],
            $prod_data
        );

        if ($updated) {
            $this->session->set_flashdata('success', 'Event Category updated successfully');
            redirect(base_url('Event_category'));
        } else {
            $this->session->set_flashdata('error', 'Event not updated');
            redirect(base_url('Event_category/edit_event_category/' . $p_id));
        }
    }

    public function delete_event_category()
    {
        $id = $this->uri->segment(3);
        $res = $this->um->delete('event_category_tbl', ['id' => $id]);

        if ($res) {
            $this->session->set_flashdata('success', 'Event Category Deleted Successfully');
            redirect(base_url('Event_category'));
        } else {
            $this->session->set_flashdata('error', 'Event Category Not Deleted');
            redirect(base_url('Event_category'));
        }
    }

    public function block($id)
    {
        $sql = $this->um->get_dataa('event_category_tbl', ['id' => $id]);

        if ($id && !empty($sql)) {
            $status = $sql[0]->block_status;

            if ($status == 0) {
                $this->um->update(
                    'event_category_tbl',
                    ['id' => $id],
                    ['block_status' => 1]
                );
                $this->session->set_flashdata('success', 'Event Category Unpublished Successfully');
            } else {
                $this->um->update(
                    'event_category_tbl',
                    ['id' => $id],
                    ['block_status' => 0]
                );
                $this->session->set_flashdata('success', 'Event Category Published Successfully');
            }

            redirect(base_url('Event_category'));
        } else {
            $this->session->set_flashdata('error', 'Event Category ID not found');
            redirect(base_url('Event_category'));
        }
    }
}
