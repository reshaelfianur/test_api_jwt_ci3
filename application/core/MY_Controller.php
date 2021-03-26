<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->headers 	= $this->input->request_headers();
		$this->data = [];
	}

	public function validate_token()
	{
		if (array_key_exists('Authorization', $this->headers) && !empty($this->headers['Authorization'])) {
			$this->_user = AUTHORIZATION::validateToken($this->headers['Authorization']);
			if ($this->_user) {
				$this->data = [
					'validateToken' => true,
					'modules' 		=> $this->get_module(),
				];
				return true;
			}
		}
		$this->data = [
			'validateToken' => false,
		];
		return false;
	}

	public function get_module()
	{
		$where = [
			'module_status'	=> 1,
		];
		return $this->m_module->get($where, ['orderBy' => 'module_order'])->result();
	}

	public function set_response_json($response)
	{
		return $this->set_response($response, REST_Controller::HTTP_OK);
	}

	public function current_route_get()
	{
		$currentRout = [
			'csrfName' => $this->security->get_csrf_token_name(),
			'csrfHash' => $this->security->get_csrf_hash(),
		];

		return $this->set_response_json($currentRout);
	}

	public function change_theme_post()
	{
		$data	= [
			'user_theme' => trim($this->input->post('user_theme')),
		];
		$data 	= $this->security->xss_clean($data);

		$update = $this->m_user->update($data, ['user_id' => $this->_user->user_id], false);

		if ($update) {
			$response = [
				'message' => 'Succesfully change the theme',
				'success' => true
			];
		} else {
			$response = [
				'message' => 'Error in the database while change the theme',
				'success' => false
			];
		}

		return $this->set_response_json($response);
	}

	public function get_settings($type = 1)
	{
		$this->security   = [];
		$securitySettings = $this->m_ss->get(['ss_type' => $type]);

		foreach ($securitySettings->result() as $row) {
			$this->security[$row->ss_name] = $row->ss_value;
		}

		return $this->security;
	}

	public function validate_session()
	{
		$state = $this->session->userdata('logged_in');

		if ($this->router->class == 'auth' && $this->router->method == 'index') {
			if ($state) {
				redirect('dashboard');
			}
		} else {
			if (!$state) {
				if ($this->input->is_ajax_request()) {
					$response = [
						'message' => 'Session expired. Please re-login',
						'success' => false
					];
					$this->session->sess_destroy();

					return $this->set_response_json($response);
				} else {
					// $this->session->sess_destroy();
					$this->session->set_userdata(['logged_in' => false]);

					$data = [
						'type' 	  => 'info',
						'message' => 'Your session has been expired. Please re-login.'
					];
					$this->session->set_flashdata('data', $data);

					redirect('auth');
				}
			} else {
				#check expiry
				$last = $this->session->userdata('user_last_request');
				$time = DateTime::createFromFormat('Y-m-d H:i:s', $last);

				#end check expiry
				$sessLifeTime = $this->m_ss->get([
					'ss_name' => 'sess_lifetime',
					'ss_type' => $this->_user->ss_type
				])->row();
				$idle 		  = (int) $sessLifeTime->ss_value * 60;

				$now 		= new DateTime();
				$lastSecond = $time->format('U');
				$nowSecond 	= $now->format('U');

				$diff       = $nowSecond - $lastSecond;

				if ($diff > $idle and $idle != 0) {
					if ($this->input->is_ajax_request()) {
						$response = [
							'message' => 'Session expired. Please re-login',
							'success' => false
						];
						$this->session->sess_destroy();

						return $this->set_response_json($response);
					} else {
						// $this->session->sess_destroy();
						$this->session->set_userdata(['logged_in' => false]);

						$data = [
							'type' 	  => 'info',
							'message' => 'Your session has been expired. Please re-login.'
						];
						$this->session->set_flashdata('data', $data);

						redirect('auth');
					}
				} else {
					$this->session->unset_userdata('user_last_request');
					$this->session->set_userdata('user_last_request', dateTimeNow());
				}
			}
		}
	}

	public function guard_module($module)
	{
		$category = $this->m_group->get(['group_id' => $this->_user->group_id])->row()->group_category;

		if ($category == 'super_user') return true;

		$get = $this->m_am->get_module([
			'group_id' => $this->_user->group_id,
			'module_code' => $module
		]);

		if ($get->num_rows() <= 0) return show_error('Directory access is forbidden.', 403, '403 Forbidden');

		$right = $get->row()->am_rights;
		return $right == 1 ? true : show_error('Directory access is forbidden.', 403, '403 Forbidden');
	}

	public function guard_module_function($funcCode)
	{
		$category = $this->m_group->get(['group_id' => $this->_user->group_id])->row()->group_category;

		if ($category == 'super_user') return json_decode('["1", "2", "3", "4"]');

		return json_decode($this->m_amf->get_mf([
			'group_id' => $this->_user->group_id,
			'mf_code'  => $funcCode
		])->row()->amf_rights);
	}

	public function table_array($table, $arr)
	{
		$response = [];
		$fetch 	  = $this->db->get($table)->result();

		foreach ($fetch as $row) {
			foreach ($arr as $key => $val) {
				$response[$row->$key] = $row->$val;
			}
		}

		return $response;
	}

	public function rights_validation($rights)
	{
		if (!in_array($rights, $this->data['rights'])) {
			if ($this->input->is_ajax_request()) {
				return [
					'message' => 'You are not allowed to access this section!',
					'success' => false
				];
			} else {
				$data = [
					'type' 	  => 'error',
					'message' => 'You are not allowed to access this section!'
				];
				$this->session->set_flashdata('data', $data);

				return redirect('dashboard');
			}
		}

		return ['success' => true];
	}

	public function upload_file($params)
	{
		makeDir($params['upload_path']);

		foreach ($params as $key => $value) {
			if ($key == 'upload_path') {
				$config['upload_path'] 	 = $value;
			} else if ($key == 'file_name') {
				$config['file_name'] 	 = $value;
			} elseif ($key == 'allowed_types') {
				$config['allowed_types'] = $value; // ex : 'bmp|jpg|png|doc|docx|pdf|xls|xlsx|ppt|pptx|txt|csv|jpeg|gif'
			} else if ($key == 'max_size') {
				$config['max_size'] 	 = $value;
			} else if ($key == 'max_width') {
				$config['max_width'] 	 = $value;
			} else if ($key == 'max_height') {
				$config['max_height'] 	 = $value;
			} else if ($key == 'encrypt_name') {
				$config['encrypt_name']  = $value; // default false
			} else if ($key == 'remove_spaces') {
				$config['remove_spaces'] = $value; // default false
			} else if ($key == 'overwrite') {
				$config['overwrite'] 	 = $value; // default false
			}
		}

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload($params['field_name'])) {
			return ['error' => $this->upload->display_errors()];
		} else {
			return $this->upload->data('file_name'); // file name with extension
		}
	}
}
