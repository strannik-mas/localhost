<?php
	try{
		// Создать SOAP-клиента
		$client = new SoapClient("http://mysite.local/soap_old/stock-full.wsdl");
		var_dump( $client->__getFunctions());
		// Послать SOAP-запрос c получением результат
		$result = $client->getStock("3");
		echo $result;
	} catch (SoapFault $e){
		echo 'Операция '.$e->faultcode.' вернула ошибку: '.$e->getMessage();
	}
		
	
?>