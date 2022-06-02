<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Newsletter_list extends CI_Controller {

	function __construct() {
		parent::__construct();

		if (!is_logged_admin()) {
			header('Location: ' . file_path() . 'login');

			exit;
		}

		$this->load->model('admin/newsletter_list_model', 'ObjM', true);
	}

	public function view() {

		$data['html'] = $this->listing();

		$page_info['menu_id'] = 'menu-nl-list';

		$page_info['page_title'] = 'News Letter Subscriber List';

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

			$row = $i + 1;
			$html .= '<tr>
						<td>' . $row . '</td>
						<td>' . $result[$i]['emailId'] . '</td>
						<td>' . date('d-m-Y', strtotime($result[$i]['create_date'])) . '</td>
						<td><div class="btn-group">
						<button class="btn dropdown-toggle ' . $cls . ' btn_custom" data-toggle="dropdown">' . $current_status . ' <i class="fa fa-angle-down"></i> </button>
						<ul class="dropdown-menu pull-right">';
			$html .= '<li><a class="delete_record" href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/delete_record/' . $result[$i]['id'] . '">Delete</a></li>';
			$html .= '</ul>
						</div>
						</td>
					</tr>';
		}

		return $html;
	}

	function status_update($st, $eid) {

		$record = $this->comman_fun->get_table_data('newsletter_master', array('id' => $eid));

		$data['status'] = $st;

		$this->comman_fun->update($data, 'newsletter_master', array('id' => $eid));

		$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Status ' . $st . ' Successfully.....'));

		redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/view");
	}

	function delete_record($eid) {

		$record = $this->comman_fun->get_table_data('newsletter_master', array('id' => $eid));

		$data['status'] = 'Delete';

		$this->comman_fun->update($data, 'newsletter_master', array('id' => $eid));

		$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Record Delete Successfully.....'));

		redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/view");
	}

	function exportData() {

		$result = $this->ObjM->getAll();

		//mysqli_query("SET NAMES utf8");

		$output .= '"No",';
		$output .= '"Email ID",';
		$output .= '"Entry Date",';
		$output .= "\n";

		for ($i = 0; $i < count($result); $i++) {
			$rowcount = $i + 1;
			$output .= '"' . $rowcount . '",';
			$output .= '"' . $result[$i]['emailId'] . '",';
			$output .= '"' . date('d-m-Y', strtotime($result[$i]['create_date'])) . '",';
			$output .= "\n";

		}

		$dt = date("d-m-Y");
		$filename = "newsletter_subscriber_list_" . $dt;
		header('Cache-Control: max-age=0'); //no cache
		header('Content-Transfer-Encoding: binary');
		header('Pragma: public');
		header('Content-Encoding: UTF-8');
		header('Content-type: text/csv; charset=UTF-8');
		header('Content-Disposition: attachment; filename=' . $filename . '.csv');
		echo "\xEF\xBB\xBF"; // UTF-8 BOM
		echo $output;
	}

}
