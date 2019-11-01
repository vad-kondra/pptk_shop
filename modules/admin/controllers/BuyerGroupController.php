<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\BuyerGroupForm;
use app\modules\admin\models\search\UserSearch;
use Yii;
use app\models\BuyersGroup;
use app\models\BuyersGroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\user\User;

/**
 * UserGroupController implements the CRUD actions for UserGroup model.
 */
class BuyerGroupController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BuyersGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionChangeGroup($id) {

        $user = User::findOne($id);

        if ($model = Yii::$app->request->post('User')) {
            $group = $this->findModel($model['group']);
            $user->group_id = $group->id;
            $user->save();
            return $this->redirect(['buyer-group/view', 'id' => $group->id]);
        }
        return $this->render('changeGroup', ['user' => $user]);
    }


    /**
     * Displays a single UserGroup model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->searchByGroup($id);

        return $this->render('view', [
            'model' => $this->findModel($id),
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new UserGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BuyerGroupForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $group = BuyersGroup::create($model);
            $group->save();
            return $this->redirect(['view', 'id' => $group->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $group = $this->findModel($id);
        $form = new BuyerGroupForm($group);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $group->edit($form);
            return $this->redirect(['view', 'id' => $group->id]);
        }

        return $this->render('update', [
            'model' => $form,
            'group' => $group,
        ]);
    }

		/**
		 * Deletes an existing UserGroup model.
		 * If deletion is successful, the browser will be redirected to the 'index' page.
		 * @param integer $id
		 * @return mixed
		 * @throws NotFoundHttpException if the model cannot be found
		 * @throws \Throwable
		 * @throws \yii\db\StaleObjectException
		 */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BuyersGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): BuyersGroup
    {
        if (($model = BuyersGroup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
