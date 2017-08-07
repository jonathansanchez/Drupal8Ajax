<?php

namespace Drupal\recharge\Domain\VO;

class Amount
{
    /** @var  */
    private $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public static function getAmount($amount): Amount
    {
        return new self($amount);
    }
}