<?php


namespace app\models\profile;


use app\models\user\User;
use yii\base\Model;

class ProfileChangePassForm extends Model
{

		public $old_password;
		public $new_password;
		public $repeat_password;


		public function __construct(User $user, $config = [])
		{
				parent::__construct($config);
		}

		public function rules()
		{
				return [
						[['old_password', 'new_password', 'repeat_password'], 'required', 'message'=>getRuleMessage('required')],
						[['old_password', 'new_password', 'repeat_password'], 'string', 'max' => 255],
						['repeat_password', 'compare', 'compareAttribute' => 'new_password', 'message' => getRuleMessage('compare_password')]
				];
		}

		public function attributeLabels()
		{
				return [
						'old_password' => 'Старый пароль',
						'new_password' => 'Новый пароль',
						'repeat_password' => 'Повторите пароль',
				];
		}


}