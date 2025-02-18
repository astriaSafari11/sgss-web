<?php

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->load->model('auth_model');
		$this->load->library('email');
	}
	
	public function index()
	{
		show_404();
	}

	public function login()
	{
			// $this->load->library('form_validation');
	
			// $rules = $this->auth_model->rules();
			// $this->form_validation->set_rules($rules);
			// debugCode('a');
	
			// if($this->form_validation->run() == FALSE){
			// 	return $this->load->view('login_form');
			// }
	
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if(!empty($username) && !empty($password)){
				if($this->auth_model->login($username, $password)){
					redirect('dashboard');
				} else {
					// redirect('dashboard');
					$this->session->set_flashdata('message_login_error', 'Login Failed, Please check your username or password!');
				}	
			}
	
			$this->load->view('login_form');	
	}

	public function register()
	{
		$data['title'] = $this->db->query("
		SELECT *
		FROM COTTON_tbl_user_title
		WHERE User_Title_Id IN(1,8)")->result();		
		$this->load->view('register_form', $data);
	}

	public function submit_registration()
	{
		$user = $this->db->get_where("COTTON_USER_HEADER",array(
			"User_Login"	=> $this->input->post('username'),
		))->row();
		
		$title = $this->db->get_where("COTTON_tbl_user_title",array(
			"User_Title_Id"	=> $this->input->post('user_title'),
		))->row();		

		if(empty($user)){
			$new_user = $this->db->insert(
			"COTTON_USER_HEADER", 
			array(
				"User_Login" 			=> $this->input->post('username'),
				"User_Password" 		=> $this->input->post('password'),
				"User_Name"				=> $this->input->post('fullname'),
				"User_Division"			=> "UFS",
				"User_Title"			=> $title->User_Title_Desc,
				"User_Position"	 		=> $title->User_Title_Id,
				"User_Status"			=> 0,
				"User_Email" 			=> $this->input->post('email'),
				"Created_Date" 			=> date("Y-m-d H:i:s"),
			));	

			$max = $this->db->query("SELECT TOP 1 * FROM COTTON_V2_Request_Header ORDER BY Request_Seq DESC")->row();
			$number = empty($max->Form_Number)?1:$max->Form_Number;

            $newId = $number + 1;

			$updated = $this->db->insert(
						"COTTON_V2_Request_Header", 
						array(
							"User_Login" 		=> $this->input->post('username'),
							"Form_Number" 		=> $newId,
							"Form_Number_Rev" 	=> 0,
							"Form_Status" 		=> 0,
							"Form_Description"	=> "New Account Request",
							"Form_Message" 		=> "New Account Request",
							"Form_Date"			=> date("Y-m-d H:i:s"),
						));
			$reqId = $this->db->query("SELECT TOP 1 * FROM COTTON_V2_Request_Header ORDER BY Request_Seq DESC")->row();	

			$inserted_brand = $this->db->insert(
							"COTTON_V2_Request_Detail", 
							array(
								"Request_Seq" 				=> $reqId->Form_Number,
								"User_Login" 				=> $this->input->post('username'),
								"Request_User_Id" 			=> $this->input->post('username'),
								"Request_User_fullname" 	=> $this->input->post('fullname'),
								"Request_User_email" 		=> $this->input->post('email'),
								"Request_User_position"		=> $title->User_Title_Id,
								"Request_User_title" 		=> $title->User_Title_Desc,
							));				
			$getApproval = $this->db->query("
				SELECT * FROM COTTON_V2_APPROVAL_LEVEL WHERE Approve_Type= 'account'
			")->result();
				
				foreach ((array)$getApproval as $datas => $item) {
					$getUser = $this->db->query("select * from COTTON_USER_HEADER WHERE User_Status = 1 AND User_Position = '".$item->Approve_Position."'")->row();				
						if($item->Approve_Level == 1){
							if($this->input->post('user_title') == 1){
								$User_LM = $this->db->query("SELECT * FROM COTTON_V2_USER_LM WHERE User_Login = '".$this->input->post('username')."'")->row();
								if(!empty($User_LM)){
									$LM = $this->db->query("SELECT * FROM COTTON_USER_HEADER WHERE User_Login = '".$User_LM->User_Line_Manager."'")->row();
									if(!empty($LM)){
										$track = $this->db->insert(
													"COTTON_V2_Request_Approval_Track", 
													array(
														"Request_Seq" 				=> $reqId->Form_Number,
														"Approve_Level"				=> $item->Approve_Level,
														"Approve_By"	 			=> $LM->User_Login,
														"Approve_Name"	 			=> $LM->User_Name,
														"Approve_Title"				=> "Line Manager",
														"Approve_Date" 				=> '',
														"Approve_Status" 			=> 'waiting',
														"Approve_Order"				=> $item->Approve_Level,
													));
									}								
								}
							}
						}else{
							$track = $this->db->insert(
										"COTTON_V2_Request_Approval_Track", 
										array(
											"Request_Seq" 				=> $reqId->Form_Number,
											"Approve_Level"				=> $item->Approve_Level,
											"Approve_By"	 			=> $getUser->User_Login,
											"Approve_Name"	 			=> $getUser->User_Name,
											"Approve_Title"				=> $getUser->User_Title,
											"Approve_Date" 				=> '',
											"Approve_Status" 			=> 'waiting',
											"Approve_Order"				=> $item->Approve_Level,
										));							
						}
				}
				if($this->input->post('user_title') == 1){
						$track = $this->db->insert(
							"COTTON_V2_Request_Track", 
							array(
								"Request_Seq" 			=> $reqId->Form_Number,
								"Approve_Level" 		=> 0,
								"Approve_By"			=> $this->input->post('username'),
								"Approve_Name"			=> $this->input->post('fullname'),
								"Approve_Title"			=> $title->User_Title_Desc,
								"Approve_Date"	 		=> date("Y-m-d H:i:s"),
								"Approve_Status"		=> 'New Account Request Submitted',
								"Approve_Order" 		=> 1,
							));
				}else{
					$updated = $this->db->update(
						"COTTON_V2_Request_Header", 
						array(
							"Form_Status" 		=> 1,
							"Update_Date"		=> date("Y-m-d H:i:s"),
						), 
						['Form_Number' => $reqId->Form_Number]);		

					$track = $this->db->insert(
						"COTTON_V2_Request_Track", 
						array(
							"Request_Seq" 			=> $reqId->Form_Number,
							"Approve_Level" 		=> 1,
							"Approve_By"			=> $this->input->post('username'),
							"Approve_Name"			=> $this->input->post('fullname'),
							"Approve_Title"			=> $title->User_Title_Desc,
							"Approve_Date"	 		=> date("Y-m-d H:i:s"),
							"Approve_Status"		=> 'New Account Request Submitted',
							"Approve_Order" 		=> 1,
						));
				}

			send_email(
				$this->input->post('email'),
				$this->input->post('fullname'),
				$title->User_Title_Desc,
				"Registered Account",
				"Your have registered new account on COTTON UFS Application, 
				please wait for administrator to approve and activate your account.",
				'email/email_request.php'
			);

			if($new_user){
				$this->session->set_flashdata('message', 'request_success');
			}else{
				$this->session->set_flashdata('message', 'request_failed');
			}
		}else{
			$this->session->set_flashdata('message', 'request_already_registered');
		}

		redirect('auth/register');
	}


	public function logout()
	{
		$this->load->model('auth_model');
		$this->auth_model->logout();
		redirect(site_url());
	}
}
