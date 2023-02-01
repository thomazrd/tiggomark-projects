tiggomark.helperController = (function () {

    //Variables

    //Constructor
    (function () {
        jQuery(document).ready(
            function () {

            }
        );

    })();

    //Functions
    var showHelperModal = function (module, minW, minH) {

        jQuery(document).ready(function () {
            jQuery.nmManual(
                tiggomark.appUrl + "/help/showOnboardingDialog?module=" + module,
                {sizes: {
                    minW: minW || 200,
                    minH: minH || 500,
                    },
                    resizable: true,
                    autoSizable: true,
                    callbacks: {
                        beforeShowCont: function () {
                            tiggomark.replaceSVGColors();
                        }
                    }
                }
            );
        });

    };

    //Functions
    var hideAndKeepHidden = function (module) {

        tiggomark.helperRepository.updateUserModalSettings(module);
        jQuery.nmTop().close();

    };

    var startDashboardTour = function () {

        tiggomark.helperRepository.startingTour();

        jQuery.nmTop().close();

        var tour = new Shepherd.Tour(
            {
                defaults: {
                    classes: 'shepherd-theme-arrows',
                    showCancelLink: true,
                    scrollTo: true,
                }
            }
        );

        tour.addStep(
            'Left Nav',
            {
                title: tiggomark.i18n.__("tour.left_navigation"),
                text: tiggomark.i18n.__("tour.left_nav_text"),
                attachTo: '.leftmenu ul right',
                advanceOn: '.headmenu click',
                buttons: [
                {
                    text: tiggomark.i18n.__("tour.cancel"),
                    classes: 'shepherd-button-secondary',
                    action: tour.cancel
                },
                {
                    text: tiggomark.i18n.__("tour.next"),
                    action: tour.next
                }
                ]
            }
        );

        tour.addStep(
            'Project Selection',
            {
                title: tiggomark.i18n.__("tour.project_selection"),
                text: tiggomark.i18n.__("tour.project_selection_text"),
                attachTo: '.project-selector right',
                buttons: [
                {
                    text: tiggomark.i18n.__("tour.back"),
                    classes: 'shepherd-button-secondary',
                    action: tour.back
                },
                {
                    text: tiggomark.i18n.__("tour.next"),
                    action: tour.next
                }
                ]
            }
        );

        tour.addStep(
            'Header Navigation',
            {
                title: tiggomark.i18n.__("tour.top_navigation"),
                text: tiggomark.i18n.__("tour.top_navigation_text"),
                attachTo: '.headmenu bottom',
                advanceOn: '#sprintBurndownChart click',
                buttons: [
                    {
                        text: tiggomark.i18n.__("tour.back"),
                        classes: 'shepherd-button-secondary',
                        action: tour.back
                },
                    {
                        text: tiggomark.i18n.__("tour.next"),
                        action: tour.next
                }
                ]
            }
        );

        tour.addStep(
            'Project Status',
            {
                title: tiggomark.i18n.__("tour.project_progress"),
                text: tiggomark.i18n.__("tour.project_progress_text"),
                attachTo: '#projectProgressContainer left',
                advanceOn: '.headmenu click',
                buttons: [
                    {
                        text: tiggomark.i18n.__("tour.back"),
                        classes: 'shepherd-button-secondary',
                        action: tour.back
                },
                    {
                        text: tiggomark.i18n.__("tour.next"),
                        action: tour.next
                }
                ]
            }
        );



        tour.addStep(
            'Your Todos',
            {
                title: tiggomark.i18n.__("tour.your_todos"),
                text: tiggomark.i18n.__("tour.your_todos_text"),
                attachTo: '#yourToDoContainer top',
                advanceOn: '.headmenu click',
                buttons: [
                    {
                        text: tiggomark.i18n.__("tour.back"),
                        classes: 'shepherd-button-secondary',
                        action: tour.back
                },
                    {
                        text: tiggomark.i18n.__("tour.next"),
                        action: tour.next
                }
                ]
            }
        );

        tour.addStep(
            'Your Todos',
            {
                title: tiggomark.i18n.__("tour.congratulations"),
                text: tiggomark.i18n.__("tour.congratulations_dashboard_text"),
                buttons:[
                {
                    text:tiggomark.i18n.__("tour.close"),
                    action:tour.cancel
                },
                {
                    text: tiggomark.i18n.__("tour.goto_projects"),
                    events: {
                        'click': function () {
                            window.location.href = tiggomark.appUrl + "/projects/newProject/";
                        }
                    }
                }
                ],
                advanceOn: '.headmenu click'
            }
        );

        tour.start();

    };

    var startKanbanTour = function () {
        jQuery.nmTop().close();
        var tour = new Shepherd.Tour(
            {
                defaults: {
                    classes: 'shepherd-theme-arrows',
                    showCancelLink: true,
                    scrollTo: true,
                }
            }
        );

        tour.addStep(
            'Left Nav',
            {
                title: tiggomark.i18n.__("tour.kanban"),
                text: tiggomark.i18n.__("tour.kanban_text"),
                attachTo: '.column right',
                advanceOn: '.headmenu click',
                buttons: [
                {
                    text: 'Cancel',
                    classes: 'shepherd-button-secondary',
                    action: tour.cancel
                }, {
                    text: 'Next',
                    action: tour.next
                }
                ]
            }
        );

        tour.addStep(
            'Left Nav',
            {
                title: tiggomark.i18n.__("tour.drag_drop"),
                text: tiggomark.i18n.__("tour.drag_drop_text"),
                attachTo: '.ticketBox h4 right',
                advanceOn: '.ticketBox click',
                buttons: [
                    {
                        text: tiggomark.i18n.__("tour.back"),
                        classes: 'shepherd-button-secondary',
                        action: tour.back
                },
                    {
                        text: tiggomark.i18n.__("tour.next"),
                        action: tour.next
                }
                ]
            }
        );

        tour.addStep(
            'Change Views',
            {
                title: tiggomark.i18n.__("tour.change_views"),
                text: tiggomark.i18n.__("tour.change_views_text"),
                attachTo: '.btn-group .fa-columns left',
                advanceOn: '.ticketBox click',
                buttons: [
                    {
                        text: tiggomark.i18n.__("tour.back"),
                        classes: 'shepherd-button-secondary',
                        action: tour.back
                },
                    {
                        text: tiggomark.i18n.__("tour.next"),
                        action: tour.next
                }
                ]
            }
        );

        tour.addStep(
            'Your Todos',
            {
                title: tiggomark.i18n.__("tour.congratulations"),
                text: tiggomark.i18n.__("tour.congratulations_kanban_text"),
                buttons:[
                {
                    text:tiggomark.i18n.__("tour.close"),
                    action:tour.complete
                }
                ],
                advanceOn: '.headmenu click'
            }
        );

        tour.on(
            'complete',
            function () {
                tiggomark.helperRepository.stopTour();
            }
        );

        tour.start();

    };

    var firstLoginModal = function () {

        jQuery(document).ready(function () {

            var onboardingModal = {
                sizes: {
                    minW: 700,
                    minH: 250
                },
                resizable: true,
                autoSizable: true,
                callbacks: {
                    afterShowCont: function () {
                        jQuery(".showDialogOnLoad").show();
                        jQuery(".onboardingModal").nyroModal(onboardingModal);
                    },
                    beforeClose: function () {

                        location.reload();
                    },
                }
            };

            jQuery(".onboardingModal").nyroModal(onboardingModal);

            jQuery.nmManual(
                tiggomark.appUrl + "/help/firstLogin?step=project",
                onboardingModal
            );
        });
    };

    // Make public what you want to have public, everything else is private
    return {
        showHelperModal: showHelperModal,
        hideAndKeepHidden: hideAndKeepHidden,
        startDashboardTour:startDashboardTour,
        startKanbanTour: startKanbanTour,
        firstLoginModal:firstLoginModal
    };
})();
