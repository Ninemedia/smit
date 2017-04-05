var Wizard = function () {

    // Selection Incubation Wizard Validation
    var handleSelectionPraIncubationWizard = function(){
        
        var form = $('#selection_praincubation_wizard');
        form.steps({
            headerTag: 'h3',
            bodyTag: 'section',
            transitionEffect: 'slideLeft',
            onInit: function (event, currentIndex) {
                $.AdminBSB.input.activate();
    
                //Set tab width
                var $tab = $(event.currentTarget).find('ul[role="tablist"] li');
                var tabCount = $tab.length;
                $tab.css('width', (100 / tabCount) + '%');
    
                //set button waves effect
                setButtonWavesEffect(event);
            },
            onStepChanging: function (event, currentIndex, newIndex) {
                if (currentIndex > newIndex) { return true; }
    
                if (currentIndex < newIndex) {
                    form.find('.body:eq(' + newIndex + ') label.error').remove();
                    form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
                }
    
                form.validate().settings.ignore = ':disabled,:hidden';
                return form.valid();
            },
            onStepChanged: function (event, currentIndex, priorIndex) {
                setButtonWavesEffect(event);
            },
            onFinishing: function (event, currentIndex) {
                form.validate().settings.ignore = ':disabled';
                return form.valid();
            },
            onFinished: function (event, currentIndex) {
                $('#save_selectionincubationsetting').modal('show');
            }
        });
        formWizardValidate(form);
        
        //Datetimepicker plugin        
        selectDatePicker( $('.selection_date_publication'),'',$('.selection_date_reg_start') );
        selectDatePicker( $('.selection_date_reg_start'),'',$('.selection_date_reg_end') );
        selectDatePicker( $('.selection_date_reg_end'),'',$('.selection_date_adm_start') );
        selectDatePicker( $('.selection_date_adm_start'),'',$('.selection_date_adm_end') );
        selectDatePicker( $('.selection_date_adm_end'),'',$('.selection_date_invitation_send') );
        selectDatePicker( $('.selection_date_invitation_send'),'',$('.selection_date_interview_start') );
        selectDatePicker( $('.selection_date_interview_start'),'',$('.selection_date_interview_end') );
        selectDatePicker( $('.selection_date_interview_end'),'',$('.selection_date_result') );
        selectDatePicker( $('.selection_date_result'),'',$('.selection_date_proposal_start') );
        selectDatePicker( $('.selection_date_proposal_start'),'',$('.selection_date_proposal_end') );
        selectDatePicker( $('.selection_date_proposal_end'),'',$('.selection_date_agreement') );
        selectDatePicker( $('.selection_date_agreement'),'',$('.selection_imp_date_start') );
        selectDatePicker( $('.selection_imp_date_start'),'',$('.selection_imp_date_end') );
    };
    
    var selectDatePicker = function(el, formatdate='', el_end=''){
        //Datetimepicker plugin
        $(el).bootstrapMaterialDatePicker({
            format: formatdate!="" ? formatdate : 'YYYY-MM-DD H:mm',
            clearButton: true,
            weekStart: 1,
        }).on('change', function(e, date){
            if( el_end!="" ){
                $(el_end).bootstrapMaterialDatePicker('setMinDate', date);
            }
            $(el).parent().removeClass('error');
            $(el).parent().parent().find('label').remove();
        });
    }

    var formWizardValidate = function(form){
        form.validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                selection_date_publication: {
                    required: true,
                },
                selection_date_reg_start: {
                    required: true,
                },
                selection_date_reg_end: {
                    required: true,
                },
                selection_date_adm_start: {
                    required: true,
                },
                selection_date_adm_end: {
                    required: true,
                },
                selection_date_invitation_send: {
                    required: true,
                },
                selection_date_interview_start: {
                    required: true,
                },
                selection_date_interview_end: {
                    required: true,
                },
                selection_date_result: {
                    required: true,
                },
                selection_date_proposal_start: {
                    required: true,
                },
                selection_date_proposal_end: {
                    required: true,
                },
                selection_date_agreement: {
                    required: true,
                },
                selection_imp_date_start: {
                    required: true,
                },
                selection_imp_date_end: {
                    required: true,
                },
                selection_files: {
                    required: true,
                },
                juri_phase1: {
                    required: true,
                },
                juri_phase2: {
                    required: true,
                }
            },
            messages: {
                selection_date_publication: {
                    required: "Tanggal Publikasi harus di isi",
                },
                selection_date_reg_start: {
                    required: "Tanggal mulai pendaftaran online harus di isi",
                },
                selection_date_reg_end: {
                    required: "Tanggal selesai pendaftaran online harus di isi",
                },
                selection_date_adm_start: {
                    required: "Tanggal mulai seleksi administrasi harus di isi",
                },
                selection_date_adm_end: {
                    required: "Tanggal selesai seleksi administrasi harus di isi",
                },
                selection_date_invitation_send: {
                    required: "Tanggal undangan presentasi harus di isi",
                },
                selection_date_interview_start: {
                    required: "Tanggal mulai seleksi presentasi harus di isi",
                },
                selection_date_interview_end: {
                    required: "Tanggal selesai seleksi presentasi harus di isi",
                },
                selection_date_result: {
                    required: "Tanggal pengumuman hasil seleksi harus di isi",
                },
                selection_date_proposal_start: {
                    required: "Tanggal mulai perbaikan proposal harus di isi",
                },
                selection_date_proposal_end: {
                    required: "Tanggal selesai perbaikan proposal harus di isi",
                },
                selection_date_agreement: {
                    required: "Tanggal penetapan &amp; penandatanganan perjanjian harus di isi",
                },
                selection_imp_date_start: {
                    required: "Tanggal mulai pelaksanaan kegiatan harus di isi",
                },
                selection_imp_date_end: {
                    required: "Tanggal selesai pelaksanaan kegiatan harus di isi",
                },
                selection_files: {
                    required: "Silahkan pilih berkas panduan",
                },
                juri_phase1: {
                    required: "Silahkan pilih juri tahap 1",
                },
                juri_phase2: {
                    required: "Silahkan pilih juri tahap 2",
                }
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
                return false;
            }
        });
    };
    
    // Save Registered Member
    $('#do_save_selectionpraincubationsetting').click(function(e){
        e.preventDefault();
        processSaveSelectionPraIncubationSetting($('#selection_praincubation_wizard'));
    });
    
    var processSaveSelectionPraIncubationSetting = function( form ) {
        var url     = form.attr( 'action' );
        var data    = new FormData(form[0]);
        var msg     = $('#alert');
    	
        $.ajax({
			type : "POST",
			url  : url,
			data : data,
            cache : false,
            contentType : false,
            processData : false,
            beforeSend: function(){
                $("div.page-loader-wrapper").fadeIn();
            },
			success: function(response) {
                $("div.page-loader-wrapper").fadeOut();
                response = $.parseJSON( response );
                
                if(response.message == 'redirect'){
                    $(location).attr('href',response.data);
                }else if(response.message == 'error'){
                    msg.html(response.data);
                    msg.removeClass('alert-success').addClass('alert-danger').fadeIn('fast').delay(3000).fadeOut();
                }else{
                    msg.removeClass('alert-danger').addClass('alert-success').hide();
                    $('#selection_praincubation_wizard').steps('reset');
                    $('#selection_praincubation_wizard')[0].reset();
                    $('#selection_list_tab').trigger('click');
                }
			}
		});
    };

    var setButtonWavesEffect = function(event) {
        $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
        $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
    };
    
    // Selection Setting Tabs
    $('#selection_list_tab').click(function(e){
        e.preventDefault();
        $('#btn_praincubation_setting_list').trigger('click');
        
    });

    return {
        //main function to initiate the module
        init: function () {
            handleSelectionPraIncubationWizard();
        }
    };
}();