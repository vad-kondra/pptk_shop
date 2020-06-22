<?php

namespace app\controllers;

use app\models\profile\ProfileChangePassForm;
use app\models\profile\ProfileInfoForm;
use app\models\user\User;
use app\services\OrderManageService;
use Yii;
use yii\filters\AccessControl;

class UserController extends AppController
{
    private $_orderService;

    public function __construct(
        $id,
        $module,
        OrderManageService $orderService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->_orderService = $orderService;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionProfile(){
        $user = $this->findModel();
        $profileInfoForm = new ProfileInfoForm($user);
        $profileChangePassForm = new ProfileChangePassForm($user);

        if ($profileInfoForm->load(Yii::$app->request->post()) && $profileInfoForm->validate()) {
            $user->username = $profileInfoForm->username;
            $user->f_name   = $profileInfoForm->f_name;
            $user->l_name   = $profileInfoForm->l_name;
            $user->p_name   = $profileInfoForm->p_name;
            $user->company  = $profileInfoForm->company;
            $user->email    = $profileInfoForm->email;
            $user->phone    = $profileInfoForm->phone;

            if ($user->save()){
                addGrowl( 'Изменения в профиль пользователя сохранены', 1400, 'success');
            }
        }

        if ($profileChangePassForm->load(Yii::$app->request->post()) && $profileChangePassForm->validate()) {
            if (Yii::$app->getSecurity()->validatePassword($profileChangePassForm->old_password, $user->getPassword())) {
                $user->setPassword($profileChangePassForm->new_password);
                if ($user->save()) addGrowl('Новый пароль сохранен', 1400, 'success');
                else addGrowl('Старый пароль не совпадает', 1400, 'danger');
            }
        }

        return $this->render('profile', [
            'user' => $user,
            'orders' => $this->_orderService->getAllUserOrders($user->id),
            'profileInfoForm' => $profileInfoForm,
            'profileChangePassForm' => $profileChangePassForm,
        ]);
    }

    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }
}