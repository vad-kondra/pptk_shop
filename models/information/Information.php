<?php

namespace app\models\information;

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
use yii\helpers\Inflector;

/**
 * This is the model class for table "shop_tech_info".
 *
 * @property int $id
 * @property integer $created_at
 * @property string $title
 * @property string $short_desc
 * @property string $body
 * @property string $slug
 * @property boolean $is_public
 * @property integer $photo_id
 * @property integer $user_id
 *
 * @property Meta $meta
 * @property Photo $photo
 * @property User $author
 */
class Information extends ActiveRecord
{

    private $_post;

    public $meta;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_tech_info';
    }

    public static function create( $title, $short_desc, $body, $is_public, $slug, Meta $meta): self
    {
        $techArticles = new static();
        $techArticles->title = $title;
        $techArticles->short_desc = $short_desc;
        $techArticles->meta = $meta;
        $techArticles->body = $body;
        $techArticles->slug = Inflector::slug($techArticles->title);
        $techArticles->created_at = time();
        $techArticles->is_public = $is_public;
        $techArticles->user_id = Yii::$app->user->identity->getId();
        return $techArticles;
    }

    public function edit( $title, $short_desc, $body, $is_public, $slug, Meta $meta)
    {
        $this->title = $title;
        $this->short_desc = $short_desc;
        $this->meta = $meta;
        $this->body = $body;
        $this->slug = Inflector::slug($this->title);
        $this->is_public = $is_public;

    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'short_desc', 'body'], 'required'],
            [['title'], 'unique'],
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
