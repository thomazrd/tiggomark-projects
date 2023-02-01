<?php

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;
    use tiggomark\domain\repositories;
    use tiggomark\domain\services;
    use tiggomark\domain\models;

    class i18n extends controller
    {
        /**
         *
         *
         *
         * @access public
         * @params parameters or body of the request
         */
        public function get($params)
        {

            header('Content-Type: application/javascript');

            $decodedString = json_encode($this->language->readIni());

            $result = $decodedString ? $decodedString : '{}';

            echo "var tiggomark = tiggomark || {};
                var tiggomark = {
                    i18n: {
                        dictionary: " . $result . ",
                        __: function(index){ return tiggomark.i18n.dictionary[index];  }
                    }
                };";
/*
            echo "var tiggomark = tiggomark || {};
                var tiggomark = {
                    i18n: {
                        dictionary: " . $decodedString ? $decodedString : '{}' .",
                        __: function(index){ return tiggomark.i18n.dictionary[index];  }
                    }
                };
            ";
*/
        }
    }

}
