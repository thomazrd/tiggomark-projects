<?php

/**
 * XML export
 */

namespace tiggomark\domain\controllers {

    use tiggomark\domain\repositories;

    class export extends \tiggomark\domain\controllers\canvas\export
    {
        protected const CANVAS_NAME = 'em';
    }
}
