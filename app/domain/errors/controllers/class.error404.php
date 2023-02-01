<?php

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;

    class error404 extends controller
    {
        public function run()
        {

            core\frontcontroller::setResponseCode(404);
            $this->tpl->display('errors.error404');
        }
    }

}
