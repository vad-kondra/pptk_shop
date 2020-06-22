<?php

namespace app\repositories\userRepository;

use app\models\user\User;
use app\repositories\NotFoundException;

class UserRepository
{

    public function get($id): User
    {
        return $this->getBy(['id' => $id]);
    }

    public function getByEmailConfirmToken($token): User
    {
        return $this->getBy(['email_confirm_token' => $token]);
    }

    public function getByEmail($email): User
    {
        return $this->getBy(['email' => $email]);
    }

    public function getByPasswordResetToken($token): User
    {
        return $this->getBy(['password_reset_token' => $token]);
    }

    public function existsByPasswordResetToken(string $token): bool
    {
        return (bool) User::findByPasswordResetToken($token);
    }

    /**
     * @param $productId
     * @return iterable|User[]
     */
    public function getAllByProductInWishList($productId): iterable
    {
        return User::find()
            ->alias('u')
            ->joinWith('wishlistItems w', false, 'INNER JOIN')
            ->andWhere(['w.product_id' => $productId])
            ->each();
    }

    /**
     * @param array $condition
     * @return User
     */
    private function getBy(array $condition): User
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('User not found.');
        }
        return $user;
    }
}