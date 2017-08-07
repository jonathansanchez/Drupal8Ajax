<?php

namespace Test\recharge\Dependencies;


class EmptyRepository
{
    public function recharge($number)
    {
        return false;
    }

    public function findOneByMsisdn($msisdn)
    {
        return null;
    }
}