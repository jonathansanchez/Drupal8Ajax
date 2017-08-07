<?php

namespace Drupal\recharge\Domain\Services;

use Drupal\recharge\Domain\Repository\NumberRepository;
use Drupal\recharge\Domain\Services\Exception\NumberDoesNotExistException;

class FindANumberUseCase
{
    /** @var NumberRepository */
    private $numberRepository;

    public function __construct($numberRepository)
    {
        $this->numberRepository = $numberRepository;
    }

    public function execute(int $msisdn)
    {
        $number = $this->numberRepository->findOneByMsisdn($msisdn);
        if (empty($number)) {
            throw new NumberDoesNotExistException();
        }

        return $number;
    }
}