<?php


namespace app\repositories;



use app\models\Characteristic;

class CharacteristicRepository
{
    public function get($id): Characteristic
    {
        if (!$characteristic = Characteristic::findOne($id)) {
            throw new NotFoundException('Characteristic is not found.');
        }

        return $characteristic;
    }

    public function save(Characteristic $characteristic): void
    {
        if (!$characteristic->save()) {
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }

    public function remove(Characteristic $characteristic): void
    {
        if (!$characteristic->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}