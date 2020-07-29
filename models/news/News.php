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
 * @property integer $publish_at
 * @property string $title
 * @property string $short_desc
 * @property string $body
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

    public static function create( $title, $short_desc, $body, $publish_at, $is_public, Meta $meta): self
    {
        $news = new static();
        $news->title = $title;
        $news->short_desc = $short_desc;
        $news->meta = $meta;
        $news->body = $body;
        $news->created_at = time();
        $news->publish_at = $publish_at;
        $news->is_public = $is_public;
        $news->user_id = Yii::$app->user->identity->getId();
        return $news;
    }

    public function edit( $title, $short_desc, $body, $publish_at, $is_public, Meta $meta)
    {
        $this->title = $title;
        $this->short_desc = $short_desc;
        $this->meta = $meta;
        $this->body = $body;
        $this->publish_at = $publish_at;
        $this->is_public = $is_public;

    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'short_desc', 'body'], 'required'],
            [['title'], 'string', 'max' => 65],
            [['short_desc'], 'string', 'max' => 100],
            [['body'], 'string'],
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
            'body' => 'Полное описание',
            'img_src' => 'Изображение',
            'is_public' => 'Показывать на основном сайте?',
            'created_at' => 'Создана',
            'publish_at' => 'Дата публикации',
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

    public function beforeSave($insert)
    {
        $this->body = strip_tags($this->body);

        if ($this->publish_at == null) {
            $this->publish_at = $this->created_at;
        }
        return parent::beforeSave($insert);
    }


}
