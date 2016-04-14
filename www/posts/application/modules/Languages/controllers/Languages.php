<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Languages extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		$this->template->set_layout("admin");
	}

	public function index(){
		$id   = (int)get("id");
		$data = array(
			"result" => $this->model->get("*", SETTINGS_TB, "id = 1")
		);

		if(post('name')){
			$theme    = post('theme');
	        $name     = post('name');
	        $register = (int)post('register');

			$data = array(
				"name"     => $name,
				"theme"    => $theme,
				"register" => $register
			);
			
			$path = "assets/img/";
			$config['upload_path'] = $path;
		    $config['allowed_types'] = 'jpg|png';
		    $config['remove_spaces'] = TRUE;
	    	$this->load->library('upload', $config);
		    if($this->upload->do_upload('file')){
		    	$data_file = $this->upload->data();
		    	$data["logo"] = $path.$data_file["file_name"];
		    	
		    }

		    $this->db->update(SETTINGS_TB, $data);
		    redirect(PATH."settings");
		}
		
		$this->template->title(TITLE);
		$this->template->build('update', $data);
	}
} 
