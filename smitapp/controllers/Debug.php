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
    
    public function test( $id=0 ){
        set_time_limit(0);
    	$this->benchmark->mark('started');
        echo "<pre>";
        
        //$province   = smit_cities($id);
        //$religion            = smit_religion();
        $rand           = smit_generate_no_announcement(1, 'charup');
        print_r($rand);
        die();
        foreach($province as $c){
            print_r($c);
        }
        
        
        $this->benchmark->mark('ended');
		echo br() . 'Elapsed Time ' . $this->benchmark->elapsed_time('started', 'ended') . '</pre>';
        
    }
}

/* End of file Debug.php */
/* Location: ./application/controllers/Debug.php */