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
        $this->load->library('AJAX_Pagination');
        $this->perPage = LIMIT_DETAIL;
        $this->perPageNews = LIMIT_NEWS_FE;
        $this->perPageBlog = LIMIT_BLOG_FE;
        $this->perPageTenant = LIMIT_DEFAULT;
    }

    /**
    * Index function.
    */
    public function index(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            //FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            FE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            FE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Banner Slider Zoom In/Out
            FE_PLUGIN_PATH . 'jquery-slider-zoom-inout/bannerscollection_zoominout.css',

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
            // Banner Slider Zoom In/Out
            FE_PLUGIN_PATH . 'jquery-slider-zoom-inout/js/jquery.ui.touch-punch.min.js',
            FE_PLUGIN_PATH . 'jquery-slider-zoom-inout/js/bannerscollection_zoominout.js',

            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
            FE_JS_PATH . 'pages/tables/table-ajax.js',
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'BannerZoomInout.init();',
        ));

        $sliderdata             = $this->Model_Slider->get_all_slider('', '', ' WHERE status = 1');
        $newsdata               = $this->Model_News->get_all_news($this->perPage, 0, ' WHERE status = 1');
        $countnewsdata          = $this->Model_News->count_data_news();

        // Total rows count
        $counttenantdata        = $this->Model_Tenant->count_data_blog_tenant();

        // Pagination configuration
        $config['target']       = '#blogtenantlist';
        $config['base_url']     = base_url('tenant/blogtenant/halaman');
        $config['total_rows']   = $counttenantdata;
        $config['per_page']     = $this->perPageBlog;
        $config['uri_segment']  = 4;
        $this->ajax_pagination->initialize($config);

        $blogtenantdata         = $this->Model_Tenant->get_all_blogtenant($this->perPageBlog, 0, ' WHERE %status% = 1');
        $tenantdata             = $this->Model_Tenant->get_all_tenant($this->perPage, 0, ' WHERE %status% = 1');

        $data['title']          = TITLE . 'Home';
        $data['blogdata']       = $blogtenantdata;
        $data['tenantdata']     = $tenantdata;
        $data['countblog']      = $counttenantdata;
        $data['sliderdata']     = $sliderdata;
        $data['newsdata']       = $newsdata;
        $data['countnews']      = $countnewsdata;
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
            //CSS Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            FE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',

            //Css Path
            FE_CSS_PATH . 'animate.css',
            FE_CSS_PATH . 'icomoon.css',
            FE_CSS_PATH . 'themify-icons.css',
            FE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
        ));

        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            FE_PLUGIN_PATH . 'momentjs/moment.js',
            FE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            FE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
            // Jquery Fileinput Plugin
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
        ));

        $lss = smit_latest_praincubation_setting();

        $data['title']          = TITLE . 'Seleksi Pra-Inkubasi';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['lss']            = $lss;
        $data['main_content']   = 'selection/selectionpraincubation';
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

            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',

            FE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            BE_PLUGIN_PATH     . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH     . 'bootstrap-fileinput/themes/explorer/theme.css',
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
        ));

        $lss = smit_latest_incubation_setting();

        $data['title']          = TITLE . 'Seleksi Inkubasi';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['lss']            = $lss;
        $data['main_content']   = 'selection/selectionincubation';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }

    /**
	 * Incubation Selection Function
	 */
	public function incubationselection()
	{
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');

        // Set JSON data
        /*
        $data       = array(
            'message' => 'success',
            'data' => smit_alert('Pendaftaran seleksi inkubasi baru berhasil!<br />Data seleksi Anda akan segera di proses<br />Silahkan <strong><a href="'.base_url('login').'">LOGIN</a></strong> untuk melihat data seleksi Anda!')
        );
        die(json_encode($data));
        */

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
        $year                   = $this->input->post('reg_year');
        $year                   = trim( smit_isset($year, "") );

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
        /*
        $user_selection = $this->Model_Incubation->get_incubation_by('userid',$userdata->id);
        if( $user_selection || !empty($user_selection) ){
            $data = array('message' => 'error','data' => 'Username sudah terdaftar dalam seleksi inkubasi. Anda hanya bisa mendaftar seleksi 1 kali dalam 1 periode seleksi.');
            die(json_encode($data));
        }
        */

        $workunit_id            = $userdata->workunit;
        $workunit_data_check    = $this->Model_User->get_workunit($workunit_id);
        $status_workunit        = $workunit_data_check->status;
        if( $status_workunit != 0 || !empty($status_workunit) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Username anda bukan dari NON LIPI. Hanya username dengan status user dari NON LIPI yang dapat melakukan seleksi Inkubasi.');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check Setting
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

        if( empty($_FILES['reg_selection_rab']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada berkas seleksi yang di unggah. Silahkan inputkan berkas seleksi!');
            die(json_encode($data));
        }

        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            $incubationselection_data = array(
                'uniquecode'    => smit_generate_rand_string(10,'low'),
                'year'          => $year,
                'setting_id'    => $incset->id,
                'user_id'       => $userdata->id,
                'username'      => strtolower($username),
                'name'          => $name,
                'event_title'   => $event_title,
                'event_desc'    => $description,
                'category'      => $category,
                'step'          => ONE,
                'status'        => NONACTIVE,
                'view'          => ACTIVE,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate,
            );

            // -------------------------------------------------
            // Save Incubation Selection
            // -------------------------------------------------
            $trans_save_incubation          = FALSE;
            if( $incubation_save_id         = $this->Model_Incubation->save_data_incubation_selection($incubationselection_data) ){
                $trans_save_incubation      = TRUE;

                // Upload Files Process
                $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/incubationselection/' . $userdata->id;
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
                    // Set File Upload Save
                    $file = $upload_data;
                    $incubationselectionfiles_data = array(
                        'uniquecode'    => smit_generate_rand_string(10,'low'),
                        'year'          => $year,
                        'selection_id'  => $incubation_save_id,
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
                    if( !$this->Model_Incubation->save_data_incubation_selection_files($incubationselectionfiles_data) ){
                        continue;
                    }
                }

                if( ! $this->my_upload->do_upload('reg_selection_rab') ){
                    $message = $this->my_upload->display_errors();

                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                    die(json_encode($data));
                }
                $upload_data    = $this->my_upload->data();
                if( !empty($upload_data) ){
                    // Set File Upload Save
                    $file = $upload_data;
                    $incubationselectionfiles_data = array(
                        'uniquecode'    => smit_generate_rand_string(10,'low'),
                        'year'          => $year,
                        'selection_id'  => $incubation_save_id,
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
                    if( !$this->Model_Incubation->save_data_incubation_selection_files($incubationselectionfiles_data) ){
                        continue;
                    }
                }
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

                    // Send Email Notification
                    $this->smit_email->send_email_registration_selection($userdata->email, $event_title);

                    // Set Log Data
                    smit_log( 'INCUBATION_REG', 'SUCCESS', maybe_serialize(array('username'=>$username, 'upload_files'=> $upload_data)) );

                    // Set JSON data
                    $data       = array(
                        'message' => 'success',
                        'data' => smit_alert('Pendaftaran seleksi inkubasi baru berhasil!<br />Data seleksi Anda akan segera di proses<br />Silahkan <strong><a href="'.base_url('login').'">LOGIN</a></strong> untuk melihat data seleksi Anda!')
                    );
                    die(json_encode($data));
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

        $year                   = $this->input->post('reg_year');
        $year                   = trim( smit_isset($year, "") );
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
        // Check Agreement
        // -------------------------------------------------
        $praincset     = smit_latest_praincubation_setting();
        if( !$praincset || empty($praincset) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada data pengaturan seleksi');
            // JSON encode data
            die(json_encode($data));
        }
        if( $praincset->status == 0 ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pengaturan seleksi sudah ditutup');
            // JSON encode data
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check User Selection
        // -------------------------------------------------
        // Check if username has been registeren on incubation selection
        $user_selection = $this->Model_Praincubation->get_praincubation_by('userid', $userdata->id);
        if( $user_selection || !empty($user_selection) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Username sudah terdaftar dalam seleksi pra-inkubasi. Anda hanya bisa mendaftar seleksi 1 kali dalam 1 periode seleksi.');
            die(json_encode($data));
        }

        /*
        $workunit_id    = $userdata->workunit;
        $workunit_data_check    = $this->Model_User->get_workunit($workunit_id);
        $status_workunit    = $workunit_data_check->status;
        if( $status_workunit != 1 || !empty($status_workunit) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Username anda bukan dari LIPI. Hanya username dengan status user dari LIPI yang dapat melakukan seleksi Pra-Inkubasi.');
            die(json_encode($data));
        }
        */

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        if( empty($_FILES['reg_selection_files']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada berkas seleksi yang di unggah. Silahkan inputkan berkas seleksi!');
            die(json_encode($data));
        }

        if( empty($_FILES['reg_selection_rab']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada berkas seleksi yang di unggah. Silahkan inputkan berkas seleksi!');
            die(json_encode($data));
        }

        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            $praincubationselection_data = array(
                'uniquecode'    => smit_generate_rand_string(10,'low'),
                'year'          => $year,
                'setting_id'    => $praincset->id,
                'user_id'       => $userdata->id,
                'username'      => strtolower($username),
                'name'          => $name,
                'event_title'   => $event_title,
                'event_desc'    => $description,
                'category'      => $category,
                'step'          => ONE,
                'status'        => NONACTIVE,
                'view'          => ACTIVE,
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
                    // Set File Upload Save
                    $file = $upload_data;
                    $praincubationselectionfiles_data = array(
                        'uniquecode'    => smit_generate_rand_string(10,'low'),
                        'year'          => $year,
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

                if( ! $this->my_upload->do_upload('reg_selection_rab') ){
                    $message = $this->my_upload->display_errors();

                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                    die(json_encode($data));
                }
                $upload_data_rab    = $this->my_upload->data();
                if( !empty($upload_data_rab) ){
                    // Set File Upload Save
                    $file_rab = $upload_data_rab;
                    $praincubationselectionfilesrab_data = array(
                        'uniquecode'    => smit_generate_rand_string(10,'low'),
                        'year'          => $year,
                        'selection_id'  => $praincubation_save_id,
                        'user_id'       => $userdata->id,
                        'username'      => strtolower($username),
                        'name'          => $name,
                        'url'           => smit_isset($file_rab['full_path'],''),
                        'extension'     => substr(smit_isset($file_rab['file_ext'],''),1),
                        'filename'      => smit_isset($file_rab['raw_name'],''),
                        'size'          => smit_isset($file_rab['file_size'],0),
                        'status'        => ACTIVE,
                        'datecreated'   => $curdate,
                        'datemodified'  => $curdate,
                    );
                    if( !$this->Model_Praincubation->save_data_praincubation_selection_files($praincubationselectionfilesrab_data) ){
                        continue;
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
                    $this->smit_email->send_email_registration_selection($userdata->email, $event_title);

                    // Set Log Data
                    smit_log( 'PRAINCUBATION_REG', 'SUCCESS', maybe_serialize(array('username'=>$username, 'upload_files'=> $upload_data)) );

                    // Set JSON data
                    $data       = array(
                        'message' => 'success',
                        'data' => smit_alert('Pendaftaran seleksi pra-inkubasi baru berhasil!<br />Data seleksi Anda akan segera di proses<br />Silahkan <strong><a href="'.base_url('login').'">LOGIN</a></strong> untuk melihat data seleksi Anda!')
                    );
                    die(json_encode($data));
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
    // PRA-INCUBATION
    /**
	 * List Pra-Incubation function.
	 */
    function listpraincubation(){
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

        $data['title']          = TITLE . 'Daftar Tenant';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'praincubation/list';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }

    /**
	 * Product Pra-Incubation function.
	 */
    function productpraincubation( $id='' ){
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

        $allcategorydata        = $this->Model_Option->get_all_category_product();
        if( !empty($id) ){
            $allcategorydata        = $this->Model_Option->get_all_category_product(LIMIT_DETAIL, 0, ' WHERE %category_id% <> "'.$id.'"');
        }

        $data['title']          = TITLE . 'Produk Pra-Inkubasi';
        $data['headstyles']     = $headstyles;
        $data['allcategorydata']= $allcategorydata;
        $data['category_id']    = $id;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'praincubation/product';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }

    /**
	 * Product Pra-Incubation function.
	 */
    function productpraincubationdetail( $uniquecode = '' ){
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

        $productdata            = '';
        if( !empty($uniquecode) ){
            $productdata        = $this->Model_Praincubation->get_all_product(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $productdata        = $productdata[0];
        }

        if($productdata){
            $file_name      = $productdata->filename . '.' . $productdata->extension;
            $file_url       = BE_UPLOAD_PATH . 'praincubationproduct/'. $productdata->user_id . '/' . $file_name;
            $product        = $file_url;
            $selection      = $this->Model_Praincubation->get_all_praincubation(0, 0, ' WHERE %id% = "'.$productdata->selection_id.'"');
            $selection      = $selection[0];
        }else{
            $product        = BE_IMG_PATH . 'news/noimage.jpg';
        }

        $alldata                = $this->Model_Praincubation->get_all_product(LIMIT_DETAIL, 0, ' WHERE %status% = 1 AND %uniquecode% <> "'.$uniquecode.'"');
        $allcategorydata        = $this->Model_Option->get_all_category_product(LIMIT_DETAIL, 0, ' WHERE %category_name% <> "'.$productdata->category_product.'"');

        $data['title']          = TITLE . 'Detail Produk Pra-Inkubasi';
        $data['productdata']    = $productdata;
        $data['product_image']  = $product;
        $data['alldata']        = $alldata;
        $data['allcategorydata']= $allcategorydata;
        $data['selectiondata']  = $selection;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'praincubation/productdetails';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }

    // ---------------------------------------------------------------------------------------------
    // INKUBASI / TENANT
    /**
	 * List Tenant function.
	 */
    function listtenant(){
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
            'TableAjax.init();',
        ));

        // Total rows count
        $tenant_list            = $this->Model_Tenant->get_all_tenant($this->perPageTenant, 0, " WHERE %status% = 1");
        $counttenantdata        = $this->Model_Tenant->count_all(1);

        // Pagination configuration
        $config['target']       = '.tenantgrid';
        $config['base_url']     = base_url('tenant/daftartenant/halaman');
        $config['total_rows']   = $counttenantdata;
        $config['per_page']     = $this->perPageTenant;
        $config['uri_segment']  = 4;
        $this->ajax_pagination->initialize($config);

        $data['title']          = TITLE . 'Daftar Tenant';
        $data['tenantdata']     = $tenant_list;
        $data['counttenant']    = $counttenantdata;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/list';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }

    /**
    * Tenant Pagination function.
    */
    function tenantpagination(){
        $page   = $this->input->post('page');
        $page   = smit_isset($page, '');

        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        // Total rows count
        $counttenantdata        = $this->Model_Tenant->count_all(1);

        // Pagination configuration
        $config['target']       = '.tenantgrid';
        $config['base_url']     = base_url('tenant/daftartenant/halaman');
        $config['total_rows']   = $counttenantdata;
        $config['per_page']     = $this->perPageTenant;
        $config['uri_segment']  = 4;
        $this->ajax_pagination->initialize($config);

        $tenant_list            = $this->Model_Tenant->get_all_tenant($this->perPageTenant, $offset, " WHERE %status% = 1");

        //get the posts data
        $data['tenantdata']     = $tenant_list;

        //load the view
        $this->load->view(VIEW_FRONT . 'tenant/tenantpagination', $data);
    }

    /**
    * Tenant Details function.
    */
    public function detailtenant( $slug='' ){
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

        $tenantdata             = '';
        if( !empty($slug) ){
            $tenantdata         = $this->Model_Tenant->get_tenant_by('slug', $slug);
        }

        if( !$tenantdata ){
            redirect( base_url('tenant/daftartenant'), 'refresh' );
        }
        
        $condition              = ' WHERE %status% = 1 AND %id% != '.$tenantdata->id;
        $order_by               = ' %datecreated% DESC';
        $other_tenants          = $this->Model_Tenant->get_all_tenant(LIMIT_DEFAULT,0,$condition,$order_by);

        $condition_blog         = ' WHERE %user_id% = '.$tenantdata->user_id.'';
        $blogtenants            = $this->Model_Tenant->get_all_blogtenant(LIMIT_DEFAULT,0,$condition,$order_by);

        $data['title']          = TITLE . 'Detail Tenant';
        $data['tenantdata']     = $tenantdata;
        $data['other_tenants']  = $other_tenants;
        $data['blogtenants']    = $blogtenants;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/details';

        $this->load->view(VIEW_FRONT . 'template', $data);
    }

    /**
	 * Product Tenant function.
	 */
    function producttenant( $id='' ){
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

        // Total rows count
        $counttenantdata        = $this->Model_Tenant->count_data_product_tenant();

        // Pagination configuration
        $config['target']       = '#productlist';
        $config['base_url']     = base_url('tenant/produktenant');
        $config['total_rows']   = $counttenantdata;
        $config['per_page']     = $this->perPage;
        $this->ajax_pagination->initialize($config);

        $tenantdata             = $this->Model_Tenant->get_all_product($this->perPage, 0, ' WHERE %status% = 1');
        $allcategorydata        = $this->Model_Option->get_all_category_product();
        if( !empty($id) ){
            $allcategorydata        = $this->Model_Option->get_all_category_product(LIMIT_DETAIL, 0, ' WHERE %category_id% <> "'.$id.'"');
        }

        $data['title']          = TITLE . 'Produk Tenant';
        $data['productdata']    = $tenantdata;
        $data['countproduct']   = $counttenantdata;
        $data['allcategorydaya']= $allcategorydata;
        $data['category_id']    = $id;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/product';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }

    /**
	 * Product Tenant Detail function.
	 */
    function producttenantdetail( $uniquecode = '' ){
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

        $productdata            = '';
        if( !empty($uniquecode) ){
            $productdata        = $this->Model_Tenant->get_all_product(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $productdata        = $productdata[0];
        }

        if($productdata){
            $file_name      = $productdata->filename . '.' . $productdata->extension;
            $file_url       = BE_UPLOAD_PATH . 'tenantproduct/'. $productdata->user_id . '/' . $file_name;
            $product        = $file_url;
        }else{
            $product        = BE_IMG_PATH . 'news/noimage.jpg';
        }

        $alldata                = $this->Model_Tenant->get_all_product(LIMIT_DETAIL, 0, ' WHERE %status% = 1 AND %uniquecode% <> "'.$uniquecode.'"');
        $allcategorydata        = $this->Model_Option->get_all_category_product(LIMIT_DETAIL, 0, ' WHERE %category_name% <> "'.$productdata->category_product.'"');

        $data['title']          = TITLE . 'Detail Produk Tenant';
        $data['productdata']    = $productdata;
        $data['product_image']  = $product;
        $data['alldata']        = $alldata;
        $data['allcategorydata']= $allcategorydata;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/productdetails';

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
    function blogtenant( $id='' ){
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
        // Total rows count
        $counttenantdata        = $this->Model_Tenant->count_data_blog_tenant();

        // Pagination configuration
        $config['target']       = '#blogtenantlist';
        $config['base_url']     = base_url('tenant/blogtenant/halaman');
        $config['total_rows']   = $counttenantdata;
        $config['per_page']     = $this->perPageBlog;
        $config['uri_segment']  = 4;
        $this->ajax_pagination->initialize($config);

        $tenantdata             = $this->Model_Tenant->get_all_blogtenant($this->perPageBlog, 0, ' WHERE %status% = 1');

        $allcategorydata        = $this->Model_Option->get_all_category_product();
        if( !empty($id) ){
            $allcategorydata    = $this->Model_Option->get_all_category_product(LIMIT_DETAIL, 0, ' WHERE %category_id% <> "'.$id.'"');
        }

        $data['title']          = TITLE . 'Blog Tenant';
        $data['blogdata']       = $tenantdata;
        $data['countblog']      = $counttenantdata;
        $data['allcategorydata']= $allcategorydata;
        $data['category_id']    = $id;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/blog';

        $this->load->view(VIEW_FRONT . 'template', $data);
    }

    /**
    * Blog Pagination function.
    */
    function blogpagination(){
        $page   = $this->input->post('page');
        $page   = smit_isset($page, '');

        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        // Total rows count
        $countblogdata          = $this->Model_Tenant->count_data_blog_tenant();

        // Pagination configuration
        $config['target']       = '#blogtenantlist';
        $config['base_url']     = base_url('tenant/blogtenant/halaman');
        $config['total_rows']   = $countblogdata;
        $config['per_page']     = $this->perPageBlog;
        $config['uri_segment']  = 4;
        $this->ajax_pagination->initialize($config);

        $blogdata               = $this->Model_Tenant->get_all_blogtenant($this->perPageBlog, $offset, ' WHERE %status% = 1');

        //get the posts data
        $data['blogdata']       = $blogdata;

        //load the view
        $this->load->view(VIEW_FRONT . 'tenant/blogpagination', $data);
    }

    /**
	 * Blog Tenant Detail function.
	 */
    function blogtenantdetail( $uniquecode = '' ){
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

        $blogdata               = '';
        if( !empty($uniquecode) ){
            $blogdata       = $this->Model_Tenant->get_all_blogtenant(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $blogdata       = $blogdata[0];
        }

        $image_blog         = BE_IMG_PATH . 'news/noimage.jpg';
        if($blogdata){
            $file_name      = $blogdata->filename . '.' . $blogdata->extension;
            $file_url       = BE_UPLOAD_PATH . 'tenantblog/'. $blogdata->user_id . '/' . $file_name;
            $file_dir       = BE_UPLOAD_DIR . 'tenantblog/'. $blogdata->user_id . '/' . $file_name;
            $image_blog     = !file_exists($file_dir) ? BE_IMG_PATH . 'news/noimage.jpg' : $file_url;
        }

        $alldata                = $this->Model_Tenant->get_all_blogtenant(LIMIT_DETAIL, 0, ' WHERE %status% = 1 AND %uniquecode% <> "'.$uniquecode.'"');
        $allcategorydata        = $this->Model_Option->get_all_category_product(LIMIT_DETAIL, 0, ' WHERE %category_name% <> "'.$blogdata->category_product.'"');

        $data['title']          = TITLE . 'Detail Blog Tenant';
        $data['blogdata']       = $blogdata;
        $data['blog_image']     = $image_blog;
        $data['alldata']        = $alldata;
        $data['allcategorydata']= $allcategorydata;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/blogdetails';

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
    // BERKAS DIGITAL
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
        $data['main_content']   = 'guide';
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
                    class="inact btn btn-xs btn-default waves-effect tooltips bottom5" data-placement="left"><i class="material-icons">file_download</i></a> ';
                }else{
                    $btn_files  = ' - ';
                }
                $records["aaData"][] = array(
                    smit_center($i),
                    '<a href="'.base_url('unduhberkas/'.$row->uniquecode).'">' . $row->title . '</a>',
                    $row->description,
                    smit_center( $btn_files ),
                    smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
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
        $data['main_content']   = 'selection/announcement';
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
                $btn_action = '<a href="'.base_url('seleksi/pengumuman/'.$row->uniquecode).'"
                    class="announcementdetails btn btn-sm btn-primary waves-effect tooltips" data-placement="left">Detail</a> ';

                $records["aaData"][] = array(
                    smit_center($i),
                    '<a href="'.base_url('seleksi/pengumuman/'.$row->uniquecode).'"><strong>' . strtoupper($row->title) . '</strong></a>',
                    smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
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
    public function announcementdetails( $uniquecode ){
        if( !$uniquecode ) redirect(base_url('seleksi/pengumuman'));

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

        $announcementdata   = $this->Model_Announcement->get_announcement_by_uniquecode($uniquecode);
        if( empty($announcementdata) || !$announcementdata ) redirect(base_url('informasi/pengumuman'));

        $data['title']          = TITLE . 'Detail Pengumuman';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['announ_data']    = $announcementdata;
        $data['main_content']   = 'selection/announcementdetails';
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
            // Morris Chart CSS Plugin
            BE_PLUGIN_PATH . 'morrisjs/morris.css',

            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            // Morrist Chart JS Plugin
            BE_PLUGIN_PATH . 'raphael/raphael.min.js',
            BE_PLUGIN_PATH . 'morrisjs/morris.js',
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'Charts.init();'
        ));

        $data['title']          = TITLE . 'Statistik';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'statistic';

        // ======================================
        // Pra-Incubation Chart
        // ======================================
        $chart_praincubation = array();
        $stats_praincubation = '';
        if ( $stats_praincubation = $this->Model_Praincubation->stats_yearly() ) {
            // Pivoting
			$pivot_yearly_praincubation = array();
			foreach( $stats_praincubation as $row ) {
                $category_praincubation = $row->category;

				if ( ! isset( $pivot_yearly_praincubation[ $row->period ] ) )
					$pivot_yearly_praincubation[ $row->period ] = array();

				if ( ! isset( $pivot_yearly_praincubation[ $row->period ][ 'total' ] ) )
					$pivot_yearly_praincubation[ $row->period ][ 'total' ] = 0;

				$pivot_yearly_praincubation[ $row->period ][ 'total' ] += $row->total;
				$pivot_yearly_praincubation[ $row->period ][ $category_praincubation ] = $row->total;
			}

            $slug_arr_praincubation         = smit_category_slug();
            $name_arr_praincubation         = smit_category_name();

            $chart_praincubation['xkey']    = 'period';
            $chart_praincubation['ykeys']   = $slug_arr_praincubation;
            $chart_praincubation['labels']  = $name_arr_praincubation;

            foreach( $pivot_yearly_praincubation as $period_praincubation => $row ) {
                $chart_arr_praincubation    = array('period' => $period_praincubation);
                foreach($slug_arr_praincubation as $slug_praincubation){
                    $chart_arr_praincubation[$slug_praincubation]   = smit_isset( $row[ $slug_praincubation ], 0 );
                }
                $chart_arr_praincubation['total'] = $row['total'];

                // chart
				$chart_praincubation['data'][] = $chart_arr_praincubation;
            }
        }
        $data['chart_praincubation']    = json_encode( $chart_praincubation );
        $data['stats_praincubation']	= $stats_praincubation;
        // ======================================

        // ======================================
        // Incubation Chart
        // ======================================

        // Chart Monthly
        $chart_inc_monthly = array();
        $stats_inc_monthly = '';
        if ( $stats_inc_monthly = $this->Model_Incubation->stats_monthly() ) {
            // Pivoting
			$pivot_inc_monthly = array();
			foreach( $stats_inc_monthly as $row ) {
                $category_inc_monthly = $row->category;

				if ( ! isset( $pivot_inc_monthly[ $row->period ] ) )
					$pivot_inc_monthly[ $row->period ] = array();

				if ( ! isset( $pivot_inc_monthly[ $row->period ][ 'total' ] ) )
					$pivot_inc_monthly[ $row->period ][ 'total' ] = 0;

				$pivot_inc_monthly[ $row->period ][ 'period_name' ] = $row->period_name;
				$pivot_inc_monthly[ $row->period ][ 'total' ] += $row->total;
				$pivot_inc_monthly[ $row->period ][ $category_inc_monthly ] = $row->total;
			}

            $slug_arr_inc_monthly           = smit_category_slug();
            $name_arr_inc_monthly           = smit_category_name();

            $chart_inc_monthly['xkey']      = 'period';
            $chart_inc_monthly['ykeys']     = $slug_arr_inc_monthly;
            $chart_inc_monthly['labels']    = $name_arr_inc_monthly;

            foreach( $pivot_inc_monthly as $period_inc_monthly => $row ) {
                $chart_arr_inc_monthly          = array('period' => $period_inc_monthly);
                foreach($slug_arr_inc_monthly as $slug_inc_monthly){
                    $chart_arr_inc_monthly[$slug_inc_monthly]   = smit_isset( $row[ $slug_inc_monthly ], 0 );
                }
                $chart_arr_inc_monthly['total'] = $row['total'];

                // chart
				$chart_inc_monthly['data'][]        = $chart_arr_inc_monthly;
            }
        }
        $data['chart_incubation_monthly']   = json_encode( $chart_inc_monthly );
        $data['stats_incubation_monthly']	= $stats_inc_monthly;

        // Chart Yearly
        $chart_inc_yearly = array();
        $stats_inc_yearly = '';
        if ( $stats_inc_yearly = $this->Model_Incubation->stats_yearly() ) {
            // Pivoting
			$pivot_inc_yearly = array();
			foreach( $stats_inc_yearly as $row ) {
                $categoryinc_yearly = $row->category;

				if ( ! isset( $pivot_inc_yearly[ $row->period ] ) )
					$pivot_inc_yearly[ $row->period ] = array();

				if ( ! isset( $pivot_inc_yearly[ $row->period ][ 'total' ] ) )
					$pivot_inc_yearly[ $row->period ][ 'total' ] = 0;

				$pivot_inc_yearly[ $row->period ][ 'total' ] += $row->total;
				$pivot_inc_yearly[ $row->period ][ $categoryinc_yearly ] = $row->total;
			}

            $slug_arr_inc_yearly           = smit_category_slug();
            $name_arr_inc_yearly           = smit_category_name();

            $chart_inc_yearly['xkey']      = 'period';
            $chart_inc_yearly['ykeys']     = $slug_arr_inc_yearly;
            $chart_inc_yearly['labels']    = $name_arr_inc_yearly;

            foreach( $pivot_inc_yearly as $period_inc_yearly => $row ) {
                $chart_arr_inc_yearly       = array('period' => $period_inc_yearly);
                foreach($slug_arr_inc_yearly as $slug_inc_yearly){
                    $chart_arr_inc_yearly[$slug_inc_yearly]  = smit_isset( $row[ $slug_inc_yearly ], 0 );
                }
                $chart_arr_inc_yearly['total']  = $row['total'];

                // chart
				$chart_inc_yearly['data'][]        = $chart_arr_inc_yearly;
            }
        }
        $data['chart_incubation_yearly']    = json_encode( $chart_inc_yearly );
        $data['stats_incubation_yearly']	= $stats_inc_yearly;
        // ======================================

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
            // Jquery Validation Plugin
            FE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            FE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
            FE_JS_PATH . 'pages/forms/form-validation.js',
        ));

        $scripts_add            = '
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
        <script type="text/javascript">
            function onloadCallback() {
    			ContactForm.loadCaptcha();
    		}
        </script>
        ';

        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'ContactValidation.init();',
            'ContactForm.init();'
        ));

        $data['title']          = TITLE . 'Kontak';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'contact';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }

    /**
	 * Contact Add
	 */
	public function contactadd()
	{
        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');

        $contact_name           = $this->input->post('contact_name');
        $contact_name           = trim( smit_isset($contact_name, "") );
        $contact_email          = $this->input->post('contact_email');
        $contact_email          = trim( smit_isset($contact_email, "") );
        $contact_title          = $this->input->post('contact_title');
        $contact_title          = trim( smit_isset($contact_title, "") );
        $contact_desc           = $this->input->post('contact_desc');
        $contact_desc           = trim( smit_isset($contact_desc, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('contact_name','Nama Anda','required');
        $this->form_validation->set_rules('contact_email','Email Anda','required');
        $this->form_validation->set_rules('contact_title','Judul Pesan','required');
        $this->form_validation->set_rules('contact_desc','Pesan Anda','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pengiriman pesan tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Check Captcha
            // -------------------------------------------------
            /*
    		$verify = smit_validate_captcha();
    		if ( empty( $verify->success ) ) {
                // Set JSON data
                $data = array(
                    'message'   => 'error',
                    'data'      => array(
                        'field' => '',
                        'msg'   => 'Captcha tidak sesuai!'
                    )
                ); die(json_encode($data));
    		}
            */

            $contact_data       = array(
                'uniquecode'    => smit_generate_rand_string(10,'low'),
                'name'          => strtoupper( $contact_name ),
                'email'         => $contact_email,
                'title'         => strtoupper( $contact_title ),
                'description'   => $contact_desc,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate,
            );

            // -------------------------------------------------
            // Save Contact Message
            // -------------------------------------------------
            $trans_save_contact         = FALSE;
            if( $contact_save_id        = $this->Model_Service->save_data_contact_message($contact_data) ){
                $trans_save_contact     = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pengiriman pesan tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_contact ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pengiriman pesan tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();

                    // Send Notification to All Administrator
                    $condition  = ' WHERE %type% = '.ADMINISTRATOR.'';
                    $order_by   = '';
                    if( $all_admin  = $this->Model_User->get_all_user(0,0,$condition,$order_by) ){
                        foreach( $all_admin as $row ){
                            $admin_email    = $row->email;
                            $this->smit_email->send_email_contact( $admin_email, $contact_name, $contact_email, $contact_title, $contact_desc );
                        }
                    }


                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pengiriman pesan baru berhasil!');
                    die(json_encode($data));
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pengiriman pesan tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }
        }
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

    // ---------------------------------------------------------------------------------------------
    // SERVICE
    /**
	 * Communication function.
	 */
    function communication(){
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

        $data['title']          = TITLE . 'Komunikasi dan Bantuan';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'service/communication';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }

    /**
	 * IKM function.
	 */
    function ikm(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            // Datetime Picker Plugin
            FE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            FE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            FE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
            // Bootstrap Select Plugin
            FE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));

        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            // Datetime Picker Plugin
            FE_PLUGIN_PATH . 'momentjs/moment.js',
            FE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Bootbox Plugin
            FE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
            // Jquery Fileinput Plugin
            FE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            FE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            FE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            FE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            FE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // Bootstrap Select Plugin
            FE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',

            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
            FE_JS_PATH . 'pages/forms/form-validation.js',
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            //'IKM.init();',
            'App.init();',
            'IKMValidation.init();',
        ));

        $ikm_list               = $this->Model_Service->get_all_ikmlist();

        $data['title']          = TITLE . 'Pengukuran IKM';
        $data['ikm_list']       = $ikm_list;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'service/ikm';
        $this->load->view(VIEW_FRONT . 'template', $data);
    }

    /**
	 * IKM Add
	 */
	public function ikmadddata()
	{
        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');

        $ikm_email              = $this->input->post('ikm_email');
        $ikm_email              = trim( smit_isset($ikm_email, "") );
        $ikm_comment            = $this->input->post('ikm_comment');
        $ikm_comment            = trim( smit_isset($ikm_comment, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('ikm_email','Email Anda','required');
        $this->form_validation->set_rules('ikm_comment','Kritik dan Saran Anda','required');
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran Pengukuran IKM tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        if( !empty($ikm_email) ){
            // -------------------------------------------------
            // Check Email
            // -------------------------------------------------
            $condition      = str_replace('%s%', $ikm_email, ' WHERE %email% LIKE "%%s%%"');
            $ikmdata        = $this->Model_Service->get_all_ikmdata(0, 0, $condition);

            if( !empty($ikmdata) ){
                // Set JSON data
                $data = array('message' => 'error','data' => 'Anda sudah melakukan pengukuran IKM. Terima Kasih!');
                die(json_encode($data));
            }

            $ikm_data  = array(
                'uniquecode'    => smit_generate_rand_string(10,'low'),
                'email'         => $ikm_email,
                'comment'       => $ikm_comment,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate,
            );

            $ikmdata_save_id    = $this->Model_Service->save_data_ikmdata($ikm_data);
        }

        $ikm_list               = $this->Model_Service->get_all_ikmlist();
        $i  = 1;
        $cfg_nilai              = config_item('ikm_nilai');
        foreach($ikm_list AS $row){
            $ikm_id             = $this->input->post('ikm_id_'.$i.'');
            $ikm_id             = trim( smit_isset($ikm_id, "") );
            $ikm_uniquecode     = $this->input->post('ikm_uniquecode_'.$i.'');
            $ikm_uniquecode     = trim( smit_isset($ikm_uniquecode, "") );
            $ikm_answer         = $this->input->post('answer_'.$i.'');
            $ikm_answer         = smit_isset($ikm_answer, 0);

            // -------------------------------------------------
            // Check Form Validation
            // -------------------------------------------------
            /*
            $this->form_validation->set_rules('answer_'.$i.'','Pertanyaan','required');
            $this->form_validation->set_message('required', '%s harus di isi');
            $this->form_validation->set_error_delimiters('', '');

            if( $this->form_validation->run() == FALSE){
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran Pengukuran IKM tidak berhasil. '.validation_errors().'');
                die(json_encode($data));
            }
            */
            $ikm_nilai  = $cfg_nilai[$ikm_answer];

            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();
            $ikm_data  = array(
                'uniquecode'    => smit_generate_rand_string(10,'low'),
                'ikm_id'        => $ikm_id,
                'ikmdata_id'    => $ikmdata_save_id,
                'answer'        => $ikm_answer,
                'nilai'         => $ikm_nilai,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate,
            );
            // -------------------------------------------------
            // Save IKM
            // -------------------------------------------------
            if( $ikm_save_id       = $this->Model_Service->save_data_ikm($ikm_data) ){
                $trans_save_ikm    = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran Pengukuran IKM tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            if ($this->db->trans_status() === FALSE){
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => 'Pendaftaran Pengukuran IKM tidak berhasil. Terjadi kesalahan data transaksi database.'
                ); die(json_encode($data));
            }else{
                // Commit Transaction
                $this->db->trans_commit();
            }

            $i++;
        }

        $trans_save_ikm    = TRUE;
        // -------------------------------------------------
        // Commit or Rollback Transaction
        // -------------------------------------------------
        if( $trans_save_ikm ){
            // Complete Transaction
            $this->db->trans_complete();

            // Set JSON data
            $data       = array('message' => 'success', 'data' => 'Pendaftaran Pengukuran IKM baru berhasil!');
            die(json_encode($data));
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran Pengukuran IKM tidak berhasil. Terjadi kesalahan data.');
            die(json_encode($data));
        }
	}
    // ---------------------------------------------------------------------------------------------

    // ---------------------------------------------------------------------------------------------
    // NEWS function

    /**
    * News Details function.
    */
    public function news(){
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

        // Total rows count
        $countnewsdata          = $this->Model_News->count_data_news();

        // Pagination configuration
        $config['target']       = '#newslist';
        $config['base_url']     = base_url('layanan/frontendberita/halaman');
        $config['total_rows']   = $countnewsdata;
        $config['per_page']     = $this->perPageNews;
        $config['uri_segment']  = 4;
        $this->ajax_pagination->initialize($config);

        $newsdata               = $this->Model_News->get_all_news($this->perPageNews, 0, ' WHERE status = 1');

        $data['title']          = TITLE . 'Daftar Berita';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['newsdata']       = $newsdata;
        $data['main_content']   = 'news';

        $this->load->view(VIEW_FRONT . 'template', $data);
    }

    /**
    * News Pagination function.
    */
    function newspagination($page=0){
        $page   = $this->input->post('page');
        $page   = smit_isset($page, '');

        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        // Total rows count
        $countnewsdata          = $this->Model_News->count_data_news();

        // Pagination configuration
        $config['target']       = '#newslist';
        $config['base_url']     = base_url('layanan/frontendberita/halaman');
        $config['total_rows']   = $countnewsdata;
        $config['per_page']     = $this->perPageNews;
        $config['uri_segment']  = 4;
        $this->ajax_pagination->initialize($config);

        $newsdata               = $this->Model_News->get_all_news($this->perPageNews, $offset, ' WHERE status = 1');

        //get the posts data
        $data['newsdata']       = $newsdata;

        //load the view
        $this->load->view(VIEW_FRONT . 'newspagination', $data);
    }

    /**
    * News Details function.
    */
    public function newsdetails( $uniquecode='' ){
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
        $newsdata               = '';

        if( !empty($uniquecode) ){
            $newsdata           = $this->Model_News->get_news_by_uniquecode($uniquecode);
        }

        $uploaded           = $newsdata->uploader;

        if($uploaded != 0){
            $file_name      = $newsdata->filename . '.' . $newsdata->extension;
            $file_url       = BE_UPLOAD_PATH . 'news/'. $newsdata->uploader . '/' . $file_name;
            $news           = $file_url;
        }else{
            $news           = BE_IMG_PATH . 'news/noimage.jpg';
        }

        $alldata                = $this->Model_News->get_all_news(LIMIT_DETAIL, 0, ' WHERE status = 1 AND uniquecode <> "'.$uniquecode.'"');

        $data['title']          = TITLE . 'Detail Berita';
        $data['news_data']      = $newsdata;
        $data['news_image']     = $news;
        $data['alldata']        = $alldata;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'newsdetails';

        $this->load->view(VIEW_FRONT . 'template', $data);
    }
    // ---------------------------------------------------------------------------------------------
    // PRA-INCUBATION
    /**
	 * Pra Incubation list data function.
	 */
    function praincubationdata( ){
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

        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_workunit         = $this->input->post('search_workunit');
        $s_workunit         = smit_isset($s_workunit, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%event_title% ' . $sort; }
        //elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }

        $praincubation_list    = $this->Model_Praincubation->get_all_praincubationdata($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($praincubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');

            $i = $offset + 1;
            foreach($praincubation_list as $row){
                $workunit   = ' - ';
                if($row->workunit > 0){
                    $workunit_type  = smit_workunit_type($row->workunit);
                    $workunit       = $workunit_type->workunit_name;
                }
                $year           = $row->year;
                $name           = strtoupper($row->name);
                $event          = $row->event_title;
                $datecreated    = date('d F Y', strtotime($row->datecreated));

                // Button
                $btn_action = '<a class="listdetail btn btn-xs btn-primary waves-effect tooltips" id="btn_list_detail" data-id="'.$row->id.'" data-year="'.$year.'" data-name="'.$name.'" data-workunit="'.$workunit.'" data-title="'.$event.'" data-category="'.$row->category.'" data-desc="'.$row->event_desc.'" data-placement="left"><i class="material-icons">zoom_in</i></a>';

                $records["aaData"][] = array(
                    smit_center( $i ),
                    smit_center( $year ),
                    strtoupper( $name ),
                    strtoupper( $workunit ),
                    strtoupper( $event ),
                    //smit_center( $datecreated ),
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


    // Tenant
    /**
	 * Tenant list data function.
	 */
    function tenantlistdata( ){
        $condition          = ' WHERE %status% = 1';

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
        $s_address          = $this->input->post('search_address');
        $s_address            = smit_isset($s_address, '');
        $s_name_tenant      = $this->input->post('search_name_tenant');
        $s_name_tenant      = smit_isset($$s_name_tenant, '');
        $s_email            = $this->input->post('search_email');
        $s_email            = smit_isset($s_email, '');
        $s_phone            = $this->input->post('search_phone');
        $s_phone            = smit_isset($s_phone, '');
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
        if( !empty($s_email) )          { $condition .= str_replace('%s%', $s_email, ' AND %email% LIKE "%%s%%"'); }
        if( !empty($s_phone) )          { $condition .= str_replace('%s%', $s_phone, ' AND %phone% LIKE "%%s%%"'); }
        if( !empty($s_address) )           { $condition .= str_replace('%s%', $s_address, ' AND %address% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        //if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
        //elseif( $column == 1 )  { $order_by .= '%name% ' . $sort; }
        if( $column == 1 )  { $order_by .= '%name_teannt% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%address% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%email% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%phone% ' . $sort; }
        elseif( $column == 6 )  { $order_by .= '%datecreated% ' . $sort; }

        $tenant_list        = $this->Model_Tenant->get_all_tenant($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();

        if( !empty($tenant_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status');

            $i = $offset + 1;
            foreach($tenant_list as $row){
                // Status
                $btn_confirm    = '';
                if( $row->status == NONACTIVE ){
                    $btn_confirm    = '<a href="'.base_url('tenants/konfirmasi/active/'.$row->user_id).'"
                        class="tenantconfirm btn btn-xs btn-success waves-effect tooltips bottom5" data-placement="left" id="tenantconfirm" title="Konfirmasi"><i class="material-icons">done</i></a> ';
                }

                $btn_team       = '<a href="'.base_url('tenants/daftar/tim/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-defaukt waves-effect tooltips bottom5" data-placement="left" title="Tambah Tim"><i class="material-icons">group</i></a> ';

                // Button
                $city   = $this->Model_Address->get_cities($row->city);
                $city   = $city->regional_name;
                $province   = $this->Model_Address->get_provinces($row->province);
                $province   = $province->province_name;

                $address        = $row->address;
                $address        .= ' '.$city;
                $address        .= ' '.$row->district;
                $address        .= ' PROVINSI '.$province;

                $btn_action = '<a href="'.base_url('tenant/detail/'.$row->slug).'" class="listdetailtenant btn btn-xs btn-primary waves-effect tooltips" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>';

                if($row->status == ACTIVE)          { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == NONACTIVE)   { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == BANNED)      { $status = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == DELETED)     { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }

                $records["aaData"][] = array(
                    smit_center( $i ),
                    //smit_center( $row->year ),
                    '<strong>'.strtoupper( $row->name_tenant ).'</strong>',
                    //strtoupper( $row->name ),
                    strtoupper( $row->address ),
                    //$row->email,
                    //smit_center( $row->phone ),
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

    // ---------------------------------------------------------------------------------------------
    // SEARCH ENGINE
    // ---------------------------------------------------------------------------------------------

    /**
	 * Search engine function.
	 */
    function searchengine(){
        $headstyles             = smit_headstyles(array(
            //Plugin Path
            FE_PLUGIN_PATH . 'node-waves/waves.css',
            FE_PLUGIN_PATH . 'sweetalert/sweetalert.css',
            FE_PLUGIN_PATH . 'jquery-pagination/css/jQueryPagination.css',

            //Css Path
            FE_CSS_PATH    . 'animate.css',
            FE_CSS_PATH    . 'icomoon.css',
            FE_CSS_PATH    . 'themify-icons.css',
        ));

        $loadscripts            = smit_scripts(array(
            FE_PLUGIN_PATH . 'node-waves/waves.js',
            FE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            FE_PLUGIN_PATH . 'jquery-countto/jquery.countTo.js',
            FE_PLUGIN_PATH . 'jquery-pagination/js/jQueryPagination.min.js',
            // Always placed at bottom
            FE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));

        $scripts_add                    = '';
        $scripts_init                   = smit_scripts_init(array(
            'SearchEngine.init()',
        ));

        if( !$_POST ) redirect( base_url() );

        $s_key                          = $this->input->post('search_key', TRUE);
        $s_key                          = smit_isset($s_key, '');
        $search_data                    = $this->Model_Search->get_search(0,0,$s_key);

        $s_news_data                    = array();
        $s_blogtenant_data              = array();
        $s_announcement_data            = array();
        $s_praincubationlist_data       = array();
        $s_praincubationproduct_data    = array();
        $s_incubationproduct_data       = array();
        $s_tenantlist_data              = array();
        $s_guides_data                  = array();

        if( $search_data || !empty($search_data) ){
            foreach($search_data as $row){
                if( $row->search_type == 'news' ){
                    $s_news_data[] = $row;
                }
                if( $row->search_type == 'blog_tenant' ){
                    $s_blogtenant_data[] = $row;
                }
                if( $row->search_type == 'announcement' ){
                    $s_announcement_data[] = $row;
                }
                if( $row->search_type == 'list_praincubation' ){
                    $s_praincubationlist_data[] = $row;
                }
                if( $row->search_type == 'list_praincubation_product' ){
                    $s_praincubationproduct_data[] = $row;
                }
                if( $row->search_type == 'list_incubation_product' ){
                    $s_incubationproduct_data[] = $row;
                }
                if( $row->search_type == 'list_tenant' ){
                    $s_tenantlist_data[] = $row;
                }
                if( $row->search_type == 'list_guide' ){
                    $s_guides_data[] = $row;
                }
            }
        }

        $data['s_news_data']                = $s_news_data;
        $data['s_blogtenant_data']          = $s_blogtenant_data;
        $data['s_announcement_data']        = $s_announcement_data;
        $data['s_praincubationlist_data']   = $s_praincubationlist_data;
        $data['s_praincubationproduct_data']= $s_praincubationproduct_data;
        $data['s_incubationproduct_data']   = $s_incubationproduct_data;
        $data['s_tenantlist_data']          = $s_tenantlist_data;
        $data['s_guides_data']              = $s_guides_data;

        $data['title']          = TITLE . 'Halaman Pencarian';
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['search_key']     = $s_key;
        $data['main_content']   = 'searchengine';

        $this->load->view(VIEW_FRONT . 'template', $data);
    }

    // ---------------------------------------------------------------------------------------------

}

/* End of file Frontend.php */
/* Location: ./application/controllers/Frontend.php */
