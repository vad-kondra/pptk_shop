<?php

namespace app\services;

use app\models\InformationEditForm;
use app\models\Meta;
use app\models\Photo;
use app\models\PhotoForm;
use app\models\information\Information;
use app\models\InformationForm;
use app\repositories\InformationRepository;
use DateTime;

class InformationManageService
{
    private $informationRepository;

    /**
     * TechManageService constructor.
     * @param InformationRepository $informationRepository
     */
    public function __construct(InformationRepository $informationRepository)
    {
        $this->informationRepository = $informationRepository;
    }

    public function getById($id): Information
    {
        $informationArticles = $this->informationRepository->get($id);

        return $informationArticles;
    }

    /**
     * @param InformationForm $form
     * @return Information
     */
    public function create(InformationForm $form): Information
    {

        $informationArticles = Information::create(
            $form->title,
            $form->short_desc,
            $form->body,
            $form->is_public,
            $form->slug,
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
            $informationArticles->setPhoto($photo->id);
        }

        $this->informationRepository->save($informationArticles);
        return $informationArticles;
    }

    /**
     * @param $id
     * @param InformationForm $form
     * @return Information
     */
    public function edit($id, InformationEditForm $form): Information
    {
        $informationArticles = $this->informationRepository->get($id);

        $informationArticles->edit(
            $form->title,
            $form->short_desc,
            $form->body,
            $form->is_public,
            $form->slug,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        $this->informationRepository->save($informationArticles);

        return $informationArticles;
    }

    /**
     * @param $id
     */
    public function remove($id): void
    {
        $order = $this->informationRepository->get($id);
        $this->informationRepository->remove($order);
    }


    /**
     * @param $id
     * @param PhotoForm $form
     */
    public function addPhoto($id, PhotoForm $form): void
    {
        $informationArticles = $this->informationRepository->get($id);
        $photo = Photo::create($form->image, $form->image->baseName);
        $photo->save();
        $informationArticles->setPhoto($photo->id);
        $this->informationRepository->save($informationArticles);
    }


    public function getAllPublicTech()
    {
        return $this->informationRepository->getAllPublicTechArticles();
    }

    public function getAllTech()
    {
        $informationArticles = $this->informationRepository->getAllTechArticlesOrderByDate();

        return $informationArticles;
    }

}