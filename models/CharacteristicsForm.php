<?php


namespace app\models;


/**
* @property ValueForm[] $values
*/

class CharacteristicsForm extends CompositeForm
{
    public $values;

    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->values = array_map(function (Characteristic $characteristic) use ($product) {
                return new ValueForm($characteristic, $product->getValue($characteristic->id));
            }, $product->characteristics);
        }
        parent::__construct($config);
    }

    protected function internalForms(): array
    {
        return ['values'];
    }
}