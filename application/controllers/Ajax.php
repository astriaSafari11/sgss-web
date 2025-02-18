<?php

class Ajax extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
	}


	public function index()
	{
		show_404();
	}
}
