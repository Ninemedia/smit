<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Tenant Controller.
 *
 * @class     Tenant
 * @author    Iqbal
 * @version   1.0.0
 * @copyright Copyright (c) 2017 SMIT (Sistem Manajemen Inkubasi Teknologi) (http://pusinov.lipi.go.id)
 */
class Tenant extends User_Controller {
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
	public function index()
	{
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
            // Put script based on current page
        ));

        $scripts_add            = '';
        $scripts_init           = '';

        $data['title']          = TITLE . 'Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant';

		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    // ---------------------------------------------------------------------------------------------
    // TENANT
    /**
	 * Blog Tenant function.
	 */
	public function tenantblogs()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $headstyles             = smit_headstyles(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            // Input Mask Plugin
            BE_PLUGIN_PATH . 'jquery-inputmask/jquery.inputmask.bundle.js',

            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'UploadFiles.init();',
            'TenantValidation.init();',
        ));

        $data['title']          = TITLE . 'Blog Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/blogs';

		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
    * Tenant Details function.
    */
    public function tenantdetails( $uniquecode='' ){
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $headstyles             = smit_headstyles(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
        ));

        $loadscripts            = smit_scripts(array(
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',

            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));

        $scripts_add            = '';
        $scripts_init           = '';
        $newsdata               = '';

        if( !empty($uniquecode) ){
            $tenantdata         = $this->Model_Tenant->get_all_blogtenant(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $tenantdata        = $tenantdata[0];
        }

        if($tenantdata){
            $file_name      = $tenantdata->filename . '.' . $tenantdata->extension;
            $file_url       = BE_UPLOAD_PATH . 'tenantblog/'. $tenantdata->user_id . '/' . $file_name;
            $tenant_image   = $file_url;
        }else{
            $tenant_image  = BE_IMG_PATH . 'news/noimage.jpg';
        }

        $data['title']          = TITLE . 'Tenant Detail';
        $data['tenantdata']     = $tenantdata;
        $data['tenant_image']   = $tenant_image;
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/blogsdetail';

        $this->load->view(VIEW_BACK . 'template', $data);
    }

    /**
    * Tenant Edit function.
    */
    public function tenantedit( $uniquecode='' ){
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $headstyles             = smit_headstyles(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',

            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
            BE_JS_PATH . 'pages/forms/editors.js',
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'UploadFiles.init();',
            'ProductValidation.init();',
        ));

        $tenantdata             = '';
        if( !empty($uniquecode) ){
            $tenantdata         = $this->Model_Tenant->get_all_blogtenant(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $tenantdata         = $tenantdata[0];
        }

        if($tenantdata){
            $file_name      = $tenantdata->filename . '.' . $tenantdata->extension;
            $file_url       = BE_UPLOAD_PATH . 'tenantblog/'. $tenantdata->user_id . '/' . $file_name;
            $tenant_image   = $file_url;
        }else{
            $tenant_image  = BE_IMG_PATH . 'news/noimage.jpg';
        }

        $data['title']          = TITLE . 'Tenant Detail';
        $data['tenantdata']     = $tenantdata;
        $data['tenant_image']   = $tenant_image;
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/blogsedit';

        $this->load->view(VIEW_BACK . 'template', $data);
    }

    /**
	 * Blog Tenant Edit Function
	 */
	public function blogtenantedit()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        $upload_data            = array();

        $uniquecode             = $this->input->post('reg_uniquecode');
        $uniquecode             = trim( smit_isset($uniquecode, "") );
        $event                  = $this->input->post('reg_event');
        $event                  = trim( smit_isset($event, "") );
        $event_title            = $this->input->post('reg_title');
        $event_title            = trim( smit_isset($event_title, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_title','Judul Produk','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi Produk','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah Kegiatan Pra-Inkubasi baru tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        /*
        if( empty($_FILES['reg_thumbnail']['name']) ){
            $data = array('message' => 'error','data' => 'Tidak ada thumbnail yang di unggah. Silahkan inputkan thumbnail gambar!');
            die(json_encode($data));
        }

        if( empty($_FILES['reg_details']['name']) ){
            $data = array('message' => 'error','data' => 'Tidak ada details gambar yang di unggah. Silahkan inputkan details gambar kegiatan!');
            die(json_encode($data));
        }
        */

        $tenantdata             = '';
        if( !empty($uniquecode) ){
            $tenantdata        = $this->Model_Tenant->get_all_blogtenant(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $tenantdata        = $tenantdata[0];
        }

        $file_name      = $tenantdata->filename . '.' . $tenantdata->extension;
        $file_url       = BE_UPLOAD_PATH . 'tenantblog/'. $tenantdata->user_id . '/' . $file_name;
        $product_image  = $file_url;

        $thumbnail_file_name      = $tenantdata->thumbnail_filename . '.' . $tenantdata->thumbnail_extension;
        $thumbnail_file_url       = BE_UPLOAD_PATH . 'tenantblog/'. $tenantdata->user_id . '/' . $thumbnail_file_name;
        $thumbnail_product_image  = $thumbnail_file_url;

        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            // Upload Files Process
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/tenantblog/' . $tenantdata->user_id;
            if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

            $config = array(
                'upload_path'       => $upload_path,
                'allowed_types' => "jpg|jpeg|png",
                'overwrite'         => FALSE,
                'max_size'          => "2048000",
            );
            $this->load->library('MY_Upload', $config);

            $file_thumbnail     = '';
            if( !empty($_FILES['reg_thumbnail']['name']) ){
                //unlink($thumbnail_product_image);

                if( ! $this->my_upload->do_upload('reg_thumbnail') ){
                    $message = $this->my_upload->display_errors();

                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                    die(json_encode($data));
                }
                $upload_data_thumbnail  = $this->my_upload->data();
                $upload_thumbnail       = $upload_data_thumbnail['raw_name'] . $upload_data_thumbnail['file_ext'];
                $this->image_moo->load($upload_path . '/' .$upload_data_thumbnail['file_name'])->resize_crop(800,600)->save($upload_path. '/' .$upload_thumbnail, TRUE);
                $this->image_moo->clear();
                $file_thumbnail         = $upload_data_thumbnail;
            }

            $file_details       = '';
            if( !empty($_FILES['reg_details']['name']) ){
                //unlink($product_image);

                if( ! $this->my_upload->do_upload('reg_details') ){
                    $message = $this->my_upload->display_errors();

                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                    die(json_encode($data));
                }
                $upload_data_details    = $this->my_upload->data();
                $upload_file            = $upload_data_details['raw_name'] . $upload_data_details['file_ext'];
                $this->image_moo->load($upload_path . '/' .$upload_data_details['file_name'])->resize_crop(1346,400)->save($upload_path. '/' .$upload_file, TRUE);
                $this->image_moo->clear();
                $file_details           = $upload_data_details;
            }

            if( !empty($file_thumbnail) && !empty($file_details) ){
                $tenant_data            = array(
                    'title'             => $event_title,
                    'description'       => $description,
                    'url'               => smit_isset($file_details['full_path'],''),
                    'extension'         => substr(smit_isset($file_details['file_ext'],''),1),
                    'filename'          => smit_isset($file_details['raw_name'],''),
                    'size'              => smit_isset($file_details['file_size'],0),
                    'thumbnail_url'           => smit_isset($file_thumbnail['full_path'],''),
                    'thumbnail_extension'     => substr(smit_isset($file_thumbnail['file_ext'],''),1),
                    'thumbnail_filename'      => smit_isset($file_thumbnail['raw_name'],''),
                    'thumbnail_size'          => smit_isset($file_thumbnail['file_size'],0),
                    'datecreated'       => $curdate,
                    'datemodified'      => $curdate,
                );
            }elseif( !empty($file_thumbnail) ){
                $tenant_data           = array(
                    'title'             => $event_title,
                    'description'       => $description,
                    'thumbnail_url'           => smit_isset($file_thumbnail['full_path'],''),
                    'thumbnail_extension'     => substr(smit_isset($file_thumbnail['file_ext'],''),1),
                    'thumbnail_filename'      => smit_isset($file_thumbnail['raw_name'],''),
                    'thumbnail_size'          => smit_isset($file_thumbnail['file_size'],0),
                    'datecreated'       => $curdate,
                    'datemodified'      => $curdate,
                );
            }elseif( !empty($file_details) ){
                $tenant_data           = array(
                    'title'             => $event_title,
                    'description'       => $description,
                    'url'               => smit_isset($file_details['full_path'],''),
                    'extension'         => substr(smit_isset($file_details['file_ext'],''),1),
                    'filename'          => smit_isset($file_details['raw_name'],''),
                    'size'              => smit_isset($file_details['file_size'],0),
                    'datecreated'       => $curdate,
                    'datemodified'      => $curdate,
                );
            }else{
                $tenant_data           = array(
                    'title'             => $event_title,
                    'description'       => $description,
                    'datecreated'       => $curdate,
                    'datemodified'      => $curdate,
                );
            }

            // -------------------------------------------------
            // Edit Incubation Selection
            // -------------------------------------------------
            $trans_edit_blog          = FALSE;
            if( $blog_edit_id      = $this->Model_Tenant->update_blogtenant($uniquecode, $tenant_data) ){
                $trans_edit_blog   = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Ubah blog tenant tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_edit_blog ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Ubah tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();

                    // Send Email Notification
                    //$this->smit_email->send_email_registration_selection($userdata->email, $event_title);

                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Ubah blog tenant baru berhasil!');
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'BLOGEDIT_REG', 'SUCCESS', maybe_serialize(array('username'=>$username, 'upload_files'=> $upload_data)) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Ubah blog tenant tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }
        }
	}

    /**
	 * List Selection Tenant function.
	 */
	public function tenantlist()
	{
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
            // Put script based on current page
        ));

        $scripts_add            = '';
        $scripts_init           = '';

        $data['title']          = TITLE . 'Daftar Seleksi Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/list';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Data Tenant function.
	 */
	public function tenantdata()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Input Mask Plugin
            BE_PLUGIN_PATH . 'jquery-inputmask/jquery.inputmask.bundle.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/editors.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'Tenant.init();',
            'UploadFiles.init();',
            'TenantValidation.init();',
        ));

        $data['title']          = TITLE . 'Daftar Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/tenantdata';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Tenant list data function.
	 */
    function tenantlistdata( ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = ' WHERE %status% <> 3';
        if( !$is_admin ){
            $condition      = ' WHERE %user_id% = '.$current_user->id.' AND %status% <> 3';
        }

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

        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_event            = $this->input->post('search_event');
        $s_event            = smit_isset($s_year, '');
        $s_name_tenant      = $this->input->post('search_name_tenant');
        $s_name_tenant      = smit_isset($$s_name_tenant, '');
        $s_position         = $this->input->post('search_position');
        $s_position         = smit_isset($s_position, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');
        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_name_tenant) )    { $condition .= str_replace('%s%', $s_name, ' AND %name_tenant% LIKE "%%s%%"'); }
        if( !empty($s_position) )       { $condition .= str_replace('%s%', $s_position, ' AND %postion% = %s%'); }
        if( !empty($s_event) )          { $condition .= str_replace('%s%', $s_year, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $is_admin ){
            if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
            elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%event_title% ' . $sort; }
            elseif( $column == 4 )  { $order_by .= '%name_tenant% ' . $sort; }
            elseif( $column == 5 )  { $order_by .= '%postion% ' . $sort; }
            elseif( $column == 6 )  { $order_by .= '%status% ' . $sort; }
            elseif( $column == 7 )  { $order_by .= '%datecreated% ' . $sort; }
        }else{
            if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
            elseif( $column == 2 )  { $order_by .= '%event_title% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%name_tenant% ' . $sort; }
            elseif( $column == 4 )  { $order_by .= '%postion% ' . $sort; }
            elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
            elseif( $column == 6 )  { $order_by .= '%datecreated% ' . $sort; }
        }

        $tenant_list        = $this->Model_Tenant->get_all_tenant($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();

        if( !empty($tenant_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status');

            $i = $offset + 1;
            foreach($tenant_list as $row){
                // Button & Status
                $btn_confirm    = '';
                if( !empty($is_admin) ){
                    if( $row->status == NONACTIVE ){
                        $btn_confirm    = '<a href="'.base_url('tenants/konfirmasi/active/'.$row->user_id).'"
                            class="tenantconfirm btn btn-xs btn-success waves-effect tooltips bottom5" data-placement="left" id="tenantconfirm" title="Konfirmasi"><i class="material-icons">done</i></a> ';
                    }
                }

                $btn_team       = '';
                if( $row->status != NONACTIVE ){
                    $btn_team       = '<a href="'.base_url('tenants/tambahtim/'.$row->uniquecode).'"
                        class="inact btn btn-xs btn-defaukt waves-effect tooltips bottom5" data-placement="left" title="Tambah Tim"><i class="material-icons">group</i></a> ';
                }
                $btn_action     = '<a href="'.base_url('tenants/detail/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-primary waves-effect tooltips bottom5" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';

                if($row->status == ACTIVE)          { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == NONACTIVE)   { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == BANNED)      { $status = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == DELETED)     { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }

                if($row->position == ACTIVE)            { $position = '<span class="label label-success">'.strtoupper('INWALL').'</span>'; }
                elseif($row->position == NONACTIVE)     { $position = '<span class="label label-default">'.strtoupper('OUTWALL').'</span>'; }
                elseif($row->position == GRADUATE)      { $position = '<span class="label label-primary">'.strtoupper('GRADUATE').'</span>'; }

                $event_title        = $row->event_title;
                if(empty($event_title)){
                    $event_title    = "<span style='color: red;'>Tidak Ada data</span>";
                }
                if( $is_admin ){
                    $records["aaData"][] = array(
                        smit_center('<input name="tenantlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                        <label for="cblist'.$row->uniquecode.'"></label>'),
                        smit_center( $i ),
                        smit_center( $row->year_tenant ),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper( $row->name ) . '</a>',
                        strtoupper( $event_title ),
                        '<strong>'.strtoupper( $row->name_tenant ).'</strong>',
                        smit_center( $position ),
                        smit_center( $status ),
                        smit_center( $btn_action . ' ' . $btn_team ),
                    );
                }else{
                    $records["aaData"][] = array(
                        //smit_center('<input name="tenantlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                        //<label for="cblist'.$row->uniquecode.'"></label>'),
                        smit_center( $i ),
                        smit_center( $row->year_tenant ),
                        strtoupper( $event_title ),
                        '<strong>'.strtoupper( $row->name_tenant ).'</strong>',
                        smit_center( $position ),
                        smit_center( $status ),
                        smit_center( $btn_action . ' ' . $btn_team ),
                    );
                }
                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $tenantlist             = $_REQUEST['tenantlist'];

            $proses                 = $this->tenantlistproses($sGroupActionName, $tenantlist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
    * Tenant List Details function.
    */
    public function tenantlistdetails( $uniquecode='' ){
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Input Mask Plugin
            BE_PLUGIN_PATH . 'jquery-inputmask/jquery.inputmask.bundle.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/editors.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'Tenant.init();',
            'TableAjax.init();',
            'TenantValidation.init();'
        ));

        if( !empty($uniquecode) ){
            $tenantdata         = $this->Model_Tenant->get_all_tenant(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $tenantdata         = $tenantdata[0];
        }

        if($tenantdata->uploader != 0){
            $file_name          = $tenantdata->filename . '.' . $tenantdata->extension;
            $file_url           = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/incubationtenant/' . $tenantdata->uploader . '/' . $file_name;

            if( !file_exists($file_url) ) {
                $logo           = BE_IMG_PATH . 'logo/logo-square.jpg';
            }else{
                $logo           = BE_UPLOAD_PATH . 'incubationtenant/' . $tenantdata->uploader . '/' . $file_name;
            }
        }else{
            $logo               = BE_IMG_PATH . 'logo/logo-square.jpg';
        }

        $data['title']          = TITLE . 'Tenant Detail';
        $data['tenantdata']     = $tenantdata;
        $data['logo']           = $logo;
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/tenantdetails';

        $this->load->view(VIEW_BACK . 'template', $data);
    }

    /**
    * Tenant List Details Edit function.
    */
    public function tenantlistdetailsedit(){
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $curdate                = date("Y-m-d H:i:s");

        $post_tenant_id         = $this->input->post('tenant_id');
        $post_tenant_name       = $this->input->post('tenant_name');
        $post_tenant_email      = $this->input->post('tenant_email');
        $post_tenant_year       = $this->input->post('tenant_year');
        $post_tenant_address    = $this->input->post('tenant_address');
        $post_tenant_province   = $this->input->post('tenant_province');
        $post_tenant_city       = $this->input->post('tenant_regional');
        $post_tenant_district   = $this->input->post('tenant_district');
        $post_tenant_phone      = $this->input->post('tenant_phone_contact');
        $post_tenant_legal      = $this->input->post('tenant_legal');
        $post_tenant_bussiness  = $this->input->post('tenant_bussiness');
        $post_tenant_mitra      = $this->input->post('tenant_mitra');
        $post_tenant_desc       = $this->input->post('tenant_desc');

        $this->form_validation->set_rules('tenant_name','Nama Tenant','required');
        $this->form_validation->set_rules('tenant_email','Email Tenant','required');
        $this->form_validation->set_rules('tenant_year','Tahun Berdiri Tenant','required');
        $this->form_validation->set_rules('tenant_address','Alamat','required');
        $this->form_validation->set_rules('tenant_province','Provinsi','required');
        $this->form_validation->set_rules('tenant_regional','Kota/Kabupaten','required');
        $this->form_validation->set_rules('tenant_district','Kecamatan/Kelurahan','required');
        $this->form_validation->set_rules('tenant_phone_contact','Telp/HP','required');
        $this->form_validation->set_rules('tenant_legal','Legal','required');
        $this->form_validation->set_rules('tenant_bussiness','NPWP','required');
        $this->form_validation->set_rules('tenant_mitra','Mitra Usaha','required');
        $this->form_validation->set_rules('tenant_desc','Deskripsi Tenant','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if($this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array(
                'status'        => 'error',
                'message'       => 'Anda memiliki beberapa kesalahan ( '.validation_errors().'). Silakan cek di formulir bawah ini!',
            );
            // JSON encode data
            die(json_encode($data));
        }else{
            // Check Data Tenant
            if( !$tenantdata = $this->Model_Tenant->get_tenantdata_by_id($post_tenant_id) ){
                // Set JSON data and JSON encode data
                $data = array('status' => 'error','message' => 'Data tenant tidak ditemukan atau belum terdaftar');
                die(json_encode($data));
            }

            $tenantdata_update  = array(
                'name_tenant'   => strtoupper( trim(smit_isset($post_tenant_name, '')) ),
                'slug'          => smit_slug( trim(smit_isset($post_tenant_name, '')) ),
                'email'         => trim(smit_isset($post_tenant_email, '')),
                'phone'         => trim(smit_isset($post_tenant_phone, '')),
                'year'          => smit_isset($post_tenant_year, ''),
                'address'       => strtoupper( trim(smit_isset($post_tenant_address, '')) ),
                'province'      => smit_isset($post_tenant_province, ''),
                'city'          => smit_isset($post_tenant_city, ''),
                'district'      => strtoupper( trim(smit_isset($post_tenant_district, '')) ),
                'legal'         => trim(smit_isset($post_tenant_legal, '')),
                'licensing'     => trim(smit_isset($post_tenant_bussiness, '')),
                'partnerships'  => smit_isset($post_tenant_mitra, ''),
                'description'   => smit_isset($post_tenant_desc, ''),
                'datemodified'  => $curdate,
            );
            if( $this->Model_Tenant->update_data($post_tenant_id, $tenantdata_update) ){
                // Set JSON data and JSON encode data
                $data = array('status' => 'success','message' => 'Data tenant berhasil diperbaharui');
                die(json_encode($data));
            }else{
                // Set JSON data and JSON encode data
                $data = array('status' => 'error','message' => 'Data tenant tidak berhasil diperbaharui');
                die(json_encode($data));
            }
        }
    }

    /**
	 * Tenant Team list data function.
	 */
    function tenantteamlistdata($id_tenant=''){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = '';
        if( !empty($id_tenant) ){
            $condition      = ' WHERE %id_tenant% LIKE "'.$id_tenant.'"';
        }

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

        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_position         = $this->input->post('search_position');
        $s_position         = smit_isset($s_position, '');

        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_position) )       { $condition .= str_replace('%s%', $s_position, ' AND %position% LIKE "%%s%%"'); }

        if( $column == 2 )      { $order_by .= '%name% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%position% ' . $sort; }

        $tenantteam_list    = $this->Model_Tenant->get_all_tenant_team($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();

        if( !empty($tenantteam_list) ){
            $iTotalRecords  = smit_get_last_found_rows();

            $i = $offset + 1;
            foreach($tenantteam_list as $row){
                $logo_name  = $row->thumbnail . '.' . $row->extension;
                $logo_file  = BE_UPLOAD_PATH . 'incubationtenantteam/' . $row->id_tenant . '/' . $logo_name;
                $logo       = '<img src="'.$logo_file.'" class="tenant-team-list-logo" />';

                $btn_edit   = '<a href="'.base_url('tenants/tenantteamdetail/'.$row->uniquecode).'"
                    class="tenantteamedit btn btn-xs btn-warning waves-effect tooltips bottom5" data-placement="left" title="Edit"><i class="material-icons">edit</i></a> ';

                $records["aaData"][] = array(
                    smit_center('<input name="tenantteamlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->id.'" value="' . $row->id . '" type="checkbox"/>
                    <label for="cblist'.$row->id.'"></label>'),
                    smit_center( $i ),
                    $row->name,
                    $row->position,
                    smit_center( $logo ),
                    smit_center( $btn_edit ),
                );

                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $tenantteamlist         = $_REQUEST['tenantteamlist'];

            // Check Tenant Data
            $tenantdata             = $this->Model_Tenant->get_tenantdata_by_id($id_tenant);
            if( !$tenantdata ){
                $status             = 'ERROR';
                $message            = 'Proses tidak dapat dilakukan karena data tenant tidak ditemukan atau belum terdaftar';
            }else{
                if( !$is_admin ){
                    if( $current_user->id != $tenantdata->user_id ){
                        $status     = 'ERROR';
                        $message    = 'Proses tidak dapat dilakukan karena data tim tenant bukan tim tenant Anda';
                    }else{
                        $proses     = $this->tenantteamlistproses($sGroupActionName, $tenantteamlist);
                        $status     = $proses['status'];
                        $message    = $proses['message'];
                    }
                }else{
                    $proses         = $this->tenantteamlistproses($sGroupActionName, $tenantteamlist);
                    $status         = $proses['status'];
                    $message        = $proses['message'];
                }
            }

            $records["sStatus"]     = $status;
            $records["sMessage"]    = $message;
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * Tenant Team List Proses function.
	 */
    function tenantteamlistproses($action, $data){
        $response = array();

        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        $curdate = date('Y-m-d H:i:s');
        if( $action=='delete' ) { $actiontxt = 'Hapus'; $status = DELETED; }

        $data = (object) $data;
        foreach( $data as $key => $id ){
            if( $action=='delete' ){
                $tenantteamlistdelete = $this->Model_Tenant->delete_tenant_team($id);
            }
        }

        $response = array(
            'status'    => 'OK',
            'message'   => 'Proses '.strtoupper($actiontxt).' data daftar tim tenant selesai di proses',
        );
        return $response;
    }

    /**
	 * Tenant Team Detail data function.
	 */
    function tenantteamdetail($uniquecode){
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');

        // Check uniquecode
        if ( !$uniquecode ){
            // Set JSON data
            $data = array('status' => 'error','message' => 'Data tim tenant tidak ditemukan atau belum terdaftar!');
            die(json_encode($data));
        }

        // Check Tenant Team Data
        if( !$teamdata_all = $this->Model_Tenant->get_all_tenant_team(0,0,' WHERE %uniquecode% LIKE "'.$uniquecode.'"','')){
            // Set JSON data
            $data = array('status' => 'error','message' => 'Data tim tenant tidak ditemukan atau belum terdaftar!');
            die(json_encode($data));
        }

        $teamdata       = $teamdata_all[0];
        $ava_name       = $teamdata->thumbnail . '.' . $teamdata->extension;
        $ava_file       = BE_UPLOAD_PATH . 'incubationtenantteam/' . $teamdata->id_tenant . '/' . $ava_name;
        $ava            = '<img src="'.$ava_file.'" class="tenant-team-ava img-responsive img-circle" alt="Avatar" />';

        $teamdata_json  = array(
            'uniquecode'=> $teamdata->uniquecode,
            'name'      => $teamdata->name,
            'position'  => $teamdata->position,
            'ava'       => $ava,
        );

        // Set JSON data
        $data = array('status' => 'success','message' => 'Data tim tenant berhasil ditemukan!','data'=>$teamdata_json);
        die(json_encode($data));
    }

    /**
	 * Tenant Team Edir data function.
	 */
    function tenantteamedit(){
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');

        $curdate                = date('Y-m-d H:i:s');
        $uniquecode             = $this->input->post('tenant_team_uniquecode_edit');
        $uniquecode             = trim( smit_isset($uniquecode, '') );
        $name                   = $this->input->post('team_name_edit');
        $name                   = trim( smit_isset($name, 0) );
        $position               = $this->input->post('team_position_edit');
        $position               = trim( smit_isset($position, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('team_name_edit','Name Tim','required');
        $this->form_validation->set_rules('team_position_edit','Position Tim','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('status' => 'error','message' => 'Pembaharuan data tim tenant tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // Check Tenant Team Data
        if( !$teamdata_all = $this->Model_Tenant->get_all_tenant_team(0,0,' WHERE %uniquecode% LIKE "'.$uniquecode.'"','')){
            // Set JSON data
            $data = array('status' => 'error','message' => 'Data tim tenant tidak ditemukan atau belum terdaftar!');
            die(json_encode($data));
        }
        $teamdata           = $teamdata_all[0];

        $teamdata_update    = array(
            'name'          => $name,
            'position'      => $position,
            'datemodified'  => $curdate,
        );

        if( $this->Model_Tenant->update_data_tenant_team($teamdata->id, $teamdata_update) ){
            // Set JSON data
            $data = array('status' => 'success','message' => 'Pembaharuan data tim tenant berhasil');
            die(json_encode($data));
        }else{
            // Set JSON data
            $data = array('status' => 'error','message' => 'Pembaharuan data tim tenant tidak berhasil');
            die(json_encode($data));
        }
    }

    /**
	 * Tenant Add Team function.
	 */
	public function addteam($uniquecode)
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $message                = '';
        $curdate                = date('Y-m-d H:i:s');

        if( !$uniquecode ){
            redirect( base_url('tenants/daftar') );
        }

        // Check Tenant Data
        $tenantdata             = '';
        if( !empty($uniquecode) ){
            $tenantdata         = $this->Model_Tenant->get_all_tenant(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $tenantdata         = $tenantdata[0];

            if( !$tenantdata ){
                redirect( base_url('tenants/daftar') );
            }
        }

        if ( $this->input->is_ajax_request() ) {
            $team_count         = $this->input->post("team_count");
            $team_count         = smit_isset( $team_count, 0 );

            if( $team_count == 0 ){
                // Set JSON data
                $data = array('status' => 'error','message' => 'Silahkan inputkan minimal 1 tim tenant!');
                die(json_encode($data));
            }

            if( empty($_FILES) || !$_FILES ){
                // Set JSON data
                $data = array('status' => 'error','message' => 'Tidak ada foto tim tenant yang diinputkan');
                die(json_encode($data));
            }

            if( empty($_POST) || !$_POST ){
                // Set JSON data
                $data = array('status' => 'error','message' => 'Semua data tim tenant harus di isi!');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            $error = 0;
            for($i=1; $i<=$team_count; $i++){
                // Set Required Variables
                $team_image_{$i}    = $_FILES['team_image_'.$i];
                $team_image_{$i}    = smit_isset( $team_image_{$i}, array() );
                $team_name_{$i}     = $this->input->post("team_name_".$i);
                $team_name_{$i}     = smit_isset( $team_name_{$i}, '' );
                $team_position_{$i} = $this->input->post("team_position_".$i);
                $team_position_{$i} = smit_isset( $team_position_{$i}, '' );

                // Check Error pass continue ...
                if( empty($team_image_{$i}['name']) ){
                    $error++; continue;
                }
                if( empty($team_name_{$i}) ){
                    $error++; continue;
                }
                if( empty($team_position_{$i}) ){
                    $error++; continue;
                }

                // Upload Image first ...
                $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/incubationtenantteam/' . $tenantdata->id;
                if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

                // Initialize Upload Config
                $config = array(
                    'upload_path'   => $upload_path,
                    'allowed_types' => "jpg|jpeg|png",
                    'overwrite'     => FALSE,
                    'max_size'      => "1024000",
                );
                $this->upload->initialize($config);

                // Do Upload Image
                if( ! $this->upload->do_upload('team_image_'.$i) ){
                    $error++; continue;
                }

                $upload_data        = $this->upload->data();
                $upload_file        = $upload_data['raw_name'] . $upload_data['file_ext'];
                $thumbnail          = 'Thumbnail_' . $upload_data['raw_name'];
                $thumbfile          = $thumbnail . $upload_data['file_ext'];

                // Set Thumbnail
                $this->image_moo->load($upload_path . '/' .$upload_data['file_name'])->resize_crop(300,300)->save($upload_path. '/' .$thumbfile, TRUE);
                $this->image_moo->clear();

                // Set Team Data
                $team_data  = array(
                    'id_tenant'     => $tenantdata->id,
                    'uniquecode'    => smit_generate_rand_string(10,'low'),
                    'name'          => $team_name_{$i},
                    'position'      => $team_position_{$i},
                    'url'           => smit_isset($upload_data['full_path'],''),
                    'extension'     => substr(smit_isset($upload_data['file_ext'],''),1),
                    'filename'      => smit_isset($upload_data['raw_name'],''),
                    'thumbnail'     => smit_isset($thumbnail,''),
                    'size'          => smit_isset($upload_data['file_size'],0),
                    'datecreated'   => $curdate,
                    'datemodified'  => $curdate,
                );

                // Save Team Data
                if( !$this->Model_Tenant->save_data_tenant_team($team_data) ){
                    $error++; continue;
                }
            }

            // Commit Transaction
            $this->db->trans_commit();
            // Complete Transaction
            $this->db->trans_complete();

            if( $error > 0 ) $message = '<span class="text-warning"><strong>Tetapi terdapat '.$error.' data tim yang gagal ditambahkan</strong></span>';

            // Set JSON data
            $data = array('status' => 'success','message' => 'Data tim tenant berhasil di tambahkan' . br() . $message);
            die(json_encode($data));
        }

        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Input Mask Plugin
            BE_PLUGIN_PATH . 'jquery-inputmask/jquery.inputmask.bundle.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'Tenant.init();',
            'UploadFiles.init();',
            'TenantValidation.init();'
        ));

        $data['title']          = TITLE . 'Tambah Tim Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['tenantdata']     = $tenantdata;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/addteam';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Tenant Logo Update function.
	 */
    function tenantlogo()
    {
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $message                = '';
        $curdate                = date('Y-m-d H:i:s');

        // Set Post Variable
        $tenant_id              = $this->input->post("tenant_id");
        $tenant_id              = smit_isset( $tenant_id, 0 );

        // -------------------------------------------------
        // Check Tenant Data
        // -------------------------------------------------
        $tenantdata             = $this->Model_Tenant->get_tenantdata_by_id($tenant_id);
        if( !$tenantdata ){
            // Set JSON data
            $data = array(
                'status'        => 'error',
                'message'       => smit_alert('Data tenant tidak ditemukan atau belum terdaftar!'),
            );
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        if( empty($_FILES['tenant_logo_files']['name']) ){
            // Set JSON data
            $data = array(
                'status'        => 'error',
                'message'       => smit_alert('Tidak ada berkas logo yang di unggah. Silahkan inputkan berkas logo!'),
            );
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Set Path and Upload Config
        // -------------------------------------------------
        $upload_path    = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/incubationtenant/' . $current_user->id;
        if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

        $current_path   = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/incubationtenant/' . $tenantdata->uploader;
        $current_file   = $current_path . '/' . $tenantdata->filename . '.' . $tenantdata->extension;

        $config = array(
            'upload_path'   => $upload_path,
            'allowed_types' => "jpg|jpeg|png",
            'overwrite'     => FALSE,
            'max_size'      => "1024000",
        );
        $this->upload->initialize($config);

        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();

        // -------------------------------------------------
        // Do Upload
        // -------------------------------------------------
        if( ! $this->upload->do_upload('tenant_logo_files') ){
            $message = $this->upload->display_errors();
            // Set JSON data
            $data = array('status' => 'error','message' => $message);
            die(json_encode($data));
        }
        $upload_data    = $this->upload->data();
        $upload_file    = $upload_data['raw_name'] . $upload_data['file_ext'];
        $this->image_moo->load($upload_path . '/' .$upload_data['file_name'])->resize_crop(200,200)->save($upload_path. '/' .$upload_file, TRUE);
        $this->image_moo->clear();

        // -------------------------------------------------
        // Update Tenant Data
        // -------------------------------------------------
        $tenantdata_update  = array(
            'url'           => smit_isset($upload_data['full_path'],''),
            'extension'     => substr(smit_isset($upload_data['file_ext'],''),1),
            'filename'      => smit_isset($upload_data['raw_name'],''),
            'size'          => smit_isset($upload_data['file_size'],0),
            'uploader'      => $current_user->id,
            'datemodified'  => $curdate,
        );

        $trans_save_tenant  = FALSE;
        if( $save_tenant_update = $this->Model_Tenant->update_data($tenant_id, $tenantdata_update) ){
            $trans_save_tenant  = TRUE;
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('status' => 'error','message' => 'Pembaharuan logo tenant tidak berhasil. Terjadi kesalahan sistem');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Commit or Rollback Transaction
        // -------------------------------------------------
        if( $trans_save_tenant ){
            if ($this->db->trans_status() === FALSE){
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('status' => 'error', 'message' => 'Pembaharuan logo tenant tidak berhasil. Terjadi kesalahan data transaksi database.');
                die(json_encode($data));
            }else{
                // Delete Previous File
                if( file_exists($current_file) ){
                    unlink($current_file);
                }

                // Commit Transaction
                $this->db->trans_commit();
                // Complete Transaction
                $this->db->trans_complete();

                // Set JSON data
                $data = array(
                    'status'    => 'success',
                    'message'   => 'Pembaharuan logo tenant berhasil!',
                    'file'      => '<img class="tenant-logo img-responsive img-circle" src="'.BE_UPLOAD_PATH . 'incubationtenant/' . $current_user->id . '/' . $upload_file.'" alt="Logo Tenant" />'
                );
                die(json_encode($data));
                // Set Log Data
                smit_log( 'TENANT_LOGO_UPDATE', 'SUCCESS', maybe_serialize(array('tenant_id'=>$tenant_id, 'url'=> smit_isset($upload_data['full_path'],''))) );
            }
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('status' => 'error','message' => 'Pembaharuan logo tenant akun tidak berhasil. Terjadi kesalahan data.');
            die(json_encode($data));
        }
    }

    /**
	 * Tenant Team Avatar Update function.
	 */
    function tenantteamava()
    {
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $message                = '';
        $curdate                = date('Y-m-d H:i:s');

        // Set Post Variable
        $tenantteam_uniquecode  = $this->input->post("tenant_team_uniquecode");
        $tenantteam_uniquecode  = smit_isset( $tenantteam_uniquecode, 0 );

        // -------------------------------------------------
        // Check Tenant Data
        // -------------------------------------------------
        $tenantteamdata_all     = $this->Model_Tenant->get_all_tenant_team(0,0,' WHERE %uniquecode% LIKE "'.$tenantteam_uniquecode.'"','');
        if( !$tenantteamdata_all ){
            // Set JSON data
            $data = array(
                'status'        => 'error',
                'message'       => smit_alert('Data tim tenant tidak ditemukan atau belum terdaftar!'),
            );
            die(json_encode($data));
        }
        $tenantteamdata         = $tenantteamdata_all[0];

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        if( empty($_FILES['tenant_team_ava_files']['name']) ){
            // Set JSON data
            $data = array(
                'status'        => 'error',
                'message'       => smit_alert('Tidak ada berkas avatar yang di unggah. Silahkan inputkan berkas avatar!'),
            );
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Set Path and Upload Config
        // -------------------------------------------------
        $upload_path    = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/incubationtenantteam/' . $tenantteamdata->id_tenant;
        if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

        $current_path   = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/incubationtenantteam/' . $tenantteamdata->id_tenant;
        $current_file   = $current_path . '/' . $tenantteamdata->filename . '.' . $tenantteamdata->extension;

        $config = array(
            'upload_path'   => $upload_path,
            'allowed_types' => "jpg|jpeg|png",
            'overwrite'     => FALSE,
            'max_size'      => "1024000",
        );
        $this->upload->initialize($config);

        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();

        // -------------------------------------------------
        // Do Upload
        // -------------------------------------------------
        if( ! $this->upload->do_upload('tenant_team_ava_files') ){
            $message = $this->upload->display_errors();
            // Set JSON data
            $data = array('status' => 'error','message' => $message);
            die(json_encode($data));
        }

        $upload_data        = $this->upload->data();
        $upload_file        = $upload_data['raw_name'] . $upload_data['file_ext'];
        $thumbnail          = 'Thumbnail_' . $upload_data['raw_name'];
        $thumbfile          = $thumbnail . $upload_data['file_ext'];

        // Set Thumbnail
        $this->image_moo->load($upload_path . '/' .$upload_data['file_name'])->resize_crop(300,300)->save($upload_path. '/' .$thumbfile, TRUE);
        $this->image_moo->clear();

        // -------------------------------------------------
        // Update Tenant Team Data
        // -------------------------------------------------
        $tenantteamdata_update  = array(
            'url'           => smit_isset($upload_data['full_path'],''),
            'extension'     => substr(smit_isset($upload_data['file_ext'],''),1),
            'filename'      => smit_isset($upload_data['raw_name'],''),
            'thumbnail'     => $thumbnail,
            'size'          => smit_isset($upload_data['file_size'],0),
            'datemodified'  => $curdate,
        );

        $trans_save_tenant_team  = FALSE;
        if( $save_tenant_team_update = $this->Model_Tenant->update_data_tenant_team($tenantteamdata->id, $tenantteamdata_update) ){
            $trans_save_tenant_team  = TRUE;
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('status' => 'error','message' => 'Pembaharuan avatar tim tenant tidak berhasil. Terjadi kesalahan sistem');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Commit or Rollback Transaction
        // -------------------------------------------------
        if( $trans_save_tenant_team ){
            if ($this->db->trans_status() === FALSE){
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('status' => 'error', 'message' => 'Pembaharuan avatar tim tenant tidak berhasil. Terjadi kesalahan data transaksi database.');
                die(json_encode($data));
            }else{
                // Delete Previous File
                if( file_exists($current_file) ){
                    unlink($current_file);
                }

                // Commit Transaction
                $this->db->trans_commit();
                // Complete Transaction
                $this->db->trans_complete();

                // Set JSON data
                $data = array(
                    'status'    => 'success',
                    'message'   => 'Pembaharuan avatar tim tenant berhasil!',
                    'file'      => '<img class="tenant-team-ava img-responsive img-circle" src="'.BE_UPLOAD_PATH . 'incubationtenantteam/' . $tenantteamdata->id_tenant . '/' . $thumbfile.'" alt="Avatar" />'
                );
                die(json_encode($data));
                // Set Log Data
                smit_log( 'TENANT_TEAM_AVA_UPDATE', 'SUCCESS', maybe_serialize(array('tenantteam_id'=>$tenantteamdata->id, 'url'=> smit_isset($upload_data['full_path'],''))) );
            }
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('status' => 'error','message' => 'Pembaharuan avatar tim tenant akun tidak berhasil. Terjadi kesalahan data.');
            die(json_encode($data));
        }
    }

    /**
	 * Score Tenant function.
	 */
	public function tenantscore()
	{
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
            // Put script based on current page
        ));

        $scripts_add            = '';
        $scripts_init           = '';

        $data['title']          = TITLE . 'Penilaian Seleksi Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/score';

		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Accompaniment Tenant function.
	 */
	public function tenantaccompaniment()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_pendamping          = as_pendamping($current_user);

        $headstyles             = smit_headstyles(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',

            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
        ));

        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
        ));

        $scripts_add            = '';

        $data['title']          = TITLE . 'Pendampingan Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_pendamping']  = $is_pendamping;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/accompaniment';

		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Pra Incubation Accompaniment list data function.
	 */
    function accompanimentlistdata(){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $is_pendamping      = as_pendamping($current_user);

        $condition          = ' WHERE %companion_id% > 0 ';
        if( !$is_admin ){
            if( !empty($is_pendamping) ){
                $condition      = ' WHERE %companion_id% = '.$current_user->id.'';
            }else{
                $condition      = ' WHERE %user_id% = '.$current_user->id.'';
            }
        }

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

        $s_tenant_name      = $this->input->post('search_tenant_name');
        $s_tenant_name      = smit_isset($s_tenant_name, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_companion_name   = $this->input->post('search_companion_name');
        $s_companion_name   = smit_isset($s_companion_name, '');

        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_tenant_name) )    { $condition .= str_replace('%s%', $s_tenant_name, ' AND %name_tenant% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_companion_name) ) { $condition .= str_replace('%s%', $s_companion_name, ' AND %companion_name% = %s%'); }

        if( $is_admin ){
            if( $column == 1 )      { $order_by .= '%name_tenant% ' . $sort; }
            elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%name% ' . $sort; }
            elseif( $column == 4 )  { $order_by .= '%companion_name% ' . $sort; }
        }else{
            if( $column == 1 )  { $order_by .= '%name_tenant% ' . $sort; }
            elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%name% ' . $sort; }
        }

        $tenant_list        = $this->Model_Tenant->get_all_tenant($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($tenant_list) ){
            $iTotalRecords  = smit_get_last_found_rows();

            $i = $offset + 1;
            foreach($tenant_list as $row){

                if( $row->companion_id > 0 ){
                    $companion_name = '<a href="'.base_url('pengguna/profil/'.$row->companion_id).'">' . strtoupper($row->companion_name) . '</a>';
                }else{ $companion_name = "<span style='color : red !important; '><strong>BELUM ADA PENDAMPING</strong></span>"; }

                // Button
                $btn_detail         = '<a href="'.base_url('tenants/detail/'.$row->uniquecode).'" class="inact btn btn-xs btn-primary waves-effect tooltips" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';
                $btn_edit           = '<a class="accompanimenttenantedit btn btn-xs btn-warning waves-effect tooltips" data-placement="left" data-id="'.$row->uniquecode.'" data-tenantid="'.$row->id.'" data-name="'.$row->companion_name.'" title="Ubah"><i class="material-icons">edit</i></a>';


                if( !empty($is_admin) ){
                    $records["aaData"][] = array(
                        smit_center($i),
                        strtoupper($row->name_tenant),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper($row->name) . '</a>',
                        strtoupper($row->name),
                        smit_center($companion_name),
                        smit_center( $btn_detail .' '.$btn_edit ),
                    );
                }elseif( !empty($is_pendamping) ){
                    $records["aaData"][] = array(
                        smit_center($i),
                        strtoupper($row->name_tenant),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper($row->name) . '</a>',
                        strtoupper($row->name),
                        //smit_center( $btn_detail ),
                        ''
                    );
                }else{
                    $records["aaData"][] = array(
                        smit_center($i),
                        strtoupper($row->name_tenant),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper($row->name) . '</a>',
                        strtoupper($row->name),
                        $companion_name,
                        smit_center( $btn_detail ),
                        ''
                    );
                }

                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $userlist               = $_REQUEST['userlist'];

            $proses                 = $this->useraction($sGroupActionName, $userlist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * Incubation Detail list data function.
	 */
    public function incubationdatadetails($uniquecode)
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_pengusul            = as_pengusul($current_user);
        $is_pendamping          = as_pendamping($current_user);

        if( !$uniquecode ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Parameter data pengaturan seleksi tidak ditemukan');
            // JSON encode data
            die(json_encode($data));
        }

        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/table/table-ajax.js',
        ));

        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'PraIncubationList.init();',
        ));

        $scripts_add            = '';

        // Custom
        $condition              = '';
        $incubation_list        = '';
        if(!empty($uniquecode)){
            $incubation_list     = $this->Model_Tenant->get_all_tenant('', '', ' WHERE %uniquecode% = "'.$uniquecode.'"', '');
            $incubation_list     = $incubation_list[0];
        }

        $data['title']          = TITLE . 'Detail Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_pengusul']    = $is_pengusul;
        $data['is_pendamping']  = $is_pendamping;
        $data['incubation']     = $incubation_list;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/listtenantdetails';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Companion Edit
	 */
	public function companiontenantedit()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');

        $uniquecode             = $this->input->post('reg_uniquecode');
        $uniquecode             = trim( smit_isset($uniquecode, "") );
        $companion_id           = $this->input->post('reg_companion_id');
        $companion_id           = trim( smit_isset($companion_id, "") );
        $tenant_id              = $this->input->post('reg_tenant_id');
        $tenant_id              = trim( smit_isset($tenant_id, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_uniquecode','Uniquecode','required');
        $this->form_validation->set_rules('reg_companion_id','Pendamping','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah pendampingan tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();

        $companion_data  = array(
            'companion_id'      => $companion_id,
            'datemodified'       => $curdate,
        );

        // -------------------------------------------------
        // Edit Companion
        // -------------------------------------------------
        $trans_edit_companion        = FALSE;
        if( $companion_edit_id       = $this->Model_Tenant->update_data_tenant($tenant_id, $companion_data) ){
            if($companion_edit_id ){
                $this->Model_Tenant->update_companion($uniquecode, $companion_data);
            }
            $trans_edit_companion    = TRUE;
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah pendampingan tidak berhasil. Terjadi kesalahan data formulir anda');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Commit or Rollback Transaction
        // -------------------------------------------------
        if( $trans_edit_companion ){
            if ($this->db->trans_status() === FALSE){
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => 'Ubah pendampingan tidak berhasil. Terjadi kesalahan data transaksi database.'
                ); die(json_encode($data));
            }else{
                // Commit Transaction
                $this->db->trans_commit();
                // Complete Transaction
                $this->db->trans_complete();

                // Set JSON data
                $data       = array('message' => 'success', 'data' => 'Ubah pendampingan baru berhasil!');
                die(json_encode($data));
            }
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah pendampingan tidak berhasil. Terjadi kesalahan data.');
            die(json_encode($data));
        }
	}

    /**
	 * Product Tenant function.
	 */
	public function tenantproduct()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $headstyles             = smit_headstyles(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',

            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
            BE_JS_PATH . 'pages/forms/editors.js',
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'UploadFiles.init();',
            'ProductValidation.init();',
        ));
        $tenantdata             = '';

        if( !$is_admin ){
            $tenantdata             = $this->Model_Tenant->get_all_tenant(0, 0, ' WHERE %user_id% = '.$current_user->id.' AND %companion_id% > 0');
        }

        $data['title']          = TITLE . 'Produk Tenant';
        $data['tenantdata']     = $tenantdata;
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/product';

		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Payment Tenant function.
	 */
	public function tenantpayment()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $headstyles             = smit_headstyles(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',

            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'UploadFiles.init();',
            'PaymentValidation.init();',
        ));

        $data['title']          = TITLE . 'Monitoring Dokumen';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/payment';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
    * Tenant Payment Details function.
    */
    public function tenantpaymentdetails( $uniquecode='' ){
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $headstyles             = smit_headstyles(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
        ));

        $loadscripts            = smit_scripts(array(
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',

            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));

        $scripts_add            = '';
        $scripts_init           = '';
        $newsdata               = '';

        if( !empty($uniquecode) ){
            $paymentdata        = $this->Model_Incubation->get_all_payment(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $paymentdata        = $paymentdata[0];
        }

        if($paymentdata){
            $file_name      = $paymentdata->filename . '.' . $paymentdata->extension;
            $file_url       = BE_UPLOAD_PATH . 'tenantpayment/'. $paymentdata->user_id . '/' . $file_name;
            $payment_image  = $file_url;
        }else{
            $payment_image  = BE_IMG_PATH . 'news/noimage.jpg';
        }

        $data['title']          = TITLE . 'Tenant Detail';
        $data['paymentdata']    = $paymentdata;
        $data['payment_image']  = $payment_image;
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/paymentdetail';

        $this->load->view(VIEW_BACK . 'template', $data);
    }

    /**
    * Tenant Payment Edit function.
    */
    public function tenantpaymentedit( $uniquecode='' ){
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $headstyles             = smit_headstyles(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',

            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
            BE_JS_PATH . 'pages/forms/editors.js',
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'UploadFiles.init();',
            'ProductValidation.init();',
        ));

        $paymentdata               = '';
        if( !empty($uniquecode) ){
            $paymentdata        = $this->Model_Incubation->get_all_payment(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $paymentdata        = $paymentdata[0];
        }

        if($paymentdata){
            $file_name      = $paymentdata->filename . '.' . $paymentdata->extension;
            $file_url       = BE_UPLOAD_PATH . 'tenantpayment/'. $paymentdata->user_id . '/' . $file_name;
            $payment_image  = $file_url;
        }else{
            $payment_image  = BE_IMG_PATH . 'news/noimage.jpg';
        }

        $data['title']          = TITLE . 'Pembayaran Detail';
        $data['paymentdata']    = $paymentdata;
        $data['payment_image']  = $payment_image;
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/paymentedit';

        $this->load->view(VIEW_BACK . 'template', $data);
    }

    /**
	 * Payment Tenant Edit Function
	 */
	public function paymentdataedit()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        $upload_data            = array();

        $uniquecode             = $this->input->post('reg_uniquecode');
        $uniquecode             = trim( smit_isset($uniquecode, "") );
        $event                  = $this->input->post('reg_event');
        $event                  = trim( smit_isset($event, "") );
        $event_title            = $this->input->post('reg_title');
        $event_title            = trim( smit_isset($event_title, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_title','Judul Pembayaran','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi Pembayaran','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah Pembayaran baru tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        /*
        if( empty($_FILES['reg_thumbnail']['name']) ){
            $data = array('message' => 'error','data' => 'Tidak ada thumbnail yang di unggah. Silahkan inputkan thumbnail gambar!');
            die(json_encode($data));
        }

        if( empty($_FILES['reg_details']['name']) ){
            $data = array('message' => 'error','data' => 'Tidak ada details gambar yang di unggah. Silahkan inputkan details gambar kegiatan!');
            die(json_encode($data));
        }
        */

        $tenantdata             = '';
        if( !empty($uniquecode) ){
            $tenantdata        = $this->Model_Incubation->get_all_payment(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $tenantdata        = $tenantdata[0];
        }

        $file_name      = $tenantdata->filename . '.' . $tenantdata->extension;
        $file_url       = BE_UPLOAD_PATH . 'tenantpayment/'. $tenantdata->user_id . '/' . $file_name;
        $product_image  = $file_url;

        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            // Upload Files Process
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/tenantpayment/' . $tenantdata->user_id;
            if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

            $config = array(
                'upload_path'       => $upload_path,
                'allowed_types' => "jpg|jpeg|png|doc|docx|xls|xlsx|pdf",
                'overwrite'         => FALSE,
                'max_size'          => "2048000",
            );
            $this->load->library('MY_Upload', $config);

            $file_details       = '';
            if( !empty($_FILES['reg_details']['name']) ){
                //unlink($product_image);

                if( ! $this->my_upload->do_upload('reg_details') ){
                    $message = $this->my_upload->display_errors();

                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                    die(json_encode($data));
                }
                $upload_data_details    = $this->my_upload->data();
                $upload_file            = $upload_data_details['raw_name'] . $upload_data_details['file_ext'];
                //$this->image_moo->load($upload_path . '/' .$upload_data_details['file_name'])->resize_crop(1346,400)->save($upload_path. '/' .$upload_file, TRUE);
                //$this->image_moo->clear();
                $file_details           = $upload_data_details;
            }

            if( !empty($file_details) ){
                $tenant_data           = array(
                    'title'             => $event_title,
                    'desc'              => $description,
                    'url'               => smit_isset($file_details['full_path'],''),
                    'extension'         => substr(smit_isset($file_details['file_ext'],''),1),
                    'filename'          => smit_isset($file_details['raw_name'],''),
                    'size'              => smit_isset($file_details['file_size'],0),
                    'datecreated'       => $curdate,
                    'datemodified'      => $curdate,
                );
            }else{
                $tenant_data           = array(
                    'title'             => $event_title,
                    'desc'              => $description,
                    'datecreated'       => $curdate,
                    'datemodified'      => $curdate,
                );
            }

            // -------------------------------------------------
            // Edit Payment Tenant Selection
            // -------------------------------------------------
            $trans_edit_blog          = FALSE;
            if( $payment_edit_id      = $this->Model_Tenant->update_payment($uniquecode, $tenant_data) ){
                $trans_edit_blog      = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Ubah pembayaran tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_edit_blog ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Ubah tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();

                    // Send Email Notification
                    //$this->smit_email->send_email_registration_selection($userdata->email, $event_title);

                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Ubah pembayaran baru berhasil!');
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'PAYMENTEDIT_REG', 'SUCCESS', maybe_serialize(array('username'=>$username, 'upload_files'=> $upload_data)) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Ubah pembayaran tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }
        }
	}

    /**
	 * Payment Add
	 */
	public function paymentadd()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');

        $tenant_id              = $this->input->post('reg_event');
        $tenant_id              = trim( smit_isset($tenant_id, "") );
        $title                  = $this->input->post('reg_title');
        $title                  = trim( smit_isset($title, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_event','Nama Tenant','required');
        $this->form_validation->set_rules('reg_title','Judul Pembayaran','required');
        $this->form_validation->set_rules('reg_desc','Keterangan','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pembayaran tenant tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        if( empty($_FILES['news_selection_files']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada bukti pembayaran yang di unggah. Silahkan inputkan bukti pembayaran!');
            die(json_encode($data));
        }

        $tenantdata     = $this->Model_Tenant->get_all_tenant(0, 0, ' WHERE %id% = '.$tenant_id.'');
        $tenantdata     = $tenantdata[0];

        if( !empty( $_POST ) ){
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/tenantpayment/' . $tenantdata->user_id;
            if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

            $config = array(
                'upload_path'   => $upload_path,
                'allowed_types' => "jpg|jpeg|png|doc|docx|xls|xlsx|pdf",
                'overwrite'     => FALSE,
                'max_size'      => "2048000",
            );
            $this->upload->initialize($config);

            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            if( !empty($_FILES['news_selection_files']['name']) ){
                if( ! $this->upload->do_upload('news_selection_files') ){
                    $message = $this->upload->display_errors();

                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->upload->display_errors());
                    die(json_encode($data));
                }

                $upload_data    = $this->upload->data();
                $upload_file    = $upload_data['raw_name'] . $upload_data['file_ext'];

                //$this->image_moo->load($upload_path . '/' .$upload_data['file_name'])->resize_crop(500,500)->save($upload_path. '/' .$upload_file, TRUE);
                //$this->image_moo->clear();

                $status         = NONACTIVE;
                if( $is_admin ){
                    $status     = ACTIVE;
                }

                $payment_data       = array(
                    'uniquecode'    => smit_generate_rand_string(10,'low'),
                    'invoice'       => smit_generate_invoice(1, 'num'),
                    'tenant_id'     => $tenant_id,
                    'user_id'       => $tenantdata->user_id,
                    'username'      => strtolower($tenantdata->username),
                    'name'          => $tenantdata->name,
                    'title'         => $title,
                    'desc'          => $description,
                    'url'           => smit_isset($upload_data['full_path'],''),
                    'extension'     => substr(smit_isset($upload_data['file_ext'],''),1),
                    'filename'      => smit_isset($upload_data['raw_name'],''),
                    'size'          => smit_isset($upload_data['file_size'],0),
                    'uploader'      => $tenantdata->id,
                    'status'        => $status,
                    'datecreated'   => $curdate,
                    'datemodified'  => $curdate,
                );
            }

            // -------------------------------------------------
            // Save Payment
            // -------------------------------------------------
            $trans_save_payment        = FALSE;
            if( $payment_save_id       = $this->Model_Incubation->save_data_payment($payment_data) ){
                $trans_save_payment    = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pembayaran tenant tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $payment_data ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pembayaran tenant tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();

                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pembayaran tenant baru berhasil!');
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'PAYEMENT_REG', 'SUCCESS', maybe_serialize(array('username'=>$tenantdata->username, 'url'=> smit_isset($upload_data['full_path'],''))) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pembayaran tenant tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }
        }
	}

    /**
	 * Tenant Payment list data function.
	 */
    function paymentlistdata(){
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

        $s_invoice          = $this->input->post('search_invoice');
        $s_invoice          = smit_isset($s_invoice, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_invoice) )        { $condition .= str_replace('%s%', $s_invoice, ' AND %invoice% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )      { $order_by .= '%invoice% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%title% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }

        $payment_list       = $this->Model_Incubation->get_all_payment($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();

        if( !empty($payment_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('files_status');

            $i = $offset + 1;
            foreach($payment_list as $row){
                // Button
                $btn_action = '<a href="'.base_url('monitoring_dokumen/detail/'.$row->uniquecode).'" class="newsdetail btn btn-xs btn-primary waves-effect tooltips bottom5" id="btn_news_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';
                $btn_edit   = '<a href="'.base_url('monitoring_dokumen/edit/'.$row->uniquecode).'" class="newsedit btn btn-xs btn-warning waves-effect tooltips bottom5" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>';

                $file_name      = $row->filename . '.' . $row->extension;
                $file_url       = BE_UPLOAD_PATH . 'tenantpayment/'.$row->user_id.'/' . $file_name;
                $image          = $file_url;
                $image          = '<img class="js-animating-object img-responsive" src="'.$image.'" alt="'.$row->title.'" />';

                if($row->status == NONACTIVE)   {
                    $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>';
                }elseif($row->status == BANNED)   {
                    $status         = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>';
                }elseif($row->status == ACTIVE)  {
                    $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                }

                $btn_download   = '<a href="'.base_url('monitoring_dokumen/unduh/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-default waves-effect tooltips bottom5" data-placement="left" title="Unduh"><i class="material-icons">file_download</i></a> ';

                $records["aaData"][] = array(
                    smit_center('<input name="paymentlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                    <label for="cblist'.$row->uniquecode.'"></label>'),
                    smit_center($i),
                    smit_center($row->invoice),
                    '<a href="'.base_url('monitoring_dokumen/detail/'.$row->uniquecode).'">' . strtoupper($row->title) . '</a>',
                    //$image,
                    smit_center( $btn_download ),
                    smit_center( $status ),
                    //smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
                    smit_center( $btn_action .' '. $btn_edit ),
                );
                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $paymentlist            = $_REQUEST['paymentlist'];

            $proses                 = $this->paymentproses($sGroupActionName, $paymentlist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * Payment / Dokument Tenant Download File function.
	 */
    function paymentdatadownloadfile($uniquecode){
        if ( !$uniquecode ){
            redirect( current_url() );
        }

        // Check Report Payment File Data
        $paymentdata     = $this->Model_Incubation->get_all_payment(0, 0, ' WHERE %uniquecode% = "'.$uniquecode.'"');
        $paymentdata     = $paymentdata[0];

        if( !$paymentdata || empty($paymentdata) ){
            redirect( current_url() );
        }

        $file_name      = $paymentdata->filename . '.' . $paymentdata->extension;
        $file_url       = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/tenantpayment/' . $paymentdata->uploader . '/' . $file_name;
        force_download($file_name, $file_url);
    }

    /**
	 * Payment Proses function.
	 */
    function paymentproses($action, $data){
        $response = array();

        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Hanya Administrator yang dapat melakukan proses ini',
            );
            return $response;
        };

        $curdate = date('Y-m-d H:i:s');
        if( $action=='confirm' )    { $actiontxt = 'Konfirmasi'; $status = ACTIVE; }
        elseif( $action=='banned' ) { $actiontxt = 'Banned'; $status = BANNED; }
        elseif( $action=='delete' ) { $actiontxt = 'Hapus'; $status = DELETED; }

        $data = (object) $data;
        foreach( $data as $key => $uniquecode ){
            if( $action=='delete' ){
                $paymentdelete  = $this->Model_Tenant->delete_payment($uniquecode);
            }else{
                $data_update    = array('status'=>$status, 'datemodified'=>$curdate);
                $this->Model_Tenant->update_payment($uniquecode, $data_update);
            }
        }

        $response = array(
            'status'    => 'OK',
            'message'   => 'Proses '.strtoupper($actiontxt).' data pembayaran selesai di proses',
        );
        return $response;
    }

    /**
	 * Report Tenant function.
	 */
	public function tenantreport()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_pendamping          = as_pendamping($current_user);

        $headstyles             = smit_headstyles(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',

            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'UploadFiles.init();',
            'ReportValidation.init();',
        ));

        $data['title']          = TITLE . 'Laporan Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_pendamping']  = $is_pendamping;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/report';

		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Tenant Add function.
	 */
	public function tenantadd()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_pelaksana           = as_pelaksana($current_user);

        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/forms/editors.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'Tenant.init();',
            'UploadFiles.init();',
            'TenantValidation.init();',
        ));

        $tenant         = '';

        if( !empty($is_admin) ){
            $avatar     = BE_IMG_PATH . 'tenant/avatar1.png';
        }else{
            $tenant         = $this->Model_Tenant->get_tenantdata($current_user->id);
            if( !empty($tenant) ){
                $uploaded       = $tenant->uploader;
                if($uploaded != 0){
                    $file_name      = $tenant->filename . '.' . $tenant->extension;
                    $file_url       = BE_IMG_PATH . 'tenant/' . $tenant->uploader . '/' . $file_name;
                    $avatar         = $file_url;
                }else{
                    $avatar     = BE_IMG_PATH . 'tenant/avatar1.png';
                }
            }else{
                $avatar     = BE_IMG_PATH . 'tenant/avatar1.png';
            }
        }

        $data['title']          = TITLE . 'Pengaturan Data Perusahaan';
        $data['user']           = $current_user;
        $data['avatar']         = $avatar;
        $data['tenant']         = $tenant;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/signuptenant';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Add Tenant function.
	 */
    function addtenant()
    {
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_pelaksana           = as_pelaksana($current_user);
        $id_user                = $current_user->id;
        $curdate                = date("Y-m-d H:i:s");

        if( !empty($is_admin) ){
            $post_user_id       = $this->input->post('tenant_user_id');
        }
        $post_selection_id      = $this->input->post('tenant_event_id');
        if( empty($post_selection_id) ){
            $post_selection_id  = '';
        }

        $post_tenant_name       = $this->input->post('tenant_name');
        $post_tenant_email      = $this->input->post('tenant_email');
        $post_tenant_year       = $this->input->post('tenant_year');
        $post_tenant_address    = $this->input->post('tenant_address');
        $post_tenant_province   = $this->input->post('tenant_province');
        $post_tenant_city       = $this->input->post('tenant_regional');
        $post_tenant_district   = $this->input->post('tenant_district');
        $post_tenant_phone      = $this->input->post('tenant_phone_contact');
        $post_tenant_legal      = $this->input->post('tenant_legal');
        $post_tenant_bussiness  = $this->input->post('tenant_bussiness');
        $post_tenant_mitra      = $this->input->post('tenant_mitra');
        $post_tenant_desc       = $this->input->post('tenant_desc');

        /*
        if( !empty($is_admin) ){
            $this->form_validation->set_rules('tenant_username','Username Tenant','required');
        }
        */

        //$this->form_validation->set_rules('tenant_event_id','Usulan Kegiatan','required');
        $this->form_validation->set_rules('tenant_name','Nama Tenant','required');
        $this->form_validation->set_rules('tenant_email','Email Tenant','required');
        $this->form_validation->set_rules('tenant_year','Tahun Berdiri Tenatn','required');
        $this->form_validation->set_rules('tenant_address','Alamat','required');
        $this->form_validation->set_rules('tenant_province','Provinsi','required');
        $this->form_validation->set_rules('tenant_regional','Kota/Kabupaten','required');
        $this->form_validation->set_rules('tenant_district','Kecamatan/Kelurahan','required');
        $this->form_validation->set_rules('tenant_phone_contact','Telp/HP','required');
        $this->form_validation->set_rules('tenant_legal','Legal','required');
        $this->form_validation->set_rules('tenant_bussiness','NPWP','required');
        $this->form_validation->set_rules('tenant_mitra','Mitra Usaha','required');
        $this->form_validation->set_rules('tenant_desc','Deskripsi Tenant','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if($this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => smit_alert('Anda memiliki beberapa kesalahan ( '.validation_errors().'). Silakan cek di formulir bawah ini!'),
            );
            // JSON encode data
            die(json_encode($data));
        }else{
            // -------------------------------------------------
            // Check File
            // -------------------------------------------------
            if( empty($_FILES['avatar_selection_files']['name']) ){
                // Set JSON data
                $data = array('message' => 'error','data' => 'Tidak ada logo tenant yang di unggah. Silahkan inputkan logo tenant dengan format gambar!');
                die(json_encode($data));
            }

            if( !empty($_POST) ){
                // -------------------------------------------------
                // Begin Transaction
                // -------------------------------------------------
                $this->db->trans_begin();

                // Upload Files Process
                $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/incubationtenant/' . $current_user->id;
                if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

                $config = array(
                    'upload_path'       => $upload_path,
                    'allowed_types'     => "jpg|jpeg|png",
                    'overwrite'         => FALSE,
                    'max_size'          => "2048000",
                );
                $this->load->library('MY_Upload', $config);

                if( ! $this->my_upload->do_upload('avatar_selection_files') ){
                    $message = $this->my_upload->display_errors();

                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                    die(json_encode($data));
                }
                $upload_data_avatar     = $this->my_upload->data();
                $upload_avatar          = $upload_data_avatar['raw_name'] . $upload_data_avatar['file_ext'];
                $this->image_moo->load($upload_path . '/' .$upload_data_avatar['file_name'])->resize_crop(200,200)->save($upload_path. '/' .$upload_avatar, TRUE);
                $this->image_moo->clear();
                $file_avatar            = $upload_data_avatar;

                $tenantdata1            = array();
                $data_selection         = "";
                // Check Selection Data
                if( !empty($post_selection_id) ){
                    $condition          = " WHERE %id% = ".$post_selection_id."";
                    $data_selection     = $this->Model_Incubation->get_all_incubationdata(0, 0, $condition);
                    $data_selection     = $data_selection[0];
                }

                if( !empty($is_admin) ){
                    $userdata           = smit_get_userdata_by_id($post_user_id);
                    if( !$userdata ){
                        // Set JSON data
                        $data = array(
                            'message'   => 'error',
                            'data'      => array(
                                'field' => '',
                                'msg'   => 'Data user tidak ditemukan atau belum terdaftar.',
                            )
                        ); die(json_encode($data));
                    }

                    $tenantdata1        = array(
                        'user_id'       => $post_user_id,
                        'username'      => $userdata->username,
                        'name'          => strtoupper( trim(smit_isset($userdata->name, '')) ),
                    );
                    if( !empty($data_selection) ){
                        $update_incubation  = $this->Model_Incubation->update_data_incubationdata($data_selection->id, $tenantdata1);
                    }
                }else{
                    $tenantdata1        = array(
                        'user_id'       => trim(smit_isset($data_selection->user_id, '')),
                        'username'      => strtolower( trim(smit_isset($data_selection->username, '')) ),
                        'name'          => strtoupper( trim(smit_isset($data_selection->name, '')) ),
                    );

                    if($data_selection->user_id != 1){ // Tidak Admin
                        $dataUser       = smit_get_userdata_by_id($data_selection->user_id);
                        $current_roles  = $dataUser->role;

                        if( empty($current_roles) ){
                            // Set JSON data
                            $data = array('status' => 'error','message' => 'Terjadi kesalahan, Anda tidak memiliki role untuk dipilih!');
                            die(json_encode($data));
                        }

                        $current_roles      = explode(',', $current_roles);
                        if( !in_array(TENANT, $current_roles) ){
                            $curdate            = date('Y-m-d H:i:s');
                            $arrTenant[]        = TENANT;
                            $arrData            = array_merge($current_roles, $arrTenant);
                            $role               = implode(',', $arrData);

                            $data_update        = array('role' => $role, 'datemodified' => $curdate);
                            $update_data        = $this->Model_User->update_data($data_selection->user_id, $data_update);
                        }
                    }
                }

                $tenantdata2         = array(
                    'uniquecode'    => smit_generate_rand_string(10,'low'),
                    'selection_id'  => $data_selection ? trim(smit_isset($data_selection->selection_id, '')) : 0,
                    'incubation_id' => $post_selection_id ? trim(smit_isset($post_selection_id, '')) : 0,
                    'name_tenant'   => strtoupper( trim(smit_isset($post_tenant_name, '')) ),
                    'slug'          => smit_slug( trim(smit_isset($post_tenant_name, '')) ),
                    'email'         => trim(smit_isset($post_tenant_email, '')),
                    'phone'         => trim(smit_isset($post_tenant_phone, '')),
                    'year'          => smit_isset($post_tenant_year, ''),
                    'address'       => strtoupper( trim(smit_isset($post_tenant_address, '')) ),
                    'province'      => smit_isset($post_tenant_province, ''),
                    'city'          => smit_isset($post_tenant_city, ''),
                    'district'      => strtoupper( trim(smit_isset($post_tenant_district, '')) ),
                    'legal'         => trim(smit_isset($post_tenant_legal, '')),
                    'licensing'     => trim(smit_isset($post_tenant_bussiness, '')),
                    'partnerships'  => smit_isset($post_tenant_mitra, ''),
                    'description'   => smit_isset($post_tenant_desc, ''),
                    'url'           => smit_isset($file_avatar['full_path'],''),
                    'extension'     => substr(smit_isset($file_avatar['file_ext'],''),1),
                    'filename'      => smit_isset($file_avatar['raw_name'],''),
                    'size'          => smit_isset($file_avatar['file_size'],0),
                    'uploader'      => trim(smit_isset($id_user, '')),
                    'status'        => $is_admin ? 1 : 0,
                    'datecreated'   => $curdate,
                    'datemodified'  => $curdate,
                );

                $tenantdata         = array_merge($tenantdata1, $tenantdata2);

                // -------------------------------------------------
                // Save Tenant Selection
                // -------------------------------------------------
                $trans_save_tenant       = FALSE;
                if( $save_tenant    = $this->Model_Tenant->save_data_tenant($tenantdata) ){
                    $trans_save_tenant   = TRUE;

                    $update_data_incubation = array(
                        'tenant_id'  => $save_tenant,
                    );

                    if( !empty($post_selection_id) ){
                        $this->Model_Incubation->update_data_incubationdata($post_selection_id, $update_data_incubation);
                    }
                }else{
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array('message' => 'error','data' => 'Pendaftaran tenant tidak berhasil. Terjadi kesalahan data formulir anda');
                    die(json_encode($data));
                }

                // -------------------------------------------------
                // Commit or Rollback Transaction
                // -------------------------------------------------
                if( $trans_save_tenant ){
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
                        //$this->smit_email->send_email_registration_selection($userdata->email, $event_title);

                        // Set JSON data
                        $data       = array('message' => 'success', 'data' => 'Pendaftaran tenant baru berhasil!');
                        die(json_encode($data));
                        // Set Log Data
                        smit_log( 'TENANT_REG', 'SUCCESS', maybe_serialize(array('username'=>$current_user->username, 'upload_files'=> $upload_data_avatar)) );
                    }
                }else{
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array('message' => 'error','data' => 'Pendaftaran tenant tidak berhasil. Terjadi kesalahan data.');
                    die(json_encode($data));
                }
            }
        }
    }

    /**
	 * Logo Tenant Setting Info Update function.
	 */
    function logotenant()
    {
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_pelaksana           = as_pelaksana($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');

        $post_user_username     = $this->input->post('username');
        $username               = smit_isset($post_user_username, '');

        $this->form_validation->set_rules('username','Username anda','required');
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if($this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => smit_alert('Anda memiliki beberapa kesalahan ( '.validation_errors().'). Silakan cek di formulir bawah ini!'),
            );
            // JSON encode data
            die(json_encode($data));
        }else{
            // -------------------------------------------------
            // Check File
            // -------------------------------------------------
            if( empty($_FILES['avatar_company']['name']) ){
                // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => smit_alert('Tidak ada berkas avatar yang di unggah. Silahkan inputkan berkas avatar!'),
                );
                die(json_encode($data));
            }

            if( !empty( $_POST ) ){
                $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/images/tenant/' . $current_user->id;
                if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

                $config = array(
                    'upload_path'   => $upload_path,
                    'allowed_types' => "jpg|jpeg|png",
                    'overwrite'     => FALSE,
                    'max_size'      => "1024000",
                );
                $this->upload->initialize($config);

                // -------------------------------------------------
                // Begin Transaction
                // -------------------------------------------------
                $this->db->trans_begin();

                if( !empty($_FILES['avatar_company']['name']) ){
                    if( ! $this->upload->do_upload('avatar_company') ){
                        $message = $this->upload->display_errors();
                        // Set JSON data
                        $data = array('message' => 'error','data' => $this->upload->display_errors());
                        die(json_encode($data));
                    }
                    $upload_data    = $this->upload->data();
                    $upload_file    = $upload_data['raw_name'] . $upload_data['file_ext'];
                    $this->image_moo->load($upload_path . '/' .$upload_data['file_name'])->resize_crop(200,200)->save($upload_path. '/' .$upload_file, TRUE);
                    $this->image_moo->clear();

                    $logotenant_data  = array(
                        'url'           => smit_isset($upload_data['full_path'],''),
                        'extension'     => substr(smit_isset($upload_data['file_ext'],''),1),
                        'filename'      => smit_isset($upload_data['raw_name'],''),
                        'size'          => smit_isset($upload_data['file_size'],0),
                        'uploader'      => $current_user->id,
                        'datemodified'  => $curdate,
                    );
                }
            }


            // -------------------------------------------------
            // Save Tenant
            // -------------------------------------------------
            $trans_save_Tenant  = FALSE;
            if( $save_tenant    = $this->Model_Tenant->update_data_tenant($current_user->id, $logotenant_data) ){

                $trans_save_Tenant  = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Perbaharui logo tenant tidak berhasil. Terjadi kesalahan berkas anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_Tenant ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Perbaharui logo tenant tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();

                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Perbaharui logo tenant baru berhasil!');
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'ACCOUNT_UPDATE', 'SUCCESS', maybe_serialize(array('username'=>$username, 'url'=> smit_isset($upload_data['full_path'],''))) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Perbaharui logo tenant tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }

            // JSON encode data
            die(json_encode($data));
        }
    }

    /**
	 * Tenant List Proses function.
	 */
    function tenantlistproses($action, $data){
        $response = array();

        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Hanya Administrator yang dapat melakukan proses ini',
            );
            return $response;
        };

        $curdate = date('Y-m-d H:i:s');
        if( $action=='confirm' )    { $actiontxt = 'Konfirmasi'; $status = ACTIVE; }
        elseif( $action=='banned' ) { $actiontxt = 'Banned'; $status = BANNED; }
        elseif( $action=='delete' ) { $actiontxt = 'Hapus'; $status = DELETED; }
        elseif( $action=='inwall' ) { $actiontxt = 'Inwall'; $postion = ACTIVE; }
        elseif( $action=='outwall' ) { $actiontxt = 'Outwall'; $postion = NONACTIVE; }
        elseif( $action=='graduate' ) { $actiontxt = 'Graduate'; $postion = GRADUATE; }

        $data = (object) $data;
        foreach( $data as $key => $uniquecode ){
            //if( $action=='delete' ){
                //$tenantlistdelete       = $this->Model_Tenant->delete_tenant($uniquecode);
            //}else
            if($action=='inwall' || $action=='outwall' || $action=='graduate'){
                $data_update = array('position'=>$postion, 'datemodified'=>$curdate);
                $this->Model_Tenant->update_tenant($uniquecode, $data_update);
            }else{
                $data_update = array('status'=>$status, 'datemodified'=>$curdate);
                $this->Model_Tenant->update_tenant($uniquecode, $data_update);
            }
        }

        $response = array(
            'status'    => 'OK',
            'message'   => 'Proses '.strtoupper($actiontxt).' data daftar tenant selesai di proses',
        );
        return $response;
    }

    /**
	 * Tenant confirm function.
	 */
    function tenantconfirm($action, $id){
        // This is for AJAX request
    	//if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');

        if ( !$action ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi data harus dicantumkan');
            // JSON encode data
            die(json_encode($data));
        };

        if ( !$id ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'ID Pengguna harus dicantumkan');
            // JSON encode data
            die(json_encode($data));
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi Pengguna hanya bisa dilakukan oleh Administrator');
            // JSON encode data
            die(json_encode($data));
        };

        $userdata           = smit_get_userdata_by_id($id);
        if( !$userdata ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Data pengguna tidak ditemukan atau belum terdaftar');
            // JSON encode data
            die(json_encode($data));
        }

        $curdate = date('Y-m-d H:i:s');
        if( $action=='active' )     { $status = ACTIVE; }
        elseif( $action=='banned' ) { $status = BANNED; }
        elseif( $action=='delete' ) { $status = DELETED; }

        $data_update = array('status'=>$status,'datemodified'=>$curdate);
        if( $this->Model_Tenant->update_data_tenant($id,$data_update) ){
            // Set JSON data
            $data = array('msg' => 'success','message' => 'Konfirmasi data pengguna berhasil dilakukan.');
            // JSON encode data
            die(json_encode($data));
        }else{
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi data pengguna tidak berhasil dilakukan.');
            // JSON encode data
            die(json_encode($data));
        }
    }

    /**
	 * Tenant Accepted list data function.
	 */
    function tenantacceptedlistdata(){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = '';
        $condition          = ' WHERE %status% = '.ACTIVE.' AND %companion_id% = 0';

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

        $s_name_tenant      = $this->input->post('search_name_tenant');
        $s_name_tenant      = smit_isset($s_name_tenant, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_user_name        = $this->input->post('search_user_name');
        $s_user_name        = smit_isset($s_user_name, '');
        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');

        if( !empty($s_name_tenant) )    { $condition .= str_replace('%s%', $s_name_tenant, ' AND %name_tenant% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_user_name) )      { $condition .= str_replace('%s%', $s_user_name, ' AND %user_name% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }

        if( $column == 1 )  { $order_by .= '%name_tenant% ' . $sort; }
        elseif( $column == 2)  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 3)  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 4)  { $order_by .= '%user_name% ' . $sort; }

        $tenant_list        = $this->Model_Tenant->get_all_tenant($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();

        if( !empty($tenant_list) ){
            $iTotalRecords  = smit_get_last_found_rows();

            $i = $offset + 1;
            foreach($tenant_list as $row){
                // Add Companion Button
                $btn_add    = '';
                if($row->companion_id == 0){
                    $btn_add = '<a href="'.base_url('tenants/pendampingan/detail/'.$row->uniquecode).'"
                    class="btn_score btn btn-xs btn-primary waves-effect tooltips" data-placement="top" title="Tetapkan"><i class="material-icons">account_box</i></a>';
                }

                $peneliti_utama     = $row->user_name;
                if( empty($peneliti_utama) ){
                    $peneliti_utama = $row->name;
                }

                $event_title        = $row->event_title;
                if( empty($event_title) ){
                    $event_title    = "<span style='color : red; '>Tidak Ada Data</span>";
                }

                $records["aaData"][] = array(
                    smit_center($i),
                    strtoupper($row->name_tenant),
                    strtoupper($event_title),
                    '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper($row->name) . '</a>',
                    strtoupper($peneliti_utama),
                    smit_center($btn_add),
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
	 * Tenant Detail list data function.
	 */
    public function companionassignment($uniquecode)
	{
        auth_redirect();

        $curdate                = date('Y-m-d H:i:s');
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        if( !$is_admin ){
            redirect( base_url('dashboard') );
        }

        if( !$uniquecode ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Parameter data pengaturan seleksi tidak ditemukan');
            // JSON encode data
            die(json_encode($data));
        }

        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/table/table-ajax.js',
        ));

        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'PraIncubationList.init();',
        ));

        $scripts_add            = '';

        // Custom
        $condition              = '';
        $tenant_list            = '';

        if(!empty($uniquecode)){
            $tenant_list        = $this->Model_Tenant->get_all_tenant('', '', ' WHERE A.uniquecode = "'.$uniquecode.'"', '');
            $tenant_list        = $tenant_list[0];
            $tenant_id          = $tenant_list->id;
        }

        if( !empty($_POST) ){
            $companion_id           = $this->input->post('companion_id');
            $companion_id           = smit_isset($companion_id, '');

            if( empty($companion_id) ){
                $this->session->set_flashdata('message','<div id="alert" class="alert alert-danger">'.smit_alert('Silahkan pilih pendamping!').'</div>');
            }else{
                // Check Companion Data
                $comppanion_data        = smit_get_userdata_by_id($companion_id);
                if( !$comppanion_data || empty($comppanion_data) ){
                    $this->session->set_flashdata('message','<div id="alert" class="alert alert-danger">'.smit_alert('Data pendamping tidak ditemukan atau belum terdaftar').'</div>');
                }else{
                    $tenant_update_data     = array(
                        'companion_id'      => $companion_id,
                        'datemodified'      => $curdate
                    );

                    $incubation_id          = $tenant_list->incubation_id;

                    if($incubation_id > 0 || !empty($incubation_id)){
                        $this->Model_Incubation->update_data_incubationdata($tenant_list->incubation_id, $tenant_update_data);
                    }

                    if( $this->Model_Tenant->update_data_tenant($tenant_list->id, $tenant_update_data) ){
                        redirect( base_url('tenants/pendampingan') );
                    }
                }
            }
        }

        $data['title']              = TITLE . 'Detail Tenant Diterima';
        $data['user']               = $current_user;
        $data['is_admin']           = $is_admin;
        $data['tenant']             = $tenant_list;
        $data['headstyles']         = $headstyles;
        $data['scripts']            = $loadscripts;
        $data['scripts_add']        = $scripts_add;
        $data['scripts_init']       = $scripts_init;
        $data['main_content']       = 'tenant/accepteddetail';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Product Tenant Add Function
	 */
	public function producttenantadd()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        $upload_data            = array();

        $event                  = $this->input->post('reg_event');
        $event                  = trim( smit_isset($event, "") );
        $event_title            = $this->input->post('reg_title');
        $event_title            = trim( smit_isset($event_title, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );
        $category               = $this->input->post('reg_category');
        $category               = trim( smit_isset($category, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_event','Kategori Bidang','required');
        $this->form_validation->set_rules('reg_title','Judul Produk','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi produk','required');
        $this->form_validation->set_rules('reg_category','Kategori Produk','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran produk tenant baru tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        if( empty($_FILES['reg_thumbnail']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada thumbnail yang di unggah. Silahkan inputkan thumbnail gambar!');
            die(json_encode($data));
        }

        if( empty($_FILES['reg_details']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada details gambar yang di unggah. Silahkan inputkan details gambar kegiatan!');
            die(json_encode($data));
        }

        $tenant_id      = $event;
        $tenantdata     = $this->Model_Tenant->get_all_tenant(0,0, ' WHERE %id% = '.$tenant_id.'');
        $tenantdata     = $tenantdata[0];
        $userdata       = smit_get_userdata_by_id($tenantdata->user_id);

        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            // Upload Files Process
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/tenantproduct/' . $userdata->id;
            if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

            $config = array(
                'upload_path'       => $upload_path,
                'allowed_types' => "jpg|jpeg|png",
                'overwrite'         => FALSE,
                'max_size'          => "2048000",
            );
            $this->load->library('MY_Upload', $config);

            if( ! $this->my_upload->do_upload('reg_thumbnail') ){
                $message = $this->my_upload->display_errors();

                // Set JSON data
                $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                die(json_encode($data));
            }
            $upload_data_thumbnail  = $this->my_upload->data();
            $upload_thumbnail       = $upload_data_thumbnail['raw_name'] . $upload_data_thumbnail['file_ext'];
            $this->image_moo->load($upload_path . '/' .$upload_data_thumbnail['file_name'])->resize_crop(800,600)->save($upload_path. '/' .$upload_thumbnail, TRUE);
            $this->image_moo->clear();

            if( ! $this->my_upload->do_upload('reg_details') ){
                $message = $this->my_upload->display_errors();

                // Set JSON data
                $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                die(json_encode($data));
            }
            $upload_data_details    = $this->my_upload->data();
            $upload_file            = $upload_data_details['raw_name'] . $upload_data_details['file_ext'];
            $this->image_moo->load($upload_path . '/' .$upload_data_details['file_name'])->resize_crop(1346,400)->save($upload_path. '/' .$upload_file, TRUE);
            $this->image_moo->clear();

            $file_thumbnail         = $upload_data_thumbnail;
            $file_details           = $upload_data_details;

            $status     = NONACTIVE;
            if( !empty($is_admin) ){
                $status = ACTIVE;
            }

            // Get Category ID
            $categorydata           = $this->Model_Option->get_categoryproductdata($category);
            if( ! $categorydata ){
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Data kategori tidak ditemukan atau belum terdaftar');
                die(json_encode($data));
            }

            $product_data           = array(
                'uniquecode'        => smit_generate_rand_string(10,'low'),
                'tenant_id'         => $tenant_id,
                'user_id'           => $userdata->id,
                'username'          => strtolower($userdata->username),
                'name'              => strtoupper($userdata->name),
                'title'             => $event_title,
                'description'       => $description,
                'category_id'       => $categorydata->category_id,
                'category_product'  => strtoupper( $categorydata->category_name ),
                'url'               => smit_isset($file_details['full_path'],''),
                'extension'         => substr(smit_isset($file_details['file_ext'],''),1),
                'filename'          => smit_isset($file_details['raw_name'],''),
                'size'              => smit_isset($file_details['file_size'],0),
                'thumbnail_url'           => smit_isset($file_thumbnail['full_path'],''),
                'thumbnail_extension'     => substr(smit_isset($file_thumbnail['file_ext'],''),1),
                'thumbnail_filename'      => smit_isset($file_thumbnail['raw_name'],''),
                'thumbnail_size'          => smit_isset($file_thumbnail['file_size'],0),
                'status'            => $status,
                'datecreated'       => $curdate,
                'datemodified'      => $curdate,
            );

            // -------------------------------------------------
            // Save Tenant Product Selection
            // -------------------------------------------------
            $trans_save_product       = FALSE;
            if( $product_save_id      = $this->Model_Tenant->save_data_product($product_data) ){
                $trans_save_product   = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran product tenant tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_product ){
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
                    //$this->smit_email->send_email_registration_selection($userdata->email, $event_title);

                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran product tenant baru berhasil!');
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'PRODUCTTENANT_REG', 'SUCCESS', maybe_serialize(array('username'=>$userdata->username)) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran product tenant tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }
        }
	}

    /**
	 * Product Tenant list data function.
	 */
    function producttenantlistdata(){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = '';
        if( !$is_admin ){
            $condition      = ' WHERE %user_id% = '.$current_user->id.'';
        }

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

        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name_tenant% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )  { $order_by .= '%name_tenant% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%title% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 6 )  { $order_by .= '%datecreated% ' . $sort; }

        $product_list       = $this->Model_Tenant->get_all_product($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($product_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status');

            $i = $offset + 1;
            foreach($product_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('tenants/produk/detail/'.$row->uniquecode).'"
                    class="sliderdetailset btn btn-xs btn-primary waves-effect tooltips" id="btn_produk_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>';

                $btn_edit   = '<a href="'.base_url('tenants/produk/edit/'.$row->uniquecode).'"
                    class="productedit btn btn-xs btn-warning waves-effect tooltips" id="btn_produk_edit" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>';

                if($row->status == NONACTIVE)   {
                    $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>';
                }elseif($row->status == ACTIVE)  {
                    $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                }elseif($row->status == BANNED)  {
                    $status         = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>';
                }elseif($row->status == DELETED) {
                    $status         = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>';
                }

                $file_name      = $row->filename . '.' . $row->extension;
                $file_url       = BE_UPLOAD_PATH . 'tenantproduct/'.$row->user_id.'/' . $file_name;
                $product        = $file_url;
                $product        = '<img class="js-animating-object img-responsive" src="'.$product.'" alt="'.$row->title.'" />';

                $records["aaData"][] = array(
                    smit_center('<input name="productlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                    <label for="cblist'.$row->uniquecode.'"></label>'),
                    smit_center($i),
                    strtoupper($row->name),
                    strtoupper($row->event_title),
                    '<a href="'.base_url('tenants/produk/detail/'.$row->uniquecode).'">' . strtoupper($row->title) . '</a>',
                    $product,
                    smit_center( $status ),
                    //smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
                    smit_center( $btn_action .' '. $btn_edit),
                );
                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $productlist            = $_REQUEST['productlist'];

            $proses                 = $this->productproses($sGroupActionName, $productlist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
    * Product Edit function.
    */
    public function productedit( $uniquecode='' ){
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $headstyles             = smit_headstyles(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',

            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
            BE_JS_PATH . 'pages/forms/editors.js',
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'UploadFiles.init();',
            'ProductValidation.init();',
        ));

        $productdata               = '';
        if( !empty($uniquecode) ){
            $productdata        = $this->Model_Tenant->get_all_product(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $productdata        = $productdata[0];
        }

        if($productdata){
            $file_name      = $productdata->filename . '.' . $productdata->extension;
            $file_url       = BE_UPLOAD_PATH . 'tenantproduct/'. $productdata->user_id . '/' . $file_name;
            $product_image  = $file_url;
        }else{
            $product_image  = BE_IMG_PATH . 'news/noimage.jpg';
        }

        $data['title']          = TITLE . 'Produk Detail';
        $data['productdata']    = $productdata;
        $data['product_image']  = $product_image;
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/productedit';

        $this->load->view(VIEW_BACK . 'template', $data);
    }

    /**
	 * Product Tenant Edit Function
	 */
	public function producttenantedit()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        $upload_data            = array();

        $uniquecode             = $this->input->post('reg_uniquecode');
        $uniquecode             = trim( smit_isset($uniquecode, "") );
        $event                  = $this->input->post('reg_event');
        $event                  = trim( smit_isset($event, "") );
        $event_title            = $this->input->post('reg_title');
        $event_title            = trim( smit_isset($event_title, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_title','Judul Produk','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi Produk','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah Kegiatan Tenant baru tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        /*
        if( empty($_FILES['reg_thumbnail']['name']) ){
            $data = array('message' => 'error','data' => 'Tidak ada thumbnail yang di unggah. Silahkan inputkan thumbnail gambar!');
            die(json_encode($data));
        }

        if( empty($_FILES['reg_details']['name']) ){
            $data = array('message' => 'error','data' => 'Tidak ada details gambar yang di unggah. Silahkan inputkan details gambar kegiatan!');
            die(json_encode($data));
        }
        */

        $productdata               = '';
        if( !empty($uniquecode) ){
            $productdata        = $this->Model_Tenant->get_all_product(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $productdata        = $productdata[0];
        }

        $file_name      = $productdata->filename . '.' . $productdata->extension;
        $file_url       = BE_UPLOAD_PATH . 'tenantproduct/'. $productdata->user_id . '/' . $file_name;
        $product_image  = $file_url;

        $thumbnail_file_name      = $productdata->thumbnail_filename . '.' . $productdata->thumbnail_extension;
        $thumbnail_file_url       = BE_UPLOAD_PATH . 'tenantproduct/'. $productdata->user_id . '/' . $thumbnail_file_name;
        $thumbnail_product_image  = $thumbnail_file_url;

        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            // Upload Files Process
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/tenantproduct/' . $productdata->user_id;
            if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

            $config = array(
                'upload_path'       => $upload_path,
                'allowed_types' => "jpg|jpeg|png",
                'overwrite'         => FALSE,
                'max_size'          => "2048000",
            );
            $this->load->library('MY_Upload', $config);

            $file_thumbnail     = '';
            if( !empty($_FILES['reg_thumbnail']['name']) ){
                //unlink($thumbnail_product_image);

                if( ! $this->my_upload->do_upload('reg_thumbnail') ){
                    $message = $this->my_upload->display_errors();

                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                    die(json_encode($data));
                }
                $upload_data_thumbnail  = $this->my_upload->data();
                $upload_thumbnail       = $upload_data_thumbnail['raw_name'] . $upload_data_thumbnail['file_ext'];
                $this->image_moo->load($upload_path . '/' .$upload_data_thumbnail['file_name'])->resize_crop(800,600)->save($upload_path. '/' .$upload_thumbnail, TRUE);
                $this->image_moo->clear();
                $file_thumbnail         = $upload_data_thumbnail;
            }

            $file_details       = '';
            if( !empty($_FILES['reg_details']['name']) ){
                //unlink($product_image);

                if( ! $this->my_upload->do_upload('reg_details') ){
                    $message = $this->my_upload->display_errors();

                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                    die(json_encode($data));
                }
                $upload_data_details    = $this->my_upload->data();
                $upload_file            = $upload_data_details['raw_name'] . $upload_data_details['file_ext'];
                $this->image_moo->load($upload_path . '/' .$upload_data_details['file_name'])->resize_crop(1346,400)->save($upload_path. '/' .$upload_file, TRUE);
                $this->image_moo->clear();
                $file_details           = $upload_data_details;
            }

            if( !empty($file_thumbnail) && !empty($file_details) ){
                $product_data           = array(
                    'title'             => $event_title,
                    'description'       => $description,
                    'url'               => smit_isset($file_details['full_path'],''),
                    'extension'         => substr(smit_isset($file_details['file_ext'],''),1),
                    'filename'          => smit_isset($file_details['raw_name'],''),
                    'size'              => smit_isset($file_details['file_size'],0),
                    'thumbnail_url'           => smit_isset($file_thumbnail['full_path'],''),
                    'thumbnail_extension'     => substr(smit_isset($file_thumbnail['file_ext'],''),1),
                    'thumbnail_filename'      => smit_isset($file_thumbnail['raw_name'],''),
                    'thumbnail_size'          => smit_isset($file_thumbnail['file_size'],0),
                    'datecreated'       => $curdate,
                    'datemodified'      => $curdate,
                );
            }elseif( !empty($file_thumbnail) ){
                $product_data           = array(
                    'title'             => $event_title,
                    'description'       => $description,
                    'thumbnail_url'           => smit_isset($file_thumbnail['full_path'],''),
                    'thumbnail_extension'     => substr(smit_isset($file_thumbnail['file_ext'],''),1),
                    'thumbnail_filename'      => smit_isset($file_thumbnail['raw_name'],''),
                    'thumbnail_size'          => smit_isset($file_thumbnail['file_size'],0),
                    'datecreated'       => $curdate,
                    'datemodified'      => $curdate,
                );
            }elseif( !empty($file_details) ){
                $product_data           = array(
                    'title'             => $event_title,
                    'description'       => $description,
                    'url'               => smit_isset($file_details['full_path'],''),
                    'extension'         => substr(smit_isset($file_details['file_ext'],''),1),
                    'filename'          => smit_isset($file_details['raw_name'],''),
                    'size'              => smit_isset($file_details['file_size'],0),
                    'datecreated'       => $curdate,
                    'datemodified'      => $curdate,
                );
            }else{
                $product_data           = array(
                    'title'             => $event_title,
                    'description'       => $description,
                    'datecreated'       => $curdate,
                    'datemodified'      => $curdate,
                );
            }

            // -------------------------------------------------
            // Edit Incubation Selection
            // -------------------------------------------------
            $trans_edit_product       = FALSE;
            if( $product_edit_id      = $this->Model_Tenant->update_product($uniquecode, $product_data) ){
                $trans_edit_product   = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Ubah product Tenant tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_edit_product ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Ubah tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();

                    // Send Email Notification
                    //$this->smit_email->send_email_registration_selection($userdata->email, $event_title);

                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Ubah produk tenant baru berhasil!');
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'PRODUCTEDIT_REG', 'SUCCESS', maybe_serialize(array('username'=>$username, 'upload_files'=> $upload_data)) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Ubah produk tenant tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }
        }
	}

    /**
	 * Product Proses function.
	 */
    function productproses($action, $data){
        $response = array();

        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Hanya Administrator yang dapat melakukan proses ini',
            );
            return $response;
        };

        $curdate = date('Y-m-d H:i:s');
        if( $action=='confirm' )    { $actiontxt = 'Konfirmasi'; $status = ACTIVE; }
        elseif( $action=='banned' ) { $actiontxt = 'Banned'; $status = BANNED; }
        elseif( $action=='delete' ) { $actiontxt = 'Hapus'; $status = DELETED; }
        elseif( $action=='graduate' ) { $actiontxt = 'Graduate'; $status = GRADUATE; }

        $data = (object) $data;
        foreach( $data as $key => $uniquecode ){
            if( $action=='delete' ){
                $productdelete  = $this->Model_Tenant->delete_product($uniquecode);
            }else{
                $data_update    = array('status'=>$status, 'datemodified'=>$curdate);
                $this->Model_Tenant->update_product($uniquecode, $data_update);
            }
        }

        $response = array(
            'status'    => 'OK',
            'message'   => 'Proses '.strtoupper($actiontxt).' data daftar produk selesai di proses',
        );
        return $response;
    }

    /**
    * Product Details function.
    */
    public function productdetails( $uniquecode='' ){
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $headstyles             = smit_headstyles(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
        ));

        $loadscripts            = smit_scripts(array(
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',

            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));

        $scripts_add            = '';
        $scripts_init           = '';
        $newsdata               = '';

        if( !empty($uniquecode) ){
            $productdata        = $this->Model_Tenant->get_all_product(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $productdata        = $productdata[0];
        }

        if($productdata){
            $file_name      = $productdata->filename . '.' . $productdata->extension;
            $file_url       = BE_UPLOAD_PATH . 'tenantproduct/'. $productdata->user_id . '/' . $file_name;
            $product_image  = $file_url;
        }else{
            $product_image  = BE_IMG_PATH . 'news/noimage.jpg';
        }

        $data['title']          = TITLE . 'Produk Detail';
        $data['productdata']    = $productdata;
        $data['product_image']  = $product_image;
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/productdetail';

        $this->load->view(VIEW_BACK . 'template', $data);
    }


    // ---------------------------------------------------------------------------------------------
    // BLOG TENANT
    /**
	 * Blog Tenant Add Function
	 */
	public function addblogtenant()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        $upload_data            = array();

        $product_id             = $this->input->post('reg_product');
        $product_id             = trim( smit_isset($product_id, "") );
        $title                  = $this->input->post('reg_title');
        $title                  = trim( smit_isset($title, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_product','Usulan','required');
        $this->form_validation->set_rules('reg_title','Judul Blog','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi Blog','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran blog tenant baru tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        if( empty($_FILES['reg_thumbnail']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada thumbnail yang di unggah. Silahkan inputkan thumbnail gambar!');
            die(json_encode($data));
        }

        if( empty($_FILES['reg_details']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada details gambar yang di unggah. Silahkan inputkan details gambar kegiatan!');
            die(json_encode($data));
        }

        $tenantdata     = $this->Model_Tenant->get_all_tenant(0,0, ' WHERE %product_id% = '.$product_id.'');
        $tenantdata     = $tenantdata[0];

        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            // Upload Files Process
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/tenantblog/' . $tenantdata->user_id;
            if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

            $config = array(
                'upload_path'       => $upload_path,
                'allowed_types' => "jpg|jpeg|png",
                'overwrite'         => FALSE,
                'max_size'          => "2048000",
            );
            $this->load->library('MY_Upload', $config);

            if( ! $this->my_upload->do_upload('reg_thumbnail') ){
                $message = $this->my_upload->display_errors();

                // Set JSON data
                $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                die(json_encode($data));
            }
            $upload_data_thumbnail  = $this->my_upload->data();
            $upload_thumbnail       = $upload_data_thumbnail['raw_name'] . $upload_data_thumbnail['file_ext'];
            $this->image_moo->load($upload_path . '/' .$upload_data_thumbnail['file_name'])->resize_crop(800,600)->save($upload_path. '/' .$upload_thumbnail, TRUE);
            $this->image_moo->clear();

            if( ! $this->my_upload->do_upload('reg_details') ){
                $message = $this->my_upload->display_errors();

                // Set JSON data
                $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                die(json_encode($data));
            }
            $upload_data_details    = $this->my_upload->data();
            $upload_file            = $upload_data_details['raw_name'] . $upload_data_details['file_ext'];
            $this->image_moo->load($upload_path . '/' .$upload_data_details['file_name'])->resize_crop(1346,400)->save($upload_path. '/' .$upload_file, TRUE);
            $this->image_moo->clear();

            $file_thumbnail         = $upload_data_thumbnail;
            $file_details           = $upload_data_details;

            $status     = NONACTIVE;
            if( !empty($is_admin) ){
                $status = ACTIVE;
            }

            $blog_data              = array(
                'uniquecode'        => smit_generate_rand_string(10,'low'),
                'product_id'        => $product_id,
                'user_id'           => $tenantdata->user_id,
                'username'          => strtolower($tenantdata->username),
                'name'              => strtoupper($tenantdata->name),
                'title'             => $title,
                'description'       => $description,
                'url'               => smit_isset($file_details['full_path'],''),
                'extension'         => substr(smit_isset($file_details['file_ext'],''),1),
                'filename'          => smit_isset($file_details['raw_name'],''),
                'size'              => smit_isset($file_details['file_size'],0),
                'thumbnail_url'           => smit_isset($file_thumbnail['full_path'],''),
                'thumbnail_extension'     => substr(smit_isset($file_thumbnail['file_ext'],''),1),
                'thumbnail_filename'      => smit_isset($file_thumbnail['raw_name'],''),
                'thumbnail_size'          => smit_isset($file_thumbnail['file_size'],0),
                'status'            => $status,
                'datecreated'       => $curdate,
                'datemodified'      => $curdate,
            );

            // -------------------------------------------------
            // Save Tenant Blog
            // -------------------------------------------------
            $trans_save_blog_tenant       = FALSE;
            if( $blog_save_id               = $this->Model_Tenant->save_data_blogtenant($blog_data) ){
                $trans_save_blog_tenant   = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran blog tenant tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_blog_tenant ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pendaftaran blog tenant tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();

                    // Send Email Notification
                    //$this->smit_email->send_email_registration_selection($userdata->email, $event_title);

                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran blog tenant baru berhasil!');
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'BLOGTENANT_REG', 'SUCCESS', maybe_serialize(array('username'=>$tenantdata->username)) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran blog tenant tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }
        }
	}

    /**
	 * Blog Tenant list data function.
	 */
    function blogtenantlistdata(){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = '';
        if( !$is_admin ){
            $condition      = ' WHERE %user_id% = '.$current_user->id.'';
        }

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

        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name_tenant% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )  { $order_by .= '%name_tenant% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%title% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 6 )  { $order_by .= '%datecreated% ' . $sort; }

        $blog_list          = $this->Model_Tenant->get_all_blogtenant($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($blog_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status');

            $i = $offset + 1;
            foreach($blog_list as $row){
                // Button
                $btn_action      = '<a href="'.base_url('tenants/blogs/detail/'.$row->uniquecode).'"
                    class="blogtenantdetail btn btn-xs btn-primary waves-effect tooltips" id="btn_produk_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>';
                $btn_edit        = '<a href="'.base_url('tenants/blogs/edit/'.$row->uniquecode).'"
                    class="blogtenantedit btn btn-xs btn-warning waves-effect tooltips" id="btn_produk_edit" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>';

                if($row->status == NONACTIVE)   {
                    $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>';
                }if($row->status == ACTIVE)  {
                    $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                }elseif($row->status == BANNED)  {
                    $status         = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>';
                }elseif($row->status == DELETED) {
                    $status         = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>';
                }

                $file_name      = $row->filename . '.' . $row->extension;
                $file_url       = BE_UPLOAD_PATH . 'tenantblog/'.$row->user_id.'/' . $file_name;
                $image          = $file_url;
                $image          = '<img class="js-animating-object img-responsive" src="'.$image.'" alt="'.$row->title.'" />';

                $title          = $row->product_title;
                if( empty($title) ){
                    $title      = '<strong> - </strong>';
                }

                $records["aaData"][] = array(
                    smit_center('<input name="blogtenantlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                    <label for="cblist'.$row->uniquecode.'"></label>'),
                    smit_center($i),
                    strtoupper($row->name),
                    '<a href="'.base_url('tenants/produk/detail/'.$row->uniquecode).'">' . strtoupper($row->title) . '</a>',
                    strtoupper( smit_center( $title) ),
                    $image,
                    smit_center( $status ),
                    //smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
                    smit_center( $btn_action .' '. $btn_edit),
                );
                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $blogtenantlist         = $_REQUEST['blogtenantlist'];

            $proses                 = $this->blogtenantproses($sGroupActionName, $blogtenantlist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * Blog Tenant Proses function.
	 */
    function blogtenantproses($action, $data){
        $response = array();

        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Hanya Administrator yang dapat melakukan proses ini',
            );
            return $response;
        };

        $curdate = date('Y-m-d H:i:s');
        if( $action=='confirm' )    { $actiontxt = 'Konfirmasi'; $status = ACTIVE; }
        elseif( $action=='banned' ) { $actiontxt = 'Banned'; $status = BANNED; }
        elseif( $action=='delete' ) { $actiontxt = 'Hapus'; $status = DELETED; }

        $data = (object) $data;
        foreach( $data as $key => $uniquecode ){
            if( $action=='delete' ){
                $blogtenantdelete   = $this->Model_Tenant->delete_blogtenant($uniquecode);
            }else{
                $data_update = array('status'=>$status, 'datemodified'=>$curdate);
                $this->Model_Tenant->update_blogtenant($uniquecode, $data_update);
            }
        }

        $response = array(
            'status'    => 'OK',
            'message'   => 'Proses '.strtoupper($actiontxt).' data blog tenant selesai di proses',
        );
        return $response;
    }

    /**
	 * Report Inkubasi/Tenant Add Function
	 */
	public function reporttenantadd()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        $upload_data            = array();

        $event                  = $this->input->post('reg_event');
        $event                  = trim( smit_isset($event, "") );
        $month                  = $this->input->post('reg_month');
        $month                  = trim( smit_isset($month, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_event','Nama Tenant','required');
        $this->form_validation->set_rules('reg_month','Bulan','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran Laporan Inkubasi/Tenant baru tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        if( empty($_FILES['reg_selection_files']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Berkas laporan yang di unggah. Silahkan inputkan Berkas laporan!');
            die(json_encode($data));
        }

        $tenantdata     = $this->Model_Tenant->get_all_tenant(0, 0, ' WHERE %id% = '.$event.'');
        $tenantdata     = $tenantdata[0];

        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            // Upload Files Process
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/report/incubation/' . $tenantdata->user_id;
            if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

            $config = array(
                'upload_path'       => $upload_path,
                'allowed_types'     => "doc|docx|pdf",
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

            $upload_data_files      = $this->my_upload->data();
            $file                   = $upload_data_files;

            $status     = NONACTIVE;
            if( !empty($is_admin) ){
                $status = ACTIVE;
            }

            $report_data        = array(
                'uniquecode'    => smit_generate_rand_string(10,'low'),
                'tenant_id'     => $event,
                'user_id'       => $tenantdata->user_id,
                'username'      => strtolower($tenantdata->username),
                'name'          => strtoupper($tenantdata->name),
                'url'           => smit_isset($file['full_path'],''),
                'extension'     => substr(smit_isset($file['file_ext'],''),1),
                'filename'      => smit_isset($file['raw_name'],''),
                'size'          => smit_isset($file['file_size'],0),
                'month'         => $month,
                'status'        => $status,
                'uploader'      => $tenantdata->user_id,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate,
            );

            // -------------------------------------------------
            // Save Report Incubation/Tenant
            // -------------------------------------------------
            $trans_save_report      = FALSE;
            if( $report_save_id     = $this->Model_Tenant->save_data_report($report_data) ){
                $trans_save_report   = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran laporan Inkubasi/Tenant tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_report ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pendaftaran laporan Inkubasi/Tenant tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();

                    // Send Email Notification
                    //$this->smit_email->send_email_registration_selection($userdata->email, $event_title);

                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran laporan Inkubasi/Tenant baru berhasil!');
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'REPORTINC_REG', 'SUCCESS', maybe_serialize(array('username'=>$tenantdata->username, 'upload_files'=> $upload_data_files)) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran laporan Inkubasi/Tenant tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }
        }
	}

    /**
	 * Report Incubation/Tenant list data function.
	 */
    function reportdata( ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $is_pendamping      = as_pendamping($current_user);
        $condition          = '';

        $order_by           = 'year DESC';
        $iTotalRecords      = 0;

        $iDisplayLength     = intval($_REQUEST['iDisplayLength']);
        $iDisplayStart      = intval($_REQUEST['iDisplayStart']);

        $sAction            = smit_isset($_REQUEST['sAction'],'');
        $sEcho              = intval($_REQUEST['sEcho']);
        $sort               = $_REQUEST['sSortDir_0'];
        $column             = intval($_REQUEST['iSortCol_0']);

        $limit              = ( $iDisplayLength == '-1' ? 0 : $iDisplayLength );
        $offset             = $iDisplayStart;

        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');
        $s_user_name        = $this->input->post('search_user');
        $s_user_name        = smit_isset($s_user_name, '');
        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_workunit         = $this->input->post('search_workunit');
        $s_workunit         = smit_isset($s_workunit, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year% LIKE "%%s%%"'); }
        if( !empty($s_user_name) )      { $condition .= str_replace('%s%', $s_user_name, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%username% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 15 )  { $order_by .= '%datecreated% ' . $sort; }

        $reportpra_list     = $this->Model_Tenant->get_all_reporttenantadmin($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();

        if( !empty($reportpra_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');

            $i = $offset + 1;
            foreach($reportpra_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('tenants/laporan/detail/'.$row->user_id).'"
                    class="inact btn btn-xs btn-primary waves-effect tooltips bottom5" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';

                $workunit   = '<center> - </cemter>';
                if($row->workunit > 0){
                    $workunit_type  = smit_workunit_type($row->workunit);
                    $workunit       = $workunit_type->workunit_name;
                }
                $year           = $row->year;
                $name_user      = strtoupper($row->username);
                $name           = strtoupper($row->name_tenant);
                $event          = $row->event_title;
                $month          = $row->month;
                $datecreated    = date('d F Y H:i:s', strtotime($row->datecreated));

                $btn_upload     = '<a href="'.base_url('prainkubasi/daftar/detail/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-default waves-effect tooltips bottom5" data-placement="left" title="Unggah"><i class="material-icons">file_upload</i></a> ';

                $btn_download   = '<a href="'.base_url('prainkubasi/daftar/detail/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-default waves-effect tooltips bottom5" data-placement="left" title="Unduh"><i class="material-icons">file_download</i></a> ';

                $count_all_report  = $this->Model_Tenant->count_all_reporttenant($row->user_id, $row->tenant_id);

                $records["aaData"][] = array(
                    smit_center( $i ),
                    smit_center( $year ),
                    strtoupper( $name ),
                    strtoupper( $name_user ),
                    strtoupper( $workunit ),
                    strtoupper( $event ),
                    smit_center( $count_all_report ),
                    smit_center( $datecreated ),
                    smit_center( $btn_action ),
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
	 * Report Action Plan list data function.
	 */
    function reportactionplandata( ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $is_pendamping      = as_pendamping($current_user);
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

        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');
        $s_user_name        = $this->input->post('search_user');
        $s_user_name        = smit_isset($s_user_name, '');
        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_workunit         = $this->input->post('search_workunit');
        $s_workunit         = smit_isset($s_workunit, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year% LIKE "%%s%%"'); }
        if( !empty($s_user_name) )      { $condition .= str_replace('%s%', $s_user_name, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%username% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 6 )  { $order_by .= '%datecreated% ' . $sort; }

        $reportaction_list  = $this->Model_Tenant->get_all_reportactionplanadmin($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();

        if( !empty($reportaction_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');

            $i = $offset + 1;
            foreach($reportaction_list as $row){
                $workunit   = '<center> - </cemter>';
                if($row->workunit > 0){
                    $workunit_type  = smit_workunit_type($row->workunit);
                    $workunit       = $workunit_type->workunit_name;
                }
                $year           = $row->year;
                $month          = $row->month;
                $name           = strtoupper($row->name_tenant);
                $name_actionplan      = $row->name_actionplan;
                $datecreated    = date('d F Y H:i:s', strtotime($row->datecreated));


                $btn_download   = '<a href="'.base_url('tenants/laporan/unduhactionplan/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-success waves-effect tooltips bottom5" data-placement="left" title="Unduh"><i class="material-icons">file_download</i></a> ';

                $btn_download   = "<center><span style='color : red;'> - </span></center>";
                $uploaded       = $row->uploader;
                if( $uploaded > 0 ){
                    $btn_download   = '<a href="'.base_url('tenants/laporan/unduhactionplan/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-default waves-effect tooltips bottom5" data-placement="left" title="Unduh"><i class="material-icons">file_download</i></a> ';
                }
                $btn_action     = "";
                if( $uploaded == 0){
                    $btn_action = '<a href="'.base_url('tenants/laporan/actionplan/detail/'.$row->id).'"
                    class="inact btn btn-xs btn-default waves-effect tooltips bottom5" data-placement="left" title="Tambah Bukti Berkas"><i class="material-icons">add</i></a> ';
                }

                $records["aaData"][] = array(
                    smit_center( $i ),
                    smit_center( $year ),
                    smit_center( $month ),
                    strtoupper( $name ),
                    strtoupper( $name_actionplan ),
                    smit_center( $btn_download ),
                    smit_center( $datecreated ),
                    smit_center( $btn_action ),
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

    function tenantreportdetail( $id = '' ){
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_pendamping          = as_pendamping($current_user);
        $is_jury                = as_juri($current_user);

        $headstyles             = smit_headstyles(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',

            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'UploadFiles.init();',
            'ReportValidation.init();',
        ));

        $data['title']          = TITLE . 'Laporan Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_jury']        = $is_jury;
        $data['is_pendamping']  = $is_pendamping;
        $data['id']             = $id;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/reportdetails';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    function tenantreportactionplandetail( $id = '' ){
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_pendamping          = as_pendamping($current_user);
        $is_jury                = as_juri($current_user);

        $headstyles             = smit_headstyles(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',

            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'UploadFiles.init();',
            'ReportValidation.init();',
        ));

        $data['title']          = TITLE . 'Laporan Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_jury']        = $is_jury;
        $data['is_pendamping']  = $is_pendamping;
        $data['id']             = $id;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/reportactionplandetails';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Report Action Plan Add Function
	 */
	public function reportactionplanadd()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        $upload_data            = array();

        $event                  = $this->input->post('reg_event');
        $event                  = trim( smit_isset($event, "") );
        $year                   = $this->input->post('reg_year');
        $year                   = trim( smit_isset($year, "") );
        $month                  = $this->input->post('reg_month');
        $month                  = trim( smit_isset($month, "") );
        $name_actionplan        = $this->input->post('reg_name_actionplan');
        $name_actionplan        = trim( smit_isset($name_actionplan, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_event','Nama Tenant','required');
        $this->form_validation->set_rules('reg_year','Tahun','required');
        $this->form_validation->set_rules('reg_month','Bulan','required');
        $this->form_validation->set_rules('reg_name_actionplan','Nama Action Plan','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran Laporan Action Plan baru tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        /*
        if( empty($_FILES['reg_actionplan_files']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Berkas laporan yang di unggah. Silahkan inputkan Berkas laporan!');
            die(json_encode($data));
        }
        */

        $tenantdata     = $this->Model_Tenant->get_all_tenant(0, 0, ' WHERE %id% = '.$event.'');
        $tenantdata     = $tenantdata[0];

        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            if( !empty($_FILES['reg_actionplan_files']['name']) ){
                // Upload Files Process
                $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/report/incubation/' . $tenantdata->user_id;
                if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

                $config = array(
                    'upload_path'       => $upload_path,
                    'allowed_types'     => "doc|docx|pdf",
                    'overwrite'         => FALSE,
                    'max_size'          => "2048000",
                );

                $this->load->library('MY_Upload', $config);

                if( ! $this->my_upload->do_upload('reg_actionplan_files') ){
                    $message = $this->my_upload->display_errors();

                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                    die(json_encode($data));
                }

                $upload_data_files      = $this->my_upload->data();
                $file                   = $upload_data_files;

                $status     = NONACTIVE;
                if( !empty($is_admin) ){
                    $status = ACTIVE;
                }

                $report_data        = array(
                    'uniquecode'    => smit_generate_rand_string(10,'low'),
                    'tenant_id'     => $event,
                    'user_id'       => $tenantdata->user_id,
                    'username'      => strtolower($tenantdata->username),
                    'name'          => strtoupper($tenantdata->name),
                    'name_actionplan'=> $name_actionplan,
                    'url'           => smit_isset($file['full_path'],''),
                    'extension'     => substr(smit_isset($file['file_ext'],''),1),
                    'filename'      => smit_isset($file['raw_name'],''),
                    'size'          => smit_isset($file['file_size'],0),
                    'month'         => $month,
                    'year'          => $year,
                    'status'        => $status,
                    'uploader'      => $tenantdata->user_id,
                    'datecreated'   => $curdate,
                    'datemodified'  => $curdate,
                );
            }else{
                $status     = NONACTIVE;
                if( !empty($is_admin) ){
                    $status = ACTIVE;
                }

                $report_data        = array(
                    'uniquecode'    => smit_generate_rand_string(10,'low'),
                    'tenant_id'     => $event,
                    'user_id'       => $tenantdata->user_id,
                    'username'      => strtolower($tenantdata->username),
                    'name'          => strtoupper($tenantdata->name),
                    'name_actionplan'=> $name_actionplan,
                    'month'         => $month,
                    'year'          => $year,
                    'status'        => $status,
                    'datecreated'   => $curdate,
                    'datemodified'  => $curdate,
                );
            }

            // -------------------------------------------------
            // Save Report Incubation/Tenant
            // -------------------------------------------------
            $trans_save_actionplan  = FALSE;
            if( $report_save_id     = $this->Model_Tenant->save_data_actionplan($report_data) ){
                $trans_save_actionplan  = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran laporan Inkubasi/Tenant tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_actionplan ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pendaftaran laporan Action Plan tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();

                    // Send Email Notification
                    //$this->smit_email->send_email_registration_selection($userdata->email, $event_title);

                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran laporan Action Plan baru berhasil!');
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'REPORTINC_REG', 'SUCCESS', maybe_serialize(array('username'=>$tenantdata->username, 'upload_files'=> $upload_data_files ? $upload_data_files : "")) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran laporan Action Plan tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }
        }
	}

    public function reportactionplanaddfiles()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        $upload_data            = array();

        $id                     = $this->input->post('tenant_id');
        $id                     = trim( smit_isset($id, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('tenant_id','Tenant Id','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran Laporan Action Plan baru tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        $reportaction_list  = $this->Model_Tenant->get_all_reportactionplanadmin(0, 0, ' WHERE %id% = '.$id.'');
        $reportaction_list  = $reportaction_list[0];

        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            if( !empty($_FILES['reg_actionplan_files']['name']) ){
                // Upload Files Process
                $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/report/incubation/' . $tenantdata->user_id;
                if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

                $config = array(
                    'upload_path'       => $upload_path,
                    'allowed_types'     => "doc|docx|pdf",
                    'overwrite'         => FALSE,
                    'max_size'          => "2048000",
                );

                $this->load->library('MY_Upload', $config);

                if( ! $this->my_upload->do_upload('reg_actionplan_files') ){
                    $message = $this->my_upload->display_errors();

                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                    die(json_encode($data));
                }

                $upload_data_files      = $this->my_upload->data();
                $file                   = $upload_data_files;

                $status     = NONACTIVE;
                if( !empty($is_admin) ){
                    $status = ACTIVE;
                }

                $report_data        = array(
                    'url'           => smit_isset($file['full_path'],''),
                    'extension'     => substr(smit_isset($file['file_ext'],''),1),
                    'filename'      => smit_isset($file['raw_name'],''),
                    'size'          => smit_isset($file['file_size'],0),
                    'uploader'      => $reportaction_list->user_id,
                    'datemodified'  => $curdate,
                );
            }

            // -------------------------------------------------
            // Save Report Incubation/Tenant
            // -------------------------------------------------
            $trans_save_actionplan  = FALSE;
            if( $report_save_id     = $this->Model_Tenant->update_actionplan($id, $report_data) ){
                $trans_save_actionplan  = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran Bekras Action Plan tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_actionplan ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pendaftaran laporan Action Plan tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();

                    // Send Email Notification
                    //$this->smit_email->send_email_registration_selection($userdata->email, $event_title);

                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran laporan Action Plan baru berhasil!');
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'REPORTINC_REG', 'SUCCESS', maybe_serialize(array('username'=>$current_user->username, 'upload_files'=> $upload_data_files ? $upload_data_files : "")) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran laporan Action Plan tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }
        }
	}

    /**
	 * Report Incubation/Tenant list data function.
	 */
    function reportdatauser( $id='' ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $is_pendamping      = as_pendamping($current_user);

        $condition          = '';
        if( !$is_admin ){
            $condition      = ' WHERE %user_id% = '.$current_user->id.'';
        }
        if( $is_pendamping ){
            $condition      = ' WHERE %companion_id% = '.$current_user->id.'';
        }
        if( !empty($id) ){
            $condition      = ' WHERE %user_id% = '.$id.'';
        }

        $order_by           = 'year DESC';
        $iTotalRecords      = 0;

        $iDisplayLength     = intval($_REQUEST['iDisplayLength']);
        $iDisplayStart      = intval($_REQUEST['iDisplayStart']);

        $sAction            = smit_isset($_REQUEST['sAction'],'');
        $sEcho              = intval($_REQUEST['sEcho']);
        $sort               = $_REQUEST['sSortDir_0'];
        $column             = intval($_REQUEST['iSortCol_0']);

        $limit              = ( $iDisplayLength == '-1' ? 0 : $iDisplayLength );
        $offset             = $iDisplayStart;

        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');
        $s_user_name        = $this->input->post('search_user');
        $s_user_name        = smit_isset($s_user_name, '');
        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_workunit         = $this->input->post('search_workunit');
        $s_workunit         = smit_isset($s_workunit, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year% LIKE "%%s%%"'); }
        if( !empty($s_user_name) )      { $condition .= str_replace('%s%', $s_user_name, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $is_pendamping ){
            if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
            elseif( $column == 2 )  { $order_by .= '%username% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%name% ' . $sort; }
            elseif( $column == 4 )  { $order_by .= '%workunit% ' . $sort; }
            elseif( $column == 5 )  { $order_by .= '%event_title% ' . $sort; }
            elseif( $column == 15 )  { $order_by .= '%datecreated% ' . $sort; }
        }else{
            if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
            elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%workunit% ' . $sort; }
            elseif( $column == 4 )  { $order_by .= '%event_title% ' . $sort; }
            elseif( $column == 15 )  { $order_by .= '%datecreated% ' . $sort; }
        }

        $reportinc_list     = $this->Model_Tenant->get_all_reporttenant($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($reportinc_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('files_status');

            $i = $offset + 1;
            foreach($reportinc_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('prainkubasi/daftar/detail/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-primary waves-effect tooltips bottom5" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';

                $workunit   = '<center> - </cemter>';
                if($row->workunit > 0){
                    $workunit_type  = smit_workunit_type($row->workunit);
                    $workunit       = $workunit_type->workunit_name;
                }
                $year           = $row->year;
                $name           = strtoupper($row->name_tenant);
                $event          = $row->event_title;
                $month          = $row->month;
                $datecreated    = date('d F Y H:i:s', strtotime($row->datecreated));

                $btn_upload     = '<a href="'.base_url('tenants/daftar/detail/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-default waves-effect tooltips bottom5" data-placement="left" title="Unggah"><i class="material-icons">file_upload</i></a> ';

                $count_all_report  = $this->Model_Tenant->count_all_reporttenant($row->user_id, $row->tenant_id);

                if($row->status == NONACTIVE)   {
                    $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>';
                }elseif($row->status == ACTIVE)  {
                    $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                }elseif($row->status == BANNED)  {
                    $status         = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>';
                }elseif($row->status == DELETED) {
                    $status         = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>';
                }

                if( !empty( $row->url ) ){
                    $btn_download   = '<a href="'.base_url('tenants/laporan/unduh/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-default waves-effect tooltips bottom5" data-placement="left" title="Unduh"><i class="material-icons">file_download</i></a> ';
                }else{
                    $btn_download  = ' - ';
                }

                if( $is_pendamping ){
                    $records["aaData"][] = array(
                        smit_center('<input name="reportlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                        <label for="cblist'.$row->uniquecode.'"></label>'),
                        smit_center( $i ),
                        smit_center( $year ),
                        strtoupper( $name ),
                        strtoupper( $workunit ),
                        strtoupper( $event ),
                        smit_center( $btn_download ),
                        smit_center( $month ),
                        smit_center( $status ),
                        smit_center( $datecreated ),
                        //smit_center( $btn_action ),
                        ''
                    );
                }else{
                    $records["aaData"][] = array(
                        smit_center('<input name="reportlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                        <label for="cblist'.$row->uniquecode.'"></label>'),
                        smit_center( $i ),
                        strtoupper( $name ),
                        smit_center( $btn_download ),
                        smit_center( $month ),
                        smit_center( $status ),
                        smit_center( $datecreated ),
                        //smit_center( $btn_action ),
                        ''
                    );
                }

                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $reportlist             = $_REQUEST['reportlist'];

            $proses                 = $this->reportlistproses($sGroupActionName, $reportlist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * Reprt List Proses function.
	 */
    function reportlistproses($action, $data){
        $response = array();

        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        $current_user       = smit_get_current_user();
        /*
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Hanya Administrator yang dapat melakukan proses ini',
            );
            return $response;
        };
        */

        $curdate = date('Y-m-d H:i:s');
        if( $action=='confirm' )    { $actiontxt = 'Konfirmasi'; $status = ACTIVE; }
        elseif( $action=='banned' ) { $actiontxt = 'Banned'; $status = BANNED; }
        elseif( $action=='delete' ) { $actiontxt = 'Hapus'; $status = DELETED; }

        $data = (object) $data;
        foreach( $data as $key => $uniquecode ){
            if( $action=='delete' ){
                $reportdelete   = $this->Model_Incubation->delete_report($uniquecode);
            }else{
                $data_update = array('status'=>$status, 'datemodified'=>$curdate);
                $this->Model_Incubation->update_report($uniquecode, $data_update);
            }
        }

        $response = array(
            'status'    => 'OK',
            'message'   => 'Proses '.strtoupper($actiontxt).' data daftar laporan selesai di proses',
        );
        return $response;
    }

    /**
	 * Report Download File function.
	 */
    function reportdatadownloadfile($uniquecode){
        if ( !$uniquecode ){
            redirect( current_url() );
        }

        // Check Report File Data
        $reportdata     = $this->Model_Tenant->get_all_reportincubation(0, 0, ' WHERE %uniquecode% = "'.$uniquecode.'"');
        $reportdata     = $reportdata[0];

        if( !$reportdata || empty($reportdata) ){
            redirect( current_url() );
        }

        $file_name      = $reportdata->filename . '.' . $reportdata->extension;
        $file_url       = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/report/incubation/' . $reportdata->uploader . '/' . $file_name;
        force_download($file_name, $file_url);
    }

    /**
	 * Action Plan Download File function.
	 */
    function actionplandatadownloadfile($uniquecode){
        if ( !$uniquecode ){
            redirect( current_url() );
        }

        // Check Report File Data
        $reportdata     = $this->Model_Tenant->get_all_actionplantincubation(0, 0, ' WHERE %uniquecode% = "'.$uniquecode.'"');
        $reportdata     = $reportdata[0];

        if( !$reportdata || empty($reportdata) ){
            redirect( current_url() );
        }

        $file_name      = $reportdata->filename . '.' . $reportdata->extension;
        $file_url       = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/report/incubation/' . $reportdata->uploader . '/' . $file_name;
        force_download($file_name, $file_url);
    }

    /**
	 * Get Event By User ID function.
	 */
    function getevent(){
        $user_id            = $this->input->post('tenant_user_id');
        $user_id            = smit_isset($user_id, '');
        $data               = '<option value="">-- Pilih Usulan Kegiatan --</option>';

        if( empty($user_id) ){
            // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => $data,
            );
            // JSON encode data
            die(json_encode($data));
        }

        $conditions         = ' WHERE %user_id% = '.$user_id.' AND %tenant_id% = 0';
        $order_by           = ' %year% DESC';
    	$incubation_list    = $this->Model_Incubation->get_all_incubationdata(0, 0, $conditions, $order_by);
        if( !empty($incubation_list) ){
            foreach($incubation_list as $row){
                $data      .= '<option value="'.$row->id.'">'.strtoupper($row->year).' - '.strtoupper($row->event_title).'</option>';
            }
            // Set JSON data
            $data = array(
                'message'       => 'success',
                'data'          => $data,
            );
            // JSON encode data
            die(json_encode($data));
        }else{
            // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => $data,
            );
            // JSON encode data
            die(json_encode($data));
        }
    }

    // ---------------------------------------------------------------------------------------------
}

/* End of file tenant.php */
/* Location: ./application/controllers/tenant.php */
