<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		$this->template->set_layout("admin");
	}

	public function index(){
		if(session("admin") != 1) redirect(PATH);
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

		$id   = (int)get("id");
		$data = array(
			"lang"   => $data_lang,
			"result" => $this->model->get("*", SETTINGS_TB, "id = 1")
		);

		if(post('name')){
			$data = array(
				"name"              => post('name'),
				"theme"             => post('theme'),
				"register"          => (int)post('register'),
				"sidebar"           => (int)post('sidebar'),
				"layout"            => post('layout'),
				"default_language"  => post('default_language'),
				"users_limit"       => post('users_limit'),
				"default_deplay"    => post('default_deplay'),
				"minimum_deplay"    => post('minimum_deplay'),
				"cron_delay"        => post('cron_delay'),
				"max_post"          => post('max_post'),
				"default_timezone"  => post('default_timezone')
			);

			foreach ($_FILES as $key => $value) {
			    if (!empty($value['tmp_name']) && $value['size'] > 0) {
			    	$this->load->library('upload');
			    	if($key == "language"){
			    		$config['upload_path'] = "language/";
					    $config['allowed_types'] = 'xml';
					    $config['remove_spaces'] = TRUE;
				    	$this->upload->initialize($config); 
				    	if ($this->upload->do_upload($key)) {}
			    	}else{
			    		$path = "assets/img/";
			    		$config['upload_path'] = $path;
					    $config['allowed_types'] = 'jpg|png';
					    $config['remove_spaces'] = TRUE;
				    	$this->upload->initialize($config); 
				    	if ($this->upload->do_upload($key)) {
			            	$data_file = $this->upload->data();
		    				$data["logo"] = $path.$data_file["file_name"];
			        	}
			    	}

			        
			    }
			}
			
			$this->db->update(SETTINGS_TB, $data);

		    redirect(PATH."settings");
		}
		
		$this->template->title(l('slug-settings'),TITLE);
		$this->template->build('update', $data);
	}
} 
