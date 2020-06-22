<?php

namespace app\modules\admin\models;

use Yii;
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
            [['file'], 'file', 'checkExtensionByMimeType' => false, 'skipOnEmpty' => false, 'extensions' => ['csv']],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if (!is_dir(Yii::getAlias('@webroot').'/csv')) {
                mkdir((Yii::getAlias('@webroot').'/csv'));
            }
            $this->file->saveAs('csv/' . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }
}