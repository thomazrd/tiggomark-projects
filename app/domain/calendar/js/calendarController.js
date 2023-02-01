tiggomark.calendarController = (function () {

    var closeModal = false;

    //Constructor
    (function () {
        jQuery(document).ready(
            function () {

            }
        );

    })();

    //Functions
    var initCalendar = function (userEvents) {

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        var heightWindow = jQuery("body").height() - 260;

        var calendar = jQuery('#calendar').fullCalendar({
            height: heightWindow,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listDay'
            },
            titleFormat: {
                month: 'MMMM yyyy',
                week: "MMM d[ yyyy]{ '&#8212;'[ MMM] d yyyy}",
                day: 'dddd, MMM d, yyyy'
            },
            columnFormat: {
                month: tiggomark.i18n.__("language.columnFormatMonth"),
                week: tiggomark.i18n.__("language.columnFormatWeek"),
                day: tiggomark.i18n.__("language.columnFormatday")
            },
            timeFormat: { // for event elements
                '': tiggomark.i18n.__("language.jstimeformat") // default
            },
            // locale
            isRTL: tiggomark.i18n.__("language.isRTL") == "false" ? 0 : 1,
            firstDay: tiggomark.i18n.__("language.firstDayOfWeek"),
            monthNames: tiggomark.i18n.__("language.monthNames").split(","),
            monthNamesShort: tiggomark.i18n.__("language.monthNamesShort").split(","),
            dayNames: tiggomark.i18n.__("language.dayNames").split(","),
            dayNamesShort: tiggomark.i18n.__("language.dayNamesShort").split(","),
            buttonText: {
                prev: '&laquo;',
                next: '&raquo;',
                prevYear: '&nbsp;&lt;&lt;&nbsp;',
                nextYear: '&nbsp;&gt;&gt;&nbsp;',
                today: tiggomark.i18n.__("buttons.today"),
                month: tiggomark.i18n.__("buttons.month"),
                week: tiggomark.i18n.__("buttons.week"),
                day: tiggomark.i18n.__("buttons.day")
            },
            select: function (start, end, allDay) {
                var title = prompt(tiggomark.i18n.__("label.event_title"));
                if (title) {
                    calendar.fullCalendar(
                        'renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true // make the event "stick"
                    );
                }
                calendar.fullCalendar('unselect');
            },
            events: userEvents,
            eventColor: '#0866c6'
        });
    };

    var initEventDatepickers = function () {

        Date.prototype.addDays = function (days) {
            this.setDate(this.getDate() + days);
            return this;
        };
        jQuery.datepicker.setDefaults(
            { beforeShow: function (i) {
                if (jQuery(i).attr('readonly')) {
                    return false; } } }
        );

        var dateFormat = tiggomark.i18n.__("language.jsdateformat"),

            from = jQuery("#event_date_from")
                .datepicker(
                    {
                        numberOfMonths: 1,
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
                        firstDay: tiggomark.i18n.__("language.firstDayOfWeek"),
                    }
                )
                .on(
                    "change",
                    function () {
                        to.datepicker("option", "minDate", getDate(this));
                    }
                ),

            to = jQuery("#event_date_to").datepicker(
                {
                    numberOfMonths: 1,
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
                    firstDay: tiggomark.i18n.__("language.firstDayOfWeek"),
                }
            )
                .on(
                    "change",
                    function () {
                        from.

                        datepicker("option", "maxDate", getDate(this));
                    }
                );

        function getDate( element )
        {
            var date;
            try {
                date = jQuery.datepicker.parseDate(dateFormat, element.value);
            } catch ( error ) {
                date = null;
                console.log(error);
            }
            return date;
        }
    }

    var initExportModal = function () {

        var exportModalConfig = {
            sizes: {
                minW: 400,
                minH: 350
            },
            resizable: true,
            autoSizable: true,
            callbacks: {
                afterShowCont: function () {

                    jQuery(".formModal").nyroModal(exportModalConfig);
                },
                beforeClose: function () {
                    location.reload();
                }


            },
            titleFromIframe: true
        };
        jQuery(".exportModal").nyroModal(exportModalConfig);

    }


    // Make public what you want to have public, everything else is private
    return {
        initCalendar:initCalendar,
        initEventDatepickers:initEventDatepickers,
        initExportModal:initExportModal
    };
})();
