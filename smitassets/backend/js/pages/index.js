$(function () {    
    // Put your sctipt here...
});

var SelectGuide = function () {
    handleSelectGuide = function(){
        $('.def option').mousedown(function(e) {
            e.preventDefault();
            $(this).prop('selected', $(this).prop('selected') ? false : true);
        });     
    };

    return {
        //main function to initiate the module
        init: function () {
            handleSelectGuide();
        }
    };
}();

var IncubationSetting = function () {
    handleIncubationSettingAction = function(){
        // Close Incubation Setting
        $("body").delegate( "a.incubsetclose", "click", function( event ) {
            event.preventDefault();
            var url = $(this).attr('href');
            var table_container = $('#incubation_setting_list').parents('.dataTables_wrapper');
            
            $.ajax({
                type:   "POST",
                url:    url,
                beforeSend: function (){
                    $("div.page-loader-wrapper").fadeIn();
                },
                success: function( response ){                    
                    $("div.page-loader-wrapper").fadeOut();
                    response    = $.parseJSON(response);
                            
                    if( response.message == 'redirect'){
                        $(location).attr('href',response.data);
                    }else if( response.message == 'error'){
                        App.alert({
                            type: 'danger', 
                            icon: 'warning', 
                            message: response.data, 
                            container: table_container, 
                            place: 'prepend'
                        });
                    }else{
                        App.alert({
                            type: 'success', 
                            icon: 'check', 
                            message: response.data, 
                            container: table_container, 
                            place: 'prepend'
                        });
                        $('#btn_incubation_setting_list').trigger('click');
                    }
                }
            });
        });    
        
        // Details Incubation Setting
        $("body").delegate( "a.incubsetdet", "click", function( event ) {
            event.preventDefault();
            var url = $(this).attr('href');
            var table_container = $('#incubation_setting_list').parents('.dataTables_wrapper');
            var el = $('#incubation_details');
            
            $.ajax({
                type:   "POST",
                url:    url,
                beforeSend: function (){
                    $("div.page-loader-wrapper").fadeIn();
                },
                success: function( response ){                    
                    $("div.page-loader-wrapper").fadeOut();
                    response    = $.parseJSON(response);
                         
                    if( response.message == 'redirect'){
                        $(location).attr('href',response.data);
                    }else if( response.message == 'error'){
                        App.alert({
                            type: 'danger', 
                            icon: 'warning', 
                            message: response.data, 
                            container: table_container, 
                            place: 'prepend'
                        });
                    }else{
                        $('.selection_det_date_start').bootstrapMaterialDatePicker('setDate', response.details.selection_date_start);
                        $('.selection_det_date_end').bootstrapMaterialDatePicker('setDate', response.details.selection_date_end);
                        $('.selection_det_imp_date_start').bootstrapMaterialDatePicker('setDate', response.details.selection_imp_date_start);
                        $('.selection_det_imp_date_end').bootstrapMaterialDatePicker('setDate', response.details.selection_imp_date_end);
                        $('#selection_det_files').val(response.details.selection_files);
                        $('#selection_det_juri_phase1').val(response.details.selection_juri_phase1);
                        $('#selection_det_juri_phase2').val(response.details.selection_juri_phase2);
                        
                        App.scrollTo($('#incubation_setting_list'),240);
                        el.fadeIn();
                    }
                }
            });
        });  
        
        // Close Details Incubation Setting
        $("body").delegate( "a.close-details, button.close-details", "click", function( event ) {
            event.preventDefault();
            var el = $('#incubation_details');
            el.fadeOut();
            App.scrollTo($('body'),0);
        });
    };

    return {
        //main function to initiate the module
        init: function () {
            handleIncubationSettingAction();
        }
    };
}();

