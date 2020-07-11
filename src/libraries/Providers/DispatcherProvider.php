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

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Dispatcher;

/**
 * Class DispatcherProvider
 *
 * We register the events manager
 *
 * @package InvoMongodb\Libraries\Providers
 */
class DispatcherProvider implements ServiceProviderInterface
{
    /**
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        $di->setShared('dispatcher', function () {
            $eventsManager = new EventsManager();

            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('InvoMongodb\Controllers');
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        });
    }
}