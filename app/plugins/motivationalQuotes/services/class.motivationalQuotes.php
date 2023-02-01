<?php

namespace tiggomark\plugins\services {

    use tiggomark\plugins\repositories;

    class motivationalQuotes
    {
        public function __construct()
        {
            $this->quotesRepo = new repositories\motivationalQuotes();
        }


        public function getRandomQuote()
        {

            $availableQuotes = $this->quotesRepo->getAllQuotes();

            $numberOfQuotes = count($availableQuotes) - 1;
            $randomNumber = rand(0, $numberOfQuotes);

            return $availableQuotes[$randomNumber];
        }
    }

}