var ScoreSetting = function () {
    handleScoreSetting = function(){
        // Details Score Incubation Setting
        $("body").delegate( "a.scoresetdet", "click", function( event ) {
            event.preventDefault();
            var url = $(this).attr('href');
            var step = $(this).data('step');

            var table_container = step == 1 ? $('#jury_stepone').parents('.dataTables_wrapper') : $('#jury_steptwo').parents('.dataTables_wrapper');
            var el = step == 1 ? $('#scoredata_details') : $('#scoredata_details2');

            $.ajax({
                type:   "POST",
                url:    url,
                beforeSend: function (){
                    $("div.page-loader-wrapper").fadeIn();
                },
                success: function( response ){                    
                    $("div.page-loader-wrapper").fadeOut();
                    response    = $.parseJSON(response);
                         
                    if( response.message == 'redirect'){
                        $(location).attr('href',response.data);
                    }else if( response.message == 'error'){
                        App.alert({
                            type: 'danger', 
                            icon: 'warning', 
                            message: response.data, 
                            container: table_container, 
                            place: 'prepend'
                        });
                    }else{
                        $('.profile-name').empty().html(response.details.user_name).show();
                        $('.profile-username').empty().html('<i class="material-icons">person</i> ' + response.details.username).show();
                        $('.profile-email').empty().html('<i class="material-icons">email</i> ' + response.details.email).show();
                        $('.profile-phone').empty().html('<i class="material-icons">phone</i> ' + response.details.phone).show();
                        
                        $('#reg_event_title, #reg_event_title2').val(response.details.event_title);
                        $('#reg_desc, #reg_desc2').val(response.details.event_desc);
                        $('#reg_name, #reg_name2').val(response.details.name);
                        $('#reg_category, #reg_category2').val(response.details.category);
                        
                        if( step == 1 ){
                            $('.status-examined').hide();
                            $('.status-called').hide();
                            
                            $('button.btn-examine, button.btn-call, button.btn-reject').attr('data-uniquecode',response.details.uniquecode);
                            $('button.btn-download-file').attr('data-uniquecode', response.details.uniquecode);
    
                            if(response.details.status == 0){
                                $('.selection-status').empty().html('<span class="label label-default">BELUM DIKONFIRMASI</span>').show();
                            }else if(response.details.status == 1){
                                $('.selection-status').empty().html('<span class="label label-success">DIKONFIRMASI</span>').show();
                                $('.status-examined').show();
                                $('button.btn-download-file').attr('disabled', 'disabled');
                            }else if(response.details.status == 2){
                                $('.selection-status').empty().html('<span class="label bg-brown">DIPERIKSA</span>').show();
                                $('.status-called').show();
                            }else if(response.details.status == 3){
                                $('.selection-status').empty().html('<span class="label label-warning">DIPANGGIL</span>').show();
                            }else if(response.details.status == 4){
                                $('.selection-status').empty().html('<span class="label bg-purple">DINILAI</span>').show();
                            }else if(response.details.status == 5){
                                $('.selection-status').empty().html('<span class="label label-primary">DITERIMA</span>').show();
                            }else if(response.details.status == 6){
                                $('.selection-status').empty().html('<span class="label label-danger">DITOLAK</span>').show();
                            }
                        }else{
                            if(response.details.status == 1){
                                $('.selection-status').empty().html('<span class="label label-success">DIKONFIRMASI</span>').show();
                            }
                        }

                        App.scrollTo(table_container,240);
                        el.fadeIn();
                    }
                }
            });
        });  
        
        // Button Score Action
        $("body").delegate( "button.btn-examine", "click", function( event ) {
            event.preventDefault();
            var div_container   = $('#alert-display');
            var baseurl         = $(this).data('baseurl');
            var uniquecode      = $(this).data('uniquecode');
            var url             = baseurl + '/' + uniquecode;

            bootbox.confirm("Anda yakin akan melakukan pemeriksaan seleksi user ini?", function(result) {
                if( result == true ){
                    $.ajax({
                        type:   "POST",
                        url:    url,
                        beforeSend: function (){
                            $("div.page-loader-wrapper").fadeIn();
                        },
                        success: function( response ){                    
                            $("div.page-loader-wrapper").fadeOut();
                            response = $.parseJSON(response);
                            
                            if( response.msg == 'error' ){
                                App.alert({
                                    type: 'danger', 
                                    icon: 'warning', 
                                    message: response.message, 
                                    container: div_container, 
                                    place: 'prepend',
                                    focus: false
                                });
                                App.scrollTo(div_container, -90);
                                $('button.btn-download-file').attr('disabled','disabled');
                            }else{
                                App.alert({
                                    type: 'success', 
                                    icon: 'check', 
                                    message: response.message, 
                                    container: div_container, 
                                    place: 'prepend',
                                    focus: false
                                });
                                App.scrollTo($('#scoredata_details'), -90);
                                $('button.btn-download-file').removeAttr('disabled');
                                $('.selection-status').empty().html('<span class="label bg-brown">DIPERIKSA</span>').show();
                                $('#btn_list_user').trigger('click');
                                $('.status-examined').hide();
                                $('.status-called').show();
                            }
                            return false;
                        }
                    });
                }
            });
        });
        
        $("body").delegate( "button.btn-call", "click", function( event ) {
            event.preventDefault();
            var div_container   = $('#alert-display');
            var baseurl         = $(this).data('baseurl');
            var uniquecode      = $(this).data('uniquecode');
            var url             = baseurl + '/' + uniquecode;

            bootbox.confirm("Anda yakin akan memanggil user ini?", function(result) {
                if( result == true ){
                    $.ajax({
                        type:   "POST",
                        url:    url,
                        beforeSend: function (){
                            $("div.page-loader-wrapper").fadeIn();
                        },
                        success: function( response ){                    
                            $("div.page-loader-wrapper").fadeOut();
                            response = $.parseJSON(response);
                            
                            if( response.msg == 'error' ){
                                App.alert({
                                    type: 'danger', 
                                    icon: 'warning', 
                                    message: response.message, 
                                    container: div_container, 
                                    place: 'prepend',
                                    focus: false
                                });
                                App.scrollTo(div_container, -90);
                            }else{
                                App.alert({
                                    type: 'success', 
                                    icon: 'check', 
                                    message: response.message, 
                                    container: div_container, 
                                    place: 'prepend',
                                    focus: false
                                });
                                App.scrollTo($('#scoredata_details'), -90);
                                $('.selection-status').empty().html('<span class="label label-warning">DIPANGGIL</span>').show();
                                $('#btn_list_user').trigger('click');
                                $('.status-examined').hide();
                                $('.status-called').hide();
                            }
                            return false;
                        }
                    });
                }
            });
        });
        
        $("body").delegate( "button.btn-reject", "click", function( event ) {
            event.preventDefault();
            var div_container   = $('#alert-display');
            var baseurl         = $(this).data('baseurl');
            var uniquecode      = $(this).data('uniquecode');
            var url             = baseurl + '/' + uniquecode;

            bootbox.confirm("Anda yakin akan menolak seleksi user ini?", function(result) {
                if( result == true ){
                    $.ajax({
                        type:   "POST",
                        url:    url,
                        beforeSend: function (){
                            $("div.page-loader-wrapper").fadeIn();
                        },
                        success: function( response ){                    
                            $("div.page-loader-wrapper").fadeOut();
                            response = $.parseJSON(response);
                            
                            if( response.msg == 'error' ){
                                App.alert({
                                    type: 'danger', 
                                    icon: 'warning', 
                                    message: response.message, 
                                    container: div_container, 
                                    place: 'prepend',
                                    focus: false
                                });
                                App.scrollTo(div_container, -90);
                            }else{
                                App.alert({
                                    type: 'success', 
                                    icon: 'check', 
                                    message: response.message, 
                                    container: div_container, 
                                    place: 'prepend',
                                    focus: false
                                });
                                App.scrollTo($('#scoredata_details'), -90);
                                $('.selection-status').empty().html('<span class="label label-danger">DITOLAK</span>').show();
                                $('#btn_list_user').trigger('click');
                                $('.status-examined').hide();
                                $('.status-called').hide();
                            }
                            return false;
                        }
                    });
                }
            });
        });
        
        $("body").delegate( "button.btn-download-file", "click", function( event ) {
            event.preventDefault();
            var div_container   = $('#alert-display');
            var baseurl         = $(this).data('baseurl');
            var uniquecode      = $(this).data('uniquecode');
            var url             = baseurl + '/' + uniquecode;

            bootbox.confirm("Anda yakin akan mendownload file seleksi user ini?", function(result) {
                if( result == true ){
                    $.ajax({
                        type:   "POST",
                        url:    url,
                        beforeSend: function (){
                            $("div.page-loader-wrapper").fadeIn();
                        },
                        success: function( response ){                    
                            $("div.page-loader-wrapper").fadeOut();
                            response = $.parseJSON(response);
                            
                            if( response.msg == 'error' ){
                                App.alert({
                                    type: 'danger', 
                                    icon: 'warning', 
                                    message: response.message, 
                                    container: div_container, 
                                    place: 'prepend',
                                    focus: false
                                });
                                App.scrollTo(div_container, -90);
                            }else{
                                document.location.href =(response.message);
                                setTimeout(function () { URL.revokeObjectURL(response.message); }, 100);
                            }
                            return false;
                        }
                    });
                }
            });
        });
        
        // Close Details Incubation Setting
        $("body").delegate( "a.close-details, button.close-details", "click", function( event ) {
            event.preventDefault();
            var el = $('#scoredata_details');
            el.fadeOut();
            App.scrollTo($('body'),0);
        });
        
        // Score Setting Rate
        $("body").delegate( "a.scoresetnilai", "click", function( event ) {
            event.preventDefault();
            var url = $(this).attr('href');
            var table_container = $('#jury_steptwo').parents('.dataTables_wrapper');
            var el = $('#scoredata_nilai');
            
            $.ajax({
                type:   "POST",
                url:    url,
                beforeSend: function (){
                    $("div.page-loader-wrapper").fadeIn();
                },
                success: function( response ){                    
                    $("div.page-loader-wrapper").fadeOut();
                    response    = $.parseJSON(response);
                         
                    if( response.message == 'redirect'){
                        $(location).attr('href',response.data);
                    }else if( response.message == 'error'){
                        App.alert({
                            type: 'danger', 
                            icon: 'warning', 
                            message: response.data, 
                            container: table_container, 
                            place: 'prepend'
                        });
                    }else{
                        //$('#reg_username').val(response.details.username);
                        //$('#reg_username_data').val(response.details.username);
                        
                        App.scrollTo($('#jury_steptwo'),240);
                        el.fadeIn();
                    }
                }
            });
        });
        
        // Close Nilai Incubation Setting
        $("body").delegate( "a.close-nilai, button.close-nilai", "click", function( event ) {
            event.preventDefault();
            var el = $('#scoredata_nilai');
            el.fadeOut();
            App.scrollTo($('body'),0);
        }); 
    };
    
    return {
        // main function to initiate the module
        init: function () {
            handleScoreSetting();
        }
    };
}();


