<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$page_size      = 10;
        $page_num       = (get('p')) ? get('p') : 1;
        $total_row      = $this->model->getList(-1,-1);
        $start_row      = (get('p'))?$page_num:0;

        $config['base_url'] = PATH."schedules"."?";
        $config['total_rows'] = $total_row;
        $config['per_page'] = 10;
        $config['query_string_segment'] = 'p';
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);

        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        set_session('actual_link', $actual_link);

		$data= array(
			'result' => $this->model->getList($page_size, $start_row)
		);

		$this->template->title(l('slug-manage-schedules'),TITLE);
		$this->template->build('index', $data);
	}

	public function update(){
		$id   = (int)get("id");
		$result = $this->model->get("*", POSTS_TB, "id = '{$id}'");
		if(empty($result)) redirect(PATH.'schedules');
		$data = array(
			"result" => $this->model->get("*", POSTS_TB, "id = '{$id}'")
		);
		$this->template->title(l('slug-manage-schedules'),TITLE);
		$this->template->build('update', $data);
	}

	public function postUpdate(){
		$json = array();
		$pages = $this->input->post('pages');

		switch (post('type_post')) {
			case 'link':
				if(post('link_url') == ""){
					$json[] = array(
						"type"   => "link_url",
						"text"   => l('slug-link-url-is-required')
					);
				}

				$data = array(
					"type"        => "link",
					"url"         => post("link_url"),
					"message"     => post("link_message"),
					"title"       => post("link_title"),
					"description" => post("link_description"),
					"image"       => post("link_picture")
				);
				break;
			case 'image':
				if(post('image_url') == ""){
					$json[] = array(
						"type"   => "image_url",
						"text"   => l('slug-image-url-is-required')
					);
				}

				$data = array(
					"type"        => "image",
					"description" => post("image_description"),
					"image"       => post("image_url")
				);
				break;
			case 'video':
				if(post('video_url') == ""){
					$json[] = array(
						"type"   => "video_url",
						"text"   => l('slug-video-url-is-required')
					);
				}

				$data = array(
					"type"        => "video",
					"title"       => post("video_title"),
					"description" => post("video_description"),
					"url"         => post("video_url")
				);
				break;
			default:
				if(post('post_message') == ""){
					$json[] = array(
						"type"   => "post_message",
						"text"   => l('slug-message-is-required')
					);
				}

				$data = array(
					"type"        => "text",
					"message"     => post("post_message")
				);
				break;
		}

		if(post('time_post') == ""){
			$json[] = array(
				"type"   => "time_post",
				"text"   => l('slug-time-post-required')
			);
		}else{
			$data["time_post"] = date("Y-m-d H:i:s", strtotime(post('time_post').":00"));
		}

		if(post('delete_complete')){
			$data["delete"] = 1;
		}else{
			$data["delete"] = 0;
		}

		if(!empty($json)){
			$json["st"] = "error";
		}else{
			$id = (int)post('id');
			$data["deplay"]  = (int)post('deplay');
			$data["changed"] = NOW;

			$this->db->update(POSTS_TB, $data, "id = '".$id."' AND uid = '".session("uid")."'");

			$json[] = array(
				"text"   => l('slug-update-successfully')
			);
			$json["st"] = "success";
			$json["url"] = session("actual_link")?session("actual_link"):PATH."schedules";

		}

		printf(json_encode($json));
	}

	public function ajax_post(){
		$json = array();
		$pages = $this->input->post('pages');

		switch (post('type_post')) {
			case 'link':
				if(post('link_url') == ""){
					$json[] = array(
						"type"   => "link_url",
						"text"   => l('slug-link-url-is-required')
					);
				}

				$data = array(
					"type"        => "link",
					"url"         => post("link_url"),
					"message"     => post("link_message"),
					"title"       => post("link_title"),
					"description" => post("link_description"),
					"image"       => post("link_picture")
				);
				break;
			case 'image':
				if(post('image_url') == ""){
					$json[] = array(
						"type"   => "image_url",
						"text"   => l('slug-image-url-is-required')
					);
				}

				$data = array(
					"type"        => "image",
					"description" => post("image_description"),
					"image"       => post("image_url")
				);
				break;
			case 'video':
				if(post('video_url') == ""){
					$json[] = array(
						"type"   => "video_url",
						"text"   => l('slug-video-url-is-required')
					);
				}

				$data = array(
					"type"        => "video",
					"title"       => post("video_title"),
					"description" => post("video_description"),
					"url"         => post("video_url")
				);
				break;
			default:
				if(post('post_message') == ""){
					$json[] = array(
						"type"   => "post_message",
						"text"   => l('slug-message-is-required')
					);
				}

				$data = array(
					"type"        => "text",
					"message"     => post("post_message")
				);
				break;
		}

		if(post('time_post') == ""){
			$json[] = array(
				"type"   => "time_post",
				"text"   => l('slug-time-post-required')
			);
		}else{
			$data["time_post"] = date("Y-m-d H:i:s", strtotime(post('time_post').":00"));
		}

		if(post('delete_complete')){
			$data["delete"] = 1;
		}else{
			$data["delete"] = 0;
		}

		if(empty($pages)){
			$json[] = array(
				"type"   => "list_pages",
				"text"   => l('slug-select-at-least-one-page-group-profile')
			);
		}

		if(!empty($json)){
			$json["st"] = "error";
		}else{
			$count = 0;
			foreach ($pages as $key => $row) {
				$value = explode("-", $row);
				if(count($value) == 4){
					$data["cid"]          = $value[0];
					$data["name"]         = $value[1];
					$data["fid"]          = $value[2];
					$data["access_token"] = $value[3];
					$data["uid"]          = session("uid");
					$data["deplay"]       = (int)post('deplay');
					$data["changed"]      = NOW;
					$data["created"]      = NOW;

					$this->db->insert(POSTS_TB, $data);
					$count++;
				}
			}

			if($count != 0){
				$json[] = array(
					"text"   => l('slug-add-schedule-posts-successfully')
				);
				$json["st"] = "success";
			}else{
				$json[] = array(
					"text"   => l('slug-the-error-occurred-during-processing')
				);
				$json["st"] = "error";
			}
		}

		printf(json_encode($json));
	}

	public function getInfo(){
		$id = (int)post("id");

		$comment = 0;
		$like    = 0;
		$share   = 0;

		$result = $this->model->get("*", POSTS_TB, "id = '".$id."' AND uid = '".session("uid")."'");
		if(!empty($result)){
			$response = FB_GET_POSTS($result);
			if(!empty($response)){
				if(isset($response['comments'])){
					$comment = count($response['comments']['data']);
				}

				if(isset($response['likes'])){
					$like = count($response['likes']['data']);
				}

				if(isset($response['sharedposts'])){
					$share = count($response['sharedposts']['data']);
				}

				$text = l('slug-comments').": {$comment} ".l('slug-likes').": {$like} ".l('slug-shares').": {$share}";
			}else{
				$text = "No data";
			}
			
			echo $text;
		}
	}

	public function postDelete(){
		$id = (int)post('id');
		$POST = $this->model->get('*', POSTS_TB, "id = '{$id}' AND uid = '".session("uid")."'");
		if(!empty($POST)){
			$this->db->delete(POSTS_TB, "id = '{$id}' AND uid = '".session("uid")."'");
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
				$POST = $this->model->get('*', POSTS_TB, "id = '{$id}' AND uid = '".session("uid")."'");
				if(!empty($POST)){
					$this->db->delete(POSTS_TB, "id = '{$id}' AND uid = '".session("uid")."'");
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
				$POST = $this->model->get('*', POSTS_TB, "id = '{$id}' AND uid = '".session("uid")."'");
				if(!empty($POST)){
					$this->db->update(POSTS_TB,array("status" => $status), "id = '{$id}' AND uid = '".session("uid")."'");
				}
			}
		}
		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> l('slug-successfully')
		)));
	}

	public function cronjob(){
		ini_set('max_execution_time', 300000);
		$result = $this->model->fetch("*", POSTS_TB, "status = 1  AND time_post <= '".NOW."'", "changed", "ASC" ,0 , MAX_POST);
		if(!empty($result)){
			foreach ($result as $key => $row) {
				$USER = $this->model->get("*", USERS_TB, "id = '".$row->uid."'");
				$this->session->set_userdata('app_id', $USER->app_id);
				$this->session->set_userdata('app_secret', $USER->app_secret);

				$response = FB_POST($row);
				$deplay = $row->deplay;
				$delete = $row->delete;
				if($delete == 1){
					$this->db->delete(POSTS_TB, "id = {$row->id}");
				}else{
					$this->db->update(POSTS_TB,array("status" => 2, 'result' => $response), "id = {$row->id}");
				}
				if($key+1 != count($result)){
					//sleep((int)$deplay);
				}
			}
		}
	}
	
}
