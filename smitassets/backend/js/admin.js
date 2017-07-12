if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

$.AdminBSB = {};
$.AdminBSB.options = {
    colors: {
        red: '#F44336',
        pink: '#E91E63',
        purple: '#9C27B0',
        deepPurple: '#673AB7',
        indigo: '#3F51B5',
        blue: '#2196F3',
        lightBlue: '#03A9F4',
        cyan: '#00BCD4',
        teal: '#009688',
        green: '#4CAF50',
        lightGreen: '#8BC34A',
        lime: '#CDDC39',
        yellow: '#ffe821',
        amber: '#FFC107',
        orange: '#FF9800',
        deepOrange: '#FF5722',
        brown: '#795548',
        grey: '#9E9E9E',
        blueGrey: '#607D8B',
        black: '#000000',
        white: '#ffffff'
    },
    leftSideBar: {
        scrollColor: 'rgba(0,0,0,0.5)',
        scrollWidth: '4px',
        scrollAlwaysVisible: false,
        scrollBorderRadius: '0',
        scrollRailBorderRadius: '0'
    },
    dropdownMenu: {
        effectIn: 'fadeIn',
        effectOut: 'fadeOut'
    }
}

/* Left Sidebar - Function =================================================================================================
*  You can manage the left sidebar menu options
*  
*/
$.AdminBSB.leftSideBar = {
    activate: function () {
        var _this = this;
        var $body = $('body');
        var $overlay = $('.overlay');

        //Close sidebar
        $(window).click(function (e) {
            var $target = $(e.target);
            if (e.target.nodeName.toLowerCase() === 'i') { $target = $(e.target).parent(); }

            if (!$target.hasClass('bars') && _this.isOpen() && $target.parents('#leftsidebar').length === 0) {
                if (!$target.hasClass('js-right-sidebar')) $overlay.fadeOut();
                $body.removeClass('overlay-open');
            }
        });

        $.each($('.menu-toggle.toggled'), function (i, val) {
            $(val).next().slideToggle(0);
        });

        //When page load
        $.each($('.menu .list li.active'), function (i, val) {
            var $activeAnchors = $(val).find('a:eq(0)');

            $activeAnchors.addClass('toggled');
            $activeAnchors.next().show();
        });

        //Collapse or Expand Menu
        $('.menu-toggle').on('click', function (e) {
            var $this = $(this);
            var $content = $this.next();

            if ($($this.parents('ul')[0]).hasClass('list')) {
                var $not = $(e.target).hasClass('menu-toggle') ? e.target : $(e.target).parents('.menu-toggle');

                $.each($('.menu-toggle.toggled').not($not).next(), function (i, val) {
                    if ($(val).is(':visible')) {
                        $(val).prev().toggleClass('toggled');
                        $(val).slideUp();
                    }
                });
            }

            $this.toggleClass('toggled');
            $content.slideToggle(320);
        });

        //Set menu height
        _this.setMenuHeight();
        _this.checkStatuForResize(true);
        $(window).resize(function () {
            _this.setMenuHeight();
            _this.checkStatuForResize(false);
        });

        //Set Waves
        Waves.attach('.menu .list a', ['waves-block']);
        Waves.init();
    },
    setMenuHeight: function () {
        if (typeof $.fn.slimScroll != 'undefined') {
            var configs = $.AdminBSB.options.leftSideBar;
            var height = ($(window).height() - ($('.legal').outerHeight() + $('.user-info').outerHeight() + $('.navbar').innerHeight()));
            var $el = $('.list');

            $el.slimScroll({ destroy: true }).height("auto");
            $el.parent().find('.slimScrollBar, .slimScrollRail').remove();

            $el.slimscroll({
                height: height + "px",
                color: configs.scrollColor,
                size: configs.scrollWidth,
                alwaysVisible: configs.scrollAlwaysVisible,
                borderRadius: configs.scrollBorderRadius,
                railBorderRadius: configs.scrollRailBorderRadius
            });
        }
    },
    checkStatuForResize: function (firstTime) {
        var $body = $('body');
        var $openCloseBar = $('.navbar .navbar-header .bars');
        var width = $body.width();

        if (firstTime) {
            $body.find('.content, .sidebar').addClass('no-animate').delay(1000).queue(function () {
                $(this).removeClass('no-animate').dequeue();
            });
        }

        if (width < 1170) {
            $body.addClass('ls-closed');
            $openCloseBar.fadeIn();
        }
        else {
            $body.removeClass('ls-closed');
            $openCloseBar.fadeOut();
        }
    },
    isOpen: function () {
        return $('body').hasClass('overlay-open');
    }
};
//==========================================================================================================================

