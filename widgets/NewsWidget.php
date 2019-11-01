<?php


namespace app\widgets;


use app\repositories\NewsRepository;
use yii\base\Widget;

class NewsWidget extends Widget
{
    private $newsRepository;

    /**
     * NewsWidget constructor.
     * @param NewsRepository $newsRepository
     * @param array $config
     */
    public function __construct(NewsRepository $newsRepository, $config = [])
    {
        $this->newsRepository = $newsRepository;
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();
    }

    function run()
    {
        $news = $this->newsRepository->getAllPublicNews();

        return $this->render('news', [
            'news' => $news
        ]);
    }


}