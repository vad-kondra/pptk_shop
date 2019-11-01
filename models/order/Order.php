<?php

namespace app\models\order;



use app\models\user\User;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Json;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property int $user_id

 * @property string $f_name
 * @property string $l_name
 * @property string $p_name
 * @property string $phone
 * @property string $email
 * @property string $city
 * @property string $post_index
 * @property string $address
 * @property int $cost
 * @property int $comment
 * @property int $current_status
 * @property string $cancel_reason
 * @property CustomerData $customerData
 *
 * @property OrderItem[] $items
 * @property User $user
 * @property Status[] $statuses
 */
class Order extends ActiveRecord
{
    public $customerData;
    public $statuses = [];

    public static function create($userId, CustomerData $customerData, array $items, $cost, $comment): self
    {
        $order = new static();
        $order->user_id = $userId;
        $order->customerData = $customerData;
        $order->items = $items;
        $order->cost = $cost;
        $order->comment = $comment;
        $order->f_name = $customerData->f_name;
        $order->l_name = $customerData->l_name;
        $order->p_name = $customerData->p_name;
        $order->phone = $customerData->phone;
        $order->email = $customerData->email;
        $order->city = $customerData->city;
        $order->post_index = $customerData->post_index;
        $order->created_at = time();
        $order->addStatus($userId, Status::NEW);
        return $order;
    }

    public function edit(CustomerData $customerData, $comment): void
    {
        $this->customerData = $customerData;
        $this->comment = $comment;
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'user' => 'Пользователь',
            'email' => 'Электронная почта',
            'phone' => 'Телефон',
            'cost' => 'Сумма',
            'status' => 'Статус',
            'current_status' => 'Текущий статус',
            'comment' => 'Комментарий заказчика',
            'created_at' => 'Создан',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['items'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%shop_orders}}';
    }


    public static function generateNumber($id)
    {
        //Логика генерации номера

        return '#'.$id;
    }


    private function addStatus($userId, $value): void
    {
        $this->statuses[] = new Status($userId, $value, time());
        $this->current_status = $value;
        $this->save();
    }

    public function isCompleted(): bool
    {
        return $this->current_status == Status::COMPLETED;
    }

    public function isCancelled(): bool
    {
        return $this->current_status == Status::CANCELED;
    }

    private function isProcessing(): bool
    {
        return $this->current_status == Status::PROCESSING;
    }


    /**
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getItems(): ActiveQuery
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }

    public function afterFind(): void
    {
        $arr = Json::decode($this->getAttribute('statuses_json'));

        $this->statuses = array_map(function ($row) {
            return new Status(
                $row['user_id'],
                $row['value'],
                $row['created_at']
            );
        }, $arr);

        parent::afterFind();
    }

    public function beforeSave($insert)
    {
        $this->setAttribute('statuses_json', Json::encode(array_map(function (Status $status) {
            return [
                'user_id' => $status->user_id,
                'value' => $status->value,
                'created_at' => $status->created_at,
            ];
        }, $this->statuses)));

        return parent::beforeSave($insert);
    }




    public function complete(): void
    {
        if ($this->isCompleted()) {
            throw new \DomainException('Заказ уже завершен.');
        }

        $this->addStatus(Yii::$app->user->identity->id,Status::COMPLETED);
    }


    public function cancel(): void
    {
        if ($this->isCancelled()) {
            throw new \DomainException('Заказ уже отменен.');
        }
        $this->addStatus(Yii::$app->user->identity->id,Status::CANCELED);
    }
    public function processing(): void
    {
        if ($this->isProcessing()) {
            throw new \DomainException('Заказ уже в обработке.');
        }

        $this->addStatus(Yii::$app->user->identity->id,Status::PROCESSING);
    }

}
