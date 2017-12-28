<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Chat\Chat;

require '../vendor/autoload.php';
require '../vendor/yiisoft/yii2/Yii.php';
$config = require '../config/web.php';

(new yii\web\Application($config))->run();

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080
);

$server->run();