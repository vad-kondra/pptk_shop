<?php

namespace app\models\news;

use app\behaviors\MetaBehavior;
use app\models\Meta;
use app\models\Photo;
use app\models\PhotoForm;
use app\models\user\User;
use app\queries\NewsQuery;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property integer $created_at
 * @property string $title
 * @property string $short_desc
 * @property string $description
 * @property boolean $is_public
 * @property integer $photo_id
 * @property integer $user_id
 *
 * @property Meta $meta
 * @property Photo $photo
 * @property User $author
 */
class News extends ActiveRecord
{

    public $meta;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_news';
    }

    public static function create(string $title, string $short_desc, string $description, $is_public, Meta $meta): self
    {
        $news = new static();
        $news->title = $title;
        $news->description = $description;
        $news->short_desc = $short_desc;
        $news->meta = $meta;
        $news->created_at = time();
        $news->is_public = $is_public;
        $news->user_id = Yii::$app->user->identity->getId();
        return $news;
    }

    public function edit(string $title, string $short_desc, string $description, bool $is_public, Meta $meta)
    {
        $this->title = $title;
        $this->description = $description;
        $this->short_desc = $short_desc;
        $this->meta = $meta;
        $this->is_public = $is_public;
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'short_desc', 'description'], 'required'],
            [['title'], 'string', 'max' => 65],
            [['short_desc'], 'string', 'max' => 100],
            [['description', 'img_src'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'short_desc' => 'Краткое описание',
            'description' => 'Полное описание',
            'img_src' => 'Изображение',
            'is_public' => 'Показывать на основном сайте?',
            'created_at' => 'Создана',
            'author.username' => 'Создатель'
        ];
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => [ 'photos'],
            ],
        ];
    }

    public function setPhoto($id): void
    {
        $this->photo_id = $id;
    }


    /**
     * @return ActiveQuery
     */
    public function getPhoto(): ActiveQuery
    {
        return $this->hasOne(Photo::class, ['id' => 'photo_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function find(): NewsQuery
    {
        return new NewsQuery(static::class);
    }
}
