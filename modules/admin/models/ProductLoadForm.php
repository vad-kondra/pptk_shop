<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Class ProductLoadForm
 * @package app\modules\admin\models
 *
 * @property UploadedFile $file
 */
class ProductLoadForm extends Model
{
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'checkExtensionByMimeType' => false, 'skipOnEmpty' => false, 'extensions' => ['xls']],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs('excel/' . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }
}