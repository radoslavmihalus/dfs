<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Block extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'block_model');
	}

	public function header()
	{
		$list_lang = scandir(APPPATH."../language/");
		unset($list_lang[0]);
		unset($list_lang[1]);
		$data_lang = array();
		foreach ($list_lang as $lang) {
			$arr_lang = explode(".", $lang);
			if(count($arr_lang) == 2 && strlen($arr_lang[0]) == 2 && $arr_lang[1] == "xml"){
				$data_lang[] = $arr_lang[0];
			}
		}

		$data = array(
			"lang" => $data_lang
		);
		$this->load->view('header', $data);
	}

	public function sidebar()
	{
		$this->load->view('sidebar');
	}
}
