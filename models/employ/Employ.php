<?php

namespace app\models\employ;

use app\models\Department;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "employ".
 *
 * @property int $id
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
            [['name', 'surname', 'first_name', 'position', 'tel_1', 'tel_2', 'email', 'skype'], 'string', 'max' => 255],
            [['department_id'], 'number']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'first_name' => 'Отчество',
            'position' => 'Должность',
            'tel_1' => 'Tel 1',
            'tel_2' => 'Tel 2',
            'email' => 'Email',
            'skype' => 'Skype',
        ];
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }

    public function saveDepartment($department_id)
    {
        $department = Department::find()->one($department_id);
        if ($department !== null)
        {
            $this->link('department', $department);
            return true;
        }
    }
}
