<?php


namespace app\repositories;


use app\models\news\News;

class NewsRepository
{

    public function getAllPublicNews(): array
    {
        return News::find()->public()->with('photo')->limit(3)->all();
    }

    public function getAll(): array
    {
        return News::find()->where(['is_public' => true])->limit(3)->all();
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