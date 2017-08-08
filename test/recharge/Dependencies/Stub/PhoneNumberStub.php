<?php

namespace Test\recharge\Dependencies\Stub;

use Drupal\recharge\Domain\VO\PhoneNumber;

final class PhoneNumberStub
{
    public static function create(int $phoneNumber)
    {
        return PhoneNumber::anotherValue($phoneNumber);
    }

    public static function random()
    {
        return self::create(1);
    }
}
