/*-------------------------------------------------------------------------
 * RENDIFY - Custom jQuery Scripts
 * ------------------------------------------------------------------------

    1. Plugins Init
    2. Site Specific Functions
    3. Shortcodes
    4. Other Need Scripts (Plugins config, themes and etc)
	
-------------------------------------------------------------------------*/
"use strict";

jQuery(document).ready(function($){

    /*------------------------------------------------------------------------*/
    /*	1.	Plugins Init
    /*------------------------------------------------------------------------*/

	/************** Single Page Nav Plugin *********************/
    /*
	$('.menu').singlePageNav(
		{filter: ':not(.external)'}
	);
    */

	/************** LightBox *********************/
    /*
	$(function(){
		$('[data-rel="lightbox"]').lightbox();
	});
    */

    /*------------------------------------------------------------------------*/
    /*	2.	Site Specific Functions
    /*------------------------------------------------------------------------*/

	/************** Go Top *********************/
	$('#go-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, 800);
        return false;
    });

    /************** Responsive Navigation *********************/
	$('.toggle-menu').click(function(){
        $('.menu').stop(true,true).toggle();
        return false;
    });
    $(".responsive-menu .menu a").click(function(){
        $('.responsive-menu .menu').hide();
    });
});

/*
var Selection = function () {
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
        });
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handleUploadFiles();
        }
    };
}();
*/

