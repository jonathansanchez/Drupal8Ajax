<?php

namespace Test\recharge\Behavior;

use Drupal\recharge\Domain\Services\RechargeNumberUseCase;
use PHPUnit\Framework\TestCase;
use Test\recharge\Dependencies\Stub\AmountStub;
use Test\recharge\Dependencies\Stub\NumberStub;
use Test\recharge\Dependencies\Stub\PhoneNumberStub;
use Test\recharge\Dependencies\WithValuesRepository;

class RechargeNumberUseCaseTest extends TestCase
{
    /**
     * @test
     */
    public function tryToRechargeANumber()
    {
        $amount      = AmountStub::random();
        $phoneNumber = PhoneNumberStub::random();
        $number      = NumberStub::create($amount, $phoneNumber);

        $this->assertTrue(
            (new RechargeNumberUseCase(
                new WithValuesRepository($number)
            ))->execute(1, 1)
        );
    }
}