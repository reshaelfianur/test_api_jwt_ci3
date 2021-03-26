<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index_get()
	{
		$this->data = array_merge($this->data, [
			'title'			=> 'Dashboard',
			'route'			=> 'dashboard/dashboard/',
			'pageContent'	=> 'dashboard/hr_dashboard/index',
			'css'			=> [
				'assets/plugins/chartist-js/dist/chartist.min',
				'assets/plugins/chartist-js/dist/chartist-init'
			],
			'js'			=> [
				'assets/plugins/chartist-js/dist/chartist.min',
				'assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min'
			]
		]);
		$this->load->view('templates/base', $this->data);
	}
}
