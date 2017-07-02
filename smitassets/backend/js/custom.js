$(function () {
    activateNotificationAndTasksScroll();

    setSkinListHeightAndScroll();
    setSettingListHeightAndScroll();
    $(window).resize(function () {
        setSkinListHeightAndScroll();
        setSettingListHeightAndScroll();
    });
    tableSearchFilterToggle();

    $("body").delegate( "button.close", "click", function( event ) {
        event.preventDefault();
        $(this).parent().fadeOut();
    });
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

// Slider Confirm
$("body").delegate( "a.sliderconfirm", "click", function( event ) {
    event.preventDefault();
    var url = $(this).attr('href');
    var table_container = $('#slider_list').parents('.dataTables_wrapper');
    var msg = '';

    bootbox.confirm("Anda yakin akan mengkonfirmasi slider ini?", function(result) {
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
                    $('#btn_slider_list').trigger('click');
                }
            });
        }
    });
});

// Produk Confirm
$("body").delegate( "a.produkconfirm", "click", function( event ) {
    event.preventDefault();
    var url = $(this).attr('href');
    var table_container = $('#product_list').parents('.dataTables_wrapper');
    var msg = '';

    bootbox.confirm("Anda yakin akan mengkonfirmasi produk ini?", function(result) {
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
                    $('#btn_product_list').trigger('click');
                    $('#btn_slider_listreset').trigger('click');
                }
            });
        }
    });
});

// Workunit Delete
$("body").delegate( "a.workunitdelete", "click", function( event ) {
    event.preventDefault();
    var url = $(this).attr('href');
    var table_container = $('#workunit_list').parents('.dataTables_wrapper');
    var msg = '';

    bootbox.confirm("Anda yakin akan menghapus data satuan kerja ini?", function(result) {
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
                    $('#btn_workunit_list').trigger('click');
                }
            });
        }
    });
});

// Category Delete
$("body").delegate( "a.categorydelete", "click", function( event ) {
    event.preventDefault();
    var url = $(this).attr('href');
    var table_container = $('#category_list').parents('.dataTables_wrapper');
    var msg = '';

    bootbox.confirm("Anda yakin akan menghapus data kategori ini?", function(result) {
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
                    $('#btn_category_list').trigger('click');
                }
            });
        }
    });
});

// News Delete
$("body").delegate( "button.newsdelete", "click", function( event ) {
    event.preventDefault();
    var url = $(this).attr('href');
    var table_container = $('#workunit_list').parents('.dataTables_wrapper');
    var msg = '';

    bootbox.confirm("Anda yakin akan menghapus data berita ini?", function(result) {
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
                    $('#btn_workunit_list').trigger('click');
                }
            });
        }
    });
});

