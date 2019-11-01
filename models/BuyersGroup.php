<?php

namespace app\models;

use app\models\user\User;
use app\modules\admin\models\BuyerGroupForm;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "user_group".
 *
 * @property int $id
 * @property string $name
 * @property int $discount
 *
 * @property User[] $users
 */
class BuyersGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_buyer_groups';
    }


    public static function create(BuyerGroupForm $form)
    {
        $group = new static();
        $group->name = $form->name;
        $group->discount = $form->discount/100;
        return $group;
    }

    public function edit(BuyerGroupForm $form): void
    {
        $this->name = $form->name;
        $this->discount = $form->discount/100;
        $this->save();
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'discount' => 'Cкидка, %',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['group_id' => 'id']);
    }



}
