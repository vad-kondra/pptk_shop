<?php


namespace app\models;

use app\models\user\User;

/**
 * @property CustomerForm $customer
 * @property string $comment
 */
class OrderForm extends CompositeForm
{
    public $comment;

    public function __construct(User $user = null,array $config = [])
    {
        $this->customer = new CustomerForm();
        if (isset($user)) {
            $this->customer->f_name = $user->f_name;
            $this->customer->l_name = $user->l_name;
            $this->customer->email = $user->email;
            $this->customer->phone = $user->phone;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['comment'], 'string', 'max' => 255],
        ];
    }
    protected function internalForms(): array
    {
        return ['customer'];
    }

    public function attributeLabels()
    {
        return [
            'comment' => 'Дополнительные сведения',
        ];
    }

}