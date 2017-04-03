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

var Guides = function () {
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

var Selection = function () {
    var handleSelection = function(){
        
    };
    
    return {
        //main function to initiate the module
        init: function () {
            handleSelection();
        }
    };
}();
