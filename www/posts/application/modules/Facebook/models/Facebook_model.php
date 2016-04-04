<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	public $table = FACEBOOK_TB;

	function getList($limit=-1, $page=-1){
		if($limit == -1){
			$this->db->select('count(*) as sum');
		}else{
			$this->db->select('*');
		}
		
		$this->db->from($this->table);

		if($limit != -1) {
			$this->db->limit($limit,$page);
		}

		$this->db->where("uid = '".session("uid")."'");

		$this->db->order_by('created','desc');
		$query = $this->db->get();

		if($query->result()){
			if($limit == -1){
				return $query->row()->sum;
			}else{
				return $query->result();
			}
		}else{
			return false;
		}
	}
}
