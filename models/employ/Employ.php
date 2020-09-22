<?php

namespace app\models\employ;

use app\models\Department;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "employ".
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
 * @property integer $department_id
 */

class Employ extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employ';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'first_name', 'position', 'tel_1', 'email'], 'required'],
            [['name', 'surname', 'first_name', 'position', 'tel_1', 'tel_2', 'email', 'skype'], 'string', 'min' => 2, 'max' => 255],
            [['department_id'], 'integer'],
            [['email'], 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'Отдел',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'first_name' => 'Отчество',
            'position' => 'Должность',
            'tel_1' => 'Телефон 1',
            'tel_2' => 'Телефон 2',
            'email' => 'Email',
            'skype' => 'Skype',
        ];
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id'])->orderBy(['id' => SORT_DESC]);
    }

    public function saveDepartment($department_id)
    {
        $this->department_id = $department_id;
        return $this->save(false);
    }

}
