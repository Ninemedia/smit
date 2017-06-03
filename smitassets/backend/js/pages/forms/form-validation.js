$(function () {
    $('#form_validation').validate({
        rules: {
            'checkbox': {
                required: true
            },
            'gender': {
                required: true
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });

    //Advanced Form Validation
    $('#form_advanced_validation').validate({
        rules: {
            'date': {
                customdate: true
            },
            'creditcard': {
                creditcard: true
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });

    //Custom Validations ===============================================================================
    //Date
    $.validator.addMethod('customdate', function (value, element) {
        return value.match(/^\d\d\d\d?-\d\d?-\d\d$/);
    },
        'Please enter a date in the format YYYY-MM-DD.'
    );

    //Credit card
    $.validator.addMethod('creditcard', function (value, element) {
        return value.match(/^\d\d\d\d?-\d\d\d\d?-\d\d\d\d?-\d\d\d\d$/);
    },
        'Please enter a credit card in the format XXXX-XXXX-XXXX-XXXX.'
    );
    //==================================================================================================
});

// Additional Function
// =====================================================================================================
var GuidesValidation = function () {
    var handleGuideValidation = function(){
        $('#guide_files').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                guide_title: {
                    required: true,
                },
                guide_description: {
                    required: true,
                },
                guide_selection_files: {
                    required: true,
                },
            },
            messages: {
                guide_title: {
                    required: "Judul panduan harus di isi."
                },
                guide_description: {
                    required: "Deskripsi panduan harus di isi."
                },
                guide_selection_files: {
                    required: "Berkas harus diisi."
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $(this)).fadeIn();
            },
            highlight: function (element) { // hightlight error inputs
                console.log(element);
                $(element).parents('.form-line').addClass('error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).parents('.form-line').removeClass('error');
            },
            success: function (label) {
                label.closest('.form-line').removeClass('error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handleGuideValidation();
        }
    };
}();

var ProfileValidation = function () {
    var handleProfileValidation = function(){
        $('#personal').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                up_name: {
                    required: true,
                },
                up_email: {
                    required: true,
                    email: true,
                },
                up_phone: {
                    required: true,
                },
                up_address: {
                    required: true,
                },
                up_province: {
                    required: true,
                },
                up_regional: {
                    required: true,
                },
                up_district: {
                    required: true,
                },
                up_gender: {
                    required: true,
                },
                up_birthplace: {
                    required: true,
                },
                up_birthdate: {
                    required: true,
                },
                up_religion: {
                    required: true,
                },
                up_marital_status: {
                    required: true,
                },
            },
            messages: {
                up_name: {
                    required: 'Nama harus di isi',
                },
                up_email: {
                    required: 'Email harus di isi',
                    email: 'Masukkan alamat email Anda yang benar',
                },
                up_phone: {
                    required: 'Nomor Telp/HP harus di isi',
                },
                up_address: {
                    required: 'Alamat harus di isi',
                },
                up_province: {
                    required: 'Provinsi harus di isi',
                },
                up_regional: {
                    required: 'Kota/Kabupaten harus di isi',
                },
                up_district: {
                    required: 'Kecamatan/Kelurahan harus di isi',
                },
                up_address: {
                    required: 'Alamat harus di isi',
                },
                up_gender: {
                    required: 'Jenis Kelamin harus di pilih',
                },
                up_birthplace: {
                    required: 'Tempat lahir harus di pilih',
                },
                up_birthdate: {
                    required: 'Tanggal lahir harus di pilih',
                },
                up_regional: {
                    required: 'Agama harus di pilih',
                },
                up_marital_status: {
                    required: 'Status pernikahan harus di pilih',
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $(this)).fadeIn().delay(3000).fadeOut();
            },
            highlight: function (element) { // hightlight error inputs
                console.log(element);
                $(element).parents('.form-line').addClass('error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).closest('.form-line').removeClass('error');
            },
            success: function (label) {
                label.closest('.form-line').removeClass('error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                $(element).parents('.input-group').append(error);
            },
            submitHandler: function (form) {
                $('#save_profile').modal('show');
            }
        });
    };
    
    var handleAccountValidation = function(){
        $('#accountsetting').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                ava_selection_files: {
                    required: true,
                },
            },
            messages: {
                ava_selection_files: {
                    required: "Berkas harus diisi."
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $(this)).fadeIn();
            },
            highlight: function (element) { // hightlight error inputs
                console.log(element);
                $(element).parents('.form-line').addClass('error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).parents('.form-line').removeClass('error');
            },
            success: function (label) {
                label.closest('.form-line').removeClass('error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            },
            submitHandler: function (form) {
                $('#save_account').modal('show');
            }
        });
    };
    
    var handleJobValidation = function(){
        $('#jobupdate').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                up_nip: {
                    required: true,
                },
                up_position: {
                    required: true,
                },
                workunit_type: {
                    required: true,
                },
            },
            messages: {
                up_nip: {
                    required: 'Nomor Induk Pegawai harus di isi',
                },
                up_position: {
                    required: 'Posisi anda harus di isi',
                },
                workunit_type: {
                    required: 'Satuan kerja anda harus di isi',
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $(this)).fadeIn().delay(3000).fadeOut();
            },
            highlight: function (element) { // hightlight error inputs
                console.log(element);
                $(element).parents('.form-line').addClass('error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).closest('.form-line').removeClass('error');
            },
            success: function (label) {
                label.closest('.form-line').removeClass('error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                $(element).parents('.input-group').append(error);
            },
            submitHandler: function (form) {
                $('#save_job').modal('show');
            }
        });
    };
    
    var handleChangePasswordValidation = function(){
        $('#changepassword').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                cur_pass: {
                    required: true,
                },
                new_pass: {
                    required: true,
                },
                cnew_pass: {
                    required: true,
                },
            },
            messages: {
                cur_pass: {
                    required: "Kata sandi lama anda harus diisi.."
                },
                new_pass: {
                    required: "Kata sandi baru harus diisi."
                },
                cnew_pass: {
                    required: "Ulangi kata sandi baru harus diisi."
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $(this)).fadeIn();
            },
            highlight: function (element) { // hightlight error inputs
                console.log(element);
                $(element).parents('.form-line').addClass('error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).parents('.form-line').removeClass('error');
            },
            success: function (label) {
                label.closest('.form-line').removeClass('error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            },
            submitHandler: function (form) {
                $('#save_changepassword').modal('show');
            }
        });
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handleProfileValidation();
            handleAccountValidation();
            handleJobValidation();
            handleChangePasswordValidation();
        }
    };
}();

var AnnouncementValidation = function () {
    var handleAnnouncementValidation = function(){
        $('#announcementadd').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                reg_title: {
                    required: true,
                },
                reg_desc: {
                    required: true,
                },
                reg_agree: {
                    required: true,
                },
            },
            messages: {
                reg_desc: {
                    required: 'Deskripsi Kegiatan harus di isi',
                },
                reg_title: {
                    required: 'Judul Kegiatan harus di isi',
                },
                reg_agree: {
                    required: 'Anda harus setuju atas pengisian formulir ini',
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $(this)).fadeIn().delay(3000).fadeOut();
            },
            highlight: function (element) { // hightlight error inputs
                console.log(element);
                $(element).parents('.form-line').addClass('error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).closest('.form-line').removeClass('error');
            },
            success: function (label) {
                label.closest('.form-line').removeClass('error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                $(element).parents('.input-group').append(error);
            },
            submitHandler: function (form) {
                $('#save_announcement').modal('show');
            }
        });
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handleAnnouncementValidation();
        }
    };
}();

