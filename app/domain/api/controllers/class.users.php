<?php

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;
    use tiggomark\domain\repositories;
    use tiggomark\domain\services;
    use tiggomark\domain\models;

    class users extends controller
    {
        private services\users $usersService;
        private repositories\files $filesRepository;
        private repositories\setting $settingsRepo;


         private $config;

        /**
         * init - initialize private variables
         *
         * @access public
         * @params parameters or body of the request
         */
        public function init()
        {

            $this->usersService = new services\users();
            $this->filesRepository = new repositories\files();
            $this->settingsRepo = new repositories\setting();

            $this->config = \tiggomark\core\environment::getInstance();
        }


        /**
         * get - handle get requests
         *
         * @access public
         * @params parameters or body of the request
         */
        public function get($params)
        {

            if (isset($params['saasConnectorToken'])) {
                header('Content-Type: application/json');
               $saasConnectorUserId = $this->settingsRepo->getSetting("saasConnectorUserId");

               $url = $this->config->saasConnectorUrl .'/user/token?userId='.$saasConnectorUserId;

               $appToken = $this->config->saasConnectorAppToken;

               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, $url);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                   "app-token: " . $appToken
               ));

               $response = curl_exec($ch);
               curl_close($ch);

               echo $response;

             }

            if (isset($params['assignedProjectUsersAssigned'])) {
            }

            if (isset($params['projectUsersAccess'])) {
                if ($params['projectUsersAccess'] == 'current') {
                    $projectId = $_SESSION['currentProject'];
                } else {
                    $projectId = $params['projectUsersAccess'];
                }

                $users = $this->usersService->getUsersWithProjectAccess($_SESSION['userdata']['id'], $projectId);

                $this->tpl->displayJson(json_encode($users));

                return;
            }

            if (isset($params["profileImage"])) {
                //var_dump("asdf");

                $return = $this->usersService->getProfilePicture($params["profileImage"]);

                if (is_string($return)) {
                    $this->tpl->redirect($return);
                } else {
                    header('Content-Type: image/jpeg');
                    echo $return;
                }
            }
        }

        /**
         * post - handle post requests
         *
         * @access public
         * @params parameters or body of the request
         */
        public function post($params)
        {

            //Updatind User Image
            if (isset($_FILES['file'])) {
                $_FILES['file']['name'] = "userPicture.png";

                $this->usersService->setProfilePicture($_FILES, $_SESSION['userdata']['id']);

                $_SESSION['msg'] = "PICTURE_CHANGED";
                $_SESSION['msgT'] = "success";

                echo "{status:ok}";
            }
        }

        /**
         * put - handle put requests
         *
         * @access public
         * @params parameters or body of the request
         */
        public function patch($params)
        {
            //Special handling for settings

            if (isset($params['patchModalSettings'])) {
                if ($this->usersService->updateUserSettings("modals", $params['settings'], 1)) {
                    echo "{status:ok}";
                }
            }

            if (isset($params['patchViewSettings'])) {
                if ($this->usersService->updateUserSettings("views", $params['patchViewSettings'], $params['value'])) {
                    echo "{status:ok}";
                }
            }

            if (isset($params['patchMenuStateSettings'])) {
                if ($this->usersService->updateUserSettings("views", "menuState", $params['value'])) {
                    echo "{status:ok}";
                }
            }
        }

        /**
         * delete - handle delete requests
         *
         * @access public
         * @params parameters or body of the request
         */
        public function delete($params)
        {
        }
    }

}
