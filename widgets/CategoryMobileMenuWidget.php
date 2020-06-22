<?php

namespace app\widgets;

use app\repositories\CategoryReadRepository;
use yii\base\Widget;

class CategoryMobileMenuWidget extends Widget{

    private $repository;

    public function __construct(CategoryReadRepository $repository, $config = [])
    {
        $this->repository = $repository;
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();
    }

    function run()
    {
        $category = $this->repository->getRoot();

        return $this->render('mobile-category', [
        	'category' => $category
        ]);
    }
}