var NewsValidation = function () {
    var handleNewsValidation = function(){
        $('#newsadd').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                reg_title: {
                    required: true,
                },
                reg_source: {
                    required: true,
                },
                reg_desc: {
                    required: true,
                },
            },
            messages: {
                reg_title: {
                    required: 'Judul Berita harus di isi',
                },
                reg_source: {
                    required: 'Sumber Berita harus di isi',
                },
                reg_desc: {
                    required: 'Isi Berita harus di isi',
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $(this)).fadeIn().delay(3000).fadeOut();
            },
            highlight: function (element) { // hightlight error inputs
                console.log(element);
                $(element).parents('.form-line').addClass('error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).closest('.form-line').removeClass('error');
            },
            success: function (label) {
                label.closest('.form-line').removeClass('error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                $(element).parents('.input-group').append(error);
            },
            submitHandler: function (form) {
                $('#save_news').modal('show');
            }
        });
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handleNewsValidation();
        }
    };
}();


var SliderValidation = function () {
    var handleSliderValidation = function(){
        $('#slideradd').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                reg_title: {
                    required: true,
                },
                reg_desc: {
                    required: true,
                },
                slider_selection_files: {
                    required: true,
                },
            },
            messages: {
                reg_title: {
                    required: 'Judul Berita harus di isi',
                },
                reg_desc: {
                    required: 'Deskripsi Slider harus di isi',
                },
                slider_selection_files: {
                    required: 'Gambar Slider di isi',
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $(this)).fadeIn().delay(3000).fadeOut();
            },
            highlight: function (element) { // hightlight error inputs
                console.log(element);
                $(element).parents('.form-line').addClass('error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).closest('.form-line').removeClass('error');
            },
            success: function (label) {
                label.closest('.form-line').removeClass('error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                $(element).parents('.input-group').append(error);
            },
            submitHandler: function (form) {
                $('#save_slider').modal('show');
            }
        });
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handleSliderValidation();
        }
    };
}();

