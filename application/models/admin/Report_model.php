<?php
Class Report_model extends CI_Model {

	function getBookingUserList() {

		$all_type = $this->input->get('all_type');
        $date_filter = $this->input->get('date_filter');
		$this->db->select('membermaster.*');

		$this->db->select('cart_master.cart_id,cart_master.payment_date,cart_master.order_no,cart_master.usercode AS cartMasterUsercode,cart_master.order_date,cart_master.total_amount,cart_master.payment_status,cart_master.status,cart_master.payment_id');

		$this->db->from('membermaster');

		$this->db->join('cart_master', 'cart_master.usercode=membermaster.usercode', 'left');

		$this->db->where('cart_master.payment_status','confirm');
       
        $this->db->where('cart_master.payment_id !=','');

        if($date_filter != '') {
            
            $dateFilters = explode(' - ',$date_filter);
            
            $first_date = date('Y-m-d', strtotime($dateFilters[0]));
            $last_date  = date('Y-m-d', strtotime($dateFilters[1]));

            $this->db->where('cart_master.payment_date >=', $first_date);
            $this->db->where('cart_master.payment_date <=', $last_date);

        } else if($all_type != '') {

            if ($all_type=="today") {
                $this->db->where('cart_master.payment_date = CURDATE()');
            } elseif ($all_type=="this_week") {
                $this_week_start = strtotime('-1 week monday 00:00:00');
                $this_week_end   = strtotime('sunday 23:59:59');
                $first_date = date('Y-m-d', $this_week_start);
                $last_date  = date('Y-m-d', $this_week_end);
                $this->db->where('payment_date >=', $first_date);
                $this->db->where('payment_date <=', $last_date);
            } elseif ($all_type=="last_week") {
                $last_week_start = strtotime('-2 week monday 00:00:00');
                $last_week_end   = strtotime('-1 week sunday 23:59:59');
                $first_date = date('Y-m-d', $last_week_start);
                $last_date  = date('Y-m-d', $last_week_end);

                $this->db->where('cart_master.payment_date >=', $first_date);
                $this->db->where('cart_master.payment_date <=', $last_date);
            } elseif ($all_type=="this_month") {
                $first_date = date('Y-m-01');
                $last_date  = date('Y-m-t');
                
                $this->db->where('cart_master.payment_date >=', $first_date);
                $this->db->where('cart_master.payment_date <=', $last_date);
            } elseif ($all_type=="last_month") {
                $month      = date("m", strtotime("-1 month"));
                $first_date = date('Y-' . $month . '-01');
                $last_date  = date('Y-' . $month . '-' . date('t', strtotime($first_date)));

                $this->db->where('cart_master.payment_date >=', $first_date);
                $this->db->where('cart_master.payment_date <=', $last_date);
            } elseif ($all_type=="last_3_month") {
                $monthStart      = date("m", strtotime("-3 month"));
                $last_3_month_start  = date('Y-' . $monthStart . '-01');
                $last_3_month_end = date('Y-m-d', strtotime('last day of previous month'));

                $this->db->where('cart_master.payment_date >=', $last_3_month_start);
                $this->db->where('cart_master.payment_date <=', $last_3_month_end);
            } elseif ($all_type=="last_6_month") {
                $monthStart      = date("m", strtotime("-6 month"));
                $last_6_month_start  = date('Y-' . $monthStart . '-01');
                $last_6_month_end = date('Y-m-d', strtotime('last day of previous month'));
            
                $this->db->where('cart_master.payment_date >=', $last_6_month_start);
                $this->db->where('cart_master.payment_date <=', $last_6_month_end);
            } elseif ($all_type=="last_12_month") {
                $last_12_month_start = date('Y-m' . '-01', strtotime("-12 month"));
                $last_12_month_end = date('Y-m-d', strtotime('last day of previous month'));

                $this->db->where('cart_master.payment_date >=', $last_12_month_start);
                $this->db->where('cart_master.payment_date <=', $last_12_month_end);
            } elseif ($all_type=="last_year") {
                $search_year = date('Y', strtotime("-1 year"));

                $this->db->where('YEAR(cart_master.payment_date)', $search_year);
            } elseif ($all_type=="this_year") {
                $search_year = date('Y');

                $this->db->where('YEAR(cart_master.payment_date)', $search_year);
            } elseif ($all_type=="period") {
                $from_date = date('Y-m-d', strtotime($this->input->get('fromdate')));
                $to_date = date('Y-m-d', strtotime($this->input->get('todate')));
                
                $this->db->where('cart_master.payment_date >=', $from_date);
                $this->db->where('cart_master.payment_date <=', $to_date);
            }
        }
		$this->db->where('membermaster.status','Active');

		$this->db->where('cart_master.status', 'Active');

		$this->db->order_by('cart_master.cart_id','DESC');

		$query = $this->db->get();

		$the_content = $query->result_array();

		return $the_content;

	}
}
?>