var AnnouncementSetting = function () {
    handleAnnouncementDataAction = function(){
        // Close Incubation Setting
        $("body").delegate( "a.incubsetclose", "click", function( event ) {
            event.preventDefault();
            var url = $(this).attr('href');
            var table_container = $('#incubation_setting_list').parents('.dataTables_wrapper');
            
            $.ajax({
                type:   "POST",
                url:    url,
                beforeSend: function (){
                    $("div.page-loader-wrapper").fadeIn();
                },
                success: function( response ){                    
                    $("div.page-loader-wrapper").fadeOut();
                    response    = $.parseJSON(response);
                            
                    if( response.message == 'redirect'){
                        $(location).attr('href',response.data);
                    }else if( response.message == 'error'){
                        App.alert({
                            type: 'danger', 
                            icon: 'warning', 
                            message: response.data, 
                            container: table_container, 
                            place: 'prepend'
                        });
                    }else{
                        App.alert({
                            type: 'success', 
                            icon: 'check', 
                            message: response.data, 
                            container: table_container, 
                            place: 'prepend'
                        });
                        $('#btn_incubation_setting_list').trigger('click');
                    }
                }
            });
        });    
        
        // Details Announcement Setting
        $("body").delegate( "a.announdetailset", "click", function( event ) {
            event.preventDefault();
            var url = $(this).attr('href');
            var table_container = $('#announcement_list').parents('.dataTables_wrapper');
            var el = $('#announcement_details');
            
            $.ajax({
                type:   "POST",
                url:    url,
                beforeSend: function (){
                    $("div.page-loader-wrapper").fadeIn();
                },
                success: function( response ){                    
                    $("div.page-loader-wrapper").fadeOut();
                    response    = $.parseJSON(response);
                         
                    if( response.message == 'redirect'){
                        $(location).attr('href',response.data);
                    }else if( response.message == 'error'){
                        App.alert({
                            type: 'danger', 
                            icon: 'warning', 
                            message: response.data, 
                            container: table_container, 
                            place: 'prepend'
                        });
                    }else{
                        
                        $('#reg_uniquecode').val(response.details.uniquecode);
                        $('#reg_title').val(response.details.title);
                        $('#reg_desc').val(response.details.desc);
                        $('#reg_no_announcement').val(response.details.no_announcement);
                        $('#reg_url').val(response.details.url);
                        
                        App.scrollTo($('#announcement_list'),240);
                        el.fadeIn();
                    }
                }
            });
        });  
        
        // Close Details Incubation Setting
        $("body").delegate( "a.close-details, button.close-details", "click", function( event ) {
            event.preventDefault();
            var el = $('#announcement_details');
            el.fadeOut();
            App.scrollTo($('body'),0);
        }); 
    };

    return {
        //main function to initiate the module
        init: function () {
            handleAnnouncementDataAction();
        }
    };
}();

