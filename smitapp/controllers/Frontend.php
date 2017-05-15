<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Frontend Controller.
 * 
 * @class     Frontend
 * @author    Iqbal
 * @version   1.0.0
 * @copyright Copyright (c) 2017 SMIT (Sistem Manajemen Inkubasi Teknologi) (http://pusinov.lipi.go.id)
 */
class Frontend extends Public_Controller {
    /**
	 * Constructor.
	 */
    function __construct()
    {       
        parent::__construct();
    }
    
    /**
    * Index function.
    */
    public function index(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';
        
        $data['title']          = TITLE . 'Home';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'home';
        $this->load->view(VIEW_FRONT . 'template', $data); 
    }
    
    // ---------------------------------------------------------------------------------------------
    // ABOOUT ME
    /**
	 * Profile function.
	 */
    function profile(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));

        $scripts_add            = '';
        $scripts_init           = '';
        
        $data['title']          = TITLE . 'Profil';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'aboutme/profile';
        
        
        
        $this->load->view(VIEW_FRONT . 'template', $data);
    }
    
    /**
	 * Services function.
	 */
    function services(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';
        
        $data['title']          = TITLE . 'Layanan';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'aboutme/services';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }
    
    /**
	 * Article function.
	 */
    function article(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';
        
        $data['title']          = TITLE . 'Artikel';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'aboutme/article';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }
    // ---------------------------------------------------------------------------------------------
    
    // ---------------------------------------------------------------------------------------------
    // INCUBATION
    /**
	 * Selection  Pra Incubation function.
	 */
    function selectionpraincubation(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            FE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
            FE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            FE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            FE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            FE_PLUGIN_PATH . 'momentjs/moment.js',
            FE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            FE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
            FE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            FE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            FE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            FE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            FE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            FE_PLUGIN_PATH . 'jquery-inputmask/jquery.inputmask.bundle.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
            FE_JS_PATH . 'pages/forms/form-validation.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'Guides.init();',
            'SelectionValidation.init();',
            'Selection.init();',
        ));
        
        $lss = smit_latest_praincubation_setting();
        
        $data['title']          = TITLE . 'Seleksi';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['lss']            = $lss;
        $data['main_content']   = 'incubation/selectionpraincubation';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }
    
    /**
	 * Selection Inkubation function.
	 */
    function selectionincubation(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            FE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
            FE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            FE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            FE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            FE_PLUGIN_PATH . 'momentjs/moment.js',
            FE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            FE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
            FE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            FE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            FE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            FE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            FE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            FE_PLUGIN_PATH . 'jquery-inputmask/jquery.inputmask.bundle.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
            FE_JS_PATH . 'pages/forms/form-validation.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'Guides.init();',
            'SelectionValidation.init();',
            'Selection.init();',
        ));
        
        $data['title']          = TITLE . 'Pendaftaran Tenant';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'incubation/selectionincubation';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }
    
    /**
	 * Incubation Selection Function
	 */
	public function incubationselection()
	{
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        
        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        
        $username               = $this->input->post('reg_username');
        $username               = trim( smit_isset($username, "") );
        $password               = $this->input->post('reg_password');
        $password               = trim( smit_isset($password, "") );
        $event_title            = $this->input->post('reg_event_title');
        $event_title            = trim( smit_isset($event_title, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );
        $name                   = $this->input->post('reg_name');
        $name                   = trim( smit_isset($name, "") );
        $category               = $this->input->post('reg_category');
        $category               = trim( smit_isset($category, "") );
        $agree                  = $this->input->post('reg_agree');
        $agree                  = trim( smit_isset($agree, "") );
        
        echo '<pre>';
        print_r($_POST);
        die();

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_username','Username Pengguna','required');
        $this->form_validation->set_rules('reg_password','Password Pengguna','required');
        $this->form_validation->set_rules('reg_event_title','Judul Kegiatan','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi Kegiatan','required');
        $this->form_validation->set_rules('reg_name','Nama Peneliti Utama','required');
        $this->form_validation->set_rules('reg_category','Kategori Bidang','required');
        $this->form_validation->set_rules('reg_agree','Setuju Pada Ketentuan','required');
        
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');
        
        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran pengguna baru tidak berhasil. '.validation_errors().''); 
            die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Check Agreement
        // -------------------------------------------------
        if( $agree != 'on' ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Anda harus menyetujui persyaratan formulir ini.'); 
            die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Check User Login
        // -------------------------------------------------
        $userdata               = $this->Model_User->get_user_by('login', $username);
        $this->Model_User->decode_password( $userdata );
        $is_admin               = as_administrator($userdata);
        if( $is_admin ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Administrator tidak perlu melakukan pendaftaran Seleksi Inkubasi.'); 
            die(json_encode($data));
        }
        if( md5( $password ) != md5( $userdata->password ) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Password yang Anda masukkan salah.'); 
            die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Check User Selection
        // -------------------------------------------------
        // Check if username has been registeren on incubation selection
        $user_selection = $this->Model_Incubation->get_incubation_by('userid',$userdata->id);
        if( $user_selection || !empty($user_selection) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Username sudah terdaftar dalam seleksi inkubasi. Anda hanya bisa mendaftar seleksi 1 kali dalam 1 periode seleksi.'); 
            die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Check Agreement
        // -------------------------------------------------
        $incset     = smit_latest_incubation_setting();
        if( !$incset || empty($incset) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada data pengaturan seleksi');
            // JSON encode data
            die(json_encode($data));
        }
        if( $incset->status == 0 ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pengaturan seleksi sudah ditutup');
            // JSON encode data
            die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        if( empty($_FILES['reg_selection_files']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada berkas panduan yang di unggah. Silahkan inputkan berkas panduan!'); 
            die(json_encode($data));
        }
        
        if( !empty( $_POST ) ){
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/praincubationselection/' . $userdata->id;
            if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }
                
            $config = array(
                'upload_path'   => $upload_path,
                'allowed_types' => "doc|docx|pdf|xls|xlsx",
                'overwrite'     => FALSE,
                'max_size'      => "2048000",
                'multi'         => 'all' 
            );
            
            $this->upload->initialize($config);
                
            if( ! $this->upload->do_upload('reg_selection_files') ){
                $message = $this->upload->display_errors();
                
                // Set JSON data
                $data = array('message' => 'error','data' => $this->upload->display_errors()); 
                die(json_encode($data));
            }
            
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();
            
            $upload_data    = $this->upload->data();
            $incubationselection_data     = array(
                'uniquecode'    => smit_generate_rand_string(10,'low'),
                'setting_id'    => $incset->id,
                'user_id'       => $userdata->id,
                'username'      => strtolower($username),
                'name'          => $name,
                'event_title'   => $event_title,
                'event_desc'    => $description,
                'category'      => $category,
                'url'           => smit_isset($upload_data['full_path'],''),
                'extension'     => substr(smit_isset($upload_data['file_ext'],''),1),
                'filename'      => smit_isset($upload_data['raw_name'],''),
                'size'          => smit_isset($upload_data['file_size'],0),
                'uploader'      => $userdata->id,
                'step'          => ONE,
                'status'        => NONACTIVE,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate,
            );
                    
            // -------------------------------------------------
            // Save Incubation Selection
            // -------------------------------------------------
            $trans_save_incubation      = FALSE;
            if( $incubation_save_id     = $this->Model_Incubation->save_data_incubation_selection($incubationselection_data) ){
                $trans_save_incubation  = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran seleksi inkubasi tidak berhasil. Terjadi kesalahan data formulir anda'); 
                die(json_encode($data));
            }
                    
            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_incubation ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pendaftaran tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();
                    
                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran selesi inkubasi baru berhasil!'); 
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'INCUBATION_REG', 'SUCCESS', maybe_serialize(array('username'=>$username, 'url'=> smit_isset($upload_data['full_path'],''))) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran tidak berhasil. Terjadi kesalahan data.'); 
                die(json_encode($data)); 
            } 
        }
	}
    
    /**
	 * Incubation Selection Function
	 */
	public function praincubationselection()
	{
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        
        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        $upload_data            = array();
        
        $username               = $this->input->post('reg_username');
        $username               = trim( smit_isset($username, "") );
        $password               = $this->input->post('reg_password');
        $password               = trim( smit_isset($password, "") );
        $event_title            = $this->input->post('reg_event_title');
        $event_title            = trim( smit_isset($event_title, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );
        $name                   = $this->input->post('reg_name');
        $name                   = trim( smit_isset($name, "") );
        $category               = $this->input->post('reg_category');
        $category               = trim( smit_isset($category, "") );
        $agree                  = $this->input->post('reg_agree');
        $agree                  = trim( smit_isset($agree, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_username','Username Pengguna','required');
        $this->form_validation->set_rules('reg_password','Password Pengguna','required');
        $this->form_validation->set_rules('reg_event_title','Judul Kegiatan','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi Kegiatan','required');
        $this->form_validation->set_rules('reg_name','Nama Peneliti Utama','required');
        $this->form_validation->set_rules('reg_category','Kategori Bidang','required');
        $this->form_validation->set_rules('reg_agree','Setuju Pada Ketentuan','required');
        
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');
        
        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran pengguna baru tidak berhasil. '.validation_errors().''); 
            die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Check Agreement
        // -------------------------------------------------
        if( $agree != 'on' ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Anda harus menyetujui persyaratan formulir ini.'); 
            die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Check User Login
        // -------------------------------------------------
        $userdata               = $this->Model_User->get_user_by('login', $username);
        $this->Model_User->decode_password( $userdata );
        $is_admin               = as_administrator($userdata);
        if( $is_admin ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Administrator tidak perlu melakukan pendaftaran Seleksi Pra-Inkubasi.'); 
            die(json_encode($data));
        }
        if( md5( $password ) != md5( $userdata->password ) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Password yang Anda masukkan salah.'); 
            die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Check User Selection
        // -------------------------------------------------
        // Check if username has been registeren on incubation selection
        $user_selection = $this->Model_Praincubation->get_praincubation_by('userid',$userdata->id);
        if( $user_selection || !empty($user_selection) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Username sudah terdaftar dalam seleksi pra-inkubasi. Anda hanya bisa mendaftar seleksi 1 kali dalam 1 periode seleksi.'); 
            die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Check Agreement
        // -------------------------------------------------
        $incset     = smit_latest_praincubation_setting();
        if( !$incset || empty($incset) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada data pengaturan seleksi');
            // JSON encode data
            die(json_encode($data));
        }
        if( $incset->status == 0 ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pengaturan seleksi sudah ditutup');
            // JSON encode data
            die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        if( empty($_FILES['reg_selection_files']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada berkas panduan yang di unggah. Silahkan inputkan berkas panduan!'); 
            die(json_encode($data));
        }

        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            $praincubationselection_data = array(
                'uniquecode'    => smit_generate_rand_string(10,'low'),
                'setting_id'    => $incset->id,
                'user_id'       => $userdata->id,
                'username'      => strtolower($username),
                'name'          => $name,
                'event_title'   => $event_title,
                'event_desc'    => $description,
                'category'      => $category,
                'step'          => ONE,
                'status'        => NONACTIVE,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate,
            );

            // -------------------------------------------------
            // Save Incubation Selection
            // -------------------------------------------------
            $trans_save_praincubation       = FALSE;
            if( $praincubation_save_id      = $this->Model_Praincubation->save_data_praincubation_selection($praincubationselection_data) ){
                $trans_save_praincubation   = TRUE;
                
                // Upload Files Process
                $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/praincubationselection/' . $userdata->id;
                if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }
                    
                $config = array(
                    'upload_path'       => $upload_path,
                    'allowed_types'     => "doc|docx|pdf|xls|xlsx",
                    'overwrite'         => FALSE,
                    'max_size'          => "2048000",
                );
                $this->load->library('MY_Upload', $config);
                    
                if( ! $this->my_upload->do_upload('reg_selection_files') ){
                    $message = $this->my_upload->display_errors();
                    
                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->my_upload->display_errors()); 
                    die(json_encode($data));
                }
                
                $upload_data    = $this->my_upload->data();
                
                if( !empty($upload_data) ){
                    if( smit_isset($upload_data[0]) ){
                        foreach($upload_data as $file){
                            // Set File Upload Save
                            $praincubationselectionfiles_data = array(
                                'uniquecode'    => smit_generate_rand_string(10,'low'),
                                'selection_id'  => $praincubation_save_id,
                                'user_id'       => $userdata->id,
                                'username'      => strtolower($username),
                                'name'          => $name,
                                'url'           => smit_isset($file['full_path'],''),
                                'extension'     => substr(smit_isset($file['file_ext'],''),1),
                                'filename'      => smit_isset($file['raw_name'],''),
                                'size'          => smit_isset($file['file_size'],0),
                                'status'        => ACTIVE,
                                'datecreated'   => $curdate,
                                'datemodified'  => $curdate,
                            );
                            if( !$this->Model_Praincubation->save_data_praincubation_selection_files($praincubationselectionfiles_data) ){
                                continue;
                            }
                        }
                    }else{
                        // Set File Upload Save
                        $file = $upload_data;
                        $praincubationselectionfiles_data = array(
                            'uniquecode'    => smit_generate_rand_string(10,'low'),
                            'selection_id'  => $praincubation_save_id,
                            'user_id'       => $userdata->id,
                            'username'      => strtolower($username),
                            'name'          => $name,
                            'url'           => smit_isset($file['full_path'],''),
                            'extension'     => substr(smit_isset($file['file_ext'],''),1),
                            'filename'      => smit_isset($file['raw_name'],''),
                            'size'          => smit_isset($file['file_size'],0),
                            'status'        => ACTIVE,
                            'datecreated'   => $curdate,
                            'datemodified'  => $curdate,
                        );
                        if( !$this->Model_Praincubation->save_data_praincubation_selection_files($praincubationselectionfiles_data) ){
                            continue;
                        }
                    }
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran seleksi pra-inkubasi tidak berhasil. Terjadi kesalahan data formulir anda'); 
                die(json_encode($data));
            }
            
            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_praincubation ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pendaftaran tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();
                    
                    // Send Email Notification
                    $this->smit_email->send_email_regitration_selection($userdata->email, $event_title);
                    
                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran selesi pra-inkubasi baru berhasil!'); 
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'PRAINCUBATION_REG', 'SUCCESS', maybe_serialize(array('username'=>$username, 'upload_files'=> $upload_data)) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran tidak berhasil. Terjadi kesalahan data.'); 
                die(json_encode($data)); 
            } 
        }
	}
    
    // ---------------------------------------------------------------------------------------------
    
    // ---------------------------------------------------------------------------------------------
    // TENANT
    /**
	 * List Tenant function.
	 */
    function listtenant(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';
        
        $data['title']          = TITLE . 'Daftar Tenant';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/list';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }
    
    /**
	 * Product Tenant function.
	 */
    function producttenant(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';
        
        $data['title']          = TITLE . 'Produk Tenant';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/product';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }
    
    /**
	 * Facilities Tenant function.
	 */
    function fasilitiestenant(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';
        
        $data['title']          = TITLE . 'Fasilitas Tenant';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/fasilities';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }
    
    /**
	 * Blog Tenant function.
	 */
    function blogtenant(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';
        
        $data['title']          = TITLE . 'Blog Tenant';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/blog';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }
    
    /**
	 * Kategori Blog Tenant function.
	 */
    function blogcategory(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';
        
        $data['title']          = TITLE . 'Kategori Blog Tenant';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/category';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }
    // ---------------------------------------------------------------------------------------------
    
    // ---------------------------------------------------------------------------------------------
    // INFORMATION
    /**
	 * Guide function.
	 */
    function guide(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            //FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            FE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            FE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            
            // DataTable Plugin
            FE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            FE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            FE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            
            // Datetime Picker Plugin
            FE_PLUGIN_PATH . 'momentjs/moment.js',
            FE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Bootbox Plugin
            FE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
            
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
            FE_JS_PATH . 'pages/tables/table-ajax.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();'
        ));
        
        $data['title']          = TITLE . 'Panduan';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'information/guide';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }
    
    /**
	 * Guides list data function.
	 */
    function guidelistdata(){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = '';
        
        $order_by           = '';
        $iTotalRecords      = 0;
        
        $iDisplayLength     = intval($_REQUEST['iDisplayLength']); 
        $iDisplayStart      = intval($_REQUEST['iDisplayStart']);
        
        $sAction            = smit_isset($_REQUEST['sAction'],'');
        $sEcho              = intval($_REQUEST['sEcho']);
        $sort               = $_REQUEST['sSortDir_0'];
        $column             = intval($_REQUEST['iSortCol_0']);
        
        $limit              = ( $iDisplayLength == '-1' ? 0 : $iDisplayLength );
        $offset             = $iDisplayStart;
        
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_desc             = $this->input->post('search_desc');
        $s_desc             = smit_isset($s_desc, '');
        
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_desc) )           { $condition .= str_replace('%s%', $s_desc, ' AND %description% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%title% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%description% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%datecreated% ' . $sort; }
        
        $guides_list        = $this->Model_Guide->get_all_guides($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($guides_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            
            $i = $offset + 1;
            foreach($guides_list as $row){
                if( !empty( $row->url ) ){
                    $btn_files  = '<a href="'.base_url('unduhberkas/'.$row->uniquecode).'" 
                    class="inact btn btn-xs btn-default waves-effect tooltips bottom5" data-placement="left" title="Unduh Berkas"><i class="material-icons">file_download</i></a> ';    
                }else{
                    $btn_files  = ' - ';
                }
                $records["aaData"][] = array(
                    smit_center($i),
                    '<a href="'.base_url('guidefiles/'.$row->id).'">' . $row->title . '</a>',
                    $row->description,
                    smit_center( $btn_files ),
                    smit_center( date('Y-m-d', strtotime($row->datecreated)) ),
                    '',
                );
                $i++;
            }   
        }
        
        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;
        
        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;
        
        echo json_encode($records);
    }
    
    /**
	 * Guides Download File function.
	 */
    function guidesdownloadfile($uniquecode){
        if ( !$uniquecode ){
            redirect( current_url() );
        }
        
        // Check Guide File Data
        $guidedata  = $this->Model_Guide->get_guide_by('uniquecode',$uniquecode);
        if( !$guidedata || empty($guidedata) ){
            redirect( current_url() );
        }

        $file_name      = $guidedata->name . '.' . $guidedata->extension;
        $file_url       = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/guide/' . $guidedata->uploader . '/' . $file_name;
        
        force_download($file_name, $file_url);
    }
    
    /**
	 * Pra Incubation Download File function.
	 */
    function praincubationdownloadfile($uniquecode){
        if ( !$uniquecode ){
            redirect( current_url() );
        }
        
        // Check Guide File Data
        $praincubation_files    = $this->Model_Praincubation->get_all_praincubation_files('', '', ' WHERE uniquecode = "'.$uniquecode.'"', '');
        $praincubation_files    = $praincubation_files[0];
        if( !$praincubation_files || empty($praincubation_files) ){
            redirect( current_url() );
        }

        $file_name      = $praincubation_files->filename . '.' . $praincubation_files->extension;
        $file_url       = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/praincubationselection/' . $praincubation_files->uploader . '/' . $file_name;
        
        force_download($file_name, $file_url);
    }
    
    /**
	 * Announcement Incubation function.
	 */
    function announcement(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            //FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            FE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            FE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            
            // DataTable Plugin
            FE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            FE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            FE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            
            // Datetime Picker Plugin
            FE_PLUGIN_PATH . 'momentjs/moment.js',
            FE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Bootbox Plugin
            FE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
            
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
            FE_JS_PATH . 'pages/tables/table-ajax.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();'
        ));
        
        $data['title']          = TITLE . 'Pengumuman';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'information/announcement';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }
    
    /**
	 * Announcement List Data function.
	 */
    function announcementlistdata(){
        $condition          = '';
        $order_by           = '';
        $iTotalRecords      = 0;
        
        $iDisplayLength     = intval($_REQUEST['iDisplayLength']); 
        $iDisplayStart      = intval($_REQUEST['iDisplayStart']);
        
        $sAction            = smit_isset($_REQUEST['sAction'],'');
        $sEcho              = intval($_REQUEST['sEcho']);
        $sort               = $_REQUEST['sSortDir_0'];
        $column             = intval($_REQUEST['iSortCol_0']);
        
        $limit              = ( $iDisplayLength == '-1' ? 0 : $iDisplayLength );
        $offset             = $iDisplayStart;
        
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%title% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%datecreated% ' . $sort; }
        
        if( !empty($condition) ){
            $condition      = substr($condition, 4);
            $condition      = ' WHERE' . $condition;
        }
        
        $announcement_list  = $this->Model_Announcement->get_all_announcements($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($announcement_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $i = $offset + 1;
            foreach($announcement_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('informasi/pengumuman/'.$row->uniquecode).'" 
                    class="announcementdetails btn btn-xs btn-primary waves-effect tooltips" data-placement="left" title="Details">Details</a> ';

                $records["aaData"][] = array(
                    smit_center($i),
                    '<a href="'.base_url('informasi/pengumuman/'.$row->uniquecode).'"><strong>' . strtoupper($row->title) . '</strong></a>',
                    smit_center( $row->datecreated ),
                    smit_center($btn_action),
                );
                $i++;
            }   
        }
        
        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;
        
        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;
        
        echo json_encode($records);
    }
    
    /**
    * Announcement Details function.
    */
    public function announcementdetails( $uniquecode='' ){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';
        $announcementdata       = '';
        
        if( !empty($uniquecode) ){
            $announcementdata   = $this->Model_Announcement->get_announcement_by_uniquecode($uniquecode);
        }
        
        $data['title']          = TITLE . 'Detail Pengumuman';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['announ_data']    = $announcementdata;
        $data['main_content']   = 'information/announcementdetails';
        $this->load->view(VIEW_FRONT . 'template', $data); 
    }
    // ---------------------------------------------------------------------------------------------
    
    // ---------------------------------------------------------------------------------------------
    // STATISTIC
    /**
	 * Statistic function.
	 */
    function statistic(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';
        
        $data['title']          = TITLE . 'Statistik';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'statistic';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }
    // ---------------------------------------------------------------------------------------------
    
    // ---------------------------------------------------------------------------------------------
    // CONTACT
    /**
	 * Contact function.
	 */
    function contact(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';
        
        $data['title']          = TITLE . 'Kontak';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'contact';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }
    // ---------------------------------------------------------------------------------------------
    
    /**
	 * Event function.
	 */
    function event(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';
        
        $data['title']          = TITLE . 'Kegiatan';
        $data['main_content']   = 'event';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $this->load->view(VIEW_FRONT . 'template', $data);
    }
    
}

/* End of file Frontend.php */
/* Location: ./application/controllers/Frontend.php */