<?php

namespace Drupal\recharge\Domain\Repository;

use Drupal\recharge\Domain\Entity\Number;

/**
 * Interface Recharge
 * @package Domain\Repository
 *
 * This file must be implemented by infrastructure
 * REST API to persist phone number.
 */
interface NumberRepository
{
    /**
     * Recharge with amount a phone number
     *
     * @param Number $number
     *
     * @return bool true|false
     */
    public function recharge(Number $number);

    /**
     * Return a phone number
     *
     * @param int $msisdn
     *
     * @return object|bool
     */
    public function findOneByMsisdn(int $msisdn);
}