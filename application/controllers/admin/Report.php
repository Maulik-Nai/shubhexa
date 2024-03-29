<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Report extends CI_Controller {

	function __construct() {
		parent::__construct();

		if (!is_logged_admin()) {
			header('Location: ' . file_path() . 'login');

			exit;
		}

		$this->load->model('admin/report_model', 'ObjM', true);
	}

	public function view() {

		$data['html'] = $this->listing();

		$page_info['menu_id'] = 'menu-report';

		$page_info['page_title'] = 'Report';

		$this->load->view('common/topheader');

		$this->load->view('common/header_admin', $page_info);

		$this->load->view('admin/' . $this->uri->rsegment(1) . '_view', $data);

		$this->load->view('common/footer_admin');
	}

	function listing() {

		$result = $this->ObjM->getBookingUserList();

		$html = '';

		for ($i = 0; $i < count($result); $i++) {

			$getCountOrder = $this->comman_fun->count_record('cart_details',array('cart_id' => $result[$i]['cart_id'],'status'=>'Active'));

			$getCelebId    = $this->comman_fun->get_table_data('cart_details',array('cart_id' => $result[$i]['cart_id'],'status'=>'Active'));

			$arr = [];
			for($k=0;$k<count($getCelebId);$k++) {
				
				$CelebsName = $this->comman_fun->get_table_data('celebrity_master',array('id' => $getCelebId[$k]['celebrity_id']));
				$arr[] = $CelebsName[0]['fname'].' '.$CelebsName[0]['lname'];

                $getCelebsIds = implode(",", $arr);
			}
			

			$row = $i + 1;
			$html .= '<tr>
						<td>' . $row . '</td>
						<td>' . $result[$i]['payment_id'] . '</td>
						<td>' . $result[$i]['fname'] . ' ' . $result[$i]['lname'] . '</td>
						<td>' . $result[$i]['mobileno'].'</td>
						<td>' . $result[$i]['emailid']. '</td>
						<td>' . $getCelebsIds. '</td>
						<td>' . $result[$i]['payment_date']. '</td>
						<td>' . $getCountOrder. '</td>
						<td>' . date('d-m-Y',strtotime($result[$i]['order_date'])) . '</td>
						<td>' . '₹. '.$result[$i]['total_amount'] . '</td>';
			$html .= '</td> 
					</tr>';
		}

		return $html;
	}

	public function export()
    {
        //$this->page_permission->_export();
        $result = $this->ObjM->getBookingUserList();

        mysqli_query("SET NAMES utf8");
        
        $output .= '"Sr No",';
		$output .= '"Payment Id",';
        $output .= '"Name",';
        $output .= '"Mobile No",';
        $output .= '"Email ID",';
        $output .= '"Order Number",';
		$output .= '"Total Order",';
		$output .= '"Payment Date",';
		$output .= '"Total Amount",';
        $output .="\n";
		$total = 0;
		for ($i=0; $i<count($result); $i++) {
            
            $getCountOrder = $this->comman_fun->count_record('cart_details',array('cart_id' => $result[$i]['cart_id'],'status'=>'Active'));

            $orderDate =  date('d-F-Y', strtotime($result[$i]['payment_date']));

			$userName = $result[$i]['fname'].' '.$result[$i]['lname'];

            $rowcount=$i+1;
            $output .='"'.$rowcount.'",';
			$output .='"'.$result[$i]['payment_id'].'",';
            $output .='"'.ucwords(strtolower($userName)).'",';
            $output .='"'.$result[$i]['mobileno'].'",';
            $output .='"'.$result[$i]['emailid'].'",';
			$output .='"'.$result[$i]['order_no'].'",';
			$output .='"'.$getCountOrder.'",';
            $output .='"'.$orderDate.'",';
			$output .='"'.$result[$i]['total_amount'].'",';
            $output .="\n";
			$total += $result[$i]['total_amount'];
        }
        
		$output .= '"Total Amount",';
		$output .= '"",';
		$output .= '"",';
		$output .= '"",';
		$output .= '"",';
		$output .= '"",';
		$output .= '"",';
		$output .= '"",';
		$output .= '"'.$total.'",';
		

        $dt = date("d-F-Y");
        $filename = "user_report_".$dt;
        
        header("content-type:application/csv;charset=UTF-8");
        header('Content-Disposition: attachment; filename='.$filename.'.csv');
        echo "\xEF\xBB\xBF";
        header('Cache-Control: max-age=0'); //no cache
        header('Content-Transfer-Encoding: binary');
        header('Pragma: public');
        echo $output;
    }
}
