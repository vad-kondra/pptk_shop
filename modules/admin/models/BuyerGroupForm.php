<?php


namespace app\modules\admin\models;


use app\models\BuyersGroup;
use yii\base\Model;

class BuyerGroupForm extends Model
{
    public $name;
    public $discount;

    public function __construct(BuyersGroup $group = null, $config = [])
    {
        if ($group) {
            $this->name = $group->name;
            $this->name = $group->name;
            $this->discount = $group->discount*100;
        }
        parent::__construct($config);
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name',], 'required', 'message'=>getRuleMessage('required')],
            [['name'], 'string', 'max' => 65],
            [['name',], 'trim'],
            [['discount'], 'integer', 'min' => '-100', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название группы',
            'discount' => 'Cкидка, %',
        ];
    }

}