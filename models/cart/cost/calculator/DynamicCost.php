<?php


namespace app\models\cart\cost\calculator;




use app\models\cart\cost\Cost;
use app\models\cart\cost\Discount;

class DynamicCost implements CalculatorInterface
{
		private $next;

		public function __construct(CalculatorInterface $next)
		{
				$this->next = $next;
		}

		public function getCost(array $items): Cost
		{
				$cost = $this->next->getCost($items);
				$cost = $cost->withDiscount(new Discount());

				return $cost;
		}
}