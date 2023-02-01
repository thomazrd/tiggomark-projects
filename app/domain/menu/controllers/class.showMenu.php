<?php

namespace tiggomark\domain\controllers;

/**
 * menu Class displays the menu
 *
 */

use tiggomark\core;
use tiggomark\core\controller;

class showMenu extends controller
{
    /**
     * run - display template and edit data
     *
     * @access public
     */
    public function run()
    {

        $this->tpl->displayPartial('menu.showMenu');
    }
}
