<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__).'/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright	Copyright (c) 2015 Wiredesignz
 * @version 	5.5
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Controller 
{
	public $autoload = array();
	
	public function __construct() 
	{
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;	
		
		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);	
		
		/* autoload module items */
		$this->load->_autoloader($this->autoload);

		$CI = &get_instance();

		$settings = $CI->db->select("*")->get(SETTINGS_TB)->row();
		if(!empty($settings)){
			if(!defined('TITLE'))
				define("TITLE", $settings->name);

			if(!defined('LOGO'))
				define("LOGO", $settings->logo);

			if(!defined('THEME'))
				define("THEME", $settings->theme);

			if(!defined('SIDEBAR'))
				define("SIDEBAR", ($settings->sidebar == 0)?"sidebar-collapse":"");

			if(!defined('LAYOUT'))
				define("LAYOUT", $settings->layout);

			if(!defined('LANGUAGE'))
				define("LANGUAGE", session('lang')?session('lang'):$settings->default_language);

			if(!defined('REGISTER'))
				define("REGISTER", $settings->register);

			if(!defined('USERS_LIMIT'))
				define("USERS_LIMIT", $settings->users_limit);

			if(!defined('DEFAULT_DEPLAY'))
				define("DEFAULT_DEPLAY", $settings->default_deplay);

			if(!defined('MINIMUM_DEPLAY'))
				define("MINIMUM_DEPLAY", $settings->minimum_deplay);

			if(!defined('CRON_DEPLAY'))
				define("CRON_DEPLAY", $settings->cron_delay);

			if(!defined('MAX_POST'))
				define("MAX_POST", $settings->max_post);

			if(!defined('TIMEZONE'))
				define("TIMEZONE", $settings->default_timezone);

			date_default_timezone_set(TIMEZONE);

			if(!defined('NOW'))
				define("NOW",date("Y-m-d H:i:s"));
		}

		if(!session('uid') && segment(1) != 'login' && segment(1) != 'cronjob' && segment(2) != 'postLogin' && segment(2) != 'postRegister' && segment(2) != 'setLang'){
			redirect(PATH."login");
		}else{
			if(session("app_id") == "" && segment(1) != 'profile' && segment(1) != 'cronjob' && segment(1) != 'logout' && segment(1) != 'login' && segment(2) != "postProfile" && segment(2) != 'postLogin' && segment(2) != 'postRegister' && segment(2) != 'setLang'){
				redirect(PATH."profile");
			}
		}
	}
	
	public function __get($class) 
	{
		return CI::$APP->$class;
	}
}