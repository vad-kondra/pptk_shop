<?php


namespace app\models;



use app\models\news\News;

/**
 * @property string $title
 * @property string $description
 * @property string $short_desc
 * @property boolean $is_public
 *
 * @property PhotoForm $photo
 * @property MetaForm $meta
 */

class NewsForm extends CompositeForm
{
    public $title;
    public $short_desc;
    public $description;
    public $is_public;

    public function __construct(News $news = null, $config = [])
    {
        if ($news) {
            $this->title = $news->title;
            $this->short_desc = $news->short_desc;
            $this->description = $news->description;
            $this->is_public = $news->is_public;
            $this->meta = new MetaForm($news->meta);
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
            'description' => 'Полное описание',
            'photo' => 'Изображение',
            'is_public' => 'Показывать на основном сайте?'
        ];
    }

    public function rules(): array
    {
        return [
            [['title', 'short_desc', 'description'], 'required'],
            [['title', 'short_desc'], 'string', 'max' => 255],
            [['title', 'short_desc'], 'trim'],
            ['is_public', 'boolean'],
        ];
    }

    protected function internalForms(): array
    {
        return ['meta', 'photo'];
    }
}