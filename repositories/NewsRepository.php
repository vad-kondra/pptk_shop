<?php

namespace app\repositories;

use app\models\news\News;

class NewsRepository
{
    public function getAllPublicNews($limit = 3): array
    {
        return News::find()
            ->public()
            ->onlyPublish()
            ->orderBy(['created_at' => SORT_DESC])
            ->limit($limit)
            ->all();
    }

    public function getAllNewsOrderByDate(): array
    {
        return News::find()
            ->public()
            ->onlyPublish()
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }

    public function getAll(): array
    {
        return News::find()->all();
    }

    public function get($id): News
    {
        if (!$news = News::findOne($id)) {
            throw new NotFoundException('Новость не найдена.');
        }
        return $news;
    }

    public function save(News $news): void
    {
        if (!$news->save()) {
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }

    public function remove(News $news): void
    {
        if (!$news->delete()) {
            throw new \RuntimeException('Ошибка удаления.');
        }
    }
}