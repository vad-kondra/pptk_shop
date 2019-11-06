<?php

namespace app\models\user;

use app\models\order\Order;
use app\models\product\Product;
use app\models\BuyersGroup;
use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

//use app\models\product\ProductGroup;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $f_name
 * @property string $l_name
 * @property string $p_name
 * @property string $city
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $company
 * @property string $post_index
 * @property string $password_hash
 * @property string $password_reset_token
 * @property int $group_id
 * @property string $auth_key
 * @property int $status
 * @property int $is_confirmed
 * @property string $created_at
 * @property string $deliveryAddress
 *
 * @property Order[] $orders
 * @property BuyersGroup $group
 *
 */
class User extends ActiveRecord implements IdentityInterface
{
    //"name" roles attribute
    const ROLE_ADMIN="admin";
    const ROLE_MANAGER="manager";
    const ROLE_USER="user";
    const ROLE_GUEST="guest";

    const USER_NO_GROUP_ID = 1 ;


    public $password_repeat;
    public $role;//for search

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['f_name', 'l_name', 'phone', 'email', 'password_hash',], 'required', 'message'=>getRuleMessage('required')],
            [['auth_key'], 'string', 'max' => 32],
            [['phone', 'email', 'company', 'city','post_index' ], 'string', 'max' => 25],
            [['username', 'p_name', 'address', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['created_at','status','f_name', 'l_name','is_confirmed', 'username'], 'safe'],
            ['email', 'email', 'message' => getRuleMessage('email')],
            [['email'], 'unique'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => BuyersGroup::class, 'targetAttribute' => ['group_id' => 'id']],
            [['username','f_name', 'l_name','p_name', 'phone','email','company','address'], 'trim']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя пользователя',
            'f_name' => 'Имя',
            'l_name' => 'Фамилия',
            'p_name' => 'Отчество',
            'email' => 'Эл. почта',
            'phone' => 'Телефон',
            'city' => 'Город',
            'address' => 'Адрес',
            'post_index' => 'Почтовый индекс',
            'company' => 'Компания',
            'password_hash' => 'Пароль',
            'password_repeat' => 'Повторите пароль',
            'is_confirmed' => 'Подтвержден',
            'created_at' => 'Создан',
            'created_atAlt' => 'Дата регистрации',
            'role' => 'Роль',
            'fullName' => 'Полное имя',
            'rememberMe' => 'Запомнить меня',
            'group' => 'Группа',
            'deliveryAdress' => 'Адрес доставки',
        ];
    }
    /*
        public function checkEmailList($attribute)
        {
            $emailsR = preg_replace('/\s+/', ' ', $this->company_emails);
            $this->company_emails = $emailsR;
            $emails = preg_split('/\s+/', $emailsR);
            $validator = new EmailValidator();
            if( is_array($emails ) ){
                foreach ($emails as $email) {
                    if (!$validator->validate($email)) {
                        $this->addError($attribute, getRuleMessage('email'));
                    }
                }
            }else{
                if (!$validator->validate($emails)) {
                    $this->addError($attribute, getRuleMessage('email'));
                }
            }
        }*/

    public function buyerGroupsList(): array
    {
        return ArrayHelper::map(BuyersGroup::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    public function beforeSave($insert){
        if (parent::beforeSave($insert)){
            if ($this->isNewRecord){
                $this->generateAuthKey();
                $this->generatePasswordResetToken();
                $this->setPassword($this->password_hash);
            }
            return true;
        }
        return false;
    }

    public function getRoleName($keyMode = false){
        $roles = Yii::$app->authManager->getRolesByUser($this->id);
        foreach ($roles as $role){
            if($role->name != "guest")
                return $keyMode ? $role->name : $role->description;
        }
        return '';
    }



    /**
     * @param $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    public function getPassword(){
        return $this->password_hash;
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return void the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function generateAuthKey()
    {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = \Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public static function findByPasswordResetToken($token){

        if ( !static::isPasswordResetTokenValid($token) ) {

            return null;
        }
        return self::findOne( ['password_reset_token' => $token] );
    }


    public function getProduction($m = true){
        if( empty($this->production) ){
            return $m ? 'Не указано' : null;
        }else{
            return $this->production;
        }
    }


    /**
     * Sends an email with a link, for resetting the password_hash.
     *
     * @return bool whether the email was send
     * @throws \yii\base\UserException
     */
    public function sendEmailPasswordReset()
    {

        if ( !self::isPasswordResetTokenValid($this->password_reset_token) ){
            $this->generatePasswordResetToken();
            if ( !$this->save() ) {
                return false;
            }
        }

        $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/password-reset', 'token' => $this->password_reset_token]);

        $linkLayout ="<a href='$resetLink'>". 'изменить пароль' . "</a>";

        $header = 'Изменение пароля';
        $content = "Вы отправили запрос для изменения пароля. Перейдите по ссылке, чтобы продолжить: ".$linkLayout . "<br/><b>" . "Проигнорируйте или удалите это сообщение если Вы не выполняли запрос изменения пароля!";
        $subject = 'Изменение пароля';
        if(sendMessageEmail($this->email, $header, $content, $subject)){
            return true;
        }else{
            return false;
        }
    }

    public function beforeDelete()
    {
        //UserSearch::deleteAll(['user_id'=>$this->id]);
        $orders = Order::find()->where(['user_id'=>$this->id])->all();
        if(sizeof($orders) >0){
            foreach ($orders as $order){
                $order->delete();
            }
        }
        return parent::beforeDelete();
    }


    public function afterDelete(){
        parent::afterDelete();
        Yii::$app->authManager->revokeAll($this->id);
    }

    public function getFullName(){
        if (empty($this->p_name))
            return $this->f_name.' '.$this->l_name;
        return $this->f_name.' '.$this->l_name.' '.$this->p_name;;
    }

    public function getRoleDesc(){
        $roles = Yii::$app->authManager->getRolesByUser($this->id);
        $result = '';

        if (!empty($roles))
        {
            foreach ($roles as $role)
            {
                $roleDesc = $role->description;
                $result .= $roleDesc . ', ';
            }
            $result = ltrim($result, ", ");

            return rtrim($result, ", ");
        }else{
            return 'нет';
        }
    }


    public function isCurrentUser(){
        if(Yii::$app->user->isGuest)
            return false;
        elseif ($this->id == Yii::$app->user->getId()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $roleName
     * @return bool
     * @throws \Exception
     */
    public function assignRole($roleName){
        $role = Yii::$app->authManager->getRole($roleName);
        if(!$role){
            return false;
        }
        Yii::$app->authManager->revokeAll($this->id);
        $res = Yii::$app->authManager->assign($role, $this->id);
        return !empty($res) ? true : false;
    }

    public function isHasRole($roleName){
        return isset(Yii::$app->authManager->getRolesByUser($this->id)[$roleName]);
    }


    /*public function getFilterProducts(){
        if($this->id == Yii::$app->user->getId()){
            $userProducts = Product::find()->where(["user_id" => $this->id])->orderBy([ 'id' => SORT_DESC ])->all();
        }else{
            $userProducts = Product::find()->where(["user_id" => $this->id])->andWhere(["is_confirmed"=> true])->orderBy([ 'id' => SORT_DESC ])->all();
        }
        return $userProducts;
    }*/

    /**
     * @return ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(BuyersGroup::className(), ['id' => 'group_id']);
    }


    /**
     * @return ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['user_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['user_id' => 'id']);
    }

    public function getDiscount() {
        if (isset($this->group)) {
            return $this->group->discount;
        }
        return 1 ;
    }

    public function setUsername()
    {
        $this->username = $this->f_name.' '.$this->l_name;
    }

}
