var FormValidation = function () {
    
    var handleValidationContact = function() {
        // for more info visit the official plugin documentation: 
        // http://docs.jquery.com/Plugins/Validation

        var form_con    = $('#contact_form');
        var msg         = $('.alert');
        
        form_con.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                contact_name: {
                    required: true,
                    maxlength: 45,
                },
                contact_email: {
                    required: true,
                    email: true,
                    maxlength: 45,
                },
                contact_subject: {
                    required: true,
                },
                contact_message: {
                    required: true,
                    maxlength: 255,
                },
            },
            messages: {
                contact_name: {
                    required: "Form nama harus di isi",
                    maxlength: "Maksimal 45 karakter",
                },
                contact_email: {
                    required: "Form email harus di isi",
                    email: "Alamat email Anda tidak valid",
                    maxlength: "Maksimal 45 karakter",
                },
                contact_subject: {
                    required: "Form subject pesan harus di isi",
                },
                contact_message: {
                    required: "Form pesan harus di isi",
                    maxlength: "Maksimal 255 karakter",
                },
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.parent(".input-group").size() > 0) {
                    error.insertAfter(element.parent(".input-group"));
                } else if (element.attr("data-error-container")) { 
                    error.appendTo(element.attr("data-error-container"));
                } else if (element.parents('.radio-list').size() > 0) { 
                    error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                } else if (element.parents('.radio-inline').size() > 0) { 
                    error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
                } else if (element.parents('.checkbox-list').size() > 0) {
                    error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                } else if (element.parents('.checkbox-inline').size() > 0) { 
                    error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit 
                msg.html('<button class="close" data-close="alert"></button>Anda memiliki beberapa kesalahan. Silakan cek di formulir bawah ini!');          
                msg.removeClass('alert-success').addClass('alert-danger').show();
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.full-row').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.full-row').removeClass('has-error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.full-row').removeClass('has-error'); // set success class to the control group
            },
            submitHandler: function (form) {
                var url         = form_con.attr('action');
                var data        = form_con.serialize();
                
                $.ajax({
                    type:   "POST",
                    data:   data,
                    url:    url,
                    beforeSend: function (){
                        $("div#mask").fadeIn();
                    },
                    success: function( response ){
                        response = $.parseJSON(response);
                        $("div#mask").fadeOut();
                        
                        if(response.message == 'error'){
                            if(response.data.msg == 'send_failed'){
                                msg.html('<button class="close" data-close="alert"></button>Ada kesalahan dalam pengiriman pesan Anda.');
                                msg.removeClass('alert-success').addClass('alert-danger').fadeIn('fast');
                            }
                        }else{
                            msg.html('<button class="close" data-close="alert"></button>Terima Kasih. Pesan Anda akan kami proses.');
                            msg.removeClass('alert-danger').addClass('alert-success').fadeIn('fast');
                            form_con[0].reset();
                        }
                        return false;
                    }
                });
            }
        });
        
        $('#btn_reset_contact').click(function(e){
            e.preventDefault();
            var msg         = $('.alert');
            
            $(msg).hide().empty();
            $('.full-row').removeClass('has-error');
            $('.help-block').hide().empty();
            $('#contact_form')[0].reset();
        });
    }
    
    var handleWysihtml5 = function() {
        if (!jQuery().wysihtml5) {
            return;
        }

        if ($('.wysihtml5').size() > 0) {
            $('.wysihtml5').wysihtml5({
                "stylesheets": ["ionassets/frontend/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
            });
        }
    }

    return {
        //main function to initiate the module
        init: function () {
            handleWysihtml5();
            handleValidationContact();
        }
    };
    
}();