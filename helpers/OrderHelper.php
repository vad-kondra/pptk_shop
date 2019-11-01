<?php


namespace app\helpers;


use app\models\order\Status;
use app\models\Product;
use app\models\user\User;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

class OrderHelper
{
    public static function statusList(): array
    {
        return [
            Status::NEW =>        'Новый',
            Status::PROCESSING => 'В обработке',
            Status::COMPLETED =>  'Завершен',
            Status::CANCELED =>   'Отменен',
        ];
    }
    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }
    public static function statusLabel($status): string
    {
        switch ($status) {
            case Product::STATUS_DRAFT:
                $class = 'label label-default';
                break;
            case Product::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }

    public static function userName($user_id)
    {
        $user = User::findOne($user_id);
        if ($user) return $user->username;
        return 'Гость';
    }
}