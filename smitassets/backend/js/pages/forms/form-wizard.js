var Wizard = function () {

    // Selection Incubation Wizard Validation
    var handleSelectionIncubationWizard = function(){
        
        var form = $('#selection_incubation_wizard');
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
        $('.selection_date_end, .selection_det_date_end').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD H:mm',
            clearButton: true,
            weekStart: 1,
        }).on('change', function(e, date){
            $(this).parent().removeClass('error');
            $(this).parent().parent().find('label').remove();
        });
        
        $('.selection_date_start, .selection_det_date_start').bootstrapMaterialDatePicker({ 
            format: 'YYYY-MM-DD H:mm',
            clearButton: true,
            weekStart: 1,
        }).on('change', function(e, date){
            $('.selection_date_end').bootstrapMaterialDatePicker('setMinDate', date);
            $(this).parent().removeClass('error');
            $(this).parent().parent().find('label').remove();
        });
        
        $('.selection_imp_date_start, .selection_det_imp_date_start').bootstrapMaterialDatePicker({ 
            format: 'YYYY-MM-DD H:mm',
            clearButton: true,
            weekStart: 1,
        }).on('change', function(e, date){
            $(this).parent().removeClass('error');
            $(this).parent().parent().find('label').remove();
        });
        
        $('.selection_imp_date_end, .selection_det_imp_date_end').bootstrapMaterialDatePicker({ 
            format: 'YYYY-MM-DD H:mm',
            clearButton: true,
            weekStart: 1,
        }).on('change', function(e, date){
            $(this).parent().removeClass('error');
            $(this).parent().parent().find('label').remove();
        });
    };

    var formWizardValidate = function(form){
        form.validate({
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                selection_date_start: {
                    required: true,
                },
                selection_date_end: {
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
                selection_date_start: {
                    required: "Tanggal Pembukaan Seleksi harus di isi."
                },
                selection_date_end: {
                    required: "Tanggal Penutupan Seleksi harus di isi."
                },
                selection_imp_date_start: {
                    required: "Tanggal Pembukaan Pelaksanaan Seleksi harus di isi."
                },
                selection_imp_date_end: {
                    required: "Tanggal Penutupan Pelaksanaan Seleksi harus di isi."
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
    $('#do_save_selectionincubationsetting').click(function(e){
        e.preventDefault();
        processSaveSelectionIncubationSetting($('#selection_incubation_wizard'));
    });
    
    var processSaveSelectionIncubationSetting = function( form ) {
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
                    $('#selection_incubation_wizard').steps('reset');
                    $('#selection_incubation_wizard')[0].reset();
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
        $('#btn_incubation_setting_list').trigger('click');
        
    });

    return {
        //main function to initiate the module
        init: function () {
            handleSelectionIncubationWizard();
        }
    };
}();