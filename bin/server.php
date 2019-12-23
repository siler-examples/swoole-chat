<?php declare(strict_types=1);

namespace Acme;

use Swoole\WebSocket\Frame;
use function Siler\Swoole\{broadcast, websocket};

require_once __DIR__ . '/../vendor/autoload.php';

$handler = function (Frame $frame) {
    echo "Message from client: {$frame->data}\n";
    broadcast($frame->data); // Envia para todos os clients conectados no websocket.
};

$server = websocket($handler, 8000);
$server->set([
    'enable_static_handler' => true,
    'document_root' => __DIR__ . '/../web'
]);
$server->start();

