<?php

use app\models\AboutContentForm;
use app\models\ContactsContentForm;
use app\models\employ\Employ;
use app\models\PhotoForm;
use app\models\TermsContentForm;
use app\modules\admin\models\FooterContentForm;
use app\modules\admin\models\HeaderContentForm;
use app\modules\admin\models\MainContentForm;
use mihaildev\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $main_logo PhotoForm */
/* @var $main MainContentForm */
/* @var $header HeaderContentForm */
/* @var $footer FooterContentForm */
/* @var $about AboutContentForm */
/* @var $contacts ContactsContentForm */
/* @var $employees Employ */
/* @var $terms TermsContentForm */

$this->title = 'Конфигурация сайта';
$this->params['breadcrumbs'][] =  [
    'template' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>",
    'label' => $this->title
];
?>
<div class="site-config-index">

    <ul class="nav nav-tabs">
        <li class="active main-config-tab-label"><a href="#main-config" data-toggle="tab">Общие</a></li>
<!--        <li class="header-config-tab-label"><a href="#header-config" data-toggle="tab">Заголовок сайта</a></li>-->
<!--        <li class="footer-config-tab-label"><a href="#footer-config" data-toggle="tab">Нижняя часть сайта</a></li>-->
        <li class="about-config-tab-label"><a href="#about-config" data-toggle="tab">О нас</a></li>
        <li class="contacts-config-tab-label"><a href="#contacts-config" data-toggle="tab">Контакты</a></li>
        <li class="terms-config-tab-label"><a href="#terms-config" data-toggle="tab">Пользовательское соглашение</a></li>
    </ul>

    <div class="tab-content site-config">
        <div class="tab-pane active" id="main-config">
            <?php $mainForm = ActiveForm::begin([
                'options' => ['method' => 'post', 'enctype'=>'multipart/form-data']
            ]); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">Общие</div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $mainForm->field($main, 'main_title')->textInput();?>
                                </div>
                            </div><div class="row">
                                <div class="col-md-12">
                                    <?= $mainForm->field($main, 'main_short_title')->textInput();?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $mainForm->field($main, 'main_phone_1')->widget(\yii\widgets\MaskedInput::class, [
                                        'mask' => '+38 (099) 999-99-99','clientOptions'=>['clearIncomplete'=>true]]); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $mainForm->field($main, 'main_phone_2')->widget(\yii\widgets\MaskedInput::class, [
                                        'mask' => '+38 (099) 999-99-99','clientOptions'=>['clearIncomplete'=>true]]); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $mainForm->field($main, 'main_email')->textInput();?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $mainForm->field($main, 'main_address')->textInput();?>
                                </div>
                            </div><div class="row">
                                <div class="col-md-12">
                                    <?= $mainForm->field($main, 'time_work')->textInput();?>
                                </div>
                            </div>

                            <?= Html::submitButton( 'Cохранить', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="tab-pane" id="header-config"></div>
        <div class="tab-pane" id="footer-config"></div>
        <div class="tab-pane" id="about-config">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">О нас</div>
                        <div class="box-body">
                            <?php $aboutForm = ActiveForm::begin([
                                'options' => ['method' => 'post', 'enctype'=>'multipart/form-data']
                            ]); ?>

                                <?= $aboutForm->field($about, 'about_text')->widget(CKEditor::class) ?>

                                <?= Html::submitButton( 'Cохранить', ['class' => 'btn btn-success']) ?>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="tab-pane" id="contacts-config">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">Контакты</div>
                        <div class="box-body">
                            <?php $contactsForm = ActiveForm::begin([
                                'options' => ['method' => 'post', 'enctype'=>'multipart/form-data']
                            ]); ?>

                            <?= $contactsForm->field($contacts, 'contacts_text')->widget(CKEditor::class) ?>

                            <?= Html::submitButton( 'Cохранить', ['class' => 'btn btn-success']) ?>

                            <?php ActiveForm::end(); ?>
                        </div>
                        <div class="box-body">
                            <h2 class="text-center mt-2 mb-2">Сотрудники</h2>
                            <?=Html::a('Добавить сотрудника', ['employ/create'], ['class' => 'btn btn-success'])?>
                            <?=Html::a('Добавить отдел', ['department/create'], ['class' => 'btn btn-success'])?>

                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'department.title',
                                    'surname',
                                    'name',
                                    'first_name',
                                    'position',
                                    'tel_1',
                                    'tel_2',
                                    'email:email',
                                    'skype',

                                    ['class' => 'yii\grid\ActionColumn',
                                        'urlCreator' => function ($action, $model) {
                                            return Url::to(['employ/'.$action, 'id' => $model->id]);
                                        }
                                    ],
                                ],
                            ]); ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="tab-pane" id="terms-config">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">Пользовательское соглашение</div>
                        <div class="box-body">
                            <?php $termsForm = ActiveForm::begin([
                                'options' => ['method' => 'post', 'enctype'=>'multipart/form-data']
                            ]); ?>

                            <?= $termsForm->field($terms, 'terms_text')->widget(CKEditor::class) ?>

                            <?= Html::submitButton( 'Cохранить', ['class' => 'btn btn-success']) ?>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
