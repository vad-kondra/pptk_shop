<?php


namespace app\models\cart\cost;


class Cost
{
    private $value;
    private $discount;

    public function __construct(float $value, Discount $discount = null)
    {
        $this->value = $value;
        $this->discount = $discount;
    }

    public function withDiscount(Discount $discount): self
    {
        return new static($this->value, $discount);
    }

    public function getOrigin(): float
    {
        return $this->value;
    }

    public function getTotal(): float
    {
        return $this->value - ($this->value * $this->getDiscount()->getValue());
    }

    /**
     * @return Discount
     */
    public function getDiscount()
    {
        return $this->discount;
    }
}