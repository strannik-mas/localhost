<?php
// Создание SOAP-клиента по WSDL-документу
//$wsdl = 'server.wsdl';
$client = new SoapClient("http://localhost/denwer/ajax/demo/module5/sample_server_1/server.wsdl");
// Поcылка SOAP-запроса и получение результата
header('Content-type: text/html; charset=utf-8');
echo $client->getTime(), '<br>';
echo $client->sayHello('Вася'), '<br>';
?>