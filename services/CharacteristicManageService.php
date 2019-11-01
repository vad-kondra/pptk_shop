<?php


namespace app\services;


use app\models\Characteristic;
use app\models\CharacteristicForm;
use app\repositories\CharacteristicRepository;

class CharacteristicManageService
{
    private $characteristics;

    public function __construct(CharacteristicRepository $characteristics)
    {
        $this->characteristics = $characteristics;
    }

    public function create(CharacteristicForm $form): Characteristic
    {
        $characteristic = Characteristic::create(
            $form->name,
            $form->type,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort
        );
        $this->characteristics->save($characteristic);
        return $characteristic;
    }

    public function edit($id, CharacteristicForm $form): void
    {
        $characteristic = $this->characteristics->get($id);
        $characteristic->edit(
            $form->name,
            $form->type,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort
        );
        $this->characteristics->save($characteristic);
    }

    public function remove($id): void
    {
        $characteristic = $this->characteristics->get($id);
        $this->characteristics->remove($characteristic);
    }

    public function get(int $id)
    {
        return $this->characteristics->get($id);
    }

    public function createFromTemp($row)
    {
        $characteristic = Characteristic::create(
            $row->name,
            Characteristic::TYPE_STRING,
            0,
            null,
            [],
            1
        );
        if (!Characteristic::findOne(['name' => $row->name])) {
            $this->characteristics->save($characteristic);
        }
        return $characteristic;

    }

}