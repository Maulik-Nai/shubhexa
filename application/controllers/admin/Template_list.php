<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Template_list extends CI_Controller {

	function __construct() {
		parent::__construct();

		if (!is_logged_admin()) {
			header('Location: ' . file_path() . 'login');

			exit;
		}

		$this->load->model('admin/template_list_model', 'ObjM', true);
	}

	public function view() {

		$data['html'] = $this->listing();

		$page_info['menu_id'] = 'menu-template-list';

		$page_info['page_title'] = 'Template List';

		$this->load->view('common/topheader');

		$this->load->view('common/header_admin', $page_info);

		$this->load->view('admin/' . $this->uri->rsegment(1) . '_view', $data);

		$this->load->view('common/footer_admin');
	}

	function listing() {

		$result = $this->ObjM->getAll();

		$html = '';

		for ($i = 0; $i < count($result); $i++) {
			if ($result[$i]['status'] == 'Active') {
				$current_status = 'Active';
				$update_status = 'Inactive';
				$cls = 'btn-success';
			} else {
				$current_status = 'Inactive';
				$update_status = 'Active';
				$cls = 'btn-danger';
			}

			// <td>'.$result[$i]['amount'].'</td>

			$record = $this->comman_fun->get_table_data('occasion_master', array('id' => $result[$i]['occasion_id']));

			$row = $i + 1;
			$html .= '<tr>
						<td>' . $row . '</td>
						<td>' . $record[0]['occasion_title'] . '</td>
						<td>' . $result[$i]['message_for'] . '</td>
						<td>' . $result[$i]['template_message'] . '</td>
						<td><div class="btn-group">
						<button class="btn dropdown-toggle ' . $cls . ' btn_custom" data-toggle="dropdown">' . $current_status . ' <i class="fa fa-angle-down"></i> </button>
						<ul class="dropdown-menu pull-right">
							<li><a class="status_change" href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/status_update/' . $update_status . '/' . $result[$i]['id'] . '">' . $update_status . '</a></li>
							<li><a href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/addnew/edit/' . $result[$i]['id'] . '">Edit</a></li>';
			$html .= '<li><a class="delete_record" href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/delete_record/' . $result[$i]['id'] . '">Delete</a></li>';
			$html .= '</ul>
						</div>
						</td>
					</tr>';
		}

		return $html;
	}

	function addnew($mode = null, $eid = null) {

		if ($mode == 'edit') {
			$data['form_set'] = array('mode' => 'edit', 'eid' => $eid);

			$data['result'] = $this->ObjM->get_record($eid);
		} else {
			$data['form_set'] = array('mode' => 'add');
		}

		$data['occasionResult'] = $this->ObjM->getOccasionList($eid);

		$page_info['menu_id'] = 'menu-template-list';

		$page_info['page_title'] = 'Template List';

		$this->load->view('common/topheader');

		$this->load->view('common/header_admin', $page_info);

		$this->load->view('admin/' . $this->uri->rsegment(1) . '_add', $data);

		$this->load->view('common/footer_admin');
	}

	function insert() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->form_validation->set_rules('occasion_title', 'occasion title', 'required|trim');
			$this->form_validation->set_rules('message_for', 'message for', 'required|trim');
			$this->form_validation->set_rules('template_message', 'template', 'required|trim');

			if ($this->form_validation->run() === false) {
				$this->addnew($_POST['mode'], $_POST['eid']);
			} else {
				$this->_insert();

				echo '<script>window.location.href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/view"</script>';

				header('Location: ' . file_path('admin') . '' . $this->uri->rsegment(1) . '/view');

				exit;
			}
		}
	}

	protected function _insert() {

		$record = $this->comman_fun->get_table_data('occasion_master', array('id' => $_POST['occasion_title']));

		$data = array();

		$data['occasion_id'] = filter_data($_POST['occasion_title']);

		$data['occasion_value'] = $record[0]['occasion_title'];

		$data['message_for'] = filter_data($_POST['message_for']);

		$data['template_message'] = filter_data($_POST['template_message']);

		if ($_POST['mode'] == 'add') {

			$data['status'] = 'Active';

			$data['create_date'] = date('Y-m-d h:i:s');

			$data['update_date'] = date('Y-m-d h:i:s');

			$this->comman_fun->additem($data, 'template_master');

			$this->session->set_flashdata("success", "Record Insert Successfully.....");
		}
		if ($_POST['mode'] == 'edit') {

			$data['update_date'] = date('Y-m-d h:i:s');

			$this->comman_fun->update($data, 'template_master', array('id' => $_POST['eid']));

			$this->session->set_flashdata("success", "Record Update Successfully.....");
		}
	}

	function status_update($st, $eid) {

		$record = $this->comman_fun->get_table_data('template_master', array('id' => $eid));

		$data['status'] = $st;

		$this->comman_fun->update($data, 'template_master', array('id' => $eid));

		$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Status ' . $st . ' Successfully.....'));

		redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/view");
	}

	function delete_record($eid) {

		$record = $this->comman_fun->get_table_data('template_master', array('id' => $eid));

		$data['status'] = 'Delete';

		$this->comman_fun->update($data, 'template_master', array('id' => $eid));

		$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Record Delete Successfully.....'));

		redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/view");
	}
}
