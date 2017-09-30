<?php
class CBR
{
	const WSDL = "http://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?wsdl";
	protected $soap;
	// Дата запроса в формате SOAP
	protected $soapDate = "";
	// XML ответа Веб-службы
	protected $soapResponse = "";
	// Ассоциативный массив с кодами валют
	public $currencyCodes = array();
	public function __construct(){
		$this->soap = new SoapClient(self::WSDL);
		//$this->getCurrencyCodes();
	}
	// Параметры:
//   $timeStamp - дата/время в формате UNIX
//   $withTime - необязательно если true,
//                то преобразование вместе со временем суток,
//                иначе только дата
	function getSOAPDate($timeStamp, $withTime = false){
		$soapDate = date("Y-m-d", $timeStamp);
		return ($withTime) ?
			  $soapDate .  "T" . date("H:i:s", $timeStamp) :
			  $soapDate . "T00:00:00";
	}
	// Метод возвращает XML строку с результатами вызова Веб-службы
// Параметры:
//   $date - дата, на которую производится запрос 
	function getXML($date)
	{
		// Строка даты, на которую производится вызов
		$currentDate = $this->getSOAPDate($date);
		// Если предыдущий запрос службы был не на эту дату...
		if ($currentDate != $this->soapDate){
			$this->soapDate = $currentDate;
			// Формируем массив параметров
			$params["On_date"] = $currentDate;
			// Вызов Веб-службы
			$responce = $this->soap->GetCursOnDateXML($params);
			var_dump($responce);
			$this->soapResponse = $response->GetCursOnDateXMLResult->any;
		}
		// Возвращаем результат
		return $this->soapResponse;
	}
	// Параметры:
//   $currencyCode - код валюты: USD, EUR и т.п.
//   $date - необязательно, дата, на которую производится запрос,
//           0 - сегодня
	function getRate($currencyCode, $date = 0){
		if (!$date) $date = time();
		$xml = simplexml_load_string($this->getXML($date));
		/*
		$xPath = "/ValuteData/ValuteCursOnDate[VchCode=''$currencyCode'']";
		$result = $xml->xpath($xPath);
		if (count($result) == 0) return 0;
		return $result[0]->Vcurs / $result[0]->Vnom;
		*/
		return $xml;
	}
	// Метод заполняет массив кодов валют, по данным на текущий день
	/*
	 protected function getCurrencyCodes()
	 {
	  $xml = simplexml_load_string($this->getXML(time()));
	  $xPath = "/ValuteData/ValuteCursOnDate";
	  $allCurrencies = $xml->xpath($xPath);
	  foreach ($allCurrencies as $currency)
	   {
	   $code = trim($currency->VchCode);
	   $name = trim(iconv("UTF-8", "windows-1251",
							  $currency->Vname));
	   $this->currencyCodes[$code] = $name;
		}
	}
	*/
}
?>