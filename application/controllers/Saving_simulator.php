<?php

class Saving_simulator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->session->set_userdata('session_created', time());
    }

    public function index()
    {
        $this->session->set_flashdata('page_title', 'SAVINGS');
        $this->load->view('saving_simulator/summary');
    }

    public function summary()
    {
        $this->session->set_flashdata('page_title', 'SAVING SUMMARY');
        $this->load->view('saving_simulator/summary');
    }

    public function table()
    {
        $this->session->set_flashdata('page_title', 'SAVING TABLE');
        $this->load->view('saving_simulator/table');
    }

    public function detail()
		{
		$this->session->set_flashdata ('page_title', 'SAVING DETAIL');
		load_view ('saving_simulator/detail.php', []);
		}
}



	// {

	// public function index()
	// 	{
	// 	$this->session->set_flashdata ('page_title', 'SAVINGS');
	// 	$this->load->view ('saving-simulator.php');
	// 	}

	// public function detail()
	// 	{
	// 	$this->session->set_flashdata ('page_title', 'SAVINGS');
	// 	load_view ('saving_simulator/detail.php', []);
	// 	}