var SliderIndikator = function () {
    handleSliderIndikator = function(){
        $(".slider-indikator").ionRangeSlider({
            grid: true,
            min: 0,
            max: 100,
            keyboard: true,
        });
        
        $(".slider-indikator").on("change",function(){
            var $this = $(this),
                value = $this.prop("value"),
                selector = $this.data("selector"),
                max = $("#" + selector + '_max').val(),
                el = $("#" + selector + '_rate');
                
            var sum = ( value * max ) / 100;
            el.prop('value',sum);
            
            countTotalRate();
        });
    };
    
    countTotalRate = function(){
        var el = $('#total_rate');
        var sum_rate_a = 0;
        var sum_rate_b = 0;
        var sum_rate_c = 0;
        var sum_rate_d = 0;
        var sum_rate_e = 0;
        var total_rate = 0;
        
        for (i=1; i<5; i++) { 
            var rate    = $("#klaster" + i + "_a_rate").prop('value');
            sum_rate_a  += parseFloat(rate);
        }
        for (i=1; i<5; i++) { 
            var rate    = $("#klaster" + i + "_b_rate").prop('value');
            sum_rate_b  += parseFloat(rate);
        }
        for (i=1; i<5; i++) { 
            var rate    = $("#klaster" + i + "_c_rate").prop('value');
            sum_rate_c  += parseFloat(rate);
        }
        for (i=1; i<5; i++) { 
            var rate    = $("#klaster" + i + "_d_rate").prop('value');
            sum_rate_d  += parseFloat(rate);
        }
        for (i=1; i<5; i++) { 
            var rate    = $("#klaster" + i + "_e_rate").prop('value');
            sum_rate_e  += parseFloat(rate);
        }
        
        total_rate = ( sum_rate_a + sum_rate_b + sum_rate_c + sum_rate_d + sum_rate_e ) / 4;
        el.prop('value', total_rate.toFixed(2));
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handleSliderIndikator();
        }
    };
}();