var SettingValidation = function () {
    var handleSettingWorkunitValidation = function(){
        $('#workunitadd').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                reg_workunit: {
                    required: true,
                },
            },
            messages: {
                reg_workunit: {
                    required: 'Nama Satuan Kerja harus di isi',
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $(this)).fadeIn().delay(3000).fadeOut();
            },
            highlight: function (element) { // hightlight error inputs
                console.log(element);
                $(element).parents('.form-line').addClass('error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).closest('.form-line').removeClass('error');
            },
            success: function (label) {
                label.closest('.form-line').removeClass('error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                $(element).parents('.input-group').append(error);
            },
            submitHandler: function (form) {
                $('#save_workunit').modal('show');
            }
        });
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handleSettingWorkunitValidation();
        }
    };
}();

var TenantValidation = function () {
    var handleTenantAddValidation = function(){
        $('#addtenant').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                up_name: {
                    required: true,
                },
                up_email: {
                    required: true,
                    email: true,
                },
                up_phone: {
                    required: true,
                },
                up_address: {
                    required: true,
                },
                up_province: {
                    required: true,
                },
                up_regional: {
                    required: true,
                },
                up_district: {
                    required: true,
                },
                up_gender: {
                    required: true,
                },
                up_birthplace: {
                    required: true,
                },
                up_birthdate: {
                    required: true,
                },
                up_religion: {
                    required: true,
                },
                up_marital_status: {
                    required: true,
                },
            },
            messages: {
                up_name: {
                    required: 'Nama harus di isi',
                },
                up_email: {
                    required: 'Email harus di isi',
                    email: 'Masukkan alamat email Anda yang benar',
                },
                up_phone: {
                    required: 'Nomor Telp/HP harus di isi',
                },
                up_address: {
                    required: 'Alamat harus di isi',
                },
                up_province: {
                    required: 'Provinsi harus di isi',
                },
                up_regional: {
                    required: 'Kota/Kabupaten harus di isi',
                },
                up_district: {
                    required: 'Kecamatan/Kelurahan harus di isi',
                },
                up_address: {
                    required: 'Alamat harus di isi',
                },
                up_gender: {
                    required: 'Jenis Kelamin harus di pilih',
                },
                up_birthplace: {
                    required: 'Tempat lahir harus di pilih',
                },
                up_birthdate: {
                    required: 'Tanggal lahir harus di pilih',
                },
                up_regional: {
                    required: 'Agama harus di pilih',
                },
                up_marital_status: {
                    required: 'Status pernikahan harus di pilih',
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $(this)).fadeIn().delay(3000).fadeOut();
            },
            highlight: function (element) { // hightlight error inputs
                console.log(element);
                $(element).parents('.form-line').addClass('error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).closest('.form-line').removeClass('error');
            },
            success: function (label) {
                label.closest('.form-line').removeClass('error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                $(element).parents('.input-group').append(error);
            },
            submitHandler: function (form) {
                $('#save_profile').modal('show');
            }
        });
    };
    
    var handleAccountValidation = function(){
        $('#accountsetting').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                ava_selection_files: {
                    required: true,
                },
            },
            messages: {
                ava_selection_files: {
                    required: "Berkas harus diisi."
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $(this)).fadeIn();
            },
            highlight: function (element) { // hightlight error inputs
                console.log(element);
                $(element).parents('.form-line').addClass('error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).parents('.form-line').removeClass('error');
            },
            success: function (label) {
                label.closest('.form-line').removeClass('error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            },
            submitHandler: function (form) {
                $('#save_account').modal('show');
            }
        });
    };
    
    var handleJobValidation = function(){
        $('#jobupdate').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                up_nip: {
                    required: true,
                },
                up_position: {
                    required: true,
                },
                workunit_type: {
                    required: true,
                },
            },
            messages: {
                up_nip: {
                    required: 'Nomor Induk Pegawai harus di isi',
                },
                up_position: {
                    required: 'Posisi anda harus di isi',
                },
                workunit_type: {
                    required: 'Satuan kerja anda harus di isi',
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $(this)).fadeIn().delay(3000).fadeOut();
            },
            highlight: function (element) { // hightlight error inputs
                console.log(element);
                $(element).parents('.form-line').addClass('error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).closest('.form-line').removeClass('error');
            },
            success: function (label) {
                label.closest('.form-line').removeClass('error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                $(element).parents('.input-group').append(error);
            },
            submitHandler: function (form) {
                $('#save_job').modal('show');
            }
        });
    };
    
    var handleChangePasswordValidation = function(){
        $('#changepassword').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                cur_pass: {
                    required: true,
                },
                new_pass: {
                    required: true,
                },
                cnew_pass: {
                    required: true,
                },
            },
            messages: {
                cur_pass: {
                    required: "Kata sandi lama anda harus diisi.."
                },
                new_pass: {
                    required: "Kata sandi baru harus diisi."
                },
                cnew_pass: {
                    required: "Ulangi kata sandi baru harus diisi."
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $(this)).fadeIn();
            },
            highlight: function (element) { // hightlight error inputs
                console.log(element);
                $(element).parents('.form-line').addClass('error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).parents('.form-line').removeClass('error');
            },
            success: function (label) {
                label.closest('.form-line').removeClass('error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            },
            submitHandler: function (form) {
                $('#save_changepassword').modal('show');
            }
        });
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handleProfileValidation();
            handleAccountValidation();
            handleJobValidation();
            handleChangePasswordValidation();
        }
    };
}();

