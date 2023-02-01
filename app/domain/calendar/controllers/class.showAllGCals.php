<?php

namespace tiggomark\domain\controllers {

    /**
     * newUser Class - show all User
     *
     */

    use tiggomark\core;
    use tiggomark\core\controller;
    use tiggomark\domain\models\auth\roles;
    use tiggomark\domain\repositories;
    use tiggomark\domain\services\auth;

    class showAllGCals extends controller
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

            //Assign vars
            $this->tpl->assign('allCalendars', $this->calendarRepo->getMyGoogleCalendars());

            $this->tpl->display('calendar.showAllGCals');
        }
    }
}
