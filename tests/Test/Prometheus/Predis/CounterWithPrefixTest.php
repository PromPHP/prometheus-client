<?php

declare(strict_types=1);

namespace Test\Prometheus\Predis;

use Predis\Client;
use Prometheus\Storage\Predis;
use Prometheus\Storage\Redis;
use Test\Prometheus\AbstractCounterTest;

/**
 * See https://prometheus.io/docs/instrumenting/exposition_formats/
 * @requires extension redis
 */
class CounterWithPrefixTest extends AbstractCounterTest
{
    public function configureAdapter(): void
    {
        $client = new Client([
            'host'   => REDIS_HOST,
            'prefix' => 'prefix:',
        ]);

        $client->connect();

        $this->adapter = Predis::fromClient($client);
        $this->adapter->wipeStorage();
    }
}
