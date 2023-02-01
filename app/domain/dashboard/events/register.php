<?php

namespace tiggomark\domain\events {

    class DashboardTest
    {
        public function handle($payload)
        {
            // code here
        }
    }

    \tiggomark\core\events::add_event_listener("core.application.start.beginning", new dashboardTest());

}
