<?php

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;
    use tiggomark\domain\models\auth\roles;
    use tiggomark\domain\repositories;
    use tiggomark\domain\services\auth;

    class delCanvasItem extends controller
    {
        private $ideasRepo;

        /**
         * init - initialize private variables
         *
         * @access public
         */
        public function init()
        {
            $this->ideasRepo = new repositories\ideas();
        }

        /**
         * run - display template and edit data
         *
         * @access public
         */
        public function run()
        {

            auth::authOrRedirect([roles::$owner, roles::$admin, roles::$manager, roles::$editor]);

            if (isset($_GET['id'])) {
                $id = (int)($_GET['id']);
            }

            if (isset($_POST['del']) && isset($id)) {
                $this->ideasRepo->delCanvasItem($id);

                $this->tpl->setNotification($this->language->__("notification.idea_board_item_deleted"), "success");

                $this->tpl->redirect(BASE_URL . "/ideas/showBoards");
            }

            $this->tpl->displayPartial('ideas.delCanvasItem');
        }
    }

}
