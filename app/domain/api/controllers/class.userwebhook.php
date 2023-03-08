<?php

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;
    use tiggomark\domain\repositories;
    use tiggomark\domain\services;
    use tiggomark\domain\models;

    class userwebhook extends controller{


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
         *
         *
         *
         * @access public
         * @params parameters or body of the request
         */
        public function post($params) {

            header('Content-Type: application/json');



            $json_payload = file_get_contents('php://input');
            $params = json_decode($json_payload, true);

            $values = array(
                'email'         => "",
                'tenant'         => "",
                'password'      => "",
                'firstname'     => "",
                'lastname'      => "",
                'tenant'      => ""
            );


            $values = array(
                'email' => ($params['email']),
                'password' => $params['password'],
                'firstname' => ($params['name']),
                'company' => ($params['companyName']),
                 'tenant' => ($params['tenant'])
            );




            if ($this->installRepo->setupDB($values)) {

               http_response_code(200);
            } else {

               http_response_code(500);
            }




        }
    }

}
