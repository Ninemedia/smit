$(function () {
    activateNotificationAndTasksScroll();

    setSkinListHeightAndScroll();
    setSettingListHeightAndScroll();
    $(window).resize(function () {
        setSkinListHeightAndScroll();
        setSettingListHeightAndScroll();
    });
    tableSearchFilterToggle();
});

//Skin tab content set height and show scroll
function setSkinListHeightAndScroll() {
    var height = $(window).height() - ($('.navbar').innerHeight() + $('.right-sidebar .nav-tabs').outerHeight());
    var $el = $('.demo-choose-skin');

    $el.slimScroll({ destroy: true }).height('auto');
    $el.parent().find('.slimScrollBar, .slimScrollRail').remove();

    $el.slimscroll({
        height: height + 'px',
        color: 'rgba(0,0,0,0.5)',
        size: '4px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}

//Setting tab content set height and show scroll
function setSettingListHeightAndScroll() {
    var height = $(window).height() - ($('.navbar').innerHeight() + $('.right-sidebar .nav-tabs').outerHeight());
    var $el = $('.right-sidebar .demo-settings');

    $el.slimScroll({ destroy: true }).height('auto');
    $el.parent().find('.slimScrollBar, .slimScrollRail').remove();

    $el.slimscroll({
        height: height + 'px',
        color: 'rgba(0,0,0,0.5)',
        size: '4px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}

//Activate notification and task dropdown on top right menu
function activateNotificationAndTasksScroll() {
    $('.navbar-right .dropdown-menu .body .menu').slimscroll({
        height: '254px',
        color: 'rgba(0,0,0,0.5)',
        size: '4px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}

// Table Search Filter Toggle
function tableSearchFilterToggle() {
    $("body").delegate( "button.table-search", "click", function( event ) {
        event.preventDefault();
        $('tr.table-filter').toggle();
    });
}

//Google Analiytics ======================================================================================
addLoadEvent(loadTracking);
var trackingId = 'UA-30038099-6';

function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
        window.onload = func;
    } else {
        window.onload = function () {
            oldonload();
            func();
        }
    }
}

function loadTracking() {
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date(); a = s.createElement(o),
        m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', trackingId, 'auto');
    ga('send', 'pageview');
}
//========================================================================================================

// Additional Functions
// User Confirm
$("body").delegate( "a.userconfirm", "click", function( event ) {
    event.preventDefault();
    var url = $(this).attr('href');
    var table_container = $('#user_list').parents('.dataTables_wrapper');
    var msg = '';
    
    bootbox.confirm("Anda yakin akan mengkonfirmasi pengguna ini?", function(result) {
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
                            container: table_container, 
                            place: 'prepend'
                        });
                    }else{
                        App.alert({
                            type: 'success', 
                            icon: 'check', 
                            message: response.message, 
                            container: table_container, 
                            place: 'prepend'
                        });
                    }
                    $('#btn_list_user').trigger('click');
                }
            });
        }
    });
});

var Guides = function () {
    var handleUploadFiles = function(){
        $("#guide_selection_files").fileinput({
            showUpload : false,
            showUploadedThumbs : false,
            'theme': 'explorer',
            'uploadUrl': '#',
            fileType: "any",
            overwriteInitial: false,
            initialPreviewAsData: true,
            allowedFileExtensions: ['doc', 'docx', 'pdf', 'xls', 'xlsx'],
            fileActionSettings : {
                showUpload: false,
                showZoom: false,
            },
            maxFileSize: 2048,
            /* uploadClass: 'btn btn-success' */
        });
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handleUploadFiles();
        }
    };
}();

var UploadFiles = function () {
    var handleUploadFiles = function(){
        $("#selection_files").fileinput({
            showUpload : false,
            showUploadedThumbs : false,
            'theme': 'explorer',
            'uploadUrl': '#',
            fileType: "any",
            overwriteInitial: false,
            initialPreviewAsData: true,
            allowedFileExtensions: ['doc', 'docx', 'pdf', 'xls', 'xlsx'],
            fileActionSettings : {
                showUpload: false,
                showZoom: false,
            },
            maxFileSize: 2048,
            /* uploadClass: 'btn btn-success' */
        });
    };
    
    var handleUploadAvatar = function(){
        $("#ava_selection_files").fileinput({
            showUpload : false,
            showUploadedThumbs : false,
            'theme': 'explorer',
            'uploadUrl': '#',
            fileType: "any",
            overwriteInitial: false,
            initialPreviewAsData: true,
            allowedFileExtensions: ['jpg', 'jpeg', 'png'],
            fileActionSettings : {
                showUpload: false,
                showZoom: false,
            },
            maxFileSize: 1024,
            /* uploadClass: 'btn btn-success' */
        });
    };
    
    var handleEditUploadFiles = function(){
        $("#edit_selection_files").fileinput({
            showUpload : false,
            showUploadedThumbs : false,
            'theme': 'explorer',
            'uploadUrl': '#',
            fileType: "any",
            overwriteInitial: false,
            initialPreviewAsData: true,
            allowedFileExtensions: ['doc', 'docx', 'pdf', 'xls', 'xlsx'],
            fileActionSettings : {
                showUpload: false,
                showZoom: false,
            },
            maxFileSize: 2048,
            /* uploadClass: 'btn btn-success' */
        });
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handleUploadFiles();
            handleEditUploadFiles();
            handleUploadAvatar();
        }
    };
}();

