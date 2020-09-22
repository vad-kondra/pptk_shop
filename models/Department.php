<?php

namespace app\models;

use app\models\employ\Employ;
use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $title
 * @property Employ[] $employees
 */

class Department extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'min' => 2, 'max' => 255],
            [['title'], 'required'],
	[['title'], 'unique'],
            [['id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Отдел',
        ];
    }

    public function getEmployees()
    {
        return $this->hasMany(Employ::class, ['department_id' => 'id']);
    }
}
