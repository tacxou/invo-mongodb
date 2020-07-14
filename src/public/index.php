<?php
declare(strict_types=1);

use Dotenv\Dotenv;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;

try {
    $rootPath = dirname(__DIR__, 2);
    /** @noinspection PhpIncludeInspection */
    require_once $rootPath . '/vendor/autoload.php';

    /**
     * Load ENV variables
     */
    Dotenv::createImmutable($rootPath)->load();

    /**
     * Init Phalcon Dependency Injection
     */
    $di = new FactoryDefault();
    $di->offsetSet('rootPath', function () use ($rootPath) {
        return $rootPath;
    });

    /**
     * Register Service Providers
     */
    $providers = $rootPath . '/src/config/providers.php';
    if (!file_exists($providers) || !is_readable($providers)) {
        throw new Exception('File providers.php does not exist or is not readable.');
    }

    /** @var array $providers */
    /** @noinspection PhpIncludeInspection */
    $providers = include_once $providers;
    foreach ($providers as $provider) {
        $di->register(new $provider());
    }

    /**
     * Init MVC Application and send output to client
     */
    (new Application($di))
        ->useImplicitView(false)
        ->handle($_SERVER['REQUEST_URI'])
        ->send();
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');

    echo json_encode([
        'status' => 255,
        'message' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
}