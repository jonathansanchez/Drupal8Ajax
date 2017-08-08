<?php

namespace Test\recharge\Dependencies\Stub;

use Drupal\recharge\Domain\Entity\Number;
use Drupal\recharge\Domain\VO\Amount;
use Drupal\recharge\Domain\VO\PhoneNumber;

final class NumberStub
{
    public static function create(Amount $amount, PhoneNumber $phoneNumber)
    {
        return new Number($amount, $phoneNumber);
    }

    public static function random()
    {
        return self::create(
            AmountStub::random(),
            PhoneNumberStub::random()
        );
    }
}
