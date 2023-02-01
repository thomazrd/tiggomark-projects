<?php

/**
 * showAll Class - show My Calender
 *
 */

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;
    use tiggomark\domain\models\auth\roles;
    use tiggomark\domain\repositories;
    use tiggomark\domain\services\auth;

    class showMyCalendar extends controller
    {
        private $calendarRepo;

        /**
         * init - initialize private variables
         */
        public function init()
        {

            $this->calendarRepo = new repositories\calendar();
        }

        /**
         * run - display template and edit data
         *
         * @access public
         */
        public function run()
        {
            auth::authOrRedirect([roles::$owner, roles::$admin, roles::$manager, roles::$editor]);

            $this->tpl->assign('calendar', $this->calendarRepo->getCalendar($_SESSION['userdata']['id']));
            //$this->tpl->assign('gCalLink', $this->calendarRepo->getMyGoogleCalendars());

            $_SESSION['lastPage'] = BASE_URL . "/calendar/showMyCalendar/";

            //ToDO: This should come from the ticket repo...
            //$this->tpl->assign('ticketEditDates', $this->calendarRepo->getTicketEditDates());
            //$this->tpl->assign('ticketWishDates', $this->calendarRepo->getTicketWishDates());
            //$this->tpl->assign('dates', $this->calendarRepo->getAllDates($dateFrom, $dateTo));

            $this->tpl->display('calendar.showMyCalendar');
        }
    }

}
