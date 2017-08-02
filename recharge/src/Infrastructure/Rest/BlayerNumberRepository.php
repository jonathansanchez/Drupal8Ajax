<?php

namespace Drupal\recharge\Infrastructure\Rest;

use Drupal\recharge\Domain\Entity\Number;
use Drupal\recharge\Domain\Repository\NumberRepository;
use GuzzleHttp\Client;

class BlayerNumberRepository implements NumberRepository
{
    const URL = 'https://api.github.com/';

    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Recharge a phone number in a
     * BLayer Service
     *
     * @param Number $number
     *
     * @return bool true|false
     */
    public function recharge(Number $number)
    {
        \Drupal::logger('recharge')->notice("Pasa con monto: " . $number->getAmount() . " y msisdn: " . $number->getMsisdn());

        return true;
    }
}