<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		//echo "222";exit;

		if (!is_login('celebs')) {

			header('Location: ' . file_path() . 'login');
			exit;

		}

		$this->load->model('Member_module', 'ObjM', TRUE);

	}

	public function index() {

		$this->view();

	}

	public function view() {

		$page_info['menu_id'] = 'menu-dashboard';

		$page_info['page_title'] = 'Dashboard';

		$this->load->view('common/topheader');

		$this->load->view('common/header_celebrity', $page_info);

		$this->load->view('celebrity/dashboard_view');

		$this->load->view('common/footer_admin');

	}

}
