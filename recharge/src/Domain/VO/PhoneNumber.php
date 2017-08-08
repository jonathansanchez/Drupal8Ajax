<?php

namespace Drupal\recharge\Domain\VO;

class PhoneNumber
{
    /** @var  */
    private $phoneNumber;

    private function __construct($aPhoneNumber)
    {
        $this->phoneNumber = $aPhoneNumber;
    }

    static public function anotherValue(int $aPhoneNumber): PhoneNumber
    {
        return new self($aPhoneNumber);
    }

    public function value(): int
    {
        return $this->phoneNumber;
    }
}