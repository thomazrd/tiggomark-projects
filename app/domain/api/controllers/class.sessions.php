<?php

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;
    use tiggomark\domain\repositories;
    use tiggomark\domain\services;
    use tiggomark\domain\models;

    class sessions extends controller
    {
        private $usersService;

        /**
         * init - initialize private variables
         *
         * @access public
         * @params parameters or body of the request
         */
        public function init()
        {

            $this->usersService = new services\users();
        }


        /**
         *
         *
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
            //Special handling for settings

            if (isset($params['tourActive'])) {
                $_SESSION['tourActive'] = filter_var($params['tourActive'], FILTER_SANITIZE_NUMBER_INT);
            }

            if (isset($params['menuState'])) {
                $_SESSION['menuState'] = htmlentities($params['menuState']);
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
