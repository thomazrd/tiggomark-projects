<?php

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;

    class error403 extends controller
    {
        public function run()
        {

            core\frontcontroller::setResponseCode(403);
            $this->tpl->display('errors.error403');
        }
    }
}