/* Right Sidebar - Function ================================================================================================
*  You can manage the right sidebar menu options
*  
*/
$.AdminBSB.rightSideBar = {
    activate: function () {
        var _this = this;
        var $sidebar = $('#rightsidebar');
        var $overlay = $('.overlay');

        //Close sidebar
        $(window).click(function (e) {
            var $target = $(e.target);
            if (e.target.nodeName.toLowerCase() === 'i') { $target = $(e.target).parent(); }

            if (!$target.hasClass('js-right-sidebar') && _this.isOpen() && $target.parents('#rightsidebar').length === 0) {
                if (!$target.hasClass('bars')) $overlay.fadeOut();
                $sidebar.removeClass('open');
            }
        });

        $('.js-right-sidebar').on('click', function () {
            $sidebar.toggleClass('open');
            if (_this.isOpen()) { $overlay.fadeIn(); } else { $overlay.fadeOut(); }
        });
    },
    isOpen: function () {
        return $('.right-sidebar').hasClass('open');
    }
}
//==========================================================================================================================

/* Searchbar - Function ================================================================================================
*  You can manage the search bar
*  
*/
var $searchBar = $('.search-bar');
$.AdminBSB.search = {
    activate: function () {
        var _this = this;

        //Search button click event
        $('.js-search').on('click', function () {
            _this.showSearchBar();
        });

        //Close search click event
        $searchBar.find('.close-search').on('click', function () {
            _this.hideSearchBar();
        });

        //ESC key on pressed
        $searchBar.find('input[type="text"]').on('keyup', function (e) {
            if (e.keyCode == 27) {
                _this.hideSearchBar();
            }
        });
    },
    showSearchBar: function () {
        $searchBar.addClass('open');
        $searchBar.find('input[type="text"]').focus();
    },
    hideSearchBar: function () {
        $searchBar.removeClass('open');
        $searchBar.find('input[type="text"]').val('');
    }
}
//==========================================================================================================================

/* Navbar - Function =======================================================================================================
*  You can manage the navbar
*  
*/
$.AdminBSB.navbar = {
    activate: function () {
        var $body = $('body');
        var $overlay = $('.overlay');

        //Open left sidebar panel
        $('.bars').on('click', function () {
            $body.toggleClass('overlay-open');
            if ($body.hasClass('overlay-open')) { $overlay.fadeIn(); } else { $overlay.fadeOut(); }
        });

        //Close collapse bar on click event
        $('.nav [data-close="true"]').on('click', function () {
            var isVisible = $('.navbar-toggle').is(':visible');
            var $navbarCollapse = $('.navbar-collapse');

            if (isVisible) {
                $navbarCollapse.slideUp(function () {
                    $navbarCollapse.removeClass('in').removeAttr('style');
                });
            }
        });
    }
}
//==========================================================================================================================

/* Input - Function ========================================================================================================
*  You can manage the inputs(also textareas) with name of class 'form-control'
*  
*/
$.AdminBSB.input = {
    activate: function () {
        //On focus event
        $('.form-control').focus(function () {
            $(this).parent().addClass('focused');
        });

        //On focusout event
        $('.form-control').focusout(function () {
            var $this = $(this);
            if ($this.parents('.form-group').hasClass('form-float')) {
                if ($this.val() == '') { $this.parents('.form-line').removeClass('focused'); }
            }
            else {
                $this.parents('.form-line').removeClass('focused');
            }
        });

        //On label click
        $('body').on('click', '.form-float .form-line .form-label', function () {
            $(this).parent().find('input').focus();
        });
    }
}
//==========================================================================================================================

/* Form - Select - Function ================================================================================================
*  You can manage the 'select' of form elements
*  
*/
$.AdminBSB.select = {
    activate: function () {
        if ($.fn.selectpicker) { $('select:not(.ms,.def)').selectpicker(); }
    }
}
//==========================================================================================================================

/* DropdownMenu - Function =================================================================================================
*  You can manage the dropdown menu
*  
*/

