tiggomark.clientsController = (function () {

    //Variables


    //Constructor
    (function () {
        jQuery(document).ready(
            function () {

            }
        );

    })();

    //Functions

    var initDates = function () {

        jQuery(".projectDateFrom, .projectDateTo").datepicker(
            {
                dateFormat:  tiggomark.i18n.__("language.dateformat"),
                dayNames: tiggomark.i18n.__("language.dayNames").split(","),
                dayNamesMin:  tiggomark.i18n.__("language.dayNamesMin").split(","),
                dayNamesShort: tiggomark.i18n.__("language.dayNamesShort").split(","),
                monthNames: tiggomark.i18n.__("language.monthNames").split(","),
                currentText: tiggomark.i18n.__("language.currentText"),
                closeText: tiggomark.i18n.__("language.closeText"),
                buttonText: tiggomark.i18n.__("language.buttonText"),
                isRTL: JSON.parse(tiggomark.i18n.__("language.isRTL")),
                nextText: tiggomark.i18n.__("language.nextText"),
                prevText: tiggomark.i18n.__("language.prevText"),
                weekHeader: tiggomark.i18n.__("language.weekHeader"),
            }
        );
    };

    var initClientTabs = function () {
        jQuery('.clientTabs').tabs();
    };

    var initClientTable = function () {

        jQuery(document).ready(function () {

            var size = 100;

            var allProjects = jQuery("#allClientsTable").DataTable({
                "language": {
                    "decimal":        tiggomark.i18n.__("datatables.decimal"),
                    "emptyTable":     tiggomark.i18n.__("datatables.emptyTable"),
                    "info":           tiggomark.i18n.__("datatables.info"),
                    "infoEmpty":      tiggomark.i18n.__("datatables.infoEmpty"),
                    "infoFiltered":   tiggomark.i18n.__("datatables.infoFiltered"),
                    "infoPostFix":    tiggomark.i18n.__("datatables.infoPostFix"),
                    "thousands":      tiggomark.i18n.__("datatables.thousands"),
                    "lengthMenu":     tiggomark.i18n.__("datatables.lengthMenu"),
                    "loadingRecords": tiggomark.i18n.__("datatables.loadingRecords"),
                    "processing":     tiggomark.i18n.__("datatables.processing"),
                    "search":         tiggomark.i18n.__("datatables.search"),
                    "zeroRecords":    tiggomark.i18n.__("datatables.zeroRecords"),
                    "paginate": {
                        "first":      tiggomark.i18n.__("datatables.first"),
                        "last":       tiggomark.i18n.__("datatables.last"),
                        "next":       tiggomark.i18n.__("datatables.next"),
                        "previous":   tiggomark.i18n.__("datatables.previous"),
                    },
                    "aria": {
                        "sortAscending":  tiggomark.i18n.__("datatables.sortAscending"),
                        "sortDescending":tiggomark.i18n.__("datatables.sortDescending"),
                    }

                },
                "dom": '<"top">rt<"bottom"ilp><"clear">',
                "searching": false,
                "displayLength":100
            });

        });

    };

    // Make public what you want to have public, everything else is private
    return {
        initDates:initDates,
        initClientTabs:initClientTabs,
        initClientTable:initClientTable
    };
})();
