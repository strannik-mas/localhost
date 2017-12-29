<?php

namespace Chat;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Yii;

class Chat implements MessageComponentInterface {

    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
        
        
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        if(is_array(json_decode($msg))){
            $tempArr = json_decode($msg);
            if($tempArr[0] === 'sayHello'){
                //обновляем статус текущего пользователя
                Yii::$app->db->createCommand()->update('users', ['status' => 1], '`username` = "'.$tempArr[1].'"')->execute();
                echo "User $tempArr[1] say hello\n";
                foreach ($this->clients as $client) {
                    $client->send("Пользователь $tempArr[1] вошёл в чат");
                }
            }
            if($tempArr[0] === 'sayBye'){
                //обновляем статус текущего пользователя
                Yii::$app->db->createCommand()->update('users', ['status' => 0], '`username` = "'.$tempArr[1].'"')->execute();
                echo "User $tempArr[1] say bye\n";
                foreach ($this->clients as $client) {
                    $client->send("Пользователь $tempArr[1] покинул чат");
                }
            }
            if($tempArr[0] === 'getAllUsers'){
                if($tempArr[1] !== 'admin')
                    $users = Yii::$app->db->createCommand("SELECT username, avatar_path, avatar_filename, mute, ban FROM users WHERE status=1")->queryAll();
                else 
                    $users = Yii::$app->db->createCommand("SELECT username, status, avatar_path, avatar_filename, mute, ban FROM users")->queryAll();
                // var_dump($users);
                $from->send(json_encode($users));
            }
            //выключатель
            if($tempArr[0] === 'tumbler'){                
                $mute = Yii::$app->db->createCommand("SELECT mute FROM users WHERE username=:uname")
                    ->bindValue(':uname', $tempArr[1])
                    ->queryOne();
                $m = $mute['mute']==='1' ? 0 : 1;
                Yii::$app->db->createCommand()->update('users', ['mute' => $m], '`username` = "'.$tempArr[1].'"')->execute();
                
                echo $m ? "On\n": "Off\n";
                var_dump($mute);
            }
            //бан
            if($tempArr[0] === 'ban'){                
                $ban = Yii::$app->db->createCommand("SELECT ban FROM users WHERE username=:uname")
                    ->bindValue(':uname', $tempArr[1])
                    ->queryOne();
                $b = $ban['ban']==='1' ? 0 : 1;
                Yii::$app->db->createCommand()->update('users', ['ban' => $b], '`username` = "'.$tempArr[1].'"')->execute();
                
                echo $b ? "On\n": "Off\n";
                var_dump($ban);
            }
        }else{
            $numRecv = count($this->clients) - 1;
            echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
                , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
            foreach ($this->clients as $client) {
                $client->send($msg);
            }
        }                  
        
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
        
        
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }

}
