var TableAjax = function () {

    // Init Date Pickers
    var initPickers = function () {
        //Datetimepicker plugin
        $('.date-picker').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            clearButton: true,
            weekStart: 1,
            time: false
        });
    };

    // Users Lists
    var handleRecordsUserList = function() {
        //gridTable( $("#user_list"), true, [ -1, 1, 0 ] );
        
        var url     = $("#user_list").data('url');
        var grid    = new Datatable();

        grid.init({
            src: $("#user_list"),
            onSuccess: function(grid) {},
            onError: function(grid) {},
            dataTable: {
                "aLengthMenu": [
                    [10, 20, 50, 100, -1],
                    [10, 20, 50, 100, "All"]                        // change per page values here
                ],
                "iDisplayLength": 10,                               // default record count per page
                "bServerSide": true,                                // server side processing
                "sAjaxSource": url,                                 // ajax source
                "aoColumnDefs": [
		          { 'bSortable': false, 'aTargets': [ -1, 1, 0 ] }
		       ]
            }
        });
        
        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function(e){
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.addAjaxParam("sAction", "group_action");
                grid.addAjaxParam("sGroupActionName", action.val());
                var records = grid.getSelectedRows();
                for (var i in records) {
                    grid.addAjaxParam(records[i]["name"], records[i]["value"]);    
                }
                grid.getDataTable().fnDraw();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({type: 'danger', icon: 'warning', message: 'Silahkan pilih proses', container: grid.getTableWrapper(), place: 'prepend'});
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({type: 'danger', icon: 'warning', message: 'Tidak ada data terpilih untuk di proses', container: grid.getTableWrapper(), place: 'prepend'});
            }
            
            $('#btn_list_user').trigger('click');
        });
    };

    // -------------------------------------------------------------------------
    // PRAINCUBATION
    // -------------------------------------------------------------------------
    // Pra Incubation Selection Lists
    var handleRecordsPraIncubationSelectionList = function() {
        gridTable( $("#praincubation_list"), true );
    };

    var handleRecordsPraIncubationSelectionList2 = function() {
        gridTable( $("#praincubation_list2"), true );
    };

    var handleRecordsPraIncubationList = function() {
        gridTable( $("#list_praincubation"), true );
    };

    // Pra Incubation Selection Setting Lists
    var handleRecordsPraIncubationSettingSelectionList = function() {
        gridTable( $("#praincubation_setting_list"), true );
    };

    // Pra Incubation Selection Report Lists
    var handleRecordsPraIncubationReportSelectionList = function() {
        gridTable( $("#praincubationreport_list"), true );
    };
    var handleRecordsPraIncubationReportList = function() {
        gridTable( $("#list_praincubationreport"), true );
    };


    // Admin Selection Lists Step One
    var handleRecordsAdminStepOneList = function() {
        gridTable( $("#admin_stepone"), true );
    };

    // Admin Selection Lists Step Two
    var handleRecordsAdminStepTwoList = function() {
        gridTable( $("#admin_steptwo"), true );
    };

    // Admin Score Lists Step One
    var handleRecordsAdminScoreStepOneList = function() {
        gridTable( $("#adminscore_stepone"), true );
    };

    // Admin Score Lists Step Two
    var handleRecordsAdminScoreStepTwoList = function() {
        gridTable( $("#adminscore_steptwo"), true );
    };

    // Juri History List Pra-Inkubasi
    var handleRecordsJuryHistoryList = function() {
        gridTable( $("#praincubationhistory_list"), true );
    };
    // Juri History List Inkubasi
    var handleRecordsJuryHistoryIncubationList = function() {
        gridTable( $("#incubationhistory_list"), true );
    };

    // Pra Incubation Accompaniment Lists
    var handleRecordsPraIncubationAccompanimentList = function() {
        gridTable( $("#accompaniment_list"), true );
    };

    // Pra Incubation Accepted Lists
    var handleRecordsPraIncubationAcceptedList = function() {
        gridTable( $("#acceptedselection_list"), true );
    };

    // -------------------------------------------------------------------------

    // -------------------------------------------------------------------------
    // INCUBATION
    // -------------------------------------------------------------------------
    // Incubation Selection Lists
    var handleRecordsIncubationSelectionList    = function() {
        gridTable( $("#incubation_list"), true );
    };

    var handleRecordsIncubationSelectionList2   = function() {
        gridTable( $("#incubation_list2"), true );
    };

    // Incubation Selection Setting Lists
    var handleRecordsIncubationSettingSelectionList = function() {
        gridTable( $("#incubation_setting_list"), true );
    };

    // Incubation Selection Report Lists
    var handleRecordsIncubationReportSelectionList = function() {
        gridTable( $("#incubationreport_list"), true );
    };

    // Incubation Lists
    var handleRecordsIncubationDataList = function() {
        gridTable( $("#list_incubation"), true );
    };

    // Tenant Accompaniment Lists
    var handleRecordsTenantAccompanimentList = function() {
        gridTable( $("#tenantaccompaniment_list"), true );
    };

    // Tenant Accepted Lists
    var handleRecordsTenantAcceptedList = function() {
        gridTable( $("#tenantacceptedselection_list"), true );
    };
    // -------------------------------------------------------------------------

    // -------------------------------------------------------------------------
    // IKM
    // -------------------------------------------------------------------------
    // List IKM
    var handleRecordsIKMList = function() {
        gridTable( $("#list_ikm"), true );
    };

    var handleRecordsIKMScoreList = function() {
        gridTable( $("#list_ikmscore"), true );
    };

    var handleRecordsIKMDataList = function() {
        gridTable( $("#list_ikmdata"), true );
    };

    // -------------------------------------------------------------------------
    // NEWS
    // -------------------------------------------------------------------------
    // News List Admin
    var handleRecordsNewsList = function() {
        gridTable( $("#news_list"), false );
    };

    // -------------------------------------------------------------------------
    // SERVICES
    // -------------------------------------------------------------------------
    // List Communication
    var handleRecordsListIn = function() {
        gridTable( $("#communication_listin"), true );
    };

    var handleRecordsListOut = function() {
        gridTable( $("#communication_listout"), true );
    };
    
    // -------------------------------------------------------------------------
    // PENDAMPINGAN
    // -------------------------------------------------------------------------
    // List Notulensi Pra-Inkubasi
    var handleRecordsListNotulensiPraincubation = function() {
        gridTable( $("#list_notespraincubation"), true );
    };
    // List Notulensi Inkubasi
    var handleRecordsListNotulensiIncubation = function() {
        gridTable( $("#list_notulensiincubation"), true );
    };

    // -------------------------------------------------------------------------

    // -------------------------------------------------------------------------
    // TENANT
    // -------------------------------------------------------------------------
    // Incubation Selection Lists
    var handleRecordsTenantList = function() {
        gridTable( $("#list_tenant"), true );
    };

    // Tenant Selection Lists
    var handleRecordsTenantSelectionList = function() {
        gridTable( $("#tenant_list"), true );
    };
    
    // Tenant Selection Lists
    var handleRecordsGuidesList = function() {
        gridTable( $("#guide_list"), true );
    };

    // Juri Selection Lists Step One
    var handleRecordsJuryStepOneList = function() {
        gridTable( $("#jury_stepone"), true );
    };

    // Juri Selection Lists Step Two
    var handleRecordsJuryStepTwoList = function() {
        gridTable( $("#jury_steptwo"), true );
    };

    // Workunit Lists
    var handleRecordsWorkunitList = function() {
        gridTable( $("#workunit_list"), true );
    };

    // Category Lists
    var handleRecordsCategoryList = function() {
        gridTable( $("#category_list"), true );
    };
    
    // Category Product Lists
    var handleRecordsCategoryProductList = function() {
        gridTable( $("#category_productlist"), true );
    };

    // Product Lists
    var handleRecordsProductList = function() {
        gridTable( $("#product_list"), true );
    };

    // Slider Lists
    var handleRecordsSliderList = function() {
        gridTable( $("#slider_list"), true );
    };

    // General Message Lists
    var handleRecordsGeneralMessageList = function() {
        gridTable( $("#generalmessage_list"), true );
    };

    // Announcement Lists
    var handleRecordsAnnouncementList = function() {
        gridTable( $("#announcement_list"), true );
    };

    // Announcement User Lists
    var handleRecordsAnnouncementUserList = function() {
        gridTable( $("#announcementuser_list"), true );
    };

    var gridTable = function(el, action=false, target='' ) {
        var url     = el.data('url');
        var grid    = new Datatable();
        var tgt     = ( target!="" ? target : [ -1, 0 ] );

        grid.init({
            src: el,
            onSuccess: function(grid) {},
            onError: function(grid) {},
            dataTable: {
                "aLengthMenu": [
                    [10, 20, 50, 100, -1],
                    [10, 20, 50, 100, "All"]                        // change per page values here
                ],
                "iDisplayLength": 10,                               // default record count per page
                "bServerSide": true,                                // server side processing
                "sAjaxSource": url,                                 // ajax source
                "aoColumnDefs": [
		          { 'bSortable': false, 'aTargets': tgt }
		       ]
            }
        });

        if( action == true ){
            gridExport( grid, '.table-export-excel' );
        }
    }

    var gridExport = function( dataTable, selectorBtn, sAction ) {
    	// handle group actionsubmit button click
        dataTable.getTableWrapper().on('click', selectorBtn, function(e) {
            e.preventDefault();

            if ( typeof sAction == 'undefined' )
            	sAction = 'export_excel';

            dataTable.addAjaxParam( "sAction", sAction );
            var table = $( selectorBtn ).closest( '.table-container' ).find( 'table' );

            // get all typeable inputs
            $( 'textarea.form-filter, select.form-filter, input.form-filter:not([type="radio"],[type="checkbox"])', table ).each( function() {
                dataTable.addAjaxParam( $(this).attr("name"), $(this).val() );
            });

            // get all checkable inputs
            $( 'input.form-filter[type="checkbox"]:checked, input.form-filter[type="radio"]:checked', table ).each( function() {
                dataTable.addAjaxParam( $(this).attr("name"), $(this).val() );
            });

            dataTable.getDataTable().fnDraw();
            dataTable.clearAjaxParams();
        });
    };

    return {
        //main function to initiate the module
        init: function () {
            initPickers();
            //User
            handleRecordsUserList();

            //Pra Incubation
            handleRecordsPraIncubationSelectionList();
            handleRecordsPraIncubationSelectionList2();
            handleRecordsPraIncubationSettingSelectionList();
            handleRecordsPraIncubationReportSelectionList();
            handleRecordsPraIncubationReportList();
            handleRecordsAdminStepOneList();
            handleRecordsAdminStepTwoList();
            handleRecordsAdminScoreStepOneList();
            handleRecordsAdminScoreStepTwoList();
            handleRecordsJuryHistoryList();
            handleRecordsPraIncubationAccompanimentList();
            handleRecordsPraIncubationAcceptedList();
            handleRecordsPraIncubationList();

            //Incubation
            handleRecordsIncubationSelectionList();
            handleRecordsIncubationSelectionList2();
            handleRecordsIncubationSettingSelectionList();
            handleRecordsIncubationReportSelectionList();
            handleRecordsIncubationDataList();

            //Tenant
            handleRecordsTenantList();
            handleRecordsTenantSelectionList();
            handleRecordsTenantAccompanimentList();
            handleRecordsTenantAcceptedList();

            //Jury
            handleRecordsJuryStepOneList();
            handleRecordsJuryStepTwoList();
            handleRecordsJuryHistoryIncubationList();

            //Product
            handleRecordsProductList();

            //Workunit
            handleRecordsWorkunitList();

            //Category
            handleRecordsCategoryList();

            //Announcement
            handleRecordsAnnouncementList();
            handleRecordsAnnouncementUserList();

            //Guide
            handleRecordsGuidesList();

            //IKM
            handleRecordsIKMList();
            handleRecordsIKMScoreList();
            handleRecordsIKMDataList();

            //News
            handleRecordsNewsList();
            
            //Pendampingan
            handleRecordsListNotulensiPraincubation();
            handleRecordsListNotulensiIncubation();
            
            //Slider
            handleRecordsSliderList();

            //Service
            //Communication
            handleRecordsListIn();
            handleRecordsListOut();
            
            //General Message
            handleRecordsGeneralMessageList();
            
            //Category Product
            handleRecordsCategoryProductList();
        }
    };

}();
