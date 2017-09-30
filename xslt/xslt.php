<?php
	//Создание объекта XML
	$xml = new DomDocument();
	//Загрузка XML документа
	$xml->load("XML/lab/module6/lab6_2.xml");
	//$xml->formatOutput = true;
	//$xml->preserveWhiteSpace = false;
	//Создание объекта XSL
	$xsl = new DomDocument();
	//Загрузка XSL документа
	$xsl->load ("XML/lab/module6/lab6_2_xml.xsl");
	//Создание XSLT парсера
	$pr = new XSLTProcessor();
	//Загрузка XSL объекта
	$pr->importStylesheet($xsl);
	//Парсинг
	$html = $pr->transformToXml($xml);
	echo $html;
?>