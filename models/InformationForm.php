<?php


namespace app\models;

use app\models\information\Information;

/**
 * @property integer $id
 * @property string $title
 * @property string $short_desc
 * @property string $body
 * @property string $slug
 * @property boolean $is_public
 * @property MetaForm $meta
 * @property Photo $photo
 */

class InformationForm extends CompositeForm
{
    public $title;
    public $short_desc;
    public $body;
    public $slug;
    public $is_public;

    public function __construct(Information $informationArticles = null, $config = [])
    {
        if ($informationArticles) {
            $this->title = $informationArticles->title;
            $this->short_desc = $informationArticles->short_desc;
            $this->body = $informationArticles->body;
            $this->slug = $informationArticles->slug;
            $this->is_public = $informationArticles->is_public;
            $this->meta = new MetaForm($informationArticles->meta);
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
            [['title', 'slug'], 'unique', 'targetClass' => Information::class, 'filter' => $this->title ? ['<>', 'id', $this->id] : null]
        ];
    }

    protected function internalForms(): array
    {
        return ['meta', 'photo'];
    }
}