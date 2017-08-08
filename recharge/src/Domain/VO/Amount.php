<?php

namespace Drupal\recharge\Domain\VO;

use InvalidArgumentException;

final class Amount
{
    const MIN_AMOUNT = 1;
    const MAX_AMOUNT = 50000;

    /** @var  */
    private $amount;

    private function __construct($a_amount)
    {
        $this->amount = $this->validate($a_amount);
    }

    private function validate($a_amount)
    {
        if (null == $a_amount) {
            throw new InvalidArgumentException();
        }

        if ($this->isLessThanMinimumNumber($a_amount)) {
            throw new InvalidArgumentException();
        }

        if ($this->isBiggerThanMaxNumber($a_amount)) {
            throw new InvalidArgumentException();
        }

        return $a_amount;
    }

    private function isLessThanMinimumNumber(int $amount): bool
    {
        return $amount < self::MIN_AMOUNT;
    }

    private function isBiggerThanMaxNumber(int $amount): bool
    {
        return $amount > self::MAX_AMOUNT;
    }

    static public function min(): Amount
    {
        return new self(self::MIN_AMOUNT);
    }

    static public function max(): Amount
    {
        return new self(self::MAX_AMOUNT);
    }

    static public function anotherValue(int $a_amount): Amount
    {
        return new self($a_amount);
    }

    public function value(): int
    {
        return $this->amount;
    }

    public function increase(Amount $amount_to_increase): Amount
    {
        $increased_amount = $this->amount + $amount_to_increase->value();

        return new self($increased_amount);
    }


}