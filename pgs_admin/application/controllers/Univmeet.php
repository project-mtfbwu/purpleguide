<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Univmeet extends CI_Controller
{
    public function __construct()
    {
        @ini_set('memory_limit', '768M');
        parent::__construct();
        $this->load->model('Univmeet_model');
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'form'));
        if (!$this->session->userdata('user_id')) {
            redirect('Users/logout');
        }
    }

    public function index()
    {
        $data['title'] = '#univMeet Dates';
        $data['current'] = $this->Univmeet_model->get_current();
        $data['courses'] = $this->Univmeet_model->get_courses();

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('course_id', 'Course', 'required|trim|integer');
            $this->form_validation->set_rules('slot1_date', 'First date (number)', 'required|trim');
            $this->form_validation->set_rules('slot1_month', 'First date label', 'required|trim');
            $this->form_validation->set_rules('slot2_date', 'Second date (number)', 'required|trim');
            $this->form_validation->set_rules('slot2_month', 'Second date label', 'required|trim');

            if ($this->form_validation->run()) {
                $save = array(
                    'course_id'   => (int) $this->input->post('course_id', true),
                    'slot1_date'  => $this->input->post('slot1_date', true),
                    'slot1_month' => $this->input->post('slot1_month', true),
                    'slot2_date'  => $this->input->post('slot2_date', true),
                    'slot2_month' => $this->input->post('slot2_month', true),
                );

                $this->Univmeet_model->save($save);
                $this->session->set_flashdata('success', '#univMeet details updated successfully.');
                redirect('Univmeet');
                return;
            }
        }

        $this->load->view('header');
        $this->load->view('univmeet_form', $data);
        $this->load->view('footer');
    }
}
