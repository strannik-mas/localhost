<?php
error_reporting(E_ALL);
$client = new SoapClient("http://mysite.local/PHP-2017/course_3/newsoap/news2.wsdl");
//print_r($client->__getFunctions());
//var_dump($client);
try{
    
    $result = $client->getNewsCount();
    echo "<p>Всего новостей: $result</p>";
    $resPol = $client->getNewsCountByCat(1);
    echo "<p>Всего новостей в категории политика: $resPol</p>";
    $resCur = $client->getNewsById(1);
    $news = unserialize(base64_decode($resCur));
    var_dump($news);
} catch (SoapFault $ex) {
    echo 'Операция '.$ex->faultcode.' вернула ошибку: '.$ex->getMessage();
}