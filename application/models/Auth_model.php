<?php

class Auth_model extends CI_Model
{
	private $_table = "m_user";
	const SESSION_KEY = 'nip';

	public function rules()
	{
		return [
			[
				'field' => 'username',
				'label' => 'Username or Email',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|max_length[255]'
			]
		];
	}

	public function login($username, $password)
	{
		$user = $this->db->query("
				SELECT TOP (1) * FROM m_user 
				WHERE 
				username = '".$username."'
				AND password = '".$password."' AND status = '0'
				")->row();

		if(!empty($user)){			
			/*set session*/
			$this->session->set_userdata(self::SESSION_KEY, $user->id);
			$this->session->set_userdata('user_nip',$user->nip);
			$this->session->set_userdata('user_name',$user->full_name);
			$this->session->set_userdata('user_email',$user->email);
			$this->session->set_userdata('user_role_id',$user->role_id);
			$this->session->set_userdata('user_role',$user->role);
			$this->session->set_userdata('user_factory',$user->factory);
		
			return $this->session->has_userdata(self::SESSION_KEY);
		}else{
			return FALSE;
		}
	}

	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$user_id = $this->session->userdata(self::SESSION_KEY);
		$query = $this->db->get_where($this->_table, ['id' => $user_id]);
		return $query->row();
	}

	public function logout()
	{
		$this->session->unset_userdata(self::SESSION_KEY);
		return !$this->session->has_userdata(self::SESSION_KEY);
	}

	private function _update_last_login($id)
	{
		$data = [
			'last_login' => date("Y-m-d H:i:s"),
		];

		return $this->db->update($this->_table, $data, ['user_id' => $id]);
	}
}
