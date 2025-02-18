<?php

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('proposal_model');
		// if(!$this->auth_model->current_user()){
		// 	redirect('auth/login');
		// }
	}

	public function index()
	{

		// $data['user'] = $this->auth_model->current_user();
		// $data['proposal'] = $this->proposal_model->dashboard_list();
		// $data['proposal_approval'] = $this->proposal_model->list();
		// $data['proposal_count'] = $this->proposal_model->count_list();
		// $data['count'] = $this->proposal_model->count_dashboard();
		// $data['draft'] = $this->proposal_model->count_draft_dashboard();
		// $data['proceed'] = $this->proposal_model->count_proceed_dashboard();
		// $data['rejected'] = $this->proposal_model->count_rejected_dashboard();
		// $data['published'] = $this->proposal_model->count_published_dashboard();
		$this->session->set_flashdata('page_title', 'DASHBOARD');
		$this->load->view('dashboard.php');
	}
}
