<?php


namespace app\models\cart\cost;


use app\models\user\User;
use Yii;

/**
 * Class Discount
 * @package app\models\cart\cost
 *
 * @property User $user
 */
class Discount
{
    private $user;

    public function __construct()
    {
        $this->user = Yii::$app->user->identity;
    }

    public function getValue(): float
    {
        return Yii::$app->user->isGuest ? 0 : $this->user->group->discount;
    }

}