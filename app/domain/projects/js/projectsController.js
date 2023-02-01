tiggomark.projectsController = (function () {

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
                dateFormat:  tiggomark.i18n.__("language.jsdateformat"),
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

    var initProjectTabs = function () {
        jQuery('.projectTabs').tabs();
    };

    var initDuplicateProjectModal = function () {

        var regularModelConfig = {
            sizes: {
                minW: 450,
                minH: 350
            },
            resizable: true,
            autoSizable: true,
            callbacks: {
                afterShowCont: function () {
                    jQuery(".showDialogOnLoad").show();
                    initDates();
                    jQuery(".duplicateProjectModal, .formModal").nyroModal(regularModelConfig);
                },
                beforeClose: function () {
                    location.reload();
                }
            }
        };

        jQuery(".duplicateProjectModal").nyroModal(regularModelConfig);

    };

    var initProgressBar = function (percentage) {

        jQuery("#progressbar").progressbar({
            value: percentage
        });

    };

    var initProjectsEditor = function () {



    };

    var initProjectTable = function () {

        jQuery(document).ready(function () {

            var size = 100;

            var allProjects = jQuery("#allProjectsTable").DataTable({
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

    var initTodoStatusSortable = function (element) {
        var sortCounter = 1;

        jQuery(element).find("input.sorter").each(function (index) {

            jQuery(this).val(sortCounter);
            sortCounter++;
        });

        jQuery(element).sortable({
            stop: function ( event, ui ) {

                sortCounter = 1;
                jQuery(element).find("input.sorter").each(function (index) {
                    jQuery(this).val(sortCounter);
                    sortCounter++;
                });
            }
        });

    };

    var initSelectFields = function () {

        jQuery(document).ready(function () {

            jQuery("#todosettings select.colorChosen").on('chosen:ready', function (e, chosen) {

                var id = jQuery(this).attr('id').replace("-", "_");

                jQuery("#" + id + "_chzn a span").removeClass();
                jQuery("#" + id + "_chzn a span").addClass(params.selected);

            }).chosen({
                disable_search_threshold: 10
            });

            jQuery("#todosettings select.colorChosen").on('change', function (evt, params) {

                var id = jQuery(this).attr('id').replace("-", "_");

                jQuery("#" + id + "_chzn a span").removeClass();
                jQuery("#" + id + "_chzn a span").addClass(params.selected);

            });
        });
    };

    var removeStatus = function (id) {

        jQuery("#todostatus-" + id).parent().remove();

    };

    var addToDoStatus = function (id) {

        var highestKey = -1;

        jQuery("#todosettings ul .statusList").each(function () {

            var keyInt = jQuery(this).find('.labelKey').val();

            if (keyInt >= highestKey) {
                highestKey = keyInt;
            }

        });

        var newKey = parseInt(highestKey) + 1;

        var statusCopy = jQuery(".newStatusTpl").clone();

        statusCopy.html(function (i, oldHTML) {
            return updatedContent = oldHTML.replaceAll('XXNEWKEYXX', newKey);
        });

        jQuery('#todoStatusList').append("<li>" + statusCopy.html() + "</li>");

        jQuery("#todosettings select.colorChosen").chosen("destroy");
        tiggomark.projectsController.initSelectFields();
        jQuery("#todoStatusList").sortable("destroy");
        tiggomark.projectsController.initTodoStatusSortable("#todoStatusList");

    };

    // Make public what you want to have public, everything else is private
    return {
        initDates:initDates,
        initProjectTabs:initProjectTabs,
        initProgressBar:initProgressBar,
        initProjectTable:initProjectTable,
        initProjectsEditor:initProjectsEditor,
        initDuplicateProjectModal:initDuplicateProjectModal,
        initTodoStatusSortable:initTodoStatusSortable,
        initSelectFields:initSelectFields,
        removeStatus:removeStatus,
        addToDoStatus:addToDoStatus
    };
})();
