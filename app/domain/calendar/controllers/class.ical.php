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

    class ical extends controller
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

            $calId = $_GET['id'];

            $idParts = explode("_", $calId);

            if (count($idParts) != 2) {
                $this->tpl->redirect(BASE_URL . "/errors/404");
            }

            $calendar = $this->calendarRepo->getCalendarBySecretHash($idParts[1], $idParts[0]);

            $this->tpl->assign("calendar", $calendar);

            header('Content-type: text/calendar; charset=utf-8');
            header('Content-disposition: attachment;filename="tiggomark.ics"');
            $this->tpl->display("calendar.ical", "blank");
        }
    }

}
