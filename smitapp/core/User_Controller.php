<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User_Controller Class
 */
class User_Controller extends SMIT_Controller {
	
	function __construct() {
		parent::__construct();
		$this->auth();
	}
}
