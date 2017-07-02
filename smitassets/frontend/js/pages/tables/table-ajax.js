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

    // Announcement Lists
    var handleRecordsAnnouncementList = function() {
        gridTable( $("#announcement_list"), true );
    };

    // Guide Lists
    var handleRecordsGuideList = function() {
        gridTable( $("#guide_list"), true );
    };

    // Pra Incubation Lists
    var handleRecordsPraIncubationList = function() {
        gridTable( $("#list_praincubation"), true );
    };

    // Tenant Lists
    var handleRecordsTenantList = function() {
        gridTable( $("#list_tenant"), true );
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
                "sAjaxSource": url,       // ajax source
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
            handleRecordsAnnouncementList();
            handleRecordsGuideList();
            handleRecordsPraIncubationList();
            handleRecordsTenantList();
        }
    };

}();
