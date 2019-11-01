<?php

namespace app\models;

/**
 * This is the model class for table "call_me".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $created_at
 * @property int $status
 */
class CallBack extends \yii\db\ActiveRecord
{

    const STATUS_NEW  = 0;
    const STATUS_ANSWERED  = 1;

    public static function getStatusAsArray(){
        return[
            self::STATUS_NEW =>  'Новый',
            self::STATUS_ANSWERED => 'Отвечено'
        ];
    }

    public function getStatusAsLabel(){
        return self::getStatusAsArray()[$this->status];
    }
    public static function tableName()
    {
        return 'call_back';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone','name','email'], 'required', 'message' => getRuleMessage('required')],
            [['created_at', 'status'], 'safe'],
            ['email', 'email', 'message'=>getRuleMessage('email')],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'email' => 'Эл. почта',
            'phone' => 'Телефон',
            'created_at' => 'Дата',
            'status' => 'Статус',
        ];
    }


    public function getDesc(){
        if(empty($this->descript)){
            return 'Нет';
        }
        return $this->descript;
    }
}
