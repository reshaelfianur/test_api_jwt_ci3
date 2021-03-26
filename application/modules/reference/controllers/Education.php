<?php defined('BASEPATH') or exit('No direct script access allowed');

class Education extends My_Controller
{
	public function __construct()
	{
		parent::__construct();

		if ($this->validate_token()) {
			// $this->guard_module('module_reference');

			$this->data = array_merge($this->data, [
				'title'	 => 'Education',
				'route'	 => 'reference/education/',
				// 'rights' => $this->guard_module_function('reference_education')
			]);
		}

		$this->load->model('m_education');
	}

	public function index_get()
	{
		if (array_key_exists('Authorization', $this->headers) && !empty($this->headers['Authorization']) && $this->data['validateToken']) {
			if (AUTHORIZATION::validateTimestamp($this->headers['Authorization'])) {
				// if (!$this->rights_validation(2)['success']) {
				// 	return $this->response($this->rights_validation(2), 403);
				// }
				$this->data = array_merge($this->data, [
					'fetch' => $this->m_education->get()->result()
				]);

				return $this->response($this->data, 200);
			} else {
				return $this->response('Request Timeout', 408);
			}
		} else {
			return $this->response('Unauthorized', 401);
		}
	}

	public function is_duplicate_post()
	{
		if (array_key_exists('Authorization', $this->headers) && !empty($this->headers['Authorization']) && $this->data['validateToken']) {
			if (AUTHORIZATION::validateTimestamp($this->headers['Authorization'])) {
				if ($this->input->post('education_id') == 'undefined') {
					$duplicate = $this->m_education->get([
						"(education_code  = '" . trim($this->input->post('education_code')) . "' 
				OR education_desc = '" . trim($this->input->post('education_desc')) . "')" => NULL,
					]);
				} else {
					$duplicate = $this->m_education->get([
						"(education_code  = '" . trim($this->input->post('education_code')) . "' 
				OR education_desc = '" . trim($this->input->post('education_desc')) . "')" => NULL,
						'education_id <>' => $this->input->post('education_id')
					]);
				}

				$response = [];

				if ($duplicate->num_rows() > 0) {
					$response['success'] = true;
					if ($duplicate->row()->education_code == strtoupper(trim($this->input->post('education_code')))) {
						$response['message'] = $this->data['title'] . ' Code has already exists.';
					} else {
						$response['message'] = $this->data['title'] . ' Description has already exists.';
					}
				} else {
					$response['success'] = false;
				}

				return $this->response($response, 200);
			} else {
				return $this->response('Request Timeout', 408);
			}
		} else {
			return $this->response('Unauthorized', 401);
		}
	}

	public function create_get()
	{
		return $this->load->view($this->data['route'] . 'create', $this->data);
	}

	public function store_post()
	{
		if (array_key_exists('Authorization', $this->headers) && !empty($this->headers['Authorization']) && $this->data['validateToken']) {
			if (AUTHORIZATION::validateTimestamp($this->headers['Authorization'])) {
				// if (!$this->rights_validation(1)['success']) {
				// 	return $this->response($this->rights_validation(1), 403);
				// }

				$storeFile = $this->upload_file([
					'field_name'    => 'ec_file',
					'upload_path'   => 'files/education',
					'file_name' 	=>  hash_hmac('sha256', uniqid(), $this->secretKey),
					'allowed_types' => 'pdf',
					'max_size' 	 	=> '10120'
				]);

				if (empty($storeFile['error'])) {
					$create = $this->m_education->insert([
						'education_code' => strtoupper(trim($this->input->post('education_code'))),
						'education_desc' => ucwords(trim($this->input->post('education_desc'))),
						'education_file' => $storeFile,
						'created_by' 	 => $this->_user->user_id
					]);
				}

				if ($create) {
					$response = [
						'message' => 'Succesfully created the ' . $this->data['title'],
						'success' => true
					];
				} else {
					$response = [
						'message' => 'Error in the database while created the ' . $this->data['title'],
						'success' => false
					];
				}

				return $this->response($response, 200);
			} else {
				return $this->response('Request Timeout', 408);
			}
		} else {
			return $this->response('Unauthorized', 401);
		}
	}

	public function update_get($eduId)
	{
		if (array_key_exists('Authorization', $this->headers) && !empty($this->headers['Authorization']) && $this->data['validateToken']) {
			if (AUTHORIZATION::validateTimestamp($this->headers['Authorization'])) {
				$this->data['row'] = $this->m_education->find($eduId);

				return $this->response($this->data, 200);
			} else {
				return $this->response('Request Timeout', 408);
			}
		} else {
			return $this->response('Unauthorized', 401);
		}
	}

	public function save_put()
	{
		if (array_key_exists('Authorization', $this->headers) && !empty($this->headers['Authorization']) && $this->data['validateToken']) {
			if (AUTHORIZATION::validateTimestamp($this->headers['Authorization'])) {
				// if (!$this->rights_validation(3)['success']) {
				// 	return $this->response($this->rights_validation(3), 403);
				// }

				$row  	  = $this->m_education->find($this->input->post('education_id'));
				$dataFile = [];

				if (!empty($_FILES['ec_file']['name'])) {
					$storeFile = $this->upload_file([
						'field_name'    => 'ec_file',
						'upload_path'   => 'files/education',
						'file_name' 	=>  hash_hmac('sha256', uniqid(), $this->secretKey),
						'allowed_types' => 'pdf',
						'max_size' 	 	=> '10120'
					]);

					if (empty($storeFile['error'])) {
						$rowFile  = 'files/education/' . $row->ec_file;
						$dataFile = ['ec_file' => $storeFile];

						if (file_exists($rowFile)) {
							unlink($rowFile);
						}
					}
				}

				$update = $this->m_employee_certificate->update(array_merge($dataFile, [
					'education_code' => strtoupper(trim($this->input->get('education_code'))),
					'education_desc' => ucwords(trim($this->input->get('education_desc'))),
					'updated_by' 	 => $this->_user->user_id
				]), ['education_id' => $this->input->get('education_id')]);

				if ($update) {
					$response = [
						'message' => 'Succesfully updated the ' . $this->data['title'],
						'success' => true
					];
				} else {
					$response = [
						'message' => 'Error in the database while updated the ' . $this->data['title'],
						'success' => false
					];
				}

				return $this->response($response, 200);
			} else {
				return $this->response('Request Timeout', 408);
			}
		} else {
			return $this->response('Unauthorized', 401);
		}
	}

	public function delete_get($eduId)
	{
		if (array_key_exists('Authorization', $this->headers) && !empty($this->headers['Authorization']) && $this->data['validateToken']) {
			if (AUTHORIZATION::validateTimestamp($this->headers['Authorization'])) {
				// if (!$this->rights_validation(4)['success']) {
				// 	return $this->response($this->rights_validation(4), 403);
				// }

				$delete = $this->m_education->delete(['deleted_by' => $this->_user->user_id], ['education_id' => $eduId]);

				if ($delete) {
					$response = [
						'message' => 'Succesfully deleted the ' . $this->data['title'],
						'success' => true
					];
				} else {
					$response = [
						'message' => 'Error in the database while deleted the ' . $this->data['title'],
						'success' => false
					];
				}

				return $this->response($response, 200);
			} else {
				return $this->response('Request Timeout', 408);
			}
		} else {
			return $this->response('Unauthorized', 401);
		}
	}
}
