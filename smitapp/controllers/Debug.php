<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Debug Controller.
 * 
 * @class     Debug
 * @author    Iqbal
 * @version   1.0.0
 * @copyright Copyright (c) 2017 SMIT (Sistem Manajemen Inkubasi Teknologi) (http://pusinov.lipi.go.id)
 */
class Debug extends Public_Controller {
    /**
	 * Constructor.
	 */
    function __construct()
    {       
        parent::__construct();
    }
    
    /**
	 * Test email functionality
	 */
	public function testmail() {
		$to = $this->input->get('to');
		
		// using PHP mailer
		echo 'sending email using PHP mailer...' . br();
		@mail($to, 'Test Email PHP Mail', 'This is test email using PHP mailer.');
		
		// using Swiftmailer
		echo 'sending email using Swiftmailer...' . br();
		$response = $this->smit_email->send_email_test($to);
		if(is_array($response)) {
			echo 'failed:' . br();
			var_dump($response);
		} else {
			echo 'success.';
		}
	}
    
    /**
	 * email format functionality
	 */
	public function emailtemplate() {
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
        ));

        $data['title']          = TITLE . 'Email Template';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'emailtemplate';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Send email selection success functionality
	 */
	public function emailselectionsuccess() {
        // Check Data Pra Incubation Selection
        $condition  = ' WHERE %step% = 1 AND %id% = 1';
        $order_by   = ' %id% ASC';
        $praincseldata  = $this->Model_Praincubation->get_all_praincubation(0,0,$condition,$order_by);
        if( !$praincseldata || empty($praincseldata) ){
            die('Tidak ada data seleksi step 1 yang belum dinilai oleh juri');
        }
       
        // Check Pra Incubation Setting
        $praincset     = smit_latest_praincubation_setting();
        if( !$praincset || empty($praincset) ){
            die('Tidak ada data pengaturan seleksi');
        }
        
        foreach($praincseldata as $row){
            /*
            $response = $this->smit_email->send_email_selection_success($praincset, $row);
            $response = $this->smit_email->send_email_selection_confirmation_step2($row);
            $response = $this->smit_email->send_email_selection_not_success_step1($praincset, $row);
            if(is_array($response)) {
    			echo 'failed:' . br();
    			var_dump($response);
    		} else {
    			echo 'success.';
    		}
            */
        }
	}
}

/* End of file Debug.php */
/* Location: ./application/controllers/Debug.php */