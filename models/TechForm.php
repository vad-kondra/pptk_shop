<?php


namespace app\models;

use app\models\tech\Tech;

/**
 * @property string $title
 * @property string $short_desc
 * @property string $body
 * @property boolean $is_public
 * @property MetaForm $meta
 * @property Photo $photo
 */

class TechForm extends CompositeForm
{
    public $title;
    public $short_desc;
    public $body;
    public $is_public;

    public function __construct(Tech $techArticles = null, $config = [])
    {
        if ($techArticles) {
            $this->title = $techArticles->title;
            $this->short_desc = $techArticles->short_desc;
            $this->body = $techArticles->body;
            $this->is_public = $techArticles->is_public;
            $this->meta = new MetaForm($techArticles->meta);
            $this->photo = new PhotoForm();

        }
        $this->photo = new PhotoForm();
        $this->meta = new MetaForm();
        parent::__construct($config);
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'short_desc' => 'Краткое описание',
            'body' => 'Текст статьи',
            'photo' => 'Изображение',
            'is_public' => 'Показывать на основном сайте?',
        ];
    }

    public function rules(): array
    {
        return [
            [['title', 'short_desc', 'body'], 'required'],
            [['title', 'short_desc'], 'string', 'max' => 255],
            [['title', 'short_desc'], 'trim'],
            [['body'], 'string'],
            [['is_public'], 'boolean'],
        ];
    }

    protected function internalForms(): array
    {
        return ['meta', 'photo'];
    }
}