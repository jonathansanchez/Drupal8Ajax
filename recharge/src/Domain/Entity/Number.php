<?php

namespace Drupal\recharge\Domain\Entity;

class Number
{
    /** @var  int $amount */
    private $amount;
    /** @var  int $msisdn */
    private $msisdn;

    public function __construct(int $amount, int $msisdn)
    {
        $this->setAmount($amount);
        $this->setMsisdn($msisdn);
    }

    private function setAmount(int $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    private function setMsisdn(int $msisdn)
    {
        $this->msisdn = $msisdn;
    }

    public function getMsisdn()
    {
        return $this->msisdn;
    }
}