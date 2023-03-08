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

            $json_payload = file_get_contents('php://input');
            $params = json_decode($json_payload, true);

            $values = array(
                'email'         => "",
                'tenant'         => "",
                'password'      => "",
                'firstname'     => "",
                'lastname'      => ""
            );

            if (isset($_POST['install'])) {
                $values = array(
                    'email' => ($params['email']),
                    'password' => $params['password'],
                    'firstname' => ($params['firstname']),
                    'lastname' => ($params['lastname']),
                    'company' => ($params['company']),
                     'tenant' => ($params['tenant'])
                );

                error_log($values['email']);


                if ($this->installRepo->setupDB($values)) {
                   http_response_code(200);
                } else {
                    http_response_code(500);
                }


            }


        }
    }
}
