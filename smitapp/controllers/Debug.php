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
		//echo 'sending email using PHP mailer...' . br();
		//@mail($to, 'Test Email PHP Mail', 'This is test email using PHP mailer.');
		
		// using Swiftmailer
		echo 'sending email using Swiftmailer...' . br();
		//$response = $this->smit_email->send_email_test($to);
        $email      = 'radenrifalardiansyah@gmail.com';
        $username   = 'haryatidian';
        $name       = 'Haryati Dian Warsari';
        $password_global    = '123456';
        $type       = 'TENANT';
        $contact_name   = 'Putri';
        $contact_title  = 'TES EMAIL';
        $contact_desc   = 'Apakah email saya masuk ? ';
		$response   = $this->smit_email->send_email_contact( $to, $contact_name, $email, $contact_title, $contact_desc );
        $step       = 1;
        $response   = $this->smit_email->send_email_rated_confirmation( $to, $step );
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
    
    /**
	 * Update User Basic Type
	 */
	public function statusselection( $uniquecode, $selection ) {
        set_time_limit( 0 );
		$this->benchmark->mark('started');
        echo "<pre>";
        
        if($selection == "pra"){
            $selectiondata  = $this->Model_Praincubation->get_all_praincubation(0,0, " WHERE %uniquecode% LIKE '".$uniquecode."'");
            $selectiondata  = $selectiondata[0];
            $update_data    = $this->Model_Praincubation->update_data_praincubation($uniquecode, array('status' => 0));
        }else{
            $selectiondata  = $this->Model_Incubation->get_all_incubation(0,0, " WHERE %uniquecode% LIKE '".$uniquecode."'");
            $selectiondata  = $selectiondata[0];
            $update_data    = $this->Model_Incubation->update_data_incubation($uniquecode, array('status' => 0));
        }
        
        if( $update_data ){
            echo "Success";
        }else{
            echo "Failed";
        }
        
        $this->benchmark->mark('ended');
		$elapsed_time = $this->benchmark->elapsed_time('started', 'ended');

        echo br(2) . 'Elapsed Time: ' . $elapsed_time . ' seconds' . '</pre>';
	}
    
    /**
	 * Update User Basic Type
	 */
	public function basictype() {
        set_time_limit( 0 );
		$this->benchmark->mark('started');
        echo "<pre>";
        
        $users  = $this->Model_User->get_all();
        if( $users ){
            foreach( $users as $user ){
                $type   = $user->type;
                $role   = implode(',',array($type));
                
                $data_update = array('role' => $role);
                $this->Model_User->update_data($user->id, $data_update);
            }
        }
        
        $this->benchmark->mark('ended');
		$elapsed_time = $this->benchmark->elapsed_time('started', 'ended');

        echo br(2) . 'Elapsed Time: ' . $elapsed_time . ' seconds' . '</pre>';
	}
    
    public function getselection($uniquecode, $selection){
        set_time_limit( 0 );
		$this->benchmark->mark('started');
        echo "<pre>";
        
        $condition          = ' WHERE %uniquecode% = "'.$uniquecode.'"';
        if( $selection == "pra" ){
            $data_selection         = $this->Model_Praincubation->get_all_praincubation(0, 0, $condition, '');    
        }else{
            $data_selection         = $this->Model_Incubation->get_all_incubation(0, 0, $condition, '');
        }
        
        print_r($data_selection);
        
        $this->benchmark->mark('ended');
		$elapsed_time = $this->benchmark->elapsed_time('started', 'ended');

        echo br(2) . 'Elapsed Time: ' . $elapsed_time . ' seconds' . '</pre>';
    }
    
    public function setrateselection($selection_id, $selection){
        set_time_limit( 0 );
		$this->benchmark->mark('started');
        echo "<pre>";
        
        if( $selection == "pra" ){
            $data_selection         = $this->Model_Praincubation->get_praincubation($selection_id);
            $all_rate_total         = $this->Model_Praincubation->get_praincubation_rate_step1_total($selection_id);
            $all_rate_count         = $this->Model_Praincubation->get_praincubation_rate_step1_count($selection_id);
            $average_score          = round( ( $all_rate_total ) /  ( $all_rate_count ) );
            $data_selection_update  = array(
                'score'             => $all_rate_total,
                'average_score'     => $average_score,
            );
            $update_data            = $this->Model_Praincubation->update_data_praincubation($data_selection->id, $data_selection_update);    
        }else{
            $data_selection         = $this->Model_Incubation->get_incubation($selection_id);
            $all_rate_total         = $this->Model_Incubation->get_incubation_rate_step1_total($selection_id);
            $all_rate_count         = $this->Model_Incubation->get_incubation_rate_step1_count($selection_id);
            $average_score          = round( ( $all_rate_total ) /  ( $all_rate_count ) );
            $data_selection_update  = array(
                'score'             => $all_rate_total,
                'average_score'     => $average_score,
            );
            $update_data            = $this->Model_Praincubation->update_data_incubation($data_selection->id, $data_selection_update); 
        }
        
        if( !empty($update_data) ){
            print_r("Success = ".$average_score);    
        }else{
            print_r("Not Success");
        }
        
        $this->benchmark->mark('ended');
		$elapsed_time = $this->benchmark->elapsed_time('started', 'ended');

        echo br(2) . 'Elapsed Time: ' . $elapsed_time . ' seconds' . '</pre>';
    }
    
    /**
     * Test Function
     */
    public function test(){
        set_time_limit( 0 );
		$this->benchmark->mark('started');
        echo "<pre>";
        
        /*
        $tenant_list    = $this->Model_Tenant->get_all_tenant();
        if( !empty($tenant_list) ){
            foreach($tenant_list as $row){
                $name = $row->name_tenant;
                $data_update = array('slug' => smit_slug($name));
                $this->Model_Tenant->update_data($row->id, $data_update);
            }
        }
        */
        $selection_id           = 2;
        $all_rate_total         = $this->Model_Praincubation->get_praincubation_rate_step1_total($selection_id);
        $all_rate_count         = $this->Model_Praincubation->get_praincubation_rate_step1_count($selection_id);
        $average_score          = round( ( $all_rate_total ) /  ( $all_rate_count ) );
        

        print_r($average_score);
        die();
        
        $this->benchmark->mark('ended');
		$elapsed_time = $this->benchmark->elapsed_time('started', 'ended');

        echo br(2) . 'Elapsed Time: ' . $elapsed_time . ' seconds' . '</pre>';
    }
}

/* End of file Debug.php */
/* Location: ./application/controllers/Debug.php */