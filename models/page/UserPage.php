<?php

namespace app\models\page;

/**
 * This is the model class for table "user_page".
 *
 * @property int $id
 * @property string $name
 * @property string $href
 */
class UserPage extends \yii\db\ActiveRecord
{
    const HREF_PREFIX = '/page/';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            ['href', 'safe'],
            [['name', 'href'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => t_app('Название'),
            'href' => t_app('Ссылка'),
        ];
    }

    public function getGetLink(){
        return "?page=".$this->link;
    }

    public function getName(){
        return t_admin($this->name);
    }
}