var TenantValidation = function () {
    var handleAddTenantValidation = function(){
        $('#addtenant').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                tenant_name: {
                    required: true,
                },
                tenant_email: {
                    required: true,
                    email: true,
                },
                tenant_year: {
                    required: true,
                },
                tenant_address: {
                    required: true,
                },
                tenant_district: {
                    required: true,
                },
                province: {
                    required: true,
                },
                regional: {
                    required: true,
                },
                tenant_phone_contact: {
                    required: true,
                },
                tenant_legal: {
                    required: true,
                },
                tenant_bussiness: {
                    required: true,
                },
                tenant_mitra: {
                    required: true,
                },
            },
            messages: {
                tenant_name: {
                    required: 'Nama Tenant harus di isi',
                },
                tenant_email: {
                    required: 'Email harus di isi',
                    email: 'Masukkan alamat email Anda yang benar',
                },
                tenant_year: {
                    required: 'Pilih tahun berdirinya tenant anda',
                },
                tenant_address: {
                    required: 'Alamat harus di isi',
                },
                tenant_district: {
                    required: 'Kecamatan/Kelurahan harus di isi',
                },
                province: {
                    required: 'Provinsi harus di isi',
                },
                regional: {
                    required: 'Kota/Kabupaten harus di isi',
                },
                tenant_phone_contact: {
                    required: 'Kontak harus di isi',
                },
                tenant_legal: {
                    required: 'Legal harus di pilih',
                },
                tenant_bussiness: {
                    required: 'NPWP harus di pilih',
                },
                tenant_mitra: {
                    required: 'Kemitraan harus di pilih',
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $(this)).fadeIn().delay(3000).fadeOut();
            },
            highlight: function (element) { // hightlight error inputs
                console.log(element);
                $(element).parents('.form-line').addClass('error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).closest('.form-line').removeClass('error');
            },
            success: function (label) {
                label.closest('.form-line').removeClass('error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                $(element).parents('.input-group').append(error);
            },
            submitHandler: function (form) {
                $('#save_addtenant').modal('show');
            }
        });
        
        // Save Add Tenant
        $('#do_save_add_tenant').click(function(e){
            e.preventDefault();
            processSaveAddTenant($('#addtenant'));
        });
        
        var processSaveAddTenant = function( form ) {
        	var url    = $( form ).attr( 'action' );
        	var data   = $( form ).serialize(); 
            var msg    = $('.alert');
        	
            $.ajax({
    			type : "POST",
    			url  : url,
    			data : data,
                beforeSend: function(){
                    $("div.page-loader-wrapper").fadeIn();
                    $('#save_addtenant').modal('hide');
                },
    			success: function(response) {
                    $("div.page-loader-wrapper").fadeOut();
                    response = $.parseJSON( response );
                    
                    if(response.message == 'error'){
                        msg.html(response.data.msg);
                        msg.removeClass('alert-success').addClass('alert-danger').fadeIn('fast').delay(3000).fadeOut();
                    }else{
                        msg.html(response.data.msgsuccess);
                        msg.removeClass('alert-danger').addClass('alert-success').fadeIn('fast').delay(3000).fadeOut();
                        
                        $('html, body').animate( { scrollTop: $('body').offset().top }, 500 );
                        $(".selectpicker, .show-tick").val('').selectpicker('render');
                    }
    			}
    		});
        };
        
        //Mobile Phone Number
        $('#tenant_phone_contact').inputmask('+62 99999999999', { placeholder: '+__ ___________' });
    };
    
    var handleLogoTenantValidation = function(){
        $('#logotenant').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                avatar_company: {
                    required: true,
                },
            },
            messages: {
                avatar_company: {
                    required: "Berkas harus diisi."
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $(this)).fadeIn();
            },
            highlight: function (element) { // hightlight error inputs
                console.log(element);
                $(element).parents('.form-line').addClass('error'); // set error class to the control group
            },
            unhighlight: function (element) {
                $(element).parents('.form-line').removeClass('error');
            },
            success: function (label) {
                label.closest('.form-line').removeClass('error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            },
            submitHandler: function (form) {
                $('#save_logotenant').modal('show');
            }
        });
        
        // Save Logo Tenant
        $('#do_save_logotenant').click(function(e){
            e.preventDefault();
            processSaveLogoTenant($('#logotenant'));
        });
        
        var processSaveLogoTenant = function( form ) {
            var url     = form.attr( 'action' );
            var data    = new FormData(form[0]);
            var msg     = $('.alert');
        	
            $.ajax({
    			type : "POST",
    			url  : url,
    			data : data,
                
                cache : false,
                contentType : false,
                processData : false,
                beforeSend: function(){
                    $("div.page-loader-wrapper").fadeIn();
                    $('#save_logotenant').modal('hide');
                },
    			success: function(response) {
                    $("div.page-loader-wrapper").fadeOut();
                    response = $.parseJSON( response );
                    
                    if(response.message == 'error'){
                        msg.html(response.data.msg);
                        msg.removeClass('alert-success').addClass('alert-danger').fadeIn('fast').delay(3000).fadeOut();
                    }else{
                        msg.html(response.data.msgsuccess);
                        msg.removeClass('alert-danger').addClass('alert-success').fadeIn('fast').delay(3000).fadeOut();
                        
                        $('#logotenant')[0].reset();
                        $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
                        $('#avatar_company').fileinput('refresh', {
                            showUpload : false,
                            showUploadedThumbs : false,
                            'theme': 'explorer',
                            'uploadUrl': '#',
                            fileType: "any",
                            overwriteInitial: false,
                            initialPreviewAsData: true,
                            allowedFileExtensions: ['jpeg', 'jpg', 'png'],
                            fileActionSettings : {
                                showUpload: false,
                                showZoom: false,
                            },
                            maxFileSize: 1024,
                        });
                    }
    			}
    		});
        };
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handleAddTenantValidation();
            handleLogoTenantValidation();
        }
    };
}();