$.AdminBSB.dropdownMenu = {
    activate: function () {
        var _this = this;

        $('.dropdown, .dropup, .btn-group').on({
            "show.bs.dropdown": function () {
                var dropdown = _this.dropdownEffect(this);
                _this.dropdownEffectStart(dropdown, dropdown.effectIn);
            },
            "shown.bs.dropdown": function () {
                var dropdown = _this.dropdownEffect(this);
                if (dropdown.effectIn && dropdown.effectOut) {
                    _this.dropdownEffectEnd(dropdown, function () { });
                }
            },
            "hide.bs.dropdown": function (e) {
                var dropdown = _this.dropdownEffect(this);
                if (dropdown.effectOut) {
                    e.preventDefault();
                    _this.dropdownEffectStart(dropdown, dropdown.effectOut);
                    _this.dropdownEffectEnd(dropdown, function () {
                        dropdown.dropdown.removeClass('open');
                    });
                }
            }
        });

        //Set Waves
        Waves.attach('.dropdown-menu li a', ['waves-block']);
        Waves.init();
    },
    dropdownEffect: function (target) {
        var effectIn = $.AdminBSB.options.dropdownMenu.effectIn, effectOut = $.AdminBSB.options.dropdownMenu.effectOut;
        var dropdown = $(target), dropdownMenu = $('.dropdown-menu', target);

        if (dropdown.size() > 0) {
            var udEffectIn = dropdown.data('effect-in');
            var udEffectOut = dropdown.data('effect-out');
            if (udEffectIn !== undefined) { effectIn = udEffectIn; }
            if (udEffectOut !== undefined) { effectOut = udEffectOut; }
        }

        return {
            target: target,
            dropdown: dropdown,
            dropdownMenu: dropdownMenu,
            effectIn: effectIn,
            effectOut: effectOut
        };
    },
    dropdownEffectStart: function (data, effectToStart) {
        if (effectToStart) {
            data.dropdown.addClass('dropdown-animating');
            data.dropdownMenu.addClass('animated dropdown-animated');
            data.dropdownMenu.addClass(effectToStart);
        }
    },
    dropdownEffectEnd: function (data, callback) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        data.dropdown.one(animationEnd, function () {
            data.dropdown.removeClass('dropdown-animating');
            data.dropdownMenu.removeClass('animated dropdown-animated');
            data.dropdownMenu.removeClass(data.effectIn);
            data.dropdownMenu.removeClass(data.effectOut);

            if (typeof callback == 'function') {
                callback();
            }
        });
    }
}
//==========================================================================================================================

/* Browser - Function ======================================================================================================
*  You can manage browser
*  
*/
var edge = 'Microsoft Edge';
var ie10 = 'Internet Explorer 10';
var ie11 = 'Internet Explorer 11';
var opera = 'Opera';
var firefox = 'Mozilla Firefox';
var chrome = 'Google Chrome';
var safari = 'Safari';

$.AdminBSB.browser = {
    activate: function () {
        var _this = this;
        var className = _this.getClassName();

        if (className !== '') $('html').addClass(_this.getClassName());
    },
    getBrowser: function () {
        var userAgent = navigator.userAgent.toLowerCase();

        if (/edge/i.test(userAgent)) {
            return edge;
        } else if (/rv:11/i.test(userAgent)) {
            return ie11;
        } else if (/msie 10/i.test(userAgent)) {
            return ie10;
        } else if (/opr/i.test(userAgent)) {
            return opera;
        } else if (/chrome/i.test(userAgent)) {
            return chrome;
        } else if (/firefox/i.test(userAgent)) {
            return firefox;
        } else if (!!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/)) {
            return safari;
        }

        return undefined;
    },
    getClassName: function () {
        var browser = this.getBrowser();

        if (browser === edge) {
            return 'edge';
        } else if (browser === ie11) {
            return 'ie11';
        } else if (browser === ie10) {
            return 'ie10';
        } else if (browser === opera) {
            return 'opera';
        } else if (browser === chrome) {
            return 'chrome';
        } else if (browser === firefox) {
            return 'firefox';
        } else if (browser === safari) {
            return 'safari';
        } else {
            return '';
        }
    }
}
//==========================================================================================================================

