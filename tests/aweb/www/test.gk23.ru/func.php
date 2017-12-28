<?php
    define ('DB_HOST', 'localhost');
    define ('DB_NAME', 'task_db');
    define ('DB_LOGIN', 'task_db');
    define ('DB_PASSWORD', 'Z8c2W6y8');
    $linkPDO = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_LOGIN, DB_PASSWORD);
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $sql = "INSERT INTO test (name, tel) VALUES('{$_POST['name']}', '{$_POST['tel']}')";
        $res = $linkPDO->exec($sql);
        echo $res;
//    var_dump($sql);
    }