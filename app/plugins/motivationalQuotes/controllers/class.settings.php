<?php

namespace tiggomark\plugins\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;


    class settings extends controller
    {
        public function init()
        {
        }

        /**
         * @return void
         */
        public function get()
        {

            $this->tpl->display("motivationalQuotes.settings");
        }

        public function post($params)
        {
        }
    }
}
