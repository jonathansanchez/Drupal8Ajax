<?php

namespace Drupal\recharge\Domain\VO;

class PhoneNumber
{
    /** @var  */
    private $phoneNumber;

    public function __construct(int $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public static function getPhoneNumber($phoneNumber): PhoneNumber
    {
        return new self($phoneNumber);
    }
}