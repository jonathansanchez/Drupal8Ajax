<?php

namespace Test\recharge\Behavior;

use Drupal\recharge\Domain\Services\FindANumberUseCase;
use PHPUnit\Framework\TestCase;
use Test\recharge\Dependencies\EmptyRepository;
use Test\recharge\Dependencies\WithValuesRepository;

class FindANumberUseCaseTest extends TestCase
{
    /**
     * @test
     * @expectedException \Drupal\recharge\Domain\Services\Exception\NumberDoesNotExistException
     */
    public function tryToGetNonExistingNumber()
    {
        (new FindANumberUseCase(
            new EmptyRepository()
        ))->execute(1);
    }

    /**
     * @test
     */
    public function tryToGetAnExistingNumber()
    {
        $expected = (new FindANumberUseCase(
            new WithValuesRepository(1)
        ))->execute(1);

        $this->assertEquals(1, $expected);
    }
}