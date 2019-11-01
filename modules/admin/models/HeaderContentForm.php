<?php

namespace app\modules\admin\models;

use app\models\CompositeForm;
use app\models\Photo;
use app\models\PhotoForm;


/**
 * @property PhotoForm $new_logo
 * @property Photo $img_logo
 *
 */

class HeaderContentForm extends CompositeForm
{
    public $img_logo;
    public $new_logo;

    public function __construct($config = [])
    {
        $this->new_logo = new PhotoForm();
        parent::__construct($config);
    }

    protected function internalForms(): array
    {
        return ['photo'];
    }
}