var Tenant = function () {
    var handleUploadAvatarTenant = function(){
        $("#avatar_company").fileinput({
            showUpload : false,
            showUploadedThumbs : false,
            'theme': 'explorer',
            'uploadUrl': '#',
            fileType: "any",
            overwriteInitial: false,
            initialPreviewAsData: true,
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            fileActionSettings : {
                showUpload: false,
                showZoom: false,
            },
            maxFileSize: 2048,
            /* uploadClass: 'btn btn-success' */
        });
    };
    
    // --------------------------------
    // Handle Province Change
    // --------------------------------
	var handleProvinceChange = function() {
        // Province Change
        $('#province-select').on("change",function(){
            
            var val     = $(this).val();
            var url     = $(this).data('url');
            var el      = $('#regional-select');
            
            $.ajax({
                type:   "POST",
                data:   {
                    'province' : val,
                    'csrf_smit' : $('input[name="csrf_smit"]').val()
                },
                url:    url,
                beforeSend: function (){},
                success: function( response ){
                    response = $.parseJSON(response);
                    el.empty().hide();
                    
                    el.parent().removeClass('has-error');
                    el.parent().find('.help-block').empty().hide();
                    
                    if(response.message == 'success'){
                        el.attr('disabled', false);
                        el.html(response.data).selectpicker('refresh'); 
                    }else{
                        el.attr('disabled', true);
                        el.html(response.data).selectpicker('refresh'); 
                    }
                }
            });
            return false;
        });
	};
    
    return {
        //main function to initiate the module
        init: function () {
            handleUploadAvatarTenant();
            handleProvinceChange();
        }
    };
}();

var PraIncubationList = function () {
    var handlePraIncubationList = function(){
        // User Confirm
        $("body").delegate( "a.praincubationconfirm", "click", function( event ) {
            event.preventDefault();
            var url = $(this).attr('href');
            var table_container = $('#praincubation_list').parents('.dataTables_wrapper');
            var msg = '';
            
            bootbox.confirm("Anda yakin akan mengkonfirmasi semua data seleksi?", function(result) {
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
                                    container: table_container, 
                                    place: 'prepend'
                                });
                            }else{
                                App.alert({
                                    type: 'success', 
                                    icon: 'check', 
                                    message: response.message, 
                                    container: table_container, 
                                    place: 'prepend'
                                });
                            }
                            $('#btn_praincubation_list').trigger('click');
                        }
                    });
                }
            });
        });
    };
    
    var handlePraIncubationReportList = function(){
        // User Confirm
        $("body").delegate( "a.praincubationreportconfirm", "click", function( event ) {
            event.preventDefault();
            var url = $(this).attr('href');
            var table_container = $('#praincubationreport_list').parents('.dataTables_wrapper');
            var msg = '';
            
            bootbox.confirm("Anda yakin akan mengkonfirmasi semua data laporan pra inkubasi seleksi?", function(result) {
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
                                    container: table_container, 
                                    place: 'prepend'
                                });
                            }else{
                                $(location).attr('href',response.message);
                            }
                            $('#btn_praincubationreport_list').trigger('click');
                        }
                    });
                }
            });
        });
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handlePraIncubationList();
            handlePraIncubationReportList();
        }
    };
}();


var IncubationList = function () {
    var handleIncubationList = function(){
        // User Confirm
        $("body").delegate( "a.incubationconfirm", "click", function( event ) {
            event.preventDefault();
            var url = $(this).attr('href');
            var table_container = $('#incubation_list').parents('.dataTables_wrapper');
            var msg = '';
            
            bootbox.confirm("Anda yakin akan mengkonfirmasi semua data seleksi?", function(result) {
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
                                    container: table_container, 
                                    place: 'prepend'
                                });
                            }else{
                                App.alert({
                                    type: 'success', 
                                    icon: 'check', 
                                    message: response.message, 
                                    container: table_container, 
                                    place: 'prepend'
                                });
                            }
                            $('#btn_incubation_list').trigger('click');
                        }
                    });
                }
            });
        });
    };
    
    var handleIncubationReportList = function(){
        // User Confirm
        $("body").delegate( "a.incubationreportconfirm", "click", function( event ) {
            event.preventDefault();
            var url = $(this).attr('href');
            var table_container = $('#incubationreport_list').parents('.dataTables_wrapper');
            var msg = '';
            
            bootbox.confirm("Anda yakin akan mengkonfirmasi semua data laporan inkubasi seleksi?", function(result) {
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
                                    container: table_container, 
                                    place: 'prepend'
                                });
                            }else{
                                $(location).attr('href',response.message);
                            }
                        }
                    });
                }
            });
        });
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handleIncubationList();
            handleIncubationReportList();
        }
    };
}();

var Setting = function () {
    // --------------------------------
    // Handle General Setting
    // --------------------------------
    var handleSetting = function() {
        
        // Dashboard Setting
        //$('#btn_be_dashboard_user').click(function(e){
        $("body").delegate( "button.btn_be_dashboard_user", "click", function( event ) {
            event.preventDefault();
            var url = $(this).data('url');
            alert(url);
            
            
            $.ajax({
                type:   "POST",
                url:    url,
                data: { 'field' : 'be_dashboard_user', 'value' : CKEDITOR.instances['be_dashboard_user'].getData() },
                beforeSend: function (){ $("div.page-loader-wrapper").fadeIn(); },
                success: function( response ){ $("div.page-loader-wrapper").fadeOut(); }
            });
        });
        // ---------------------------------------------------------------------
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handleSetting();
        }
    };
}();
