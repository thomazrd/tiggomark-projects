<?php

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;
    use tiggomark\domain\repositories;
    use tiggomark\domain\services;
    use tiggomark\domain\models;
    use tiggomark\domain\models\auth\roles;

    class tickets extends controller
    {
        private $projects;

        /**
         * init - initialize private variables
         *
         * @access public
         * @params parameters or body of the request
         */
        public function init()
        {

            $this->projects = new repositories\projects();
            $this->ticketsApiService = new services\tickets();
        }


        /**
         * get - handle get requests
         *
         * @access public
         * @params parameters or body of the request
         */
        public function get($params)
        {
        }

        /**
         * post - handle post requests
         *
         * @access public
         * @params parameters or body of the request
         */
        public function post($params)
        {

            if (services\auth::userIsAtLeast(roles::$editor)) {
                if (isset($params['action']) && $params['action'] == "kanbanSort" && isset($params["payload"]) === true) {
                    $handler = null;
                    if (isset($params["handler"]) == true) {
                        $handler = $params["handler"];
                    }
                    $results = $this->ticketsApiService->updateTicketStatusAndSorting($params["payload"], $handler);

                    if ($results === true) {
                        echo "{status:ok}";
                    } else {
                        echo "{status:failure}";
                    }
                } else {
                    echo "{status:failure}";
                }
            } else {
                echo "{status:failure}";
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
            if (services\auth::userIsAtLeast(roles::$editor)) {
                $results = false;
                if (isset($params['id'])) {
                    $results = $this->ticketsApiService->patchTicket($params['id'], $params);
                } else {
                    echo "{status:failure, message: 'ID not set'}";
                }

                if ($results === true) {
                    echo "{status:ok}";
                } else {
                    echo "{status:failure}";
                }
            } else {
                echo "{status:failure}";
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
