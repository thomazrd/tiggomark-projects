<?php

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;
    use tiggomark\domain\repositories;
    use tiggomark\domain\services;
    use tiggomark\domain\models;

    class index extends controller
    {
        private $usersService;
        private $redirectUrl;

        /**
         * init - initialize private variables
         *
         * @access public
         */
        public function init()
        {

            $this->installRepo = new repositories\install();


        }

        /**
         * get - handle get requests
         *
         * @access public
         * @params parameters or body of the request
         */
        public function get($params)
        {

            $this->tpl->display("install.new", "entry");
        }

        public function post($params){



        }
    }
}
