tiggomark.dashboardController = (function () {

    // Variables (underscore for private variables)

    if (tiggomark.theme == "dark") {
        var chartColors = {
            red: 'rgb(201,48,44)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(90,182,90)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(56, 56, 56)'
        };
    } else {
        var chartColors = {
            red: 'rgb(201,48,44)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(90,182,90)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };
    }

    var _burndownConfig = '';

    var _progressChart = '';

    //Constructor
    (function () {
        jQuery(document).ready(
            function () {
                _initDueDateTimePickers();

            }
        );
    })();

    //Functions

    var prepareHiddenDueDate = function () {

        var thisFriday = moment().startOf('week').add(5, 'days');
        jQuery("#dateToFinish").val(thisFriday.format("YYYY-MM-DD"));

    };

    var initProgressChart = function (chartId, complete, incomplete ) {
        var config = {
            type: 'doughnut',

            data: {
                datasets: [{
                    data: [
                        complete,
                        incomplete

                    ],
                    backgroundColor: [
                            tiggomark.dashboardController.chartColors.green,
                            tiggomark.dashboardController.chartColors.grey

                        ],
                    label: tiggomark.i18n.__("label.project_done")
                }],
                labels: [
                            complete + '% Done',
                            incomplete + '% Open'
                        ]
            },
            options: {
                maintainAspectRatio : false,
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: false,
                        text: ''
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        };

        var ctx = document.getElementById(chartId).getContext('2d');
        _progressChart = new Chart(ctx, config);
    };

    var initBurndown = function (labels, plannedData, actualData) {

        moment.locale(tiggomark.i18n.__("language.code"));

        var MONTHS = labels;
        var config = {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: tiggomark.i18n.__("label.ideal"),
                        backgroundColor: tiggomark.dashboardController.chartColors.blue,
                        borderColor: tiggomark.dashboardController.chartColors.blue,
                        data: plannedData,
                        fill: false,
                        lineTension: 0,
                },
                    {
                        label: 'Actual',
                        backgroundColor: tiggomark.dashboardController.chartColors.red,
                        borderColor: tiggomark.dashboardController.chartColors.red,
                        data: actualData,
                        fill: false,
                        lineTension: 0,
                }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio : false,


                hover: {
                    mode: 'nearest',
                    intersect: true
                },

                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: false,
                        text: 'Line Chart'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: tiggomark.i18n.__("label.date"),
                        },
                        type: 'time',
                        time: {
                            unit: 'day'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: tiggomark.i18n.__("label.num_tickets")
                        },
                        ticks: {
                            beginAtZero:true
                        }
                    }
                }
            }
        };

        var ctx2 = document.getElementById('sprintBurndown').getContext('2d');
        _burndownChart = new Chart(ctx2, config);

        return _burndownChart;

    };

    var initChartButtonClick = function (id, label, plannedData, actualData, chart) {

        jQuery("#" + id).click(
            function (event) {

                chart.data.datasets[0].data = plannedData;
                chart.data.datasets[1].data = actualData;
                chart.options.scales.y.title.text = label;
                //chart.options.scales.yAxes[0].scaleLabel.labelString = label;
                jQuery(".chartButtons").removeClass('active');
                jQuery(this).addClass('active');
                chart.update();

            }
        );

    };

    var initBacklogBurndown = function (labels, actualData) {

        moment.locale(tiggomark.i18n.__("language.code"));

        var MONTHS = labels;
        var config = {
            type: 'line',
            data: {
                labels: labels,
                datasets: [

                    {
                        label: tiggomark.i18n.__("label.done_todos"),
                        backgroundColor: tiggomark.dashboardController.chartColors.green,
                        borderColor: tiggomark.dashboardController.chartColors.green,
                        data: actualData['done']['data'],
                        fill: true,
                        lineTension: 0,
                        pointRadius:0,
                },
                    {
                        label: tiggomark.i18n.__("label.progress_todos"),
                        backgroundColor: tiggomark.dashboardController.chartColors.yellow,
                        borderColor: tiggomark.dashboardController.chartColors.yellow,
                        data: actualData['progress']['data'],
                        fill: true,
                        lineTension: 0,
                        pointRadius:0,

                },
                    {
                        label: tiggomark.i18n.__("label.new_todos"),
                        backgroundColor: tiggomark.dashboardController.chartColors.red,
                        borderColor: tiggomark.dashboardController.chartColors.red,
                        data: actualData['open']['data'],
                        fill: true,
                        lineTension: 0,
                        pointRadius:0,

                },

                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio : false,
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                elements: {
                    point: {
                        pointStyle: "line",
                        radius:"0"
                    }
                },
                plugins: {
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: false,
                        text: 'Line Chart'
                    },
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: tiggomark.i18n.__("label.date"),

                        },
                        type: 'time',
                        time: {
                            unit: 'day'
                        },
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: tiggomark.i18n.__("label.num_tickets")
                        },
                        ticks: {
                            beginAtZero:true
                        },
                        stacked: true
                    }
                }
            }
        };

        var ctx2 = document.getElementById('backlogBurndown').getContext('2d');
        _burndownChart = new Chart(ctx2, config);

        return _burndownChart;

    };

    var initBacklogChartButtonClick = function (id, actualData, label, chart) {

        jQuery("#" + id).click(
            function (event) {

                chart.data.datasets[0].data = actualData['done']['data'];

                chart.data.datasets[1].data = actualData['progress']['data'];
                chart.data.datasets[2].data = actualData['open']['data'];


                chart.options.scales.y.title.text = label;
                jQuery(".backlogChartButtons").removeClass('active');
                jQuery(this).addClass('active');
                chart.update();

            }
        );

    };

    var _initDueDateTimePickers = function () {
        jQuery(".duedates").datepicker(
            {
                dateFormat: tiggomark.i18n.__("language.jsdateformat"),
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
                onClose: function (date) {

                    var newDate = "";

                    if (date == "") {
                        jQuery(this).val(tiggomark.i18n.__("text.anytime"));
                    }

                    var dateTime = moment(date, tiggomark.i18n.__("language.momentJSDate")).format("YYYY-MM-DD HH:mm:ss");

                    var id = jQuery(this).attr("data-id");
                    newDate = dateTime;

                    tiggomark.ticketsRepository.updateDueDates(id, newDate, function () {
                        jQuery.growl({message: tiggomark.i18n.__("short_notifications.duedate_updated")});
                    });

                }
            }
        );
    };

    // Make public what you want to have public, everything else is private
    return {
        chartColors: chartColors,
        initBurndown: initBurndown,
        initChartButtonClick: initChartButtonClick,
        initBacklogBurndown:initBacklogBurndown,
        initBacklogChartButtonClick:initBacklogChartButtonClick,
        initProgressChart:initProgressChart,
        prepareHiddenDueDate:prepareHiddenDueDate,
        _initDueDateTimePickers:_initDueDateTimePickers
    };
})();
