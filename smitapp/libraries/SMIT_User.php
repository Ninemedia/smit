<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * SMIT_User Class
 *
 * @package		SMIT
 * @subpackage	Libraries
 * @category	SMIT_User
 * @author		Iqbal
 */
class SMIT_User
{
	var $CI;
	var $data;
	var $id_user = 0;

	/**
	 * Constructor - Sets up the object properties.
	 */
	function __construct()
	{
		$this->CI =& get_instance();
	}

	/**
	 * Sets up the object properties.
	 *
	 * Retrieves the userdata and then assigns all of the data keys to direct
	 * properties of the object.
	 *
	 * @param int $id      Optional    User's ID
	 * @param int $email   Optional    User's Email
	 * @return object
	 */
	function user($id=0, $email='')
	{
		if (empty($id) && empty($email))
		{
			return false;
		}
        
        if (!is_numeric($id))
		{
            $email  = $id;
            $id     = 0;
		}
		
		if (!empty($id))
		{
			$this->data = $this->CI->Model_User->get_userdata($id);
		}
        else
		{
			$this->data = $this->CI->Model_User->get_user_by('email', $email);
		}
	
		if (!isset($this->data->id) || empty($this->data->id))
		{
			return false;
		}
		
		$this->id_user = $this->data->id;

		return $this->data;
	}
}