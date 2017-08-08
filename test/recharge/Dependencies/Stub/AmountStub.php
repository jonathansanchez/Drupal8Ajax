<?php

namespace Test\recharge\Dependencies\Stub;

use Drupal\recharge\Domain\VO\Amount;

final class AmountStub
{
    public static function create(int $amount)
    {
        return Amount::anotherValue($amount);
    }

    public static function random()
    {
        return self::create(1);
    }
}
