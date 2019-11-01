<?php


namespace app\repositories;




use app\models\Brand;

class BrandReadRepository
{
		public function find($id): ?Brand
		{
				return Brand::findOne($id);
		}
}