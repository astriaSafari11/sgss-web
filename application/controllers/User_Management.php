<?php

class User_Management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->session->set_userdata('session_created', time());
    }

    public function index()
    {
        $this->session->set_flashdata('page_title', 'USER MANAGEMENT');
        $this->load->view('user_management/dashboard');
    }

    public function authorized()
    {
        $this->session->set_flashdata('page_title', 'USER MANAGEMENT');
        $this->load->view('user_management/authorized');
    }
}