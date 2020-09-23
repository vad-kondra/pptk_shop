<?php

namespace app\repositories;

use app\models\tech\Tech;

class TechRepository
{
    public function getAllPublicTechArticles($limit = 3): array
    {
        return Tech::find()
            ->public()
            ->orderBy(['created_at' => SORT_DESC])
            ->limit($limit)
            ->all();
    }

    public function getAllTechArticlesOrderByDate(): array
    {
        return Tech::find()
            ->public()
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }

    public function getAll(): array
    {
        return Tech::find()->all();
    }

    public function get($id): Tech
    {
        if (!$techArticles = Tech::findOne($id)) {
            throw new NotFoundException('Новость не найдена.');
        }
        return $techArticles;
    }

    public function save(Tech $techArticles): void
    {
        if (!$techArticles->save()) {
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }

    public function remove(Tech $techArticles): void
    {
        if (!$techArticles->delete()) {
            throw new \RuntimeException('Ошибка удаления.');
        }
    }
}