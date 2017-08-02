<?php

namespace Drupal\recharge\Domain\Services;

use Drupal\recharge\Domain\Repository\NumberRepository;

class FindANumberUseCase
{
    /** @var NumberRepository */
    private $numberRepository;

    public function __construct(NumberRepository $numberRepository)
    {
        $this->numberRepository = $numberRepository;
    }

    public function execute(int $msisdn)
    {
        return $this
            ->numberRepository
            ->findOneByMsisdn($msisdn);
    }
}