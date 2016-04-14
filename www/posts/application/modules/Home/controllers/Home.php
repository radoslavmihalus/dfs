<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		$this->template->set_layout("admin");
	}

	public function index(){
		$result = $this->model->fetch("*", FACEBOOK_TB, "status = 1 AND uid = '".session("uid")."'");
		$list_profile = $this->model->fetch("*", FACEBOOK_TB, "uid = '".session("uid")."'");

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$fid = $row->fid;
				$token = $row->access_token;

				$groups   = FB()->get("/".$fid."/groups", $token)->getDecodedBody();
				$pages = FB()->get("/".$fid."/accounts", $token)->getDecodedBody();

				$result[$key]->groups = $groups;
				$result[$key]->pages  = $pages;
			}
		}

		$data = array(
			"all_profiles" => $list_profile,
			"authUrl"  => FB_LOGIN(),
			'profiles' => $result
		);
		$this->template->title(TITLE);
		$this->template->build('index', $data);
	}

	public function setLang(){
		$list_lang = scandir(APPPATH."../language/");
		unset($list_lang[0]);
		unset($list_lang[1]);
		$data_lang = array();
		$data_lang = array();
		foreach ($list_lang as $lang) {
			$arr_lang = explode(".", $lang);
			if(count($arr_lang) == 2 && strlen($arr_lang[0]) == 2 && $arr_lang[1] == "xml"){
				if($arr_lang[0] == post('lang')){
					set_session("lang", post('lang'));				
				}
			}
		}
	}
}
