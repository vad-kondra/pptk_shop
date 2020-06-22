<?php
/**
 * Created by PhpStorm.
 * User: emrissol
 * Date: 16-Oct-18
 * Time: 10:26 PM
 */

namespace app\controllers;


use app\models\auth\AuthForm;
use app\models\Config;
use app\models\user\User;
use Yii;
use yii\base\UserException;
use yii\filters\VerbFilter;

class AuthController extends AppController
{
    public function actionSignIn()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new AuthForm(['scenario' => AuthForm::SCENARIO_SIGN_IN]);
        $message = '';

        if( $model->load( \Yii::$app->request->post() ) && $model->validate() )
        {
            $user = User::findOne(['email' => $model->email]);
            if ($user)
            {
                $user_hash = $user->getPassword();

                if (Yii::$app->getSecurity()->validatePassword($model->password_hash, $user_hash))
                {
                    if($user->is_confirmed){
                        $duration = $model->rememberMe ? 60*60*24 : 0;
                        Yii::$app->user->login($user, $duration);

                        if (Yii::$app->user->can(User::ROLE_MANAGER ) || Yii::$app->user->can(User::ROLE_ADMIN))
                        		return $this->redirect('/admin');
//                        $afterLoginUrl = Url::previous('after_login');
//                        if( !empty($afterLoginUrl) ){
//                            return Yii::$app->controller->redirect($afterLoginUrl);
//                        }
//                        elseif (Helper::checkRoute('/admin/default/index')){
//                            return $this->redirect('/admin');Чтобы подтвердить регистрацию перейдите по ссылке

                        return $this->goHome();
                    }else{
                        addGrowl( 'Ваш аккаунт не подтвержден! Проверьте указаную Вами при регистрации эл. почту, чтобы подтвердить!', 1400, 'warning');
                        return $this->refresh();
                    }
                } else {

                    $message = "Неверный пароль";
                }
            } else {
                $message = "Пользователь с такой эл. почтой не существует";
            }
        }
        return $this->render('signin', ['title' => 'Войти', 'model' => $model, 'message' => $message]);
    }

    public function actionSignUp(){
        if(!Yii::$app->user->isGuest) return $this->goHome();

        $authForm = new AuthForm(['scenario' => AuthForm::SCENARIO_SIGN_UP]);
        if($authForm->load(\Yii::$app->request->post()) && $authForm->validate()) {

            $authForm->setUsername();
            $user = new User();
            $user->setAttributes($authForm->attributes);
            $user->group_id = User::USER_NO_GROUP_ID;
            $user->save(false);

            $user->assignRole(User::ROLE_USER);

            //EMAIL
            if($this->confirmEmail($user->id)){
                addGrowl('На указаную Вами эл. почту было выслано письмо для подтверждения регистрации!',4400);
                return $this->redirect('sign-in');
            }

        }
        $title = 'Регистрация';

        return $this->render('signup', [ 'title' => $title, 'model' => $authForm ]);
    }

    //user-confirm-email

    /**
     * @param $userId
     * @return bool
     * @throws UserException
     */
    public function confirmEmail($userId): bool
    {
        $user = User::findOne($userId);

        $link = Yii::$app->urlManager->createAbsoluteUrl(['/auth/confirm', 'id' => $user->id, 'key' => $user->auth_key]);

        $linkLayout ="<a href='$link'>". 'подтвердить' . "</a>";

        $header = 'Подтверждение электронной почты';
        $content = 'Чтобы подтвердить регистрацию перейдите по ссылке:'.' '.$linkLayout;
        $subject = 'Регистрация на сайте "' . Config::getValue(Config::MAIN_TITLE).'"';

        return sendMessageEmail($user->email, $header, $content, $subject);
    }

    public function actionLogout()
    {
        if(!Yii::$app->session->isActive) return $this->goHome();
        Yii::$app->user->logout();
        return $this->redirect('/sign-in');
    }


    public function actionRecover(){
        $title = 'Изменение пароля';
        $model = new AuthForm(['scenario' => AuthForm::SCENARIO_PASSWORD_RESET_REQUEST]);
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $user = User::findOne(['email' => $model->email]);
            if(is_null($user)){
                addGrowl('Пользователь с такой эл. почтой не существует!', 2000,'warning');
                return $this->refresh();
            }
            if ( $user->sendEmailPasswordReset() ) {
                addGrowl('На указанную Вами эл. почту было выслано письмо для изменения пароля.');
                return $this->goHome();
            } else {
                addAlert('danger', 'Не удалось отправить письмо на указанную эл. почту!');
            }
        }
        return $this->render('recover', ['title' => $title, 'model' => $model]);
    }

    public function actionPasswordReset($token)
    {
        $title = 'Изменить пароль';
        $model = new AuthForm(['scenario' => AuthForm::SCENARIO_PASSWORD_RESET]);
        if (empty($token) || !is_string($token))
        {
            $exception_message =  'Пустой токен изменения пароля.';
            throw new UserException($exception_message);
        }
        $user = User::findByPasswordResetToken($token);

        if (!$user) {
            $e_message = 'Данная ссылка не действительна. Возможно Вы уже изменяли пароль по этой ссылке.';
            throw new UserException($e_message);
        }
        if ( $model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword($user) ) {
            addGrowl( 'Пароль изменен!');
            return $this->redirect(['sign-in']);
        }
        return $this->render('password-reset', ['title' => $title, 'model' => $model]);
    }

    public function actionConfirm($id, $key)
    {
        $user = User::findOne(['id' => $id, 'auth_key' => $key, 'is_confirmed' => false]);
        if(!empty($user))
        {
            $user->is_confirmed = true;
            $user->save(false);
            addGrowl( 'Регистрация подтверждена.');
            return $this->redirect('sign-in');
        }
        else{
            addGrowl('Не удалось подтвердить регистрацию. Возможно Ваш аккаунт уже подтвержден.' , 1400, 'warning');
            return $this->goHome();
        }
    }


    /*public function actionRequest(){
        $title = 'Отправить заявку';
        $model = new UserRequest();
        $renderParams = ['title' => $title, 'model' => $model,];
        if($model->load(Yii::$app->request->post())){
            $model->email = $model->emailAlt;
            if( !is_null(Phone::findOne(['number' => $model->phone])) ){
                addAlert('warning', 'Пользователь с таким моб. телефоном уже существует!');
                return $this->render('request', $renderParams);
            }
            if($model->save()){
                addAlert('success', 'Ваша заявка принята на рассмотрение!');
            }else{
                addAlert('danger', 'Не удалось выполнить операцию!'." ". 'Попробуйте позже.');
            }
            return $this->goHome();
        }

        return $this->render('request', $renderParams);
    }*/

    public function behaviors()
    {
        return [
          'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
              'logout' => ['post'],
            ],
          ],
        ];
    }
}