<?php


namespace app\models\cart\cost\calculator;


use app\models\cart\CartItem;
use app\models\cart\cost\Cost;

interface CalculatorInterface
{
		/**
		 * @param CartItem[] $items
		 * @return Cost
		 */
		public function  getCost(array $items): Cost;
}