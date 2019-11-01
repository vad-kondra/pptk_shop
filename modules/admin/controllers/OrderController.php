<?php

namespace app\modules\admin\controllers;

use app\helpers\OrderHelper;
use app\models\order\Order;
use app\models\OrderEditForm;
use app\models\OrderSearch;
use app\services\OrderManageService;
use DomainException;
use PHPExcel;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{

    private $service;

    public function __construct($id, $module, OrderManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id){

        return $this->render('view', [
            'order' => $this->findModel($id)
        ]);
    }


    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $order = $this->findModel($id);

        $form = new OrderEditForm($order);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($order->id, $form);
                return $this->redirect(['view', 'id' => $order->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'order' => $order,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Order
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * @return mixed
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     */
    public function actionExport()
    {
        $query = Order::find()->orderBy(['id' => SORT_DESC]);
        //print ('<pre>');print_r($query->all());die;


        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);

        $worksheet = $objPHPExcel->getActiveSheet();
        $worksheet->setTitle('Заказы '.date('Y-m-d', time()));

        $worksheet->setCellValueByColumnAndRow(0, 0, 'ID');
        $worksheet->setCellValueByColumnAndRow(1, 1, 'Статус');
        $worksheet->setCellValueByColumnAndRow(2, 2, 'Дата создания');
        $worksheet->setCellValueByColumnAndRow(3, 3, 'ФИО заказчика');
        $worksheet->setCellValueByColumnAndRow(4, 4, 'Email заказчика');
        $worksheet->setCellValueByColumnAndRow(5, 5, 'Телефон заказчика');
        $worksheet->setCellValueByColumnAndRow(6, 6, 'Общая сумма заказа');

        foreach ($query->each() as $row => $order) {
            /** @var Order $order */

            $worksheet->setCellValueByColumnAndRow(0, $row + 1, $order->id);
            $worksheet->setCellValueByColumnAndRow(1, $row + 1, $order->current_status);
            $worksheet->setCellValueByColumnAndRow(2, $row + 1, date('Y-m-d H:i:s', $order->created_at));
            $worksheet->setCellValueByColumnAndRow(3, $row + 1, $order->user->username);
            $worksheet->setCellValueByColumnAndRow(4, $row + 1, $order->email);
            $worksheet->setCellValueByColumnAndRow(5, $row + 1, $order->phone);
            $worksheet->setCellValueByColumnAndRow(6, $row + 1, $order->cost);

        }

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $file = tempnam(sys_get_temp_dir(), 'export');
        $objWriter->save($file);

        return Yii::$app->response->sendFile($file, 'zakazi_'.date('d-m-Y', time()).'.xlsx');
    }


    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     */
    public function actionExportExcelOrder($id)
    {
        $order = $this->findModel($id);

        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);

        $worksheet = $objPHPExcel->getActiveSheet();



        $worksheet->setCellValueByColumnAndRow(0, 1, 'ID');
        $worksheet->setCellValueByColumnAndRow(1, 1, 'Статус');
        $worksheet->setCellValueByColumnAndRow(2, 1, 'Дата создания');
        $worksheet->setCellValueByColumnAndRow(3, 1, 'ФИО заказчика');
        $worksheet->setCellValueByColumnAndRow(4, 1, 'Email заказчика');
        $worksheet->setCellValueByColumnAndRow(5, 1, 'Телефон заказчика');
        $worksheet->setCellValueByColumnAndRow(6, 1, 'Общая сумма заказа');

        $worksheet->setCellValueByColumnAndRow(0, 2, $order->id);
        $worksheet->setCellValueByColumnAndRow(1, 2, OrderHelper::statusName($order->current_status));
        $worksheet->setCellValueByColumnAndRow(2, 2, $order->created_at);
        $worksheet->setCellValueByColumnAndRow(3, 2, $order->user->username);
        $worksheet->setCellValueByColumnAndRow(4, 2, $order->email);
        $worksheet->setCellValueByColumnAndRow(5, 2, $order->phone);
        $worksheet->setCellValueByColumnAndRow(6, 2, $order->cost);




        $worksheet->setCellValueByColumnAndRow(0, 5, 'ID');
        $worksheet->setCellValueByColumnAndRow(1, 5, 'Название товара');
        $worksheet->setCellValueByColumnAndRow(1, 5, 'Артикул');
        $worksheet->setCellValueByColumnAndRow(2, 5, 'Количество в заказе');
        $worksheet->setCellValueByColumnAndRow(3, 5, 'Цена за 1 ед.');
        $worksheet->setCellValueByColumnAndRow(4, 5, 'Сумма всего');


        foreach ($order->items as $row=> $item) {

            $worksheet->setCellValueByColumnAndRow(0, $row + 6, $item->product->id);
            $worksheet->setCellValueByColumnAndRow(1, $row + 6, $item->product->name);
            $worksheet->setCellValueByColumnAndRow(2, $row + 6, $item->product->art);
            $worksheet->setCellValueByColumnAndRow(3, $row + 6, $item->quantity);
            $worksheet->setCellValueByColumnAndRow(4, $row + 6, $item->price);
            $worksheet->setCellValueByColumnAndRow(5, $row + 6, $item->getCost());

        }

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $file = tempnam(sys_get_temp_dir(), 'export');
        $objWriter->save($file);

        return Yii::$app->response->sendFile($file, 'zakaz_'.$order->id.'.xlsx');
    }


    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionProcessing($id)
    {
        $order = $this->findModel($id);

        try {
            $order->processing();

        } catch (DomainException $ex) {
            addAlert(ALERT_TYPE_DANGER,'Заказ уже в обработке');
        }
        return $this->redirect(['view', 'id' => $order->id]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionComplete($id)
    {
        $order = $this->findModel($id);
        try {
            $order->complete();
            addAlert(ALERT_TYPE_SUCCESS,'Заказ завершен');
        } catch (DomainException $ex) {
            addAlert(ALERT_TYPE_DANGER,'Заказ уже завершен');
        }
        return $this->redirect(['view', 'id' => $order->id]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCancel($id)
    {
        $order = $this->findModel($id);
        try {
            $order->cancel();
            addAlert(ALERT_TYPE_SUCCESS,'Заказ отменен');
        } catch (DomainException $ex) {
            addAlert(ALERT_TYPE_DANGER,'Заказ уже отменен');
        }
        return $this->redirect(['view', 'id' => $order->id]);
    }

}
