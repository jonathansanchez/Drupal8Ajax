<?php

namespace Test\recharge\Dependencies;


class WithValuesRepository
{
    private $number;

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function findOneByMsisdn($msisdn)
    {
        return $this->number;
    }

    public function recharge($msisdn)
    {
        return true;
    }
}