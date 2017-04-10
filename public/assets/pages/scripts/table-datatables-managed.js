var TableDatatablesManaged = function () {

    var initTable3 = function () {

        var table = $('#table_impuestos');

        // begin: third table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "Sin datos",
                "info": "MOSTRANDO _START_ A _END_ DE _TOTAL_ CFDI",
                "infoEmpty": "NO SE ENCONTRARON RESULTADOS",
                "infoFiltered": "(FILTRANDO EN _MAX_ CFDI TOTALES)",
                "lengthMenu": "VER _MENU_",
                "search": "BUSCAR:",
                "zeroRecords": "NO SE ENCONTRARON RESULTADOS",
                "paginate": {
                    "previous":"INICIO",
                    "next": "SIGUIENTE",
                    "last": "ÚLTIMA",
                    "first": "PRIMERA"
                }
            },
            
            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
            
            "lengthMenu": [
                [20, 40, 60, -1],
                [20, 40, 60, "TODAS"] // change per page values here
            ],
            // set the initial value
            "pageLength": 20,
            "columnDefs": [{  // set default column settings
                'orderable': true,
                'targets': [7]
            }, {
                "searchable": false,
                "targets": [7]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#table_impuestos_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                } else {
                    $(this).prop("checked", false);
                }
            });
            jQuery.uniform.update(set);
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }
            initTable3();
        }

    };

}();

if (App.isAngularJsApp() === false) { 
    jQuery(document).ready(function() {
        TableDatatablesManaged.init();
    });
}