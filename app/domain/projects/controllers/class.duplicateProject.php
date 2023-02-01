<?php

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;
    use tiggomark\domain\models\auth\roles;
    use tiggomark\domain\repositories;
    use tiggomark\domain\services;
    use tiggomark\domain\services\auth;

    class duplicateProject extends controller
    {
        public function init()
        {

            auth::authOrRedirect([roles::$owner, roles::$admin, roles::$manager], true);

            $this->projectRepo = new repositories\projects();
            $this->projectService = new services\projects();
            $this->clientRepo = new repositories\clients();
        }

        public function get()
        {

            //Only admins
            if (auth::userIsAtLeast(roles::$manager)) {
                if (isset($_GET['id']) === true) {
                    $id = (int)($_GET['id']);
                    $project = $this->projectService->getProject($id);


                    $this->tpl->assign('allClients', $this->clientRepo->getAll());


                    $this->tpl->assign("project", $project);
                    $this->tpl->displayPartial('projects.duplicateProject');
                } else {
                    $this->tpl->displayPartial('errors.error403');
                }
            } else {
                $this->tpl->displayPartial('errors.error403');
            }
        }

        public function post($params)
        {

            //Only admins
            if (auth::userIsAtLeast(roles::$manager)) {
                $id = (int)($_GET['id']);
                $projectName = $params['projectName'];
                $startDate = $this->language->getISODateString($params['startDate']);
                $clientId = (int) $params['clientId'];
                $assignSameUsers = false;

                if (isset($params['assignSameUsers'])) {
                    $assignSameUsers = true;
                }

                $result = $this->projectService->duplicateProject($id, $clientId, $projectName, $startDate, $assignSameUsers);

                $this->tpl->setNotification(sprintf($this->language->__("notifications.project_copied_successfully"), BASE_URL . "/projects/changeCurrentProject/" . $result), 'success');

                $this->tpl->redirect(BASE_URL . "/projects/duplicateProject/" . $id);
            } else {
                $this->tpl->displayPartial('errors.error403');
            }
        }
    }

}
