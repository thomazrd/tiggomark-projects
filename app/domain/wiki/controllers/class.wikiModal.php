<?php

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;
    use tiggomark\domain\models\auth\roles;
    use tiggomark\domain\models\wiki;
    use tiggomark\domain\repositories;
    use tiggomark\domain\services;
    use tiggomark\domain\services\auth;

    class wikiModal extends controller
    {
        public function init()
        {

            $this->wikiService = new services\wiki();
        }

        public function get($params)
        {

            $wiki = new wiki();
            if (isset($_GET["id"])) {
                $wiki = $this->wikiService->getWiki($_GET["id"]);
            }


            $this->tpl->assign("wiki", $wiki);
            $this->tpl->displayPartial("wiki.wikiDialog");
        }

        public function post($params)
        {

            $wiki = new wiki();

            if (isset($_GET["id"])) {
                $id = (int) $_GET["id"];
                //Update
                $wiki->title = $params['title'];
                $this->wikiService->updateWiki($wiki, $id);
                $this->tpl->setNotification("notification.wiki_updated_successfully", "success");
                $this->tpl->redirect(BASE_URL . "/wiki/wikiModal/" . $id);
            } else {
            //New
                $wiki->title = $params['title'];
                $wiki->projectId = $_SESSION['currentProject'];
                $wiki->author = $_SESSION['userdata']['id'];

                $id = $this->wikiService->createWiki($wiki);

                //$_SESSION['currentWiki'] = $id;

                if ($id) {
                    $this->tpl->setNotification("notification.wiki_created_successfully", "success");
                    $this->tpl->redirect(BASE_URL . "/wiki/wikiModal/" . $id . "?closeModal=1");
                }
            }
        }
    }

}
