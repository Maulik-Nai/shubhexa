<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Slider_list extends CI_Controller {

	function __construct() {
		parent::__construct();

		if (!is_logged_admin()) {
			header('Location: ' . file_path() . 'login');

			exit;
		}

		$this->load->library('upload');

		$this->load->library('image_lib');

		$this->load->model('admin/slider_model', 'ObjM', true);
	}

	public function view() {

		$data['html'] = $this->listing();

		$page_info['menu_id'] = 'menu-slider-list';

		$page_info['page_title'] = 'Slider List';

		$this->load->view('common/topheader');

		$this->load->view('common/header_admin', $page_info);

		$this->load->view('admin/' . $this->uri->rsegment(1) . '_view', $data);

		$this->load->view('common/footer_admin');
	}

	function listing() {

		$result = $this->ObjM->getAllCategory();

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

			if ($result[$i]['img_name'] != "") {
				$td_image = "<img src='" . base_url() . "upload/slider/" . $result[$i]['img_name'] . "' height='50' />";
			} else {
				$td_image = "-";
			}

			$row = $i + 1;
			$html .= '<tr>
						<td width="2%"><input type="checkbox" class="wall_chk" name="checkbox[]" value=' . $result[$i]["id"] . '></td>
						<td width="2%">' . $row . '</td>
						<td width="15%">' . $result[$i]['slider_title'] . '</td>
						<td width="15%">' . $td_image . '</td>
						<td width="5%">' . date('d-m-Y', strtotime($result[$i]['create_date'])) . '</td>
						<td width="5%"><div class="btn-group">
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

		$page_info['menu_id'] = 'menu-slider-list';

		$page_info['page_title'] = 'Slider List';

		$this->load->view('common/topheader');

		$this->load->view('common/header_admin', $page_info);

		$this->load->view('admin/' . $this->uri->rsegment(1) . '_add', $data);

		$this->load->view('common/footer_admin');
	}

	function insert() {

		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$this->form_validation->set_rules('slider_title', 'title', 'required|trim');

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

		$data = array();

		$data['slider_title'] = filter_data($_POST['slider_title']);

		if (isset($_FILES['upload_file']) && !empty($_FILES['upload_file']['name'])) {
			$this->handle_upload();
			$data['img_name'] = $_POST['file_name'];
		}

		if ($_POST['mode'] == 'add') {

			$data['status'] = 'Active';

			$data['create_date'] = date('Y-m-d h:i:s');

			$data['update_date'] = date('Y-m-d h:i:s');

			$this->comman_fun->additem($data, 'slider_master');

			$this->session->set_flashdata("success", "Record Insert Successfully.....");
		}
		if ($_POST['mode'] == 'edit') {

			$data['update_date'] = date('Y-m-d h:i:s');

			$this->comman_fun->update($data, 'slider_master', array('id' => $_POST['eid']));

			if (isset($_FILES['upload_file']) && !empty($_FILES['upload_file']['name'])) {
				$url = './upload/slider/' . $_POST['old_file'];
				$url2 = './upload/slider/thum/' . $_POST['old_file'];
				unlink($url);
				unlink($url2);
			}

			$this->session->set_flashdata("success", "Record Update Successfully.....");
		}
	}

	function status_update($st, $eid) {

		$record = $this->comman_fun->get_table_data('slider_master', array('id' => $eid));

		$data['status'] = $st;

		$this->comman_fun->update($data, 'slider_master', array('id' => $eid));

		$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Status ' . $st . ' Successfully.....'));

		redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/view");
	}

	function delete_record($eid) {

		$record = $this->comman_fun->get_table_data('slider_master', array('id' => $eid));

		$data['status'] = 'Delete';

		$this->comman_fun->update($data, 'slider_master', array('id' => $eid));

		if (count($record) > 0) {
			$url = './upload/slider/' . $record[0]['img_name'];
			$url2 = './upload/slider/thum/' . $record[0]['img_name'];
			unlink($url);
			unlink($url2);
		}

		$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Record Delete Successfully.....'));

		redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/view");
	}
	public function deleteMultiple() {
		$id = $_REQUEST['unique_id'];
		$id = explode(',', $id);
		$data = array();
		$data['status'] = 'Delete';
		for ($i = 0; $i < count($id); $i++) {
			if ($id[$i] != '') {
				$this->comman_fun->update($data, 'slider_master', array('id' => $id[$i]));
				$record = $this->comman_fun->get_table_data('slider_master', array('id' => $id[$i]));
				if (count($record) > 0) {
					$url = './upload/slider/' . $record[0]['img_name'];
					$url2 = './upload/slider/thum/' . $record[0]['img_name'];
					unlink($url);
					unlink($url2);
				}
			}
		}

	}
	function handle_upload() {
		if (isset($_FILES['upload_file']) && !empty($_FILES['upload_file']['name'])) {
			$config = array();
			$config['upload_path'] = './upload/slider/';
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['max_size'] = '0';
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$_FILES['userfile']['name'] = $_FILES['upload_file']['name'];
			$_FILES['userfile']['type'] = $_FILES['upload_file']['type'];
			$_FILES['userfile']['tmp_name'] = $_FILES['upload_file']['tmp_name'];
			$_FILES['userfile']['error'] = $_FILES['upload_file']['error'];
			$_FILES['userfile']['size'] = $_FILES['upload_file']['size'];
			$rand = md5(uniqid(rand(), true));
			$fileName = 'slider_' . $rand . '' . $_FILES['upload_file']['name'];
			$fileName = str_replace(" ", "", $fileName);
			$config['file_name'] = $fileName;
			$this->upload->initialize($config);

			if ($this->upload->do_upload()) {
				$upload_data = $this->upload->data();
				$_POST['file_name'] = $upload_data['file_name'];

				$this->_create_slider($upload_data['file_name'], 1462, 837);
				$this->_create_thumbnail($upload_data['file_name'], 250, 250);
				return true;
			} else {

				echo $this->upload->display_errors();
			}
		}

	}

	protected function _create_thumbnail($fileName, $width, $height) {

		$config['image_library'] = 'gd2';
		$config['source_image'] = './upload/slider/' . $fileName;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;
		$config['new_image'] = './upload/slider/thum/' . $fileName;
		$config['thumb_marker'] = '';

		$this->image_lib->initialize($config);
		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}
	}

	protected function _create_slider($fileName, $width, $height) {

		$config['image_library'] = 'gd2';
		$config['source_image'] = './upload/slider/' . $fileName;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width . 'px';
		$config['height'] = $height . 'px';
		$config['new_image'] = './upload/slider/' . $fileName;
		$config['thumb_marker'] = '';

		$this->image_lib->initialize($config);

		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}
	}
}
