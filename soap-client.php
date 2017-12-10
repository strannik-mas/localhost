<?php
	// Создание SOAP-клиента
	$client = new SoapClient("http://mysite.local/soap/news.wsdl");
	try{
		$result = $client->getNewsCount();
		echo "<p>Всего новостей: $result</p>";
		$result = $client->getNewsCountByCat(1);
		echo "<p>Всего новостей в категории политика: $result</p>";
		$result = $client->getNewsById(4);
		//var_dump($result);
		$news = unserialize(base64_decode($result));
		var_dump($news);
	}catch(SoapFault $e){
		echo 'Операция'.$e->faultcode.' вернула ошибку: '.$e->getMessage();
	}
?>