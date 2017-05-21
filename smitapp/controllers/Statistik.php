<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Statistik Controller.
 * 
 * @class     Statistik
 * @author    Iqbal
 * @version   1.0.0
 * @copyright Copyright (c) 2017 SMIT (Sistem Manajemen Inkubasi Teknologi) (http://pusinov.lipi.go.id)
 */
class Statistik extends User_Controller {
    /**
	 * Constructor.
	 */
    function __construct()
    {       
        parent::__construct();
    }
    
    /**
	 * Profile function.
	 */
    function userchart(){
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // Morris Chart Plugin
            BE_PLUGIN_PATH . 'morrisjs/morris.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'morrisjs/morris.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'Charts.init();',
        ));

        // Chart
        $chart              = array();
        $chart['xkey']      = 'period';
        $chart['ykeys']     = array( 'total' );
        $chart['labels']    = array( 'Total' );

        if ( $users = $this->Model_User->stats_monthly() ) {
            // Pivoting table
			$pivot = array();
			foreach( $stats as $row ) {
				if ( ! isset( $pivot[ $row->period ] ) ) $pivot[ $row->period ] = array();
				if ( ! isset( $pivot[ $row->period ][ 'total' ] ) ) $pivot[ $row->period ][ 'total' ] = 0;
				
				$pivot[ $row->period ][ 'period_name' ] = $row->period_name;
				$pivot[ $row->period ][ 'total' ] += $row->total;
			}
            
            $i = 0; 
			$recap = array(
				'total' => 0
			);

            foreach( $pivot as $period => $row ) {
				$tr = array(
					jl_center( ++$i ),
					jl_center( $row['period_name'] ),
					jl_center( $row['total'] )
				);
				$this->table->add_row( $tr );
				$recap['total'] += $row['total'];
				
				// chart
				$chart['data'][] = array(
					'period'   => $period,
					'total'    => $row['total']
				);
			}
            
            if( count($chart['data']) == 1 ){
                $chart_to       = $chart['data'][0];
                $chart['data'][0] = array(
    				'period'   => $from,
    				'total'    => 0
    			);
                $chart['data'][1] = $chart_to;
            }
            
            // add recap row
			$this->table->add_row( 
                array( 
    				array( 'data' => '<strong>Total</strong>', 'colspan' => 2, 'class' => 'bg-teal' ),
    				array( 'data' => jl_center( '<strong>'. $recap['total'] . '</strong>' ), 'class' => 'bg-teal' ),
    			) 
            );
        }else{
            $this->table->add_row( array( 'data' => jl_center( 'No Data' ), 'colspan' => 3 ) );
            $chart['data'][] = array(
				'period'   => $from,
				'total'    => 0
			); 
            $chart['data'][] = array(
				'period'   => $to,
				'total'    => 0
			);
        }

        $data['title']          = TITLE . 'Statistik Pengguna';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['chart']			= json_encode( $chart );
        $data['main_content']   = 'statistik/userchart';
        
        $this->load->view(VIEW_BACK . 'template', $data);
    }
    
    // ---------------------------------------------------------------------------------------------
}

/* End of file Statistik.php */
/* Location: ./application/controllers/Statistik.php */