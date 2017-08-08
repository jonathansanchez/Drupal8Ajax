<?php

namespace Drupal\recharge\Domain\Entity;

use Drupal\recharge\Domain\VO\Amount;
use Drupal\recharge\Domain\VO\PhoneNumber;

class Number
{
    /** @var  Amount $amount */
    private $amount;
    /** @var  PhoneNumber $msisdn */
    private $msisdn;

    public function __construct(Amount $amount, PhoneNumber $msisdn)
    {
        $this->setAmount($amount);
        $this->setMsisdn($msisdn);
    }

    private function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    private function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;
    }

    public function getMsisdn()
    {
        return $this->msisdn;
    }
}