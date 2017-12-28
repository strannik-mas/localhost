<?php

namespace MyApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MyRatchetClass implements MessageComponentInterface {

    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
        
        //приветствие
        foreach ($this->clients as $client) {
            if ($conn !== $client) {
                $client->send($conn->resourceId.' присоеденился к чату');
            }else $client->send('ты присоеденился к чату');
        }
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        if(json_decode($msg) === NULL){
            echo sprintf('sending file');
            $binObj = new BinaryFileResponse($msg);
            foreach ($this->clients as $client) {
//                $client->send($binObj->sendContent());
            }
        }else{
            $numRecv = count($this->clients) - 1;
            echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
                , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
        }
        

        foreach ($this->clients as $client) {
//            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
//            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
        
        //пока пока
        foreach ($this->clients as $client) {
            $client->send($conn->resourceId.' ушёл');
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }

}
