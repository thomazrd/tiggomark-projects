<?php

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;

    class footer extends controller
    {
        private $settings;

        public function init()
        {

            $this->settings = new core\appSettings();
        }

        public function run()
        {

            $this->tpl->assign("version", $this->settings->appVersion);
            $this->tpl->displayPartial('pageparts.footer');
        }
    }

}
