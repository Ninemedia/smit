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
var SelectionValidation = function () {
    var handleSelectionValidationIncubation = function(){
        $('#selectionincubation').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                reg_desc: {
                    required: true,
                },
                reg_name: {
                    required: true,
                },
                reg_event_title: {
                    required: true,
                },
                reg_category: {
                    required: true,
                },
                reg_agree: {
                    required: true,
                },
                selection_files: {
                    required: true,
                },
                rab_selection_files: {
                    required: true,
                },
            },
            messages: {
                reg_desc: {
                    required: 'Deskripsi Kegiatan harus di isi',
                },
                reg_name: {
                    required: 'Nama Peneliti Utama harus di isi',
                },
                reg_event_title: {
                    required: 'Judul Kegiatan harus di isi',
                },
                reg_category: {
                    required: 'Kategori bidang harus di isi',
                },
                reg_agree: {
                    required: 'Anda harus setuju atas pengisian formulir ini',
                },
                selection_files: {
                    required: 'Data File Kegiatan harus di isi',
                },
                rab_selection_files: {
                    required: 'Data File Rencana Anggaran Kegiatan harus di isi',
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
                $('#save_selectionincubation').modal('show');
            }
        });
    };

    var handleSelectionValidationPraIncubaion = function(){
        $('#selectionpraincubation').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                reg_desc: {
                    required: true,
                },
                reg_name: {
                    required: true,
                },
                reg_event_title: {
                    required: true,
                },
                reg_category: {
                    required: true,
                },
                reg_agree: {
                    required: true,
                },
                selection_files: {
                    required: true,
                },
                rab_selection_files: {
                    required: true,
                },
            },
            messages: {
                reg_desc: {
                    required: 'Deskripsi Kegiatan harus di isi',
                },
                reg_name: {
                    required: 'Nama Peneliti Utama harus di isi',
                },
                reg_event_title: {
                    required: 'Judul Kegiatan harus di isi',
                },
                reg_category: {
                    required: 'Kategori bidang harus di isi',
                },
                reg_agree: {
                    required: 'Anda harus setuju atas pengisian formulir ini',
                },
                selection_files: {
                    required: 'Data File Kegiatan harus di isi',
                },
                rab_selection_files: {
                    required: 'Data File Rencana Anggaran Kegiatan harus di isi',
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
                $('#save_selectionpraincubation').modal('show');
            }
        });
    };

    return {
        //main function to initiate the module
        init: function () {
            handleSelectionValidationIncubation();
            handleSelectionValidationPraIncubaion();
        }
    };
}();

var ContactValidation = function () {
    var handleContactValidation = function(){
        $('#contactadd').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                contact_name: {
                    required: true,
                },
                contact_email: {
                    required: true,
                },
                contact_title: {
                    required: true,
                },
                contact_desc: {
                    required: true,
                },
            },
            messages: {
                contact_name: {
                    required: 'Nama Anda harus di isi',
                },
                contact_email: {
                    required: 'Email Anda harus di isi',
                },
                contact_title: {
                    required: 'Judul Pesan harus di isi',
                },
                contact_desc: {
                    required: 'Deskripsi Pesan harus di isi',
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
                $('#save_contact').modal('show');
            }
        });
    };

    return {
        //main function to initiate the module
        init: function () {
            handleContactValidation();
        }
    };
}();

var IKMValidation = function () {
    var handleIKMValidation = function(){
        $('#ikmadddata').validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                ikm_email: {
                    required: true,
                },
                ikm_comment: {
                    required: true,
                },
            },
            messages: {
                ikm_email: {
                    required: 'Nama Anda harus di isi',
                },
                ikm_comment: {
                    required: 'Kritik dan Saran harus di isi',
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
                $('#save_ikmadddata').modal('show');
            }
        });
    };

    return {
        //main function to initiate the module
        init: function () {
            handleIKMValidation();
        }
    };
}();
