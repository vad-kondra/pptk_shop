<?php


namespace app\models;


use app\validators\SlugValidator;

/**
 * @property MetaForm $meta;
 */
class BrandForm extends CompositeForm
{
    public $name;
    private $_brand;

    public function __construct(Brand $brand = null, $config = [])
    {
        if ($brand) {
            $this->name = $brand->name;
            $this->meta = new MetaForm($brand->meta);
            $this->_brand = $brand;
        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique', 'targetClass' => Brand::class, 'filter' => $this->_brand ? ['<>', 'id', $this->_brand->id] : null]
        ];
    }
    public function internalForms(): array
    {
        return ['meta'];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название'
        ];
    }


}