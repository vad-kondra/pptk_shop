<?php

namespace app\modules\admin;

use yii\filters\AccessControl;
use yii\web\ErrorHandler;

/**
 * admin module definition class
 */
class Admin extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        \Yii::configure($this, [
            'components' => [
                'errorHandler' => [
                    'class' => ErrorHandler::class,
                    'errorAction' => 'admin/default/error',
                ],
            ]
        ]);
        /** @var ErrorHandler $handler */

        $handler = $this->get('errorHandler');

        \Yii::$app->set('errorHandler', $handler);

        $handler->register();

        // custom initialization code goes here
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin', 'manager'],
                    ],
                ],
            ],
        ];
    }





}
