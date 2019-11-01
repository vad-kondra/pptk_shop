<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property integer $id
 * @property string $img_src
 *
 * @mixin ImageUploadBehavior
 */
class Photo extends ActiveRecord
{
    const PATH_TO_SAVE = 'images/upload/';

    public static function create(UploadedFile $file, string $newName): self
    {
        $photo = new static();
        try {
            $photo->img_src = Photo::saveImage(self::PATH_TO_SAVE, $file, $newName, ["extension" => ["jpg", "png", "jpeg"]]);
        } catch (ForbiddenHttpException $e) {}
        return $photo;
    }

    public static function tableName(): string
    {
        return '{{%shop_photos}}';
    }


    /**
     * Сохраняет загруженное изображение в указанную директорию
     * @param $pathToSave
     * @param UploadedFile $file
     * @param string $newName
     * @param array $options
     * @return string
     * @throws ForbiddenHttpException
     */
    public static function saveImage($pathToSave, UploadedFile $file, string $newName, $options = []){

        $ext = pathinfo($file->name)["extension"];
        if(isset($options["extension"]) && !in_array($ext,$options["extension"]))
            throw new \yii\web\ForbiddenHttpException("Расширение файла ".$ext." доступные расширения(".implode(",",$options["extension"]).")");
        if(!file_exists($pathToSave))
            throw new \yii\web\ForbiddenHttpException("Не существующая директория ".$pathToSave);

        $filepath = $pathToSave . $newName . "." . $ext;

        if(!move_uploaded_file($file->tempName, $filepath))
            throw new \yii\web\ForbiddenHttpException("Ошибка перемещения файла '".$file->tempName ."' в '". $filepath."''");

        return $filepath;
    }


    public function deleteImage()
    {
        unlink_if_exists($this->img_src);
    }

    public function beforeDelete(): bool
    {
        if (parent::beforeDelete()) {
            $this->deleteImage();
            return true;
        }
        return false;
    }


}