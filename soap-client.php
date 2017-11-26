<?php
$client = new SoapClient("http://mysite.local/PHP-2017/course_3/soap/news.wsdl");
try{
    $result = $client->getNewsCount();
    echo "<p>Всего новостей: $result</p>";
    $resPol = $client->getNewsCountByCat(1);
    echo "<p>Всего новостей в категории политика: $resPol</p>";
    $resCur = $client->getNewsById(3);
    $news = unserialize(base64_decode($resCur));
    var_dump($news);
} catch (SoapFault $ex) {
    echo 'Операция '.$ex->faultcode.' вернула ошибку: '.$ex->getMessage();
}