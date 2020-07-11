<?php
declare(strict_types=1);
die('lol');
use Phalcon\Config;

return new Config([
    'mongo' => [
        'host' => getenv('MONGO_HOST'),
        'username' => getenv('MONGO_USERNAME'),
        'password' => getenv('MONGO_PASSWORD'),
        'dbname' => getenv('MONGO_DBNAME')
    ],
    'application' => [
        'baseUri' => getenv('BASE_URI')
    ],
]);