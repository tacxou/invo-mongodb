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
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Exception;

/**
 * Class MongoProvider
 *
 * @package InvoMongodb\Libraries\Providers
 */
class MongoProvider implements ServiceProviderInterface
{
    /**
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        $di->setShared('config', function () use ($di) {
            $mongoConfig = $di->getShared('config')->get('mongo')->toArray();

            if (!isset($mongoConfig['dbname'])) {
                throw new Exception('MongoDB dbname is required');
            }

            if (isset($mongoConfig['username']) && isset($mongoConfig['password'])) {
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
    }
}