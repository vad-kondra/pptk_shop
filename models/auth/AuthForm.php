<?php

namespace app\models\auth;

use app\models\user\User;
use Yii;
use yii\base\Model;


class AuthForm extends Model
{
    const SCENARIO_SIGN_IN = 'login';
    const SCENARIO_SIGN_UP = 'registration';
    const SCENARIO_PASSWORD_RESET = 'password_reset';
    const SCENARIO_PASSWORD_RESET_REQUEST = 'password_reset_request';
    const SCENARIO_ADMIN_UC = 'admin_user_create';


    public $f_name;
    public $l_name;
    public $p_name;
    public $username;
    public $email;
    public $phone;
    public $password_hash;
    public $password_repeat;
    public $rememberMe;
    public $role;

    public function rules()
    {
        return [

            [['email'], 'email', 'message' => getRuleMessage('email')],
            ['rememberMe', 'boolean'],


            //SIGN UP
            [['l_name', 'f_name', 'p_name'], 'filter', 'filter' => 'trim',
                'on' => self::SCENARIO_SIGN_UP],
            [['f_name', 'l_name', 'password_hash', 'password_repeat', 'phone', 'email'], 'required', 'message' => getRuleMessage('required'),
                'on' => self::SCENARIO_SIGN_UP],
            ['email', 'unique', 'targetClass' => '\app\models\user\User', 'message' => getRuleMessage('unique_email'),
                'on' => self::SCENARIO_SIGN_UP],
            [['email'], 'string', 'max' => 65, 'tooLong' => getRuleMessage('tooLong'),
                'on' => self::SCENARIO_SIGN_UP],
            [['password_hash'], 'string', 'min' => 6, 'max' => 22, 'tooShort' => 'Пароль должен содержать не менее 6 символов', 'tooLong' => getRuleMessage('tooLong'),
                'on' => self::SCENARIO_SIGN_UP],
            ['password_repeat', 'compare', 'compareAttribute' => 'password_hash', 'message' => getRuleMessage('compare_password'),
                'on' => self::SCENARIO_SIGN_UP],


            //SIGN IN
            [['email', 'password_hash'], 'required', 'message' => getRuleMessage('required'),
                'on' => self::SCENARIO_SIGN_IN],

            //SCENARIO_PASSWORD_RESET_REQUEST
            ['email', 'email', 'message' => getRuleMessage('email'),
                'on' => self::SCENARIO_PASSWORD_RESET_REQUEST],

            ['email', 'required',
                'on' => self::SCENARIO_PASSWORD_RESET_REQUEST, 'message' => getRuleMessage('required')],

            //SCENARIO_PASSWORD_RESET
            [['password_hash'], 'string', 'min' => 6, 'message' => 'Пароль должен содержать не менее 6 символов',
                'on' => self::SCENARIO_PASSWORD_RESET],

            ['password_repeat', 'compare', 'compareAttribute' => 'password_hash', 'message' => getRuleMessage('compare_password'),
                'on' => self::SCENARIO_PASSWORD_RESET],

            //common
            ['password_hash', 'string', 'min' => 6, 'max' => 22, 'tooShort' => 'Пароль должен содержать не менее 6 символов', 'tooLong' => getRuleMessage('tooLong'),
                'on' => self::SCENARIO_ADMIN_UC],
            ['password_repeat', 'compare', 'compareAttribute' => 'password_hash', 'message' => getRuleMessage('compare_password'),
                'on' => self::SCENARIO_ADMIN_UC],
            [['password_hash', 'password_repeat'], 'required', 'message' => getRuleMessage('required'),
                'on' => self::SCENARIO_ADMIN_UC],
            ['role', 'safe', 'on' => self::SCENARIO_ADMIN_UC],
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_SIGN_IN => ['email', 'password_hash', 'rememberMe'],
            self::SCENARIO_SIGN_UP => ['f_name','l_name', 'email','password_hash','password_repeat','phone'],
            self::SCENARIO_PASSWORD_RESET => ['password_hash', 'password_repeat'],
            self::SCENARIO_PASSWORD_RESET_REQUEST => ['email'],
            self::SCENARIO_ADMIN_UC => ['password_hash', 'password_repeat', 'role']
        ];
    }

    public function attributeLabels()
    {
        return User::instance()->attributeLabels();
    }

    public function setUserAttributes($user)
    {
        $user->username = $this->l_name.' '.$this->f_name;
        $user->email = $this->email;
        $user->setPassword($this->password_hash);
    }

    public function resetPassword($user)
    {
        $user->setPassword($this->password_hash);
        $user->generatePasswordResetToken();
        return $user->save(false);
    }

    public function setUsername()
    {
        $this->username = $this->f_name.' '.$this->l_name;
    }

    function getRoleList(){
        $roles = Yii::$app->authManager->getRoles();
        unset($roles['guest']);
        $arr = [];
        foreach ($roles as $role){
            $arr[$role->name] = $role->description;
        }
        return $arr;
    }

}