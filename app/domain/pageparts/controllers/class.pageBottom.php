<?php

namespace tiggomark\domain\controllers {

    use DebugBar\StandardDebugBar;
    use tiggomark\core;
    use tiggomark\core\controller;

    class pageBottom extends controller
    {
        private $settings;

        public function init()
        {

            $this->settings = new core\appSettings();
        }

        public function run()
        {

            $this->tpl->displayPartial('pageparts.pageBottom');
        }
    }

}