$(function () {
    $.AdminBSB.browser.activate();
    $.AdminBSB.leftSideBar.activate();
    $.AdminBSB.rightSideBar.activate();
    $.AdminBSB.navbar.activate();
    $.AdminBSB.dropdownMenu.activate();
    $.AdminBSB.input.activate();
    $.AdminBSB.select.activate();
    $.AdminBSB.search.activate();

    setTimeout(function () { $('.page-loader-wrapper').fadeOut(); }, 50);
});

// App General Function
// ---------------------------------------------------------------------------
var App = function() {
    var isRTL = false;
    
    var handleInit = function () {
        if ($('body').css('direction') === 'rtl') {
            isRTL = true;
        }
    }
    
    // Handles custom checkboxes & radios using jQuery Uniform plugin
    var handleUniform = function () {
        if (!jQuery().uniform) {
            return;
        }
        var test = $("input[type=checkbox]:not(.toggle, .make-switch), input[type=radio]:not(.toggle, .star, .make-switch)");
        if (test.size() > 0) {
            test.each(function () {
                if ($(this).parents(".checker").size() == 0) {
                    $(this).show();
                    $(this).uniform();
                }
            });
        }
    };
    
    var handleAddAnnouncement = function() {
        // Save Announcement
        $('body').on('click', '#btn_addannouncement_reset', function(event){
			event.preventDefault();
            var url = $(this).attr('href');
            var table_container = $('#announcementuser_list').parents('.dataTables_wrapper');
            var el = $('#save_announcement');
            
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
                        el.fadeIn();
                    }
                }
            });
        }); 
        
        $('#do_save_announcement').click(function(e){
            e.preventDefault();
            processSaveAnnouncement($('#announcementadd'));
        });
        
        var processSaveAnnouncement = function( form ) {
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
                        
                        $('#announcementadd')[0].reset();
                        $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
                        $('#selection_files').fileinput('refresh', {
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
                        });
                    }
    			}
    		});
        };
        
        // Reset Announcement Form
        $('body').on('click', '#btn_addannouncement_reset', function(event){
			event.preventDefault();
            var frm         = $(this).data('form');
            var msg         = $('#alert');
            
            $(msg).hide().empty();
            $('.form-group').removeClass('has-error');
            $('#reg_title').val('');
            $('#reg_desc').val('');
            $('#selection_files').fileinput('refresh', {
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
            });
            $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
        });
    };
    
    var handleAddNews = function() {
        // Save News
        $('#do_save_news').click(function(e){
            e.preventDefault();
            processSaveNews($('#newsadd'));
        });
        
        var processSaveNews = function( form ) {
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
                        
                        $('#newsadd')[0].reset();
                        $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
                        $('#news_selection_files').fileinput('refresh', {
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
                        });
                        $('#btn_news_listreset').trigger('click');
                        $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
                    }
    			}
    		});
        };
        
        // Reset News Form
        $('body').on('click', '#btn_newsadd_reset', function(event){
			event.preventDefault();
            var frm         = $(this).data('form');
            var msg         = $('#alert');
            
            $(msg).hide().empty();
            $('.form-group').removeClass('has-error');
            $('#reg_title').val('');
            $('#reg_source').val('');
            $('#reg_desc').val('');
            $('#news_selection_files').fileinput('refresh', {
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
            });
            $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
        });
    };
    
    var handleAddIKM = function() {
        // Save IKM
        $('#do_save_ikmadd').click(function(e){
            e.preventDefault();
            processSaveAddIKM($('#ikmadd'));
        });
        
        var processSaveAddIKM = function( form ) {
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
                        
                        $('#ikmadd')[0].reset();
                        $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
                        $('#btn_list_ikm').trigger('click');
                        $('#btn_list_ikmreset').trigger('click');
                    }
    			}
    		});
        };
        
        // Reset News Form
        $('body').on('click', '#btn_ikmadd_reset', function(event){
			event.preventDefault();
            var frm         = $(this).data('form');
            var msg         = $('#alert');
            
            $(msg).hide().empty();
            $('.form-group').removeClass('has-error');
            $('#reg_question').val('');
            $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
        });
    };
    
    var handleAddPraincubation = function() {
        // Save Praincubation
        $('#do_save_praincubationadd').click(function(e){
            e.preventDefault();
            processSavePraincubationAdd($('#praincubationadd'));
        });
        
        var processSavePraincubationAdd = function( form ) {
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
                        
                        $('#praincubationadd')[0].reset();
                        $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
                        $('#reg_selection_files').fileinput('refresh', {
                            showUpload : false,
                            showUploadedThumbs : false,
                            'theme': 'explorer',
                            'uploadUrl': '#',
                            fileType: "any",
                            overwriteInitial: false,
                            initialPreviewAsData: true,
                            allowedFileExtensions: ['doo', 'docx', 'pdf'],
                            fileActionSettings : {
                                showUpload: false,
                                showZoom: false,
                            },
                            maxFileSize: 2048,
                        });
                        $('#reg_selection_rab').fileinput('refresh', {
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
                        });
                    }
    			}
    		});
        };
        
        // Reset News Form
        $('body').on('click', '#btn_praincubationadd_reset', function(event){
			event.preventDefault();
            var frm         = $(this).data('form');
            var msg         = $('#alert');
            
            $(msg).hide().empty();
            $('.form-group').removeClass('has-error');
            $('#reg_title').val('');
            $('#reg_name').val('');
            $('#reg_desc').val('');
            $('#reg_year').val('');
            $('#reg_category').val('');
            $('#praincubationadd')[0].reset();
            $('#reg_selection_files').fileinput('refresh', {
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
            });
            $('#reg_selection_rab').fileinput('refresh', {
                showUpload : false,
                showUploadedThumbs : false,
                'theme': 'explorer',
                'uploadUrl': '#',
                fileType: "any",
                overwriteInitial: false,
                initialPreviewAsData: true,
                allowedFileExtensions: ['xls', 'xls'],
                fileActionSettings : {
                    showUpload: false,
                    showZoom: false,
                },
                maxFileSize: 2048,
            });
            $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
        });
    };
    
    var handleAddProductPraincubation = function() {
        // Save Praincubation
        $('#do_save_productadd').click(function(e){
            e.preventDefault();
            processSaveProductPraincubationAdd($('#productadd'));
        });
        
        var processSaveProductPraincubationAdd = function( form ) {
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
                        
                        $('#productadd')[0].reset();
                        $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
                        $('#reg_thumbnail').fileinput('refresh', {
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
                            maxFileSize: 2048,
                        });
                        $('#reg_details').fileinput('refresh', {
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
                            maxFileSize: 2048,
                        });
                    }
    			}
    		});
        };
        
        // Reset News Form
        $('body').on('click', '#btn_productadd_reset', function(event){
			event.preventDefault();
            var frm         = $(this).data('form');
            var msg         = $('#alert');
            
            $(msg).hide().empty();
            $('.form-group').removeClass('has-error');
            $('#reg_event').val('');
            $('#reg_desc').val('');
            $('#reg_title').val('');
            $('#reg_thumbnail').fileinput('refresh', {
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
                maxFileSize: 2048,
            });
            $('#reg_details').fileinput('refresh', {
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
                maxFileSize: 2048,
            });
            $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
        });
    };
    
    var handleAddIncubation = function() {
        // Save Incubation
        $('#do_save_incubationadd').click(function(e){
            e.preventDefault();
            processSaveIncubationAdd($('#incubationadd'));
        });
        
        var processSaveIncubationAdd = function( form ) {
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
                        
                        $('#incubationadd')[0].reset();
                        $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
                        $('#reg_selection_files').fileinput('refresh', {
                            showUpload : false,
                            showUploadedThumbs : false,
                            'theme': 'explorer',
                            'uploadUrl': '#',
                            fileType: "any",
                            overwriteInitial: false,
                            initialPreviewAsData: true,
                            allowedFileExtensions: ['doo', 'docx', 'pdf'],
                            fileActionSettings : {
                                showUpload: false,
                                showZoom: false,
                            },
                            maxFileSize: 2048,
                        });
                        $('#reg_selection_rab').fileinput('refresh', {
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
                        });
                    }
    			}
    		});
        };
        
        // Reset News Form
        $('body').on('click', '#btn_incubationadd_reset', function(event){
			event.preventDefault();
            var frm         = $(this).data('form');
            var msg         = $('#alert');
            
            $(msg).hide().empty();
            $('.form-group').removeClass('has-error');
            $('#reg_title').val('');
            $('#reg_name').val('');
            $('#reg_desc').val('');
            $('#reg_year').val('');
            $('#reg_category').val('');
            $('#incubationadd')[0].reset();
            $('#reg_selection_files').fileinput('refresh', {
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
            });
            $('#reg_selection_rab').fileinput('refresh', {
                showUpload : false,
                showUploadedThumbs : false,
                'theme': 'explorer',
                'uploadUrl': '#',
                fileType: "any",
                overwriteInitial: false,
                initialPreviewAsData: true,
                allowedFileExtensions: ['xls', 'xls'],
                fileActionSettings : {
                    showUpload: false,
                    showZoom: false,
                },
                maxFileSize: 2048,
            });
            $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
        });
    };
    
    var handleAddServices = function() {
        // Save Communication
        $('#do_save_cmm').click(function(e){
            e.preventDefault();
            processSaveCmm($('#cmm_form'));
        });
        
        var processSaveCmm = function( form ) {
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
                        
                        $('#cmm_form')[0].reset();
                        $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
                    }
    			}
    		});
        };
        
        // Reset News Form
        $('body').on('click', '#btn_cmmadd_reset', function(event){
			event.preventDefault();
            var frm         = $(this).data('form');
            var msg         = $('#alert');
            
            $(msg).hide().empty();
            $('.form-group').removeClass('has-error');
            $('#cmm_title').val('');
            $('#cmm_description').val('');
            $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
        });
    };
    
    var handleAddSlider = function() {
        // Save Slider
        $('#do_save_slider').click(function(e){
            e.preventDefault();
            processSaveSlider($('#slideradd'));
        });
        
        var processSaveSlider = function( form ) {
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
                        
                        $('#slideradd')[0].reset();
                        $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
                        $('#slider_selection_files').fileinput('refresh', {
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
                        });
                    }
    			}
    		});
        };
        
        // Reset Slider Form
        $('body').on('click', '#btn_slideradd_reset', function(event){
			event.preventDefault();
            var frm         = $(this).data('form');
            var msg         = $('#alert');
            
            $(msg).hide().empty();
            $('.form-group').removeClass('has-error');
            $('#reg_title').val('');
            $('#reg_desc').val('');
            $('#slider_selection_files').fileinput('refresh', {
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
            });
            $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
        });
    };
    
    var handleAddWorkunit = function() {
        // Save Workunit
        $('#do_save_workunit').click(function(e){
            e.preventDefault();
            processSaveWorkunit($('#workunitadd'));
        });
        
        var processSaveWorkunit = function( form ) {
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
                    
                    if(response.msg == 'error'){
                        msg.html(response.data.msg);
                        msg.removeClass('alert-success').addClass('alert-danger').fadeIn('fast').delay(3000).fadeOut();
                    }else{
                        msg.html(response.data.msgsuccess);
                        msg.removeClass('alert-danger').addClass('alert-success').fadeIn('fast').delay(3000).fadeOut();
                        
                        $('#workunitadd')[0].reset();
                        $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
                    }
                    $('#btn_workunit_list').trigger('click');
    			}
    		});
        };
        
        // Reset Workunit Form
        $('body').on('click', '#btn_workunit_reset', function(event){
			event.preventDefault();
            var frm         = $(this).data('form');
            var msg         = $('#alert');
            
            $(msg).hide().empty();
            $('.form-group').removeClass('has-error');
            $('#reg_workunit').val('');
            $('#workunitadd')[0].reset();
            $('html, body').animate( { scrollTop: $('body').offset().top }, 500 );
        });
    };
    
    var handleEditWorkunit = function() {
        // Save Workunit
        $('#do_edit_workunit').click(function(e){
            e.preventDefault();
            processEditWorkunit($('#workunitedit'));
        });
        
        var processEditWorkunit = function( form ) {
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
                        
                        $('#workunitedit')[0].reset();
                        $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
                    }
    			}
    		});
        };
    };
    
    var handleAddCategory = function() {
        // Save Category
        $('#do_save_category').click(function(e){
            e.preventDefault();
            processSaveCategory($('#categoryadd'));
        });
        
        var processSaveCategory = function( form ) {
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
                        
                        $('#categoryadd')[0].reset();
                        $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
                    }
    			}
    		});
        };
        
        // Reset Category Form
        $('body').on('click', '#btn_category_reset', function(event){
			event.preventDefault();
            var frm         = $(this).data('form');
            var msg         = $('#alert');
            
            $(msg).hide().empty();
            $('.form-group').removeClass('has-error');
            $('#reg_category').val('');
            $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
        });
    };
    
    var handleAddNotes = function() {
        // Save Notes
        $('#do_save_notesadd').click(function(e){
            e.preventDefault();
            processSaveNotesAdd($('#notesadd'));
        });
        
        var processSaveNotesAdd = function( form ) {
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
                        
                        $('#notesadd')[0].reset();
                        $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
                        $('#reg_selection_files').fileinput('refresh', {
                            showUpload : false,
                            showUploadedThumbs : false,
                            'theme': 'explorer',
                            'uploadUrl': '#',
                            fileType: "any",
                            overwriteInitial: false,
                            initialPreviewAsData: true,
                            allowedFileExtensions: ['doo', 'docx', 'pdf'],
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
        $('body').on('click', '#btn_notesadd_reset', function(event){
			event.preventDefault();
            var frm         = $(this).data('form');
            var msg         = $('#alert');
            
            $(msg).hide().empty();
            $('.form-group').removeClass('has-error');
            $('#reg_title').val('');
            $('#reg_name').val('');
            $('#reg_desc').val('');
            $('#notesadd')[0].reset();
            $('#reg_selection_files').fileinput('refresh', {
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
            });
            $('#btn_notesreset_list').trigger('click');
            $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
        });
    };
    
    
    return {
		init: function() {
            // Input your handle function here
            // Add
            handleInit();
            handleAddAnnouncement();
            handleAddWorkunit();
            handleAddCategory();
            handleAddNews();
            handleAddSlider();
            handleAddServices();
            handleAddPraincubation();
            handleAddProductPraincubation();
            handleAddIncubation();
            handleAddIKM();
            handleAddNotes();
            
            // Edit 
            handleEditWorkunit
		},
        
        // wrapper function to scroll(focus) to an element
        scrollTo: function (el, offeset) {
            var pos = (el && el.size() > 0) ? el.offset().top : 0;

            if (el) {
                if ($('body').hasClass('hold-transition')) {
                    pos = pos - $('.header').height(); 
                }            
                pos = pos + (offeset ? offeset : -1 * el.height());
            }

            jQuery('html,body').animate({
                scrollTop: pos
            }, 'slow');
        },

        // function to scroll to the top
        scrollTop: function () {
            scrollTo();
        },
        
        // check RTL mode
        isRTL: function () {
            return isRTL;
        },
        
        getUniqueID: function(prefix) {
            return 'prefix_' + Math.floor(Math.random() * (new Date()).getTime());
        },
        
        alert: function(options) {

            options = $.extend(true, {
                container: "", // alerts parent container(by default placed after the page breadcrumbs)
                place: "append", // append or prepent in container 
                type: 'success',  // alert's type
                message: "",  // alert's message
                close: true, // make alert closable
                reset: true, // close all previouse alerts first
                focus: true, // auto scroll to the alert after shown
                closeInSeconds: 0, // auto close after defined seconds
                icon: "" // put icon before the message
            }, options);

            var id = App.getUniqueID("app_alert");

            var html = '<div id="'+id+'" class="app-alerts alert alert-'+options.type+' fade in">' + 
            	(options.close ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="material-icons">close</i></button>' : '' ) + 
        		(options.icon != "" ? '' : '') + options.message+'</div>';

            if (options.reset) {
                $('.app-alerts').remove();
            }

            if (!options.container) {
                $('.page-breadcrumb').after(html);
            } else {
                if (options.place == "append") {
                    $(options.container).append(html);
                } else {
                    $(options.container).prepend(html);
                }
            }

            if (options.focus) {
                App.scrollTo( $('#' + id).parent().parent().parent().parent().parent() );
            }

            if (options.closeInSeconds > 0) {
                setTimeout(function(){
                    $('#' + id).remove();
                }, options.closeInSeconds * 1000);
            }
        },
        
        // initializes uniform elements
        initUniform: function (els) {
            if (els) {
                jQuery(els).each(function () {
                    if ($(this).parents(".checker").size() == 0) {
                        $(this).show();
                        $(this).uniform();
                    }
                });
            } else {
                handleUniform();
            }
        },

        //wrapper function to update/sync jquery uniform checkbox & radios
        updateUniform: function (els) {
            $.uniform.update(els); // update the uniform checkbox & radios UI after the actual input control state changed
        },
	};
}();