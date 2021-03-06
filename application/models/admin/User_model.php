<?php
Class User_model extends CI_Model {

	function getAllUser() {

		$this->db->select('membermaster.*');

		$this->db->from('membermaster');

		$this->db->where('membermaster.role_type', '3');

		$this->db->where('membermaster.status !=', 'Delete');

		$this->db->order_by('membermaster.usercode', 'Desc');

		$query = $this->db->get();

		$the_content = $query->result_array();

		return $the_content;

	}
	function getAllCategory() {

		$this->db->select('category_master.*');

		$this->db->from('category_master');

		$this->db->where('category_master.status !=', 'Delete');

		$this->db->order_by('category_master.category_id', 'Desc');

		$query = $this->db->get();

		$the_content = $query->result_array();

		return $the_content;

	}

	function get_record($category_id) {

		$this->db->select('category_master.*');

		$this->db->from('category_master');

		$this->db->where('category_master.status !=', 'Delete');

		$this->db->where('category_master.category_id', '' . $category_id . '');

		$query = $this->db->get();

		$the_content = $query->result_array();

		return $the_content;

	}

}
?>
