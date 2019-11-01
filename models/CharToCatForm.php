<?php


namespace app\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * @property integer[] $characteristics
 */
class CharToCatForm extends Model
{
		public $characteristics;

		public function __construct(Category $category, $config = [])
		{
				if ($category) {
						$this->characteristics = ArrayHelper::getColumn($category->characteristics, 'id');
				}
				parent::__construct($config);
		}

		public function characteristicsList(): array
		{
				return ArrayHelper::map(Characteristic::find()->asArray()->all(), 'id', 'name');
		}

		public function attributeLabels()
		{
				return [
						'characteristics' => 'Характеристики'
				];
		}



}