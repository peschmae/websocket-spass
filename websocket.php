<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Palaver\WsRelay;


    require getcwd() . '/vendor/autoload.php';
    require 'ws-relay.php';

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new WsRelay()
            )
        ),
        8090
    );

    $server->run();