/*
$("body").delegate( "a.tenantconfirm", "click", function( event ) {
    event.preventDefault();
    var url             = $(this).attr('href');
    var table_container = $('#list_tenant').parents('.dataTables_wrapper');
    var msg             = '';

    bootbox.confirm("Anda yakin akan mengkonfirmasi tenant ini?", function(result) {
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
                    $('#btn_tenant_list').trigger('click');
                }
            });
        }
    });
});
*/

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

    var handleUploadNews = function(){
        $("#news_selection_files").fileinput({
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

    var handleUploadSlider = function(){
        $("#slider_selection_files").fileinput({
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

    var handleUploadLogoTenant = function(){
        $("#avatar_company").fileinput({
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
            maxFileSize: 2048,
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

    var handleEditUploadFilesIncubation = function(){
        $("#reg_selection_files").fileinput({
            showUpload : false,
            showUploadedThumbs : false,
            'theme': 'explorer',
            'uploadUrl': '#',
            fileType: "any",
            overwriteInitial: false,
            initialPreviewAsData: true,
            allowedFileExtensions: ['doc', 'docx', 'pdf'],
            fileActionSettings : {
                showUpload: false,
                showZoom: false,
            },
            maxFileSize: 2048,
            /* uploadClass: 'btn btn-success' */
        });
    };

    var handleEditUploadFilesRAB = function(){
        $("#reg_selection_rab").fileinput({
            showUpload : false,
            showUploadedThumbs : false,
            'theme': 'explorer',
            'uploadUrl': '#',
            fileType: "any",
            overwriteInitial: false,
            initialPreviewAsData: true,
            allowedFileExtensions: ['xls', 'xlsx'],
            fileActionSettings : {
                showUpload: false,
                showZoom: false,
            },
            maxFileSize: 2048,
            /* uploadClass: 'btn btn-success' */
        });
    };

    var handleUploadProductPraincubation = function(){
        $("#reg_thumbnail").fileinput({
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

        $("#reg_details").fileinput({
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

    var handleUploadAvatarTenant = function(){
        $("#avatar_selection_files").fileinput({
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
            handleUploadLogoTenant();
            handleUploadNews();
            handleUploadSlider();
            handleEditUploadFilesIncubation();
            handleEditUploadFilesRAB();
            handleUploadProductPraincubation();
            handleUploadAvatarTenant();
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
                    'province' : val
                },
                url:    url,
                beforeSend: function (){
                    $("div.page-loader-wrapper").fadeIn();
                },
                success: function( response ){
                    $("div.page-loader-wrapper").fadeOut();
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

    // --------------------------------
    // Handle Add Tenant Change
    // --------------------------------
	var handleResetAddTenantChange = function() {
        $('#do_save_addtenant').click(function(e){
            e.preventDefault();
            processSaveAddTenant($('#addtenant'));
        });

        var processSaveAddTenant = function( form ) {
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

                        $('#addtenant')[0].reset();
                        $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
                        $('#avatar_selection_files').fileinput('refresh', {
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
                            maxFileSize: 2048,
                        });
                    }
    			}
    		});
        };

        // Reset News Form
        $('body').on('click', '#btn_addtenant_reset', function(event){
			event.preventDefault();
            var frm         = $(this).data('form');
            var msg         = $('#alert');

            $(msg).hide().empty();
            $('.form-group').removeClass('has-error');
            $('#addtenant')[0].reset();
            $('#avatar_selection_files').fileinput('refresh', {
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
                maxFileSize: 2048,
            });
            $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
        });
	};



    return {
        //main function to initiate the module
        init: function () {
            handleUploadAvatarTenant();
            handleProvinceChange();
            handleResetAddTenantChange();
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
                            $('#btn_resetpraincubation_list').trigger('click');
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

    var handlePraIncubationAccompanimentList = function(){
        // Save Update Profile
        $('#listaccompaniment_tab').click(function(e){
            e.preventDefault();
            $('#btn_accompaniment_list').trigger('click');
        });

        // Save Change Password
        $('#companionassignment_tab').click(function(e){
            e.preventDefault();
            $('#btn_acceptedselection_list').trigger('click');
        });
    };

    return {
        //main function to initiate the module
        init: function () {
            handlePraIncubationList();
            handlePraIncubationReportList();
            handlePraIncubationAccompanimentList();
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
        $("body").delegate( "button.btn-dashboard-setting", "click", function( event ) {
            event.preventDefault();
            var url = $(this).data('url');
            var type = $(this).data('type');
            var instances = 'be_dashboard_' + type;
            var value = getValue(instances);

            $.ajax({
                type:   "POST",
                url:    url,
                data: { 'field' : instances, 'value' : value },
                beforeSend: function (){ $("div.page-loader-wrapper").fadeIn(); },
                success: function( response ){ $("div.page-loader-wrapper").fadeOut(); }
            });
        });

        // Frontend Setting
        $("body").delegate( "button.btn-frontend-setting", "click", function( event ) {
            event.preventDefault();
            var url = $(this).data('url');
            var type = $(this).data('type');
            var instances = 'be_frontend_' + type;
            var value = getValue(instances);

            $.ajax({
                type:   "POST",
                url:    url,
                data: { 'field' : instances, 'value' : value },
                beforeSend: function (){ $("div.page-loader-wrapper").fadeIn(); },
                success: function( response ){ $("div.page-loader-wrapper").fadeOut(); }
            });
        });

        // Registration Setting
        $("body").delegate( "button.btn-notif-registration", "click", function( event ) {
            event.preventDefault();
            var url = $(this).data('url');
            var type = $(this).data('type');
            var instances = 'be_notif_' + type;
            var value = getValue(instances);

            $.ajax({
                type:   "POST",
                url:    url,
                data: { 'field' : instances, 'value' : value },
                beforeSend: function (){ $("div.page-loader-wrapper").fadeIn(); },
                success: function( response ){ $("div.page-loader-wrapper").fadeOut(); }
            });
        });

        // Pra-Incubation Setting
        $("body").delegate( "button.btn-notif-praincubation-setting", "click", function( event ) {
            event.preventDefault();
            var url = $(this).data('url');
            var type = $(this).data('type');
            var instances = 'be_notif_praincubation_' + type;
            var value = getValue(instances);

            $.ajax({
                type:   "POST",
                url:    url,
                data: { 'field' : instances, 'value' : value },
                beforeSend: function (){ $("div.page-loader-wrapper").fadeIn(); },
                success: function( response ){ $("div.page-loader-wrapper").fadeOut(); }
            });
        });

        // Incubation Setting
        $("body").delegate( "button.btn-notif-incubation-setting", "click", function( event ) {
            event.preventDefault();
            var url = $(this).data('url');
            var type = $(this).data('type');
            var instances = 'be_notif_incubation_' + type;
            var value = getValue(instances);

            $.ajax({
                type:   "POST",
                url:    url,
                data: { 'field' : instances, 'value' : value },
                beforeSend: function (){ $("div.page-loader-wrapper").fadeIn(); },
                success: function( response ){ $("div.page-loader-wrapper").fadeOut(); }
            });
        });
        // ---------------------------------------------------------------------
    };

    var getValue = function(id) {
        var content = CKEDITOR.instances[id].getData();
        return content;
    };

    return {
        //main function to initiate the module
        init: function () {
            handleSetting();
        }
    };
}();

// Charts Daily
// ---------------------------------------------------------------------------
var Charts = function() {
	var formatDate = function( date ) {
		return moment( date ).format( 'DD-MMM-YY' );
	};

	var handleChartUser = function() {
		var elm = 'chart-user';
		var chart = $( '#' + elm ).find( '.data' ).text();

		if ( ! chart )
			return;

		chart = $.parseJSON( chart );
		if ( ! chart.data )
            return;

		var data = chart.data;
		var xkey = chart.xkey;
		var ykeys = chart.ykeys;
		var labels = chart.labels;

		new Morris.Bar({
            // ID of the element in which to draw the chart.
            element: elm,
            // Chart data records -- each entry in this array corresponds to a point on the chart.
            data: data,
            // The name of the data record attribute that contains x-values.
            xkey: xkey,
            // A list of names of data record attributes that contain y-values.
            ykeys: ykeys,
            // Labels for the ykeys -- will be displayed when you hover over the chart.
            labels: labels,
            xLabels: 'day',
            // custom options
            hideHover: 'auto',
            xLabelAngle: 30,
            xLabelFormat: function( date ) {
            return formatDate( date );
            },
            dateFormat: function( date ) {
            return formatDate( date );
            },
            resize: true
		});
	};

	return {
		init: function() {
			handleChartUser();
		}
	};
}();
