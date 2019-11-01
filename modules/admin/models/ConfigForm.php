<?php


namespace app\modules\admin\models;

/**
 * @property MainContentForm $main
 * @property HeaderContentForm $header
 * @property FooterContentForm $footer
 */

use app\models\CompositeForm;
use yii\base\Model;

class ConfigForm extends CompositeForm
{
    public $main;
    public $header;
    public $footer;


    protected function internalForms(): array
    {
        return ['main', 'header', 'footer'];
    }
}