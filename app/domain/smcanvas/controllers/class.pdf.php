<?php

/**
 * HTML code for PDF report
 */

namespace tiggomark\domain\controllers {

    use tiggomark\domain\repositories;

    class pdf extends \tiggomark\domain\controllers\canvas\pdf
    {
        protected const CANVAS_NAME = 'sm';

        /***
         * reportGenerate - Generate report for module
         *
         * @access public
         * @param  int    $id     Canvas identifier
         * @param  string $filter Filter value
         * @return string PDF filename
         */
        public function reportGenerate(int $id, array $filter = [], array $options = []): string
        {

            $options = [ 'canvasShow' => false ];
            return parent::reportGenerate($id, $filter, $options);
        }
    }
}
