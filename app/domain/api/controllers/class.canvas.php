<?php

/**
 * canvas class - Generic canvas API controller
 */

namespace tiggomark\domain\controllers\api {

    use tiggomark\core;
    use tiggomark\core\controller;
    use tiggomark\domain\repositories;
    use tiggomark\domain\services;
    use tiggomark\domain\models;

    class canvas extends controller
    {
        /**
         * Constant that must be redefined
         */
        protected const CANVAS_NAME = '??';

        private $projects;

        /**
         * constructor - initialize private variables
         *
         * @access public
         * @params parameters or body of the request
         */
        public function init()
        {

            $this->projects = new repositories\projects();
            $canvasRepoName = "tiggomark\\domain\\repositories\\" . static::CANVAS_NAME . 'canvas';
            $this->canvasRepo = new $canvasRepoName();
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
        }

        /**
         * put - handle put requests
         *
         * @access public
         * @params parameters or body of the request
         */
        public function patch($params)
        {
            $results = $this->canvasRepo->patchCanvasItem($params['id'], $params);

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
