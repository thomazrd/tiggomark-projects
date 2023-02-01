<?php

namespace tiggomark\domain\controllers {

    /**
     * importGCal Class - Add a new client
     *
     */

    use tiggomark\core;
    use tiggomark\core\controller;
    use tiggomark\domain\models\auth\roles;
    use tiggomark\domain\repositories;
    use tiggomark\domain\services\auth;

    class editGCal extends controller
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

            $msgKey = '';

            if (isset($_GET['id']) === true) {
                $id = ($_GET['id']);

                $row = $this->calendarRepo->getGCal($id);

                $values = array(
                    'url' => $row['url'],
                    'name' => $row['name'],
                    'colorClass' => $row['colorClass']
                );

                if (isset($_POST['save']) === true) {
                    $values = array(
                        'url' => ($_POST['url']),
                        'name' => ($_POST['name']),
                        'colorClass' => ($_POST['color'])
                    );

                    $this->calendarRepo->editGUrl($values, $id);

                    $msgKey = 'Kalender bearbeitet';
                }

                $this->tpl->assign('values', $values);
                $this->tpl->assign('info', $msgKey);

                $this->tpl->display('calendar.editGCal');
            } else {
                $this->tpl->display('errors.error403');
            }
        }
    }
}
