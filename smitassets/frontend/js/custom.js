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

var IKM = function () {
    handleIKMCheck = function(){
        <?php 
            $ikm_list               = $this->Model_Service->get_all_ikmlist();
            $i  = 1; 
            foreach($ikm_list AS $row){  
        ?>
        $("input.answer_<?php echo $i; ?>").click(function() {
            if ($(this).is(":checked")) {
                var group = "input:radio[name='" + $(this).attr("name") + "']";
                $(group).prop("checked", false);
                $(this).prop("checked", true);
            } else {
                $(this).prop("checked", false);
            }
        });
        <?php $i++; } ?>
    }
    
    return {
        //main function to initiate the module
        init: function () {
            handleIKMCheck();
        }
    };
}();


