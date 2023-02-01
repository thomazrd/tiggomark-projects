<?php

namespace tiggomark\domain\controllers {

    use tiggomark\core;
    use tiggomark\core\controller;
    use tiggomark\domain\models\auth\roles;
    use tiggomark\domain\repositories;
    use tiggomark\domain\services;
    use tiggomark\domain\services\auth;

    class showAll extends controller
    {
        public function init()
        {

            $this->userRepo =  new repositories\users();
            $this->ldapService = new services\ldap();
        }

        public function get()
        {

            auth::authOrRedirect([roles::$owner, roles::$admin], true);



            //Only Admins
            if (auth::userIsAtLeast(roles::$admin)) {
                if (auth::userIsAtLeast(roles::$admin)) {
                    $this->tpl->assign('allUsers', $this->userRepo->getAll());
                } else {
                    $this->tpl->assign('allUsers', $this->userRepo->getAllClientUsers(auth::getUserClientId()));
                }

                $this->tpl->assign('admin', true);
                $this->tpl->assign('roles', roles::getRoles());

                $this->tpl->display('users.showAll');
            } else {
                $this->tpl->display('errors.error403');
            }
        }

        public function post($params)
        {
        }
    }

}
