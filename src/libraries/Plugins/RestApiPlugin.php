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

namespace InvoMongodb\Libraries\Plugins;

use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

/**
 * Class RestApiPlugin
 *
 * @package Invo\Plugins
 */
class RestApiPlugin extends Injectable
{
    /**
     * @param Event $event
     * @param Dispatcher $dispatcher
     */
    public function afterExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        if (is_array($dispatcher->getReturnedValue())) {
            $this->response->setJsonContent($dispatcher->getReturnedValue());
        }
    }
}