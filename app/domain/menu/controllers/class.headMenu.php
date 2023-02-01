<?php

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;
    use tiggomark\domain\services;

    class headMenu extends controller
    {
        private $timesheets;

        public function init()
        {

            $this->timesheets = new services\timesheets();
        }

        public function run()
        {

            $notificationService = new services\notifications();
            $notifications = $notificationService->getAllNotifications($_SESSION['userdata']['id']);
            $newnotificationCount = $notificationService->getAllNotifications($_SESSION['userdata']['id'], true);
            $nCount = '';

            if (is_array($newnotificationCount)) {
                $nCount = count($newnotificationCount);
            }

            $this->tpl->assign('newNotificationCount', $nCount);
            $this->tpl->assign('notifications', $notifications);
            $this->tpl->assign('current', explode(".", core\frontcontroller::getCurrentRoute()));
            $this->tpl->assign("onTheClock", $this->timesheets->isClocked($_SESSION["userdata"]["id"]));
            $this->tpl->displayPartial("menu.headMenu");
        }
    }

}
