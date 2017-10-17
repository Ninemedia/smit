;(function () {
	
	'use strict';

	var mobileMenuOutsideClick = function() {

		$(document).click(function (e) {
	    var container = $("#gtco-offcanvas, .js-gtco-nav-toggle");
	    if (!container.is(e.target) && container.has(e.target).length === 0) {
	    	$('.js-gtco-nav-toggle').addClass('gtco-nav-white');

	    	if ( $('body').hasClass('offcanvas') ) {

    			$('body').removeClass('offcanvas');
    			$('.js-gtco-nav-toggle').removeClass('active');
				
	    	}
	    
	    	
	    }
		});

	};
	var offcanvasMenu = function() {

		$('#mobile-nav').prepend('<div id="gtco-offcanvas" />');
		$('#mobile-nav').prepend('<a href="javascript:;" class="js-gtco-nav-toggle gtco-nav-toggle gtco-nav-white"><i></i></a>');
		var clone1 = $('.menu-1 > ul').clone();
		$('#gtco-offcanvas').append(clone1);
		var clone2 = $('.menu-2 > ul').clone();
		$('#gtco-offcanvas').append(clone2);

		$('#gtco-offcanvas .has-dropdown').addClass('offcanvas-has-dropdown');
		$('#gtco-offcanvas')
			.find('li')
			.removeClass('has-dropdown');

		// Hover dropdown menu on mobile
		$('.offcanvas-has-dropdown').click(function(){
			var $this = $(this);
            
            if( $this.hasClass('active') ){
                $this
    				.removeClass('active')
    				.find('ul')
    				.slideUp(500, 'easeOutExpo');
            }else{
                $this
    				.addClass('active')
    				.find('ul')
    				.slideDown(500, 'easeOutExpo');	
            }			
		});

		$(window).resize(function(){

			if ( $('body').hasClass('offcanvas') ) {
    			$('body').removeClass('offcanvas');
    			$('.js-gtco-nav-toggle').removeClass('active');
                $('.offcanvas-has-dropdown').removeClass('active');
                $('ul.dropdown').hide();
                $('#gtco-offcanvas').hide();
	    	}
		});
	};


	var burgerMenu = function() {

		$('body').on('click', '.js-gtco-nav-toggle', function(event){
			var $this = $(this);

			if ( $('body').hasClass('overflow offcanvas') ) {
				$('body').removeClass('overflow offcanvas');
                $('#gtco-offcanvas').slideUp(500,'easeOutExpo');
			} else {
				$('body').addClass('overflow offcanvas');
                $('#gtco-offcanvas').slideDown(500,'easeOutExpo');
			}
			$this.toggleClass('active');

			event.preventDefault();

		});
	};



	var contentWayPoint = function() {
		var i = 0;

		// $('.gtco-section').waypoint( function( direction ) {


			$('.animate-box').waypoint( function( direction ) {

				if( direction === 'down' && !$(this.element).hasClass('animated-fast') ) {
					
					i++;

					$(this.element).addClass('item-animate');
					setTimeout(function(){

						$('body .animate-box.item-animate').each(function(k){
							var el = $(this);
							setTimeout( function () {
								var effect = el.data('animate-effect');
								if ( effect === 'fadeIn') {
									el.addClass('fadeIn animated-fast');
								} else if ( effect === 'fadeInLeft') {
									el.addClass('fadeInLeft animated-fast');
								} else if ( effect === 'fadeInRight') {
									el.addClass('fadeInRight animated-fast');
								} else {
									el.addClass('fadeInUp animated-fast');
								}

								el.removeClass('item-animate');
							},  k * 200, 'easeInOutExpo' );
						});
						
					}, 100);
					
				}

			} , { offset: '85%' } );
		// }, { offset: '90%'} );
	};


	var dropdown = function() {

		$('.has-dropdown').mouseenter(function(){

			var $this = $(this);
			$this
				.find('.dropdown')
				.css('display', 'block')
				.addClass('animated-fast fadeInUpMenu');

		}).mouseleave(function(){
			var $this = $(this);

			$this
				.find('.dropdown')
				.css('display', 'none')
				.removeClass('animated-fast fadeInUpMenu');
		});

	};


	var owlCarousel = function(){
		
		var owl = $('.owl-carousel-carousel');
		owl.owlCarousel({
			items: 6,
			loop: true,
			margin: 10,
			nav: true,
			dots: true,
			smartSpeed: 800,
			autoHeight: true,
			navText: [
		      "<i class='ti-arrow-left owl-direction'></i>",
		      "<i class='ti-arrow-right owl-direction'></i>"
	     	],
	     	responsive:{
    	        0:{
    	            items:1
    	        },
                480:{
    	            items:3
    	        },
    	        600:{
    	            items:3
    	        },
                768:{
    	            items:3
    	        },
                800:{
    	            items:3
    	        },
    	        1000:{
    	            items:6
    	        }
	    	}
		});
        
        var owl = $('.owl-carousel-footer');
		owl.owlCarousel({
			items: 6,
			loop: true,
			margin: 25,
			nav: true,
			dots: false,
			smartSpeed: 800,
			autoHeight: true,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
			navText: [
		      "<i class='ti-arrow-left owl-direction'></i>",
		      "<i class='ti-arrow-right owl-direction'></i>"
	     	],
	     	responsive:{
    	        0:{
    	            items:1
    	        },
                320:{
    	            items:2
    	        },
                480:{
    	            items:3
    	        },
    	        600:{
    	            items:4
    	        },
                768:{
    	            items:4
    	        },
                800:{
    	            items:4
    	        },
    	        1000:{
    	            items:6
    	        }
	    	}
		});

		var owl = $('.owl-carousel-fullwidth');
		owl.owlCarousel({
			items: 1,
			loop: true,
			margin: 20,
			nav: true,
			dots: true,
			smartSpeed: 800,
			autoHeight: true,
			navText: [
		      "<i class='ti-arrow-left owl-direction'></i>",
		      "<i class='ti-arrow-right owl-direction'></i>"
	     	]
		});
	};

	var tabs = function() {

		// Auto adjust height
		$('.gtco-tab-content-wrap').css('height', 0);
		var autoHeight = function() {

			setTimeout(function(){

				var tabContentWrap = $('.gtco-tab-content-wrap'),
					tabHeight = $('.gtco-tab-nav').outerHeight(),
					formActiveHeight = $('.tab-content.active').outerHeight(),
					totalHeight = parseInt(tabHeight + formActiveHeight + 90);

					tabContentWrap.css('height', totalHeight );

				$(window).resize(function(){
					var tabContentWrap = $('.gtco-tab-content-wrap'),
						tabHeight = $('.gtco-tab-nav').outerHeight(),
						formActiveHeight = $('.tab-content.active').outerHeight(),
						totalHeight = parseInt(tabHeight + formActiveHeight + 90);

						tabContentWrap.css('height', totalHeight );
				});

			}, 100);
			
		};

		autoHeight();


		// Click tab menu
		$('.gtco-tab-nav a').on('click', function(event){
			
			var $this = $(this),
				tab = $this.data('tab');

			$('.tab-content')
				.addClass('animated-fast fadeOutDown');

			$('.tab-content')
				.removeClass('active');

			$('.gtco-tab-nav li').removeClass('active');
			
			$this
				.closest('li')
					.addClass('active')

			$this
				.closest('.gtco-tabs')
					.find('.tab-content[data-tab-content="'+tab+'"]')
					.removeClass('animated-fast fadeOutDown')
					.addClass('animated-fast active fadeIn');


			autoHeight();
			event.preventDefault();

		}); 
	};


	var goToTop = function() {

		$('.js-gotop').on('click', function(event){
			
			event.preventDefault();

			$('html, body').animate({
				scrollTop: $('html').offset().top
			}, 500, 'easeInOutExpo');
			
			return false;
		});

		$(window).scroll(function(){

			var $win = $(window);
			if ($win.scrollTop() > 200) {
				$('.js-top').addClass('active');
			} else {
				$('.js-top').removeClass('active');
			}

		});
	
	};


	// Loading page
	var loaderPage = function() {
		$(".gtco-loader").fadeOut("slow");
	};

	var counter = function() {
		$('.js-counter').countTo({
			 formatter: function (value, options) {
	      return value.toFixed(options.decimals);
	    },
		});
	};

	var counterWayPoint = function() {
		if ($('#gtco-counter').length > 0 ) {
			$('#gtco-counter').waypoint( function( direction ) {
										
				if( direction === 'down' && !$(this.element).hasClass('animated') ) {
					setTimeout( counter , 400);					
					$(this.element).addClass('animated');
				}
			} , { offset: '90%' } );
		}
	};
    
    var closeAlert = function() {
        $('body').on('click', 'button.close', function(event){
			event.preventDefault();
            $(this).parent().fadeOut();
			return false;
		});
    };
    
    // --------------------------------
    // Handle Search Username
    // --------------------------------
    var handleSearchUsername = function() {
        
        // Search Username
        $('#check_username').click(function(){
            return validateUsername( $(this) );
        });
        
        var validateUsername = function( element ) {
            var username    = $('#reg_username').val();
            var password    = $('#reg_password').val();
            var year        = $('#reg_year').val();
            var url         = element.data('url');
            var sel         = element.data('selection');
            var el          = $('#username_info');
            var eldet       = $('#detail_selection');
            var elacc       = $('#account_selection');
            var btn_add     = $('#btn_addincubation');
            var msg         = $('#alert');
            
            $.ajax({
                type:   "POST",
                data:   {
                    'username' : username,
                    'password' : password,
                    'year'     : year,
                    'selection': sel,
                },
                url:    url,
                beforeSend: function (){
                    $("div.page-loader-wrapper").fadeIn();
                },
                success: function( response ){
                    $("div.page-loader-wrapper").fadeOut();
                    
                    response = $.parseJSON(response);
                    $(msg).hide().empty();
                    $(el).hide().empty();
                    
                    if(response.message == '' || response.message == 'error'){
                        msg.html(response.info);
                        msg.removeClass('alert-success').addClass('alert-danger').fadeIn('fast');
                        $(el).hide();
                        $(eldet).hide();
                        $('html, body').animate( { scrollTop: $('#selectionpraincubation').offset().top - 100 }, 500 );
                    }else if(response.message == "success"){
                        msg.html(response.info);
                        msg.removeClass('alert-danger').addClass('alert-success').fadeIn('fast');
                        $(el).html(response.data).fadeIn('fast');
                        $(eldet).show();
                        $(elacc).hide();
                    }else{
                        msg.fadeOut('fast');
                        $(el).hide();
                        $(eldet).hide();
                        $(elacc).show();
                    }
                }
            });
            return false;
        };        
    };
    
    var handleAddSelectionIncubation = function() {
        // Save Registered Member
        $('#do_save_selectionincubation').click(function(e){
            e.preventDefault();
            processSaveSelectionIncubation($('#selectionincubation'));
        });
        
        var processSaveSelectionIncubation = function( form ) {
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
                    
                    if(response.message == 'error'){
                        msg.html(response.data);
                        msg.removeClass('alert-success').addClass('alert-danger').fadeIn('fast').delay(3000).fadeOut();
                    }else{
                        $('#save_selectionincubation_success').modal('show');
                        $(msg).empty().hide();
                        
                        $('#selectionincubation')[0].reset();
                        $(".selectpicker, .show-tick").val('').selectpicker('render');
                        $('#selection_files').fileinput('refresh', {
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
                        $('#rab_selection_files').fileinput('refresh', {
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
                        $('#username_info').hide();
                        $('#detail_selection').hide();
                        $('#account_selection').show();
                        
                        $('html, body').animate( { scrollTop: $('body').offset().top + 300 }, 500 );
                    }
    			}
    		});
        };
        
        // Reset Selection Inkubasi Form
        $('body').on('click', '#btn_incubation_reset', function(event){
			event.preventDefault();
            var frm         = $(this).data('form');
            var msg         = $('#alert');
            
            $(msg).hide().empty();
            $('.form-group').removeClass('has-error');
            $('#reg_event_title').val('');
            $('#reg_desc').val('');
            $('#reg_name').val('');
            $('select#reg_category').val('');
            $('select#reg_category').selectpicker('render');
            $('#selection_files').fileinput('refresh', {
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
            $('#rab_selection_files').fileinput('refresh', {
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
            $('html, body').animate( { scrollTop: $('body').offset().top + 600 }, 500 );
        });
    };
    
    var handleAddSelectionPraIncubation = function() {
        // Save Selection Pra-Incubation
        $('#do_save_selectionpraincubation').click(function(e){
            e.preventDefault();
            processSaveSelectionPraIncubation($('#selectionpraincubation'));
        });
        
        var processSaveSelectionPraIncubation = function( form ) {
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

                    if(response.message == 'error'){
                        msg.html(response.data);
                        msg.removeClass('alert-success').addClass('alert-danger').fadeIn('fast').delay(3000).fadeOut();
                    }else{
                        $('#save_selectionpraincubation_success').modal('show');
                        $(msg).empty().hide();
                        
                        $('#selectionpraincubation')[0].reset();
                        $(".selectpicker, .show-tick").val('').selectpicker('render');
                        $('#selection_files').fileinput('refresh', {
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
                        $('#rab_selection_files').fileinput('refresh', {
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
                        $('#username_info').hide();
                        $('#detail_selection').hide();
                        $('#account_selection').show();
                        
                        $('html, body').animate( { scrollTop: $('body').offset().top + 550 }, 500 );
                    }
    			}
    		});
        };
        
        // Reset Selection Inkubasi Form
        $('body').on('click', '#btn_praincubation_reset', function(event){
			event.preventDefault();
            var frm         = $(this).data('form');
            var msg         = $('#alert');
            
            $(msg).hide().empty();
            $('.form-group').removeClass('has-error');
            $('.input-group').find('label.error').hide();
            $('#reg_event_title').val('');
            $('#reg_desc').val('');
            $('#reg_name').val('');
            $('select#reg_category').val('');
            $('select#reg_category').selectpicker('render');
            $('#selection_files').fileinput('refresh', {
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
            $('#rab_selection_files').fileinput('refresh', {
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
            $('#reg_agree').prop('checked', false);
            $('html, body').animate( { scrollTop: $('body').offset().top + 600 }, 500 );
        });
    };

	$(function(){
		mobileMenuOutsideClick();
		offcanvasMenu();
		burgerMenu();
		contentWayPoint();
		dropdown();
		owlCarousel();
		tabs();
		goToTop();
		loaderPage();
		counterWayPoint();
        closeAlert();
        handleSearchUsername();
        handleAddSelectionIncubation();
        handleAddSelectionPraIncubation();
	});

}());