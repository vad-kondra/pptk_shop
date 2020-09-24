<?php


namespace app\models;



use app\models\news\News;

/**
 * @property string $title
 * @property string $short_desc
 * @property string $body
 * @property boolean $is_public
 * @property integer $publish_at
 *
 * @property MetaForm $meta
 * @property Photo $photo
 */

class NewsForm extends CompositeForm
{
    public $title;
    public $short_desc;
    public $body;
    public $is_public;
    public $publish_at;

    public function __construct(News $news = null, $config = [])
    {
        if ($news) {
            $this->title = $news->title;
            $this->short_desc = $news->short_desc;
            $this->body = $news->body;
            $this->is_public = $news->is_public;
            $this->publish_at = $news->publish_at;
            $this->meta = new MetaForm($news->meta);
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
            'publish_at' => 'Время публикации'
        ];
    }

    public function rules(): array
    {
        return [
            [['title', 'short_desc', 'body'], 'required'],
            [['title', 'short_desc'], 'string', 'max' => 255],
            ['publish_at', 'datetime', 'timestampAttribute' => 'publish_at', 'format' => 'php:Y-m-d H:i'],
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