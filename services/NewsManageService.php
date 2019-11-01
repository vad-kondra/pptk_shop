<?php


namespace app\services;


use app\models\Meta;
use app\models\news\News;
use app\models\NewsForm;
use app\models\Photo;
use app\models\PhotoForm;
use app\repositories\NewsRepository;

class NewsManageService
{
    private $newsRepository;

    /**
     * NewsManageService constructor.
     * @param NewsRepository $newsRepository
     */
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @param NewsForm $form
     * @return News
     */
    public function create(NewsForm $form): News
    {
        $news = News::create(
            $form->title,
            $form->short_desc,
            $form->description,
            $form->is_public,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        $image = $form->photo->image;
        if ($image){
            $photo = Photo::create($image, $image->baseName);
            $photo->save();
            $news->setPhoto($photo->id);
        }

        $this->newsRepository->save($news);
        return $news;
    }

    /**
     * @param $id
     * @param NewsForm $form
     * @return News
     */
    public function edit($id, NewsForm $form): News
    {
        $news = $this->newsRepository->get($id);

        $news->edit(
            $form->title,
            $form->short_desc,
            $form->description,
            $form->is_public,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        $image = $form->photo->image;
        if ($image){
            $photo = Photo::create($image, $image->baseName);
            $photo->save();
            $news->setPhoto($photo->id);
        }
        $this->newsRepository->save($news);

        return $news;
    }

    /**
     * @param $id
     */
    public function remove($id): void
    {
        $order = $this->newsRepository->get($id);
        $this->newsRepository->remove($order);
    }


    /**
     * @param $id
     * @param PhotoForm $form
     */
    public function addPhoto($id, PhotoForm $form): void
    {
        $news = $this->newsRepository->get($id);
        $photo = Photo::create($form->image, $form->image->baseName);
        $photo->save();
        $news->setPhoto($photo->id);
        $this->newsRepository->save($news);
    }


}