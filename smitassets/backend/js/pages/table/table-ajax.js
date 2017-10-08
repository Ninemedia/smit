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
        gridTable( $("#user_list"), true, [ -1, 1, 0 ], true, $('#btn_list_user') );
    };

    // -------------------------------------------------------------------------
    // PRAINCUBATION
    // -------------------------------------------------------------------------
    // Pra Incubation Selection Lists
    var handleRecordsPraIncubationSelectionList = function() {
        gridTable( $("#praincubation_list"), true, [ -1, 1, 0 ], true, $('#btn_resetpraincubation_list') );
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
        gridTable( $("#praincubationreport_list"), true, [ -1, 1, 0 ], true, $('#btn_resetadmin_stepone') );
    };
    var handleRecordsPraIncubationReportList = function() {
        gridTable( $("#list_praincubationreport"), true, [ -1, 1, 0 ], true, $('#btn_praincubation_listreset') );
    };
    
    // Tenant Report Lists
    var handleRecordsTenantReportList = function() {
        gridTable( $("#list_tenantreport"), true, [ -1, 1, 0 ], true, $('#btn_tenant_listreset') );
    };
    var handleRecordsActionPlanTenantReportList = function() {
        gridTable( $("#list_actionplantenantreport"), true, [ -1, 1, 0 ], true, $('#btn_actionplantenant_listreset') );
    };

    // Admin Selection Lists Step One
    var handleRecordsAdminStepOneList = function() {
        gridTable( $("#admin_stepone"), true, [ -1, 1, 0 ], true, $('#btn_resetadmin_stepone') );
    };

    // Admin Selection Lists Step Two
    var handleRecordsAdminStepTwoList = function() {
        gridTable( $("#admin_steptwo"), true, [ -1, 1, 0 ], true, $('#btn_resetadmin_steptwo') );
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
        gridTable( $("#praincubationhistory_list"), true, [ -1, 1, 0 ], true, $('#btn_list_historyreset') );
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
        gridTable( $("#incubation_list"), true, [ -1, 1, 0 ], true, $('#btn_incubation_list') );
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
        gridTable( $("#list_ikm"), true, [ -1, 1, 0 ], true, $('#btn_list_ikmreset') );
    };

    var handleRecordsIKMScoreList = function() {
        gridTable( $("#list_ikmscore"), true );
    };

    var handleRecordsIKMDataList = function() {
        gridTable( $("#list_ikmdata"), true, [ -1, 1, 0 ], true, $('#btn_list_ikmdatareset') );
    };
    
    // -------------------------------------------------------------------------
    // PAYMENT
    // -------------------------------------------------------------------------
    // Payment List Admin
    var handleRecordsPaymentTenantList = function() {
        gridTable( $("#payment_list"), true, [ -1, 1, 0 ], true, $('#btn_payment_listreset') );
    };

    // -------------------------------------------------------------------------
    // NEWS
    // -------------------------------------------------------------------------
    // News List Admin
    var handleRecordsNewsList = function() {
        gridTable( $("#news_list"), true, [ -1, 1, 0 ], true, $('#btn_news_listreset') );
    };

    // -------------------------------------------------------------------------
    // SERVICES
    // -------------------------------------------------------------------------
    // List Communication
    var handleRecordsListIn = function() {
        gridTable( $("#communication_listin"), true, [ -1, 1, 0 ], true, $('#btn_communication_listinreset') );
    };

    var handleRecordsListOut = function() {
        gridTable( $("#communication_listout"), true, [ -1, 1, 0 ], true, $('#btn_list_ikmdatareset') );
    };
    
    // -------------------------------------------------------------------------
    // PENDAMPINGAN
    // -------------------------------------------------------------------------
    // List Notulensi Pra-Inkubasi
    var handleRecordsListNotulensiPraincubation = function() {
        gridTable( $("#list_notespraincubation"), true, [ -1, 1, 0 ], true, $('#btn_notespra_listreset') );
    };
    // List Notulensi Inkubasi
    var handleRecordsListNotulensiIncubation = function() {
        gridTable( $("#list_notesincubation"), true, [ -1, 1, 0 ], true, $('#btn_notesinc_listreset') );
    };

    // -------------------------------------------------------------------------
    
    // -------------------------------------------------------------------------
    // TENANT BLOGS
    // -------------------------------------------------------------------------
    // Blogs Tenant List
    var handleRecordsBlogTenant = function() {
        gridTable( $("#blogtenant_list"), true, [ -1, 1, 0 ], true, $('#btn_blogtenant_listreset') );
    };
    
    // -------------------------------------------------------------------------
    // TENANT
    // -------------------------------------------------------------------------
    // Incubation Selection Lists
    var handleRecordsTenantList = function() {
        gridTable( $("#list_tenant"), true, [ -1, 1, 0 ], true, $('#btn_tenant_listreset') );
    };
    
    var handleRecordsTenantTeamList = function() {
        gridTable( $("#list_tenant_team"), true, [ -1, 1, 0, 4 ], true, $('#btn_list_tenant_team_reset') );
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
        gridTable( $("#workunit_list"), true, [ -1, 1, 0 ], true, $('#btn_workunit_listreset') );
    };

    // Category Lists
    var handleRecordsCategoryList = function() {
        gridTable( $("#category_list"), true, [ -1, 1, 0 ], true, $('#btn_category_listreset') );
    };
    
    // Category Product Lists
    var handleRecordsCategoryProductList = function() {
        gridTable( $("#category_productlist"), true, [ -1, 1, 0 ], true, $('#btn_category_productlistreset') );
    };

    // Product Lists
    var handleRecordsProductList = function() {
        gridTable( $("#product_list"), true, [ -1, 1, 0 ], true, $('#btn_product_listreset') );
    };

    // Slider Lists
    var handleRecordsSliderList = function() {
        gridTable( $("#slider_list"), true, [ -1, 1, 0 ], true, $('#btn_slider_listreset') );
    };

    // General Message Lists
    var handleRecordsGeneralMessageList = function() {
        gridTable( $("#generalmessage_list"), true, [ -1, 1, 0 ], true, $('#btn_list_messagereset') );
    };

    // Announcement Lists
    var handleRecordsAnnouncementList = function() {
        gridTable( $("#announcement_list"), true, [ -1, 1, 0 ], true, $('#btn_list_announcementreset') );
    };

    // Announcement User Lists
    var handleRecordsAnnouncementUserList = function() {
        gridTable( $("#announcementuser_list"), true );
    };

    var gridTable = function(el, action=false, target='', process=false, listbtn='' ) {
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
                "iDisplayLength": 50,                               // default record count per page
                "bServerSide": true,                                // server side processing
                "sAjaxSource": url,                                 // ajax source
                "aoColumnDefs": [
		          { 'bSortable': false, 'aTargets': tgt }
		       ]
            }
        });

        if( action == true ){
            gridExport( grid, '.table-export-excel', 'export_excel' );
            gridExport( grid, '.table-export-pdf', 'export_pdf' );
        }
        
        if( process == true ){
            gridProcess( grid, listbtn );
        }
    }

    var gridExport = function( dataTable, selectorBtn, sAction ) {
    	// handle group actionsubmit button click
        dataTable.getTableWrapper().on('click', selectorBtn, function(e) {
            e.preventDefault();

            if ( typeof sAction == 'undefined' )
            	sAction = 'export_excel';

            dataTable.addAjaxParam( "sAction", sAction );
            dataTable.getDataTable().fnDraw();
            dataTable.clearAjaxParams();
        });
    };
    
    var gridProcess = function( dataTable, selectorBtn ){
        // handle group actionsubmit button click
        dataTable.getTableWrapper().on('click', '.table-group-action-submit', function(e){
            e.preventDefault();
            
            var processVal = $('select.table-group-action-input option:selected', dataTable.getTableWrapper()).val();
            var processTxt = $('select.table-group-action-input option:selected', dataTable.getTableWrapper()).text().toUpperCase();
            
            if( processVal == "" ){
                swal('Silahkan pilih proses');
            }else{
                bootbox.confirm("Anda yakin akan melakukan proses "+processTxt+" data terpilih?", function(result) {
                    if( result == true ){
                        var action = $(".table-group-action-input", dataTable.getTableWrapper());
                        if (action.val() != "" && dataTable.getSelectedRowsCount() > 0) {
                            dataTable.addAjaxParam("sAction", "group_action");
                            dataTable.addAjaxParam("sGroupActionName", action.val());
                            var records = dataTable.getSelectedRows();
                            for (var i in records) {
                                dataTable.addAjaxParam(records[i]["name"], records[i]["value"]);    
                            }
                            dataTable.getDataTable().fnDraw();
                            dataTable.clearAjaxParams();
                        } else if (action.val() == "") {
                            App.alert({type: 'danger', icon: 'warning', message: 'Silahkan pilih proses', container: dataTable.getTableWrapper(), place: 'prepend'});
                        } else if (dataTable.getSelectedRowsCount() === 0) {
                            App.alert({type: 'danger', icon: 'warning', message: 'Tidak ada data terpilih untuk di proses', container: dataTable.getTableWrapper(), place: 'prepend'});
                        }
                        
                        selectorBtn.trigger('click');
                        $('#select_all').prop('checked', false);
                        $('select.table-group-action-input').attr('disabled','disabled');
                        $('button.table-group-action-submit').attr('disabled','disabled');
                    }
                });
            }
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
            handleRecordsTenantTeamList();
            handleRecordsTenantSelectionList();
            handleRecordsTenantAccompanimentList();
            handleRecordsTenantAcceptedList();
            handleRecordsBlogTenant();
            handleRecordsTenantReportList();
            handleRecordsActionPlanTenantReportList();

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
            
            //Payment
            handleRecordsPaymentTenantList();
        }
    };

}();
