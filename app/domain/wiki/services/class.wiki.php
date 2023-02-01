<?php

namespace tiggomark\domain\services {

    use tiggomark\core;
    use tiggomark\domain\repositories;
    use DatePeriod;
    use DateTime;
    use DateInterval;

    class wiki
    {
        private $projectRepository;
        private $wikiRepository;
        private $ticketRepository;
        private $reportRepository;

        public function __construct()
        {

            $this->tpl = new core\template();
            $this->projectRepository = new repositories\projects();
            $this->wikiRepository = new repositories\wiki();
            $this->reportRepository = new repositories\reports();
            $this->ticketRepository = new repositories\tickets();
            $this->language = core\language::getInstance();
        }

        public function getArticle($id, $projectId = null)
        {

            if (!is_null($id)) {
                $article = $this->wikiRepository->getArticle($id, $projectId);

                if (!$article) {
                    $article = $this->wikiRepository->getArticle(-1, $projectId);
                }
            } else {
                $article = $this->wikiRepository->getArticle(-1, $projectId);
            }


            return $article;
        }

        public function getAllProjectWikis($projectId)
        {
            return $this->wikiRepository->getAllProjectWikis($projectId);
        }

        public function getAllWikiHeadlines($wikiId, $userId)
        {
            return $this->wikiRepository->getAllWikiHeadlines($wikiId, $userId);
        }

        public function getWiki($id)
        {
            return $this->wikiRepository->getWiki($id);
        }

        public function createWiki(\tiggomark\domain\models\wiki $wiki)
        {
            return $this->wikiRepository->createWiki($wiki);
        }

        public function updateWiki(\tiggomark\domain\models\wiki $wiki, $wikiId)
        {
            return $this->wikiRepository->updateWiki($wiki, $wikiId);
        }

        public function createArticle(\tiggomark\domain\models\wiki\article $article)
        {
            return $this->wikiRepository->createArticle($article);
        }

        public function updateArticle(\tiggomark\domain\models\wiki\article $article)
        {
            return $this->wikiRepository->updateArticle($article);
        }
    }

}
