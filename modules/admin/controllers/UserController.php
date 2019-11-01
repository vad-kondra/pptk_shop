<?php

namespace app\modules\admin\controllers;


use app\models\auth\AuthForm;
use app\models\Image;
use app\models\user\Phone;
use app\models\user\ProfileSocial;
use app\models\user\User;
use app\models\user\UserRequest;
use app\modules\admin\models\search\UserSearch;
use Yii;
use yii\base\UserException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }



    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 16]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        $user = $this->findModel($id);

        return $this->render('view', [
          'model' =>$user,
          'modelProfile' => $user,
          //'modelBilling' => $user->getBillingInfo(),
        ]);

    }


    public function actionCreate()
    {
        $model = new User();

        $model->is_confirmed = true;
        $modelAuthForm = new AuthForm(['scenario' => AuthForm::SCENARIO_ADMIN_UC]);
        $modelAuthForm->role = User::ROLE_USER;

        $roleList = getRolesAsAssoc();
        unset($roleList['guest']);

        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            if ($model->load($request->post())  && $modelAuthForm->load( $request->post())) {

                $model->setUsername();
                $model->group_id = User::USER_NO_GROUP_ID;
                $model->password_hash = $modelAuthForm->password_hash;
                if ($model->save(false)) {

                    $model->assignRole($modelAuthForm->role);
                    addAlert('success', "Пользователь создан");
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    addAlert('danger', "Не удалось выполнить операцию!");
                    return $this->refresh();
                }

            }
        }
        return $this->render('create', [
            'model' => $model,
            'modelAuthForm' => $modelAuthForm,
            //'modelProfile' => $modelProfile,
            //'modelProfile' => $modelProfile,
            'roleList' => $roleList,
        ]);
    }


    public function actionUpdate($id)
    {
        $modelUser = $this->findModel($id);

        $modelAuthForm = new AuthForm(['scenario' => AuthForm::SCENARIO_ADMIN_UC]);
        $modelAuthForm->role = $modelUser->getRoleName(true);


        if ($modelUser->load(Yii::$app->request->post())  && $modelAuthForm->load( Yii::$app->request->post())) {
            if ($modelUser->save(false)) {
                $modelUser->assignRole($modelAuthForm->role);
                addAlert('success', "Пользователь изменен");
                return $this->redirect(['view', 'id' => $modelUser->id]);
            }else{
                return $this->refresh();
            }
        }

        return $this->render('update', [
            'model' => $modelUser,
            'modelUser' => $modelUser,
            'modelAuthForm' => $modelAuthForm,
        ]);
    }



    public function actionPersonal($id)
    {
        $modelUser = $this->findModel($id);

        if ($modelUser->load(\Yii::$app->request->post()) && $modelUser->validate())
        {
            $modelUser->save();
            addAlert('success', "Пользователь изменен");
            return $this->redirect(['view', 'id' => $modelUser->id]);
        }

        return $this->render('personal', [
            'modelUser' => $modelUser,
        ]);
    }

    public function actionRequest()
    {
        $title = 'Заявки';
        $dataProvider = new ActiveDataProvider([ 'query' => UserRequest::find()]);

        return $this->render('request',[
            'title' => $title,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionAccept($id)
    {
        $model = $this->findModelRequest($id);
        $user = new User();
        $modelPhone = new Phone();

        $password = Yii::$app->getSecurity()->generateRandomString(12);
        $user->company_name = $model->company_name;
        $user->username = $model->username;
        $user->email = $model->email;
        $user->is_confirmed = true;
        $user->setPassword($password);
        $modelPhone->number = $model->phone;
        $modelPhone->type = Phone::TYPE_USER;
        $content = "Ваша регистрационная заявка была принята. Ваш пароль: " . $password;
        sendMessageEmail($model->email, "Заявка", $content);
        if($user->save(false)){
            $modelPhone->item_id = $user->id;
            if(!$modelPhone->save()){
                $user->delete();
                addAlert('danger', 'Не удалось выполнить операцию!');
            }
            $user->assignRole(User::ROLE_BUYER);
            $model->delete();
            addAlert('success', 'Пользователь добавлен');
        }else{
            addAlert('danger', 'Не удалось выполнить операцию!');
        }
        return $this->redirect('request');
    }


    public function actionDecline($id)
    {
        $model = $this->findModelRequest($id);
        if($model->delete()){
            addAlert('success', t_app('Удалено!'));
        }else{
            addAlert('danger', t_app('Не удалось выполнить операцию'));
        }
        return $this->redirect('request');
    }


    public function actionDelete($id)
    {
        $user = $this->findModel($id);
        if($user->delete()) addAlert('warning', 'Пользователь удален');
        return $this->actionIndex();
    }



    public function actionDeleteCertImg(){
        $request = Yii::$app->request;
        if($request->isAjax){
            if($id = $request->post('img_id')){
                $image = Image::findOne(['id' => $id, 'type' => Image::TYPE_USER_CERT]);
                if(!$image) return false;
                if($image->delete()){
                    unlink_if_exists(Yii::getAlias('@webroot') . "/" . $image->src);
                    return true;
                }
                return false;
            }
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws UserException
     */
    protected function findModel($id): User
    {
        if (($model = User::findOne(['id=:user_id', 'user_id' => $id])) !== null) {
            return $model;
        }
        throw new UserException('Пользователь не найден!');
    }



}
