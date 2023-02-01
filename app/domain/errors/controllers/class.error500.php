<?php

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;

    class error500 extends controller
    {
        public function run()
        {

            core\frontcontroller::setResponseCode(500);
            $this->tpl->display('errors.error500');
        }
    }

}
