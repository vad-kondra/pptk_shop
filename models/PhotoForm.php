<?php


namespace app\models;


use yii\base\Model;
use yii\web\UploadedFile;

class PhotoForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $image;

    public function rules(): array
    {
        return [
            ['image', 'image', 'extensions' => 'jpg, png, jpeg'],
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->image = UploadedFile::getInstance($this, 'image');
        }
        return true;
    }

}