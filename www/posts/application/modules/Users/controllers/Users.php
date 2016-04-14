<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		$this->template->set_layout("admin");
	}

	public function index(){
		if(session("admin") != 1) redirect(PATH);

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

		$this->template->title(l('slug-manage-user'),TITLE);
		$this->template->build('index', $data);
	}

	public function update(){
		if(session("admin") != 1) redirect(PATH);

		$id   = (int)get("id");
		
		$data = array(
			"result" => $this->model->get("*", USERS_TB, "id = '{$id}'")
		);
		$this->template->title(l('slug-manage-user'),TITLE);
		$this->template->build('update', $data);
	}

	public function profile(){
		$id   = (int)session("uid");
		$result = $this->model->get("*", USERS_TB, "id = '{$id}'");
		if(empty($result)) redirect(PATH);
		
		$data = array(
			"result" => $result
		);
		$this->template->title(l('slug-manage-user'),TITLE);
		$this->template->build('profile', $data);
	}

	public function postProfile(){
		$id   = (int)session("uid");
		$result = $this->model->get("*", USERS_TB, "id = '{$id}'");
		if(empty($result)) exit(0);

		$id = (int)session("uid");
    	$data = array(
    		'app_id'    => post('app_id'),
    		'app_secret'=> post('app_secret'),
    		'fid'       => post('fid'),
    		'changed'   => NOW
    	);

		if(post('password') != ""){
			if(strlen(post('password')) < 6){
        		$json= array(
					'st' 	=> 'error',
					'txt' 	=> l('slug-password-length')
				);
        		print_r(json_encode($json));
        		exit(0);
        	}

        	if(post('password') != post('repassword')){
        		$json= array(
					'st' 	=> 'error',
					'txt' 	=> l('slug-this-password-is-not-matching')
				);
        		print_r(json_encode($json));
        		exit(0);
        	}
        	
        	$data['password'] = md5(post('password'));
		}

		if(strlen(post('fid')) != 15 && strlen(post('fid')) != 16){
    		$json= array(
				'st' 	=> 'error',
				'txt' 	=> l('slug-facebook-user-id-not-valid')
			);
    		print_r(json_encode($json));
    		exit(0);
    	}

    	if(strlen(post('app_id')) != 15 && strlen(post('app_id')) != 16){
    		$json= array(
				'st' 	=> 'error',
				'txt' 	=> l('slug-app-id-not-valid')
			);
    		print_r(json_encode($json));
    		exit(0);
    	}

    	if(strlen(post('app_secret')) != 32){
    		$json= array(
				'st' 	=> 'error',
				'txt' 	=> l('slug-app-serect-not-valid')
			);
    		print_r(json_encode($json));
    		exit(0);
    	}

    	if($result->app_id != post('app_id') || $result->app_secret != post('app_secret')){
    		$this->session->set_userdata('fid', post('fid'));
    		$this->session->set_userdata('app_id', post('app_id'));
			$this->session->set_userdata('app_secret', post('app_secret'));

    		$this->db->delete(FACEBOOK_TB,"uid = '".session("uid")."'");
    		$this->db->delete(POSTS_TB,"uid = '".session("uid")."'");
    	}

		$this->db->update(USERS_TB, $data, "id = '{$id}'");	
		$json= array(
			'st' 	=> 'success',
			'txt' 	=> l('slug-update-successfully')
		);
	
        
		print_r(json_encode($json));
	}

	public function postUpdate(){
		if(session("admin") != 1) redirect(PATH);

		$id = (int)post('id');
        if(post('username') != ''){
        	$data = array(
        		'admin'     => (post('admin')!= 0)?1:0,
        		'username'  => post('username'),
        		'app_id'    => post('app_id'),
        		'app_secret'=> post('app_secret'),
        		'fid'       => post('fid'),
        		'status'    => (post('status')!= 0)?1:0,
        		'changed'   => NOW
        	);

        	if($id == 0){
        		if(strlen(post('password')) == ''){
	        		$json= array(
						'st' 	=> 'error',
						'txt' 	=> l('slug-password-is-required')
					);
	        		print_r(json_encode($json));
	        		exit(0);
	        	}

	        	if(strlen(post('password')) < 6){
	        		$json= array(
						'st' 	=> 'error',
						'txt' 	=> l('slug-password-length')
					);
	        		print_r(json_encode($json));
	        		exit(0);
	        	}

	        	if(post('password') != post('repassword')){
	        		$json= array(
						'st' 	=> 'error',
						'txt' 	=> l('slug-this-password-is-not-matching')
					);
	        		print_r(json_encode($json));
	        		exit(0);
	        	}

	        	if(strlen(post('fid')) != 15 && strlen(post('fid')) != 16){
	        		$json= array(
						'st' 	=> 'error',
						'txt' 	=> l('slug-facebook-user-id-not-valid')
					);
	        		print_r(json_encode($json));
	        		exit(0);
	        	}

	        	if(strlen(post('app_id')) != 15 && strlen(post('app_id')) != 16){
	        		$json= array(
						'st' 	=> 'error',
						'txt' 	=> l('slug-app-id-not-valid')
					);
	        		print_r(json_encode($json));
	        		exit(0);
	        	}

	        	if(strlen(post('app_secret')) != 32){
	        		$json= array(
						'st' 	=> 'error',
						'txt' 	=> l('slug-app-serect-not-valid')
					);
	        		print_r(json_encode($json));
	        		exit(0);
	        	}

        		$data['password'] = md5(post('password'));
        		$data['created'] = NOW;
        		$POST = $this->model->get('*', USERS_TB, "username = '".post("username")."'");
        		if(empty($POST)){
	        		$this->db->insert(USERS_TB, $data);
	        		$json= array(
						'st' 	=> 'success',
						'txt' 	=> 'Add new item successfully'
					);
	        	}else{
	        		$json= array(
						'st' 	=> 'error',
						'txt' 	=> l('slug-username-already-exists')
					);
	        	}
        	}else{
        		if(post('password') != ""){
        			if(strlen(post('password')) < 6){
		        		$json= array(
							'st' 	=> 'error',
							'txt' 	=> l('slug-password-length')
						);
		        		print_r(json_encode($json));
		        		exit(0);
		        	}

		        	if(post('password') != post('repassword')){
		        		$json= array(
							'st' 	=> 'error',
							'txt' 	=> l('slug-this-password-is-not-matching')
						);
		        		print_r(json_encode($json));
		        		exit(0);
		        	}
		        	
		        	$data['password'] = md5(post('password'));
        		}

        		if(strlen(post('fid')) != 15 && strlen(post('fid')) != 16){
	        		$json= array(
						'st' 	=> 'error',
						'txt' 	=> l('slug-facebook-user-id-not-valid')
					);
	        		print_r(json_encode($json));
	        		exit(0);
	        	}

	        	if(strlen(post('app_id')) != 15 && strlen(post('app_id')) != 16){
	        		$json= array(
						'st' 	=> 'error',
						'txt' 	=> l('slug-app-id-not-valid')
					);
	        		print_r(json_encode($json));
	        		exit(0);
	        	}

	        	if(strlen(post('app_secret')) != 32){
	        		$json= array(
						'st' 	=> 'error',
						'txt' 	=> l('slug-app-serect-not-valid')
					);
	        		print_r(json_encode($json));
	        		exit(0);
	        	}

        		$POST = $this->model->get("*", USERS_TB, "username = '".post("username")."' AND id != '{$id}'");
    			if(empty($POST)){
    				if($id == 1){
    					$data['status'] = 1;
    				}
    				if($id == 1){
    					if(session("uid") == 1){
	    					$this->db->update(USERS_TB, $data, "id = '{$id}'");
    					}
    				}else{
						$this->db->update(USERS_TB, $data, "id = '{$id}'");				
    				}
	    			$json= array(
						'st' 	=> 'success',
						'txt' 	=> l('slug-update-successfully')
					);
				}else{
	        		$json= array(
						'st' 	=> 'error',
						'txt' 	=> l('slug-username-already-exists')
					);
	        	}
        	}
        }else{
        	$json= array(
				'st' 	=> 'error',
				'txt' 	=> l('slug-username-is-required')
			);
        }
		print_r(json_encode($json));
	}

	public function postRegister(){
		if(!REGISTER) redirect(PATH);

        if(post('username') != ''){
        	$data = array(
        		'username'  => post('username'),
        		'app_id'    => post('app_id'),
        		'app_secret'=> post('app_secret'),
        		'fid'       => post('fid'),
        		'changed'   => NOW
        	);

    		if(strlen(post('password')) == ''){
        		$json= array(
					'st' 	=> 'error',
					'txt' 	=> l('slug-password-is-required')
				);
        		print_r(json_encode($json));
        		exit(0);
        	}

        	if(strlen(post('password')) < 6){
        		$json= array(
					'st' 	=> 'error',
					'txt' 	=> l('slug-password-length')
				);
        		print_r(json_encode($json));
        		exit(0);
        	}

        	if(post('password') != post('repassword')){
        		$json= array(
					'st' 	=> 'error',
					'txt' 	=> l('slug-this-password-is-not-matching')
				);
        		print_r(json_encode($json));
        		exit(0);
        	}

        	if(strlen(post('fid')) != 15 && strlen(post('fid')) != 16){
        		$json= array(
					'st' 	=> 'error',
					'txt' 	=> l('slug-facebook-user-id-not-valid')
				);
        		print_r(json_encode($json));
        		exit(0);
        	}

        	if(strlen(post('app_id')) != 15 && strlen(post('app_id')) != 16){
        		$json= array(
					'st' 	=> 'error',
					'txt' 	=> l('slug-app-id-not-valid')
				);
        		print_r(json_encode($json));
        		exit(0);
        	}

        	if(strlen(post('app_secret')) != 32){
        		$json= array(
					'st' 	=> 'error',
					'txt' 	=> l('slug-app-serect-not-valid')
				);
        		print_r(json_encode($json));
        		exit(0);
        	}

    		$data['password'] = md5(post('password'));
    		$data['created'] = NOW;
    		$POST = $this->model->get('*', USERS_TB, "username = '".post('username')."'");
    		if(empty($POST)){
        		$this->db->insert(USERS_TB, $data);
        		$json= array(
					'st' 	=> 'success',
					'txt' 	=> l('slug-register-successfully')
				);
        	}else{
        		$json= array(
					'st' 	=> 'error',
					'txt' 	=> l('slug-username-already-exists')
				);
        	}
        }else{
        	$json= array(
				'st' 	=> 'error',
				'txt' 	=> l('slug-username-is-required')
			);
        }
		print_r(json_encode($json));
	}

	public function change_password(){
		$this->template->title('Change password', TITLE);
		$this->template->build('change_password');
	}

	public function postUpdatePassword(){
		$id           = (int)session('uid');
        $password_old = post('password_old');
        $password     = post('password');
        $repassword   = post('repassword');

        $POST = $this->model->get('*', USERS_TB, "password = '".md5($password_old)."' AND id = '".session("uid")."'");
		if(empty($POST)){
			$json= array(
				'st' 	=> 'error',
				'txt' 	=> l('slug-old-password-incorrect')
			);
    		print_r(json_encode($json));
    		exit(0);
		}

    	if(strlen(post('password')) == ''){
    		$json= array(
				'st' 	=> 'error',
				'txt' 	=> l('slug-new-password-is-required')
			);
    		print_r(json_encode($json));
    		exit(0);
    	}

    	if(strlen(post('password')) < 6){
    		$json= array(
				'st' 	=> 'error',
				'txt' 	=> l('slug-password-length')
			);
    		print_r(json_encode($json));
    		exit(0);
    	}

    	if(post('password') != post('repassword')){
    		$json= array(
				'st' 	=> 'error',
				'txt' 	=> l('slug-this-password-is-not-matching')
			);
    		print_r(json_encode($json));
    		exit(0);
    	}

    	$data = array(
    		'password'=> md5(post('password')),
    		'changed' => NOW
    	);

    	$this->db->update(USERS_TB, $data, "id = '{$id}'");
		$json= array(
			'st' 	=> 'success',
			'txt' 	=> 'Change password successfully'
		);
		print_r(json_encode($json));
	}

	public function postDelete(){
		if(session("admin") != 1) redirect(PATH);

		$id = (int)post('id');
		$POST = $this->model->get('*', USERS_TB, "id = '{$id}' AND id != 1");
		if(!empty($POST)){
			$this->db->delete(USERS_TB, "id = '{$id}'");
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
		if(session("admin") != 1) redirect(PATH);


		$ids =$this->input->post('id');
		if(!empty($ids)){
			foreach ($ids as $id) {
				$POST = $this->model->get('*', USERS_TB, "id = '{$id}' AND id != 1");
				if(!empty($POST)){
					$this->db->delete(USERS_TB, "id = '{$id}'");
				}
			}
		}
		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> l('slug-successfully')
		)));
	}

	public function postStatusAll(){
		if(session("admin") != 1) redirect(PATH);

		$ids    =$this->input->post('id');
		$status =(int)post('status');
		if(!empty($ids)){
			foreach ($ids as $id) {
				$POST = $this->model->get('*', USERS_TB, "id = '{$id}'");
				if(!empty($POST)){
					if($id != 1){
						$this->db->update(USERS_TB,array("status" => $status), "id = '{$id}'");
					}
				}
			}
		}
		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> l('slug-successfully')
		)));
	}

	//Logout
	public function logout(){
		$this->session->sess_destroy();
		redirect(PATH);
	}

	//Login Process
	public function register(){
		$this->template->set_layout('login');
		$this->template->title(l('slug-register'),TITLE);
		$this->template->build('register');
	}

	public function login(){
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

		if(session("uid")) redirect(PATH);
		$this->template->set_layout("home");
		$this->template->title(l('slug-login'),TITLE);
		$this->template->build('login', array("lang" => $data_lang));
	}

	public function postLogin(){
		$username   = post('username');
        $password   = md5(post('password'));

		$USER= $this->model->get('*', USERS_TB, "username = '{$username}'");
		if(!empty($USER)){
			if($USER->password != $password){
				$json= array(
					'st' 	=> 'error',
					'txt' 	=> l('slug-username-or-password-incorrect')
				);
				print_r(json_encode($json));
				exit();
			}
			     
			$this->model->session($USER);
			if($this->input->post('remember') == 1){
				$cookie= _token();
				setcookie("__username", $username, time()+604800, '/');  /* expire in 7 day */
				setcookie("__remember", $cookie, time()+604800, '/');  /* expire in 7 day */

				$data_user['cookie']= $cookie;
				$this->db->where('id', $USER->id)->update(USERS_TB, $data_user);
			}else{
				setcookie("__username", '', time()-604800, '/');
				setcookie("__remember", '', time()-604800, '/');
			}

			$json= array(
				'st' 	=> 'success',
				'txt' 	=> l('slug-login-successfully')
			);
		
		}else{
			$json= array(
				'st' 	=> 'error',
				'txt' 	=> l('slug-username-or-password-incorrect')
			);	
		}
		print_r(json_encode($json));
	}
}