var Guides = function () {
    var handleUploadFilesEvent = function(){
        $("#selection_files").fileinput({
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
    };
    
    var handleUploadFilesRAB = function(){ 
        $("#rab_selection_files").fileinput({
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
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handleUploadFilesEvent();
            handleUploadFilesRAB();
        }
    };
}();

var BannerZoomInout = function () {
    var handleBannerZoomInout = function(){ 
        $('#main-slider-banner-zoom-inout').bannerscollection_zoominout({
			skin: 'opportune',
			responsive:true,
            width100Proc:true,
			width: 1077,
			height: 320,
			circleRadius:8,
			circleLineWidth:4,
			circleColor: "#ffffff", //849ef3
			circleAlpha: 50,
			behindCircleColor: "#000000",
			behindCircleAlpha: 20,
			xshowBottomNav:false,
			thumbsWrapperMarginTop:30
		});	
    }
    
    return {
        //main function to initiate the module
        init: function () {
            handleBannerZoomInout();
        }
    };
}();

/*
var IKM = function () {
    handleIKMCheck = function(){

            $ikm_list               = $this->Model_Service->get_all_ikmlist();
            $i  = 1; 
            foreach($ikm_list AS $row){  

        $("input.answer_").click(function() {
            if ($(this).is(":checked")) {
                var group = "input:radio[name='" + $(this).attr("name") + "']";
                $(group).prop("checked", false);
                $(this).prop("checked", true);
            } else {
                $(this).prop("checked", false);
            }
        });

        $i++; }
    }
    
    return {
        //main function to initiate the module
        init: function () {
            handleIKMCheck();
        }
    };
}();
*/

var ContactForm = function () {

    var getCaptchaResponse = function() {
		return grecaptcha.getResponse( widgetCaptcha );
	};
    
    var showCaptchaContact = function() {
        // here we render the captcha
		var container = $( '.smit-captcha-contact' )[0];
		var parameters = {
			"sitekey": $( container ).data( 'smit-site-key' )
		};
		
		widgetCaptcha = grecaptcha.render(
			container,
			parameters
		);
	};
    
    return {
        // main function to initiate the module
        init: function () {
            
        },
        loadCaptcha: function() {
			showCaptchaContact();
		},
    };
}();

// Charts Daily
// ---------------------------------------------------------------------------
var Charts = function() {
	var formatDate = function( date ) {
		return moment( date ).format( 'MMM YY' );
	};

    var handleChartTabIKM = function() {
        // Chart IKM Init
        var elmIKM = 'chart-ikm-monthly';
		var chartIKMData = $( '#' + elmIKM ).find( '.data-ikm-monthly' ).text();

		if ( ! chartIKMData )
			return;

		chartIKMData = $.parseJSON( chartIKMData );
		if ( ! chartIKMData.data )
            return;

		var dataI = chartIKMData.data;
		var xkeyI = chartIKMData.xkey;
		var ykeysI = chartIKMData.ykeys;
		var labelsI = chartIKMData.labels;

		var chartIKM = Morris.Bar({
            // ID of the element in which to draw the chart.
            element: elmIKM,
            // Chart data records -- each entry in this array corresponds to a point on the chart.
            data: dataI,
            // The name of the data record attribute that contains x-values.
            xkey: xkeyI,
            // A list of names of data record attributes that contain y-values.
            ykeys: ykeysI,
            // Labels for the ykeys -- will be displayed when you hover over the chart.
            labels: labelsI,
            xLabels: 'year',
            // custom options
            hideHover: 'auto',
            xLabelAngle: 0,
            resize: true
		});

        // Chart Question Init
        var elmQuest = 'chart-question';
		var chartQuestData = $( '#' + elmQuest ).find( '.data-question' ).text();

		if ( ! chartQuestData )
			return;

		chartQuestData = $.parseJSON( chartQuestData );
		if ( ! chartQuestData.data )
            return;

		var dataQ = chartQuestData.data;
		var xkeyQ = chartQuestData.xkey;
		var ykeysQ = chartQuestData.ykeys;
		var labelsQ = chartQuestData.labels;

		var chartQuestion = Morris.Bar({
            // ID of the element in which to draw the chart.
            element: elmQuest,
            // Chart data records -- each entry in this array corresponds to a point on the chart.
            data: dataQ,
            // The name of the data record attribute that contains x-values.
            xkey: xkeyQ,
            // A list of names of data record attributes that contain y-values.
            ykeys: ykeysQ,
            // Labels for the ykeys -- will be displayed when you hover over the chart.
            labels: labelsQ,
            xLabels: 'year',
            // custom options
            hideHover: 'auto',
            xLabelAngle: 0,
            resize: true
		});

        $('a.tab_chart_ikm').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr("href") // activated tab

            switch (target) {
                case "#monthly":
                    chartIKM.redraw();
                    $(window).trigger('resize');
                    break;
                case "#yearly":
                    chartQuestion.redraw();
                    $(window).trigger('resize');
                    break;
            }
        });
    };
    
    var handleChartPraIncubation = function() {
        // Chart Year Init
        var elm = 'chart-praincubation-yearly';
		var chart = $( '#' + elm ).find( '.data-praincubation-yearly' ).text();

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
            xLabels: 'year',
            // custom options
            hideHover: 'auto',
            xLabelAngle: 0,
            resize: true
		});
    };
    
    var handleChartTabIncubation = function() {
        // Chart Month Init
        var elmMonth = 'chart-incubation-monthly';
		var chartMonthData = $( '#' + elmMonth ).find( '.data-incubation-monthly' ).text();

		if ( ! chartMonthData )
			return;

		chartMonthData = $.parseJSON( chartMonthData );
		if ( ! chartMonthData.data )
            return;

		var dataM = chartMonthData.data;
		var xkeyM = chartMonthData.xkey;
		var ykeysM = chartMonthData.ykeys;
		var labelsM = chartMonthData.labels;

		var chartMonth = Morris.Bar({
            // ID of the element in which to draw the chart.
            element: elmMonth,
            // Chart data records -- each entry in this array corresponds to a point on the chart.
            data: dataM,
            // The name of the data record attribute that contains x-values.
            xkey: xkeyM,
            // A list of names of data record attributes that contain y-values.
            ykeys: ykeysM,
            // Labels for the ykeys -- will be displayed when you hover over the chart.
            labels: labelsM,
            xLabels: 'month',
            // custom options
            hideHover: 'auto',
            xLabelAngle: 0,
            resize: true
		});

        // Chart Year Init
        var elmYear = 'chart-incubation-yearly';
		var chartYearData = $( '#' + elmYear ).find( '.data-incubation-yearly' ).text();

		if ( ! chartYearData )
			return;

		chartYearData = $.parseJSON( chartYearData );
		if ( ! chartYearData.data )
            return;

		var dataY = chartYearData.data;
		var xkeyY = chartYearData.xkey;
		var ykeysY = chartYearData.ykeys;
		var labelsY = chartYearData.labels;

		var chartYear = Morris.Bar({
            // ID of the element in which to draw the chart.
            element: elmYear,
            // Chart data records -- each entry in this array corresponds to a point on the chart.
            data: dataY,
            // The name of the data record attribute that contains x-values.
            xkey: xkeyY,
            // A list of names of data record attributes that contain y-values.
            ykeys: ykeysY,
            // Labels for the ykeys -- will be displayed when you hover over the chart.
            labels: labelsY,
            xLabels: 'year',
            // custom options
            hideHover: 'auto',
            xLabelAngle: 0,
            resize: true
		});

        $('a.tab_chart_incubation').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr("href") // activated tab

            switch (target) {
                case "#monthly":
                    chartMonth.redraw();
                    $(window).trigger('resize');
                    break;
                case "#yearly":
                    chartYear.redraw();
                    $(window).trigger('resize');
                    break;
            }
        });
        
        $('.collapse').on('shown.bs.collapse', function(e) {
            var id = $(e.target).attr('id');
            
            switch (id) {
                case "collapse_incubation":
                    chartMonth.redraw();
                    $(window).trigger('resize');
                    break;
                case "#yearly":
                    chartYear.redraw();
                    $(window).trigger('resize');
                    break;
            }
        });
    };

	return {
		init: function() {
            handleChartTabIKM();
            handleChartPraIncubation();
            handleChartTabIncubation();
		}
	};
}();

// Search Engine
// ---------------------------------------------------------------------------
var SearchEngine = function() {
    var handleSearchEngine = function() {
        $(  '#search_news_paginate,' +
            '#search_blogtenant_paginate,' + 
            '#search_announcement_paginate,' + 
            '#search_praincubationlist_paginate,' + 
            '#search_praincubationproduct_paginate,' + 
            '#search_incubationproduct_paginate,' + 
            '#search_tenantlist_paginate,' + 
            '#search_guides_paginate').mbPagination({
        	showFirstLast: true,
            prevText: 'Prev',
            nextText: 'Next',
            firstText: 'First',
            lastText: 'Last',
        	perPage: $(this).data('perpage'),
        });
    };

    return {
		init: function() {
            handleSearchEngine();
		}
	};
}();


