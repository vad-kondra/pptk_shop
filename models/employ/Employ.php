<?php

namespace app\models\news;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $first_name
 * @property string $position
 * @property string $tel_1
 * @property string $tel_2
 * @property string $email
 * @property string $skype
 *
 */

class Employ extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
//    public static function tableName()
//    {
//        return 'employee';
//    }
//
//    public static function create( $id, $name, $surname, $first_name, $position, $tel_1, $tel_2, $email, $skype): self
//    {
//        $employ = new static();
//        $employ->id = $id;
//        $employ->name = $name;
//        $employ->;
//        $employ->;
//        $employ->;
//        $employ->;
//        return $employ;
//    }
//
//    public function edit( $title, $short_desc, $body, $publish_at, $is_public, Meta $meta)
//    {
//        $this->title = $title;
//        $this->short_desc = $short_desc;
//        $this->meta = $meta;
//        $this->body = $body;
//        $this->publish_at = $publish_at;
//        $this->is_public = $is_public;
//
//    }
//
//
//    /**
//     * {@inheritdoc}
//     */
//    public function rules()
//    {
//        return [
//            [['title', 'short_desc', 'body'], 'required'],
//            [['title'], 'string', 'max' => 65],
//            [['short_desc'], 'string', 'max' => 100],
//            [['body'], 'string'],
//        ];
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function attributeLabels()
//    {
//        return [
//            'id' => 'ID',
//            'title' => 'Заголовок',
//            'short_desc' => 'Краткое описание',
//            'body' => 'Полное описание',
//            'img_src' => 'Изображение',
//            'is_public' => 'Показывать на основном сайте?',
//            'created_at' => 'Создана',
//            'publish_at' => 'Дата публикации',
//            'author.username' => 'Создатель'
//        ];
//    }
//
//    public function behaviors(): array
//    {
//        return [
//            MetaBehavior::class,
//            [
//                'class' => SaveRelationsBehavior::class,
//                'relations' => [ 'photos'],
//            ],
//        ];
//    }
//
//    public function setPhoto($id): void
//    {
//        $this->photo_id = $id;
//    }
//
//
//    /**
//     * @return ActiveQuery
//     */
//    public function getPhoto(): ActiveQuery
//    {
//        return $this->hasOne(Photo::class, ['id' => 'photo_id']);
//    }
//
//    /**
//     * @return ActiveQuery
//     */
//    public function getAuthor(): ActiveQuery
//    {
//        return $this->hasOne(User::class, ['id' => 'user_id']);
//    }
//
//    public static function find(): NewsQuery
//    {
//        return new NewsQuery(static::class);
//    }
//
//    public function beforeSave($insert)
//    {
//        $this->body = strip_tags($this->body);
//
//        if ($this->publish_at == null) {
//            $this->publish_at = $this->created_at;
//        }
//        return parent::beforeSave($insert);
//    }


}
