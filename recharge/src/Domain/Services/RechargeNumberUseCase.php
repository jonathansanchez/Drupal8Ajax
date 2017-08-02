<?php

namespace Drupal\recharge\Domain\Services;

use Drupal\recharge\Domain\Entity\Number;
use Drupal\recharge\Domain\Repository\NumberRepository;

class RechargeNumberUseCase
{
    /** @var NumberRepository */
    private $numberRepository;

    public function __construct(NumberRepository $numberRepository)
    {
        $this->numberRepository = $numberRepository;
    }

    public function execute($amount, $msisdn)
    {
        $number = new Number($amount, $msisdn);

        $this
            ->numberRepository
            ->recharge($number);

        return true;
    }
}