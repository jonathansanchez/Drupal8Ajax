<?php

namespace Drupal\recharge\Infrastructure\Rest;

use Drupal\recharge\Domain\Entity\Number;
use Drupal\recharge\Domain\Repository\NumberRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class BlayerNumberRepository implements NumberRepository
{
    const URL = 'https://api.example.com/';

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
        try {
            $this
                ->client
                ->request('POST', self::URL . 'phone/' . $number->getMsisdn()->value(), [
                    'json' => ['amount' => $number->getAmount()->value()]
                ]);

            return true;
        } catch (RequestException $e) {
            return false;
        }
    }

    /**
     * Return a phone number
     *
     * @param int $msisdn
     *
     * @return object|bool
     */
    public function findOneByMsisdn(int $msisdn)
    {
        try {
            $response = $this
                ->client
                ->request('GET', self::URL . 'phone/' . $msisdn);

            return json_decode($response->getBody());
        } catch (RequestException $e) {
            return false;
        }
    }
}