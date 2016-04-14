<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$page_size      = 10;
        $page_num       = (get('p')) ? get('p') : 1;
        $total_row      = $this->model->getList(-1,-1);
        $start_row      = (get('p'))?$page_num:0;

        $config['base_url'] = current_url()."?";
        $config['total_rows'] = $total_row;
        $config['per_page'] = 10;
        $config['query_string_segment'] = 'p';
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);

		$data= array(
			'result' => $this->model->getList($page_size, $start_row)
		);

		$this->template->title(l('slug-accounts-facebook'),TITLE);
		$this->template->build('index', $data);
	}

	public function update(){
		$pages = array();

		//unset_session("fb_token");
		$list_profile = $this->model->fetch("*", FACEBOOK_TB, "uid = '".session("uid")."'");

		if(get("code")){
			FB_ACCESS_TOKEN();
			redirect(PATH."facebook/add");
		}
		if(session("fb_token")){
			if(count($list_profile) < USERS_LIMIT){
				$token = getExtendedTokenFB(session("fb_token"));
				$info  = FB()->get('/me', $token)->getDecodedBody();
				$data = array(
					"fid"          => $info['id'],
					"name"         => $info['name'],
					"access_token" => $token,
					"uid"          => session("uid"),
					"changed"      => NOW,
				);
				$check = $this->model->get("*", FACEBOOK_TB, "fid = '".$info['id']."' AND uid = '".session("uid")."'");
				if(empty($check)){
					$data["created"] = NOW;
					$this->db->insert(FACEBOOK_TB,$data);
				}else{
					$this->db->update(FACEBOOK_TB,$data,"id = '{$check->id}'");
				}

				unset_session("fb_token");
				redirect(PATH."facebook");
			}else{
				pr(l('slug-desc-user-limit'),1);
			}
		}
		
		$id   = (int)get("id");
		$data = array(
			"profiles" => $list_profile,
			"result"   => $this->model->get("*", FACEBOOK_TB, "id = '{$id}'"),
			"authUrl"  => FB_LOGIN(),
			"pages"    => $pages
		);
		$this->template->title(l('slug-accounts-facebook'), TITLE);
		$this->template->build('update', $data);
	}

	public function postDelete(){
		$id = (int)post('id');
		$POST = $this->model->get('*', FACEBOOK_TB, "id = '{$id}' AND uid = '".session("uid")."'");
		if(!empty($POST)){
			$this->db->delete(FACEBOOK_TB, "id = '{$id}' AND uid = '".session("uid")."'");
			$json= array(
				'st' 	=> 'success',
				'txt' 	=> l('slug-delete-successfully')
			);
		}else{
			$json= array(
				'st' 	=> 'error',
				'txt' 	=> l('slug-cannot-delete-item')
			);
		}
		print_r(json_encode($json));
	}

	public function postDeleteAll(){
		$ids =$this->input->post('id');
		if(!empty($ids)){
			foreach ($ids as $id) {
				$POST = $this->model->get('*', FACEBOOK_TB, "id = '{$id}' AND uid = '".session("uid")."'");
				if(!empty($POST)){
					$this->db->delete(FACEBOOK_TB, "id = '{$id}' AND uid = '".session("uid")."'");
				}
			}
		}
		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> l('slug-successfully')
		)));
	}

	public function postStatusAll(){
		$ids    =$this->input->post('id');
		$status =(int)post('status');
		if(!empty($ids)){
			foreach ($ids as $id) {
				$POST = $this->model->get('*', FACEBOOK_TB, "id = '{$id}' AND uid = '".session("uid")."'");
				if(!empty($POST)){
					$this->db->update(FACEBOOK_TB,array("status" => $status), "id = '{$id}' AND uid = '".session("uid")."'");
				}
			}
		}
		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> l('slug-successfully')
		)));
	}
}
