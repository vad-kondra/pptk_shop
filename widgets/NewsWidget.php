<?php

namespace app\widgets;

use app\models\news\News;
use app\services\NewsManageService;
use yii\base\Widget;

/**
 * Class NewsWidget
 * @package app\widgets
 *
 * @property NewsManageService $newsService
 * @property News[] $news
 * @property string $header
 */
class NewsWidget extends Widget
{
    private $newsService;
    public $news;
    public $header;

    public function __construct(NewsManageService $newsService, $config = [])
    {
        $this->newsService = $newsService;
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();
        $this->news = $this->newsService->getAllPublicNews();
    }

    public function run()
    {
        if (empty($this->news)) {

            return "";

        } else {
            $this->header = "Новости";

            return $this->render('news', [
                'header' => $this->header,
                'news' => $this->news
            ]);
        }
    }
}