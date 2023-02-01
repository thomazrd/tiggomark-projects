<?php

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;
    use tiggomark\domain\repositories;
    use tiggomark\domain\services;
    use tiggomark\domain\models;

    class ideas extends controller
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
            $this->ideaAPIRepo = new repositories\ideas();
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

            if (isset($params['action']) && $params['action'] == "ideaSort" && isset($params["payload"]) === true) {
                $sortOrder = $params["payload"];

                $results = $this->ideaAPIRepo->updateIdeaSorting($sortOrder);

                if ($results === true) {
                    echo "{status:ok}";
                } else {
                    echo "{status:failure}";
                }
            } elseif (isset($params['action']) && $params['action'] == "statusUpdate" && isset($params["payload"]) === true) {
                $results = $this->ideaAPIRepo->bulkUpdateIdeaStatus($params["payload"]);

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
         * put - handle put requests
         *
         * @access public
         * @params parameters or body of the request
         */
        public function patch($params)
        {
            $results = $this->ideaAPIRepo->patchCanvasItem($params['id'], $params);

            if ($results === true) {
                echo "{status:ok}";
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
