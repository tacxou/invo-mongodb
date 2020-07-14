<?php
declare(strict_types=1);

/**
 * This file is part of the Invo.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace InvoMongodb\Libraries\Providers;

use MongoDB\Client;
use Phalcon\Config;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Exception;
use Phalcon\Incubator\Mvc\Collection\Manager;

/**
 * Class MongoProvider
 *
 * @package InvoMongodb\Libraries\Providers
 */
class MongoProvider implements ServiceProviderInterface
{
    /**
     * @param DiInterface $di
     * @throws Exception
     */
    public function register(DiInterface $di): void
    {
        $mongoConfig = $di
            ->getShared('config', new Config())
            ->get('mongo', new Config())
            ->toArray();

        if (!isset($mongoConfig['dbname'])) {
            throw new Exception('MongoDB dbname is required');
        }
        $di->setShared('mongo', function () use ($mongoConfig) {
            if (!empty($mongoConfig['username']) && !empty($mongoConfig['password'])) {
                $dsn = sprintf(
                    'mongodb://%s:%s@%s',
                    $mongoConfig['username'],
                    $mongoConfig['password'],
                    $mongoConfig['host']
                );
            } else {
                $dsn = sprintf(
                    'mongodb://%s',
                    $mongoConfig['host'] ?? '127.0.0.1'
                );
            }

            $mongo = new Client($dsn);
            return $mongo->selectDatabase($mongoConfig['dbname']);
        });

        $di->setShared('collectionsManager', new Manager());
    }
}