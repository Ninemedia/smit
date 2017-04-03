<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MY_Controller Class
 * @author Iqbal
 */
class SMIT_Controller extends CI_Controller
{
    /**
     * Current user
     * 
     * @since 1.0.0
     * @access protected
     * @var user
     */
    protected $user;

    function __construct()
    {
        parent::__construct();
        
        $ip_lost_permission = config_item('ip_lost_permission');
        if( is_coming_soon() ){
            if( !in_array($this->input->ip_address(), $ip_lost_permission) ){
                return $this->_coming_soon();
            }
        }
        
        if( is_maintenance() ){
            if( !in_array($this->input->ip_address(), $ip_lost_permission) ){
                return $this->_maintenance(); 
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Authenticates user
     * 
     * @since 1.0.0
     * @access protected
     * 
     * @param bool $admin. Authenticate admin? False by default.
     */
    protected function auth($admin = false)
    {
        // auth redirect
        auth_redirect();

        // get current user
        $this->user = smit_get_current_user();

        // authenticate admin access
        if ($admin && !as_administrator($this->user)) die('You have no sufficient permission to access this content!');
    }

    // --------------------------------------------------------------------

    protected function _no_access()
    {
        $this->auth(true);

        $current_user = $this->user;
        $is_admin = as_administrator($current_user);

        $data['title'] = TITLE . 'Tidak Ada Akses Ke Halaman Ini';
        $data['main_content'] = 'noaccess';
        $data['user'] = $current_user;
        $data['is_admin'] = $is_admin;

        $buffer = $this->load->view(VIEW_BACK . 'template', $data, true);

        $this->output->set_output($buffer);
        $this->output->_display();

        die();
    }

    // --------------------------------------------------------------------

    protected function _coming_soon()
    {
        $data['title'] = TITLE . 'Coming Soon';        
        $buffer = $this->load->view(VIEW_COMING_SOON . 'comingsoon', $data, true);
        
        $this->output->set_output($buffer);
        $this->output->_display();

        die();
    }

    // --------------------------------------------------------------------
    
    protected function _maintenance()
    {
        $data['title'] = TITLE . 'Maintenance';
        $buffer = $this->load->view(VIEW_MAINTENANCE . 'maintenance', $data, true);
        
        $this->output->set_output($buffer);
        $this->output->_display();

        die();
    }

    // --------------------------------------------------------------------
}
