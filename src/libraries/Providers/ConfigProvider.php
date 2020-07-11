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
use Phalcon\Exception;

/**
 * Class ConfigProvider
 *
 * Read the configuration
 *
 * @package InvoMongodb\Libraries\Providers
 */
class ConfigProvider implements ServiceProviderInterface
{
    /**
     * @param DiInterface $di
     * @throws Exception
     */
    public function register(DiInterface $di): void
    {
        $configPath = $di->offsetGet('rootPath') . '/src/config/config.php';
        if (!file_exists($configPath) || !is_readable($configPath)) {
            throw new Exception('Config file does not exist: ' . $configPath);
        }

        $di->setShared('config', function () use ($configPath) {
            /** @noinspection PhpIncludeInspection */
            return require_once $configPath;
        });
    }
}