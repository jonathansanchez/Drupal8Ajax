<?php

namespace Drupal\recharge\Event;

use Symfony\Component\EventDispatcher\Event;
use Drupal\recharge\Domain\Entity\Number;

class RechargeEvent extends Event
{
    const NAME = 'recharge.recharge_event';

    /** @var Number */
    private $number;

    public function __construct(Number $number)
    {
        $this->number = $number;
    }

    /**
     * Getter for the number object.
     *
     * @return Number
     */
    public function getNumber()
    {
        return $this->number;
    }
}