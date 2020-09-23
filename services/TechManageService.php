<?php

namespace app\services;

use app\models\Meta;
use app\models\Photo;
use app\models\PhotoForm;
use app\models\tech\Tech;
use app\models\TechForm;
use app\repositories\TechRepository;
use DateTime;

class TechManageService
{
    private $techRepository;

    /**
     * TechManageService constructor.
     * @param TechRepository $techRepository
     */
    public function __construct(TechRepository $techRepository)
    {
        $this->techRepository = $techRepository;
    }

    public function getById($id): Tech
    {
        $techArticles = $this->techRepository->get($id);

        return $techArticles;
    }

    /**
     * @param TechForm $form
     * @return Tech
     */
    public function create(TechForm $form): Tech
    {

        $techArticles = Tech::create(
            $form->title,
            $form->short_desc,
            $form->body,
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
            $techArticles->setPhoto($photo->id);
        }

        $this->techRepository->save($techArticles);
        return $techArticles;
    }

    /**
     * @param $id
     * @param TechForm $form
     * @return Tech
     */
    public function edit($id, TechForm $form): Tech
    {
        $techArticles = $this->techRepository->get($id);

        $techArticles->edit(
            $form->title,
            $form->short_desc,
            $form->body,
            $form->is_public,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        $this->techRepository->save($techArticles);

        return $techArticles;
    }

    /**
     * @param $id
     */
    public function remove($id): void
    {
        $order = $this->techRepository->get($id);
        $this->techRepository->remove($order);
    }


    /**
     * @param $id
     * @param PhotoForm $form
     */
    public function addPhoto($id, PhotoForm $form): void
    {
        $techArticles = $this->techRepository->get($id);
        $photo = Photo::create($form->image, $form->image->baseName);
        $photo->save();
        $techArticles->setPhoto($photo->id);
        $this->techRepository->save($techArticles);
    }


    public function getAllPublicTech()
    {
        return $this->techRepository->getAllPublicTechArticles();
    }

    public function getAllTech()
    {
        $techArticles = $this->techRepository->getAllTechArticlesOrderByDate();

        return $techArticles;
    }

}