<?php defined('BASEPATH') or exit('No direct script access allowed');

class General extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function show_errors_get($errorType)
	{
		return $this->load->view('errors/page-error-' . $errorType);
	}
}
