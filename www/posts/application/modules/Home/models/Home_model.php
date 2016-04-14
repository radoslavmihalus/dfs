<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	public function getPage(){
		$keyword = '';
		if(get('q')){
			$keyword = " AND name LIKE '%".get('q')."%'";
		}

		$result = $this->model->fetch('*', FACEBOOK_TB, "(uid = '".session('uid')."' OR  list_user like '%\"".session('uid')."\"%') AND status = 1 {$keyword}", "name", "ASC");
		if(!empty($result)){
			for ($i=0; $i < count($result); $i++) {
				$response = FB_PAGE($result[$i]->access_token, $result[$i]->fid."?fields=name,access_token,picture.type(large),cover,id,category,likes,talking_about_count"); 
				if(!empty($response)){
					$response = (object)$response;
					$result[$i]->data = (object)array(
						'title'      => $response->name,
						'banner'     => (isset($response->cover))?$response->cover["source"]:"",
						'avatar'     => $response->picture["url"],
						'category'   => $response->category,
						'likes'      => $response->likes,
						'talking_about_count' => $response->talking_about_count
					);
				}else{
					$result[$i]->data = (object)array(
						'title'      => '',
						'banner'     => '',
						'avatar'     => '',
						'category'   => '',
						'likes'      => 0,
						'talking_about_count' => 0
					);
				}
			}
		}
		return $result;
	}
}
