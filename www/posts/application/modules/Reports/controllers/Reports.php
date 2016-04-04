<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){

		$data= array(
		);

		$this->template->title(l('slug-reports'),TITLE);
		$this->template->build('index', $data);
	}


	//Chart
	public function ajax_report_posts(){
		$post_success = 0;
		$post_error   = 0;

		$post_complete    = 0;
		$post_processing  = 0;
		$post_cancel      = 0;

		$post_day  = array();

		$result = $this->model->fetch("*", POSTS_TB, "uid = '".session("uid")."'", 0, 1000);
		if(!empty($result)){
			foreach ($result as $key => $row) {
				switch ($row->status) {
					case 0:
						$post_cancel++;
						break;
					case 1:
						$post_processing++;
						break;
					case 2:
						$post_complete++;
						//check posts
						if($row->result != ""){
							$post_success++;
							$date = date("Y-m-d", strtotime($row->created));
							if(!isset($post_day[$date])){
								$post_day[$date] = 0;
							}

							$post_day[$date] += 1;
						}else{
							$post_error++;
						}
						break;
				}
			}
		}

		$post_by_status    = "['Complete',".$post_complete."],['Processing',".$post_processing."],['Cancel',".$post_cancel."]";
		$post_by_complete  = "['Success',".$post_success."],['Error',".$post_error."]";

		$post_by_day = "";
		if(!empty($post_day)){
			foreach ($post_day as $key => $value) {
				$year  = date("Y", strtotime($key));
	            $month = date("n", strtotime($key)) - 1;
	            $day   = date("j", strtotime($key));
				$post_by_day.="[Date.UTC(".$year.",".$month.",".$day."),".$value."],";
			}
		}
		
		$data = array(
			"post_by_day"      => $post_by_day,
			"post_by_status"   => $post_by_status,
			"post_by_complete" => $post_by_complete
		);

		$this->load->view("chart/post",$data);
	}
}
