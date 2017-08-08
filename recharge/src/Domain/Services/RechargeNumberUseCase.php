<?php

namespace Drupal\recharge\Domain\Services;

use Drupal\recharge\Domain\Entity\Number;
use Drupal\recharge\Domain\Repository\NumberRepository;
use Drupal\recharge\Domain\VO\Amount;
use Drupal\recharge\Domain\VO\PhoneNumber;

class RechargeNumberUseCase
{
    /** @var NumberRepository */
    private $numberRepository;

    public function __construct($numberRepository)
    {
        $this->numberRepository = $numberRepository;
    }

    public function execute($amount, $msisdn)
    {
        $number = new Number(
            Amount::anotherValue($amount),
            PhoneNumber::anotherValue($msisdn)
        );

        return $this
            ->numberRepository
            ->recharge($number);
    }
}