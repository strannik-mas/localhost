<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:a="myNamespace">
<!-- Вывести даты в формате 01 декабря 2008 -->

	<xsl:output method="html" 
				encoding="utf-8"
				doctype-public="-//W3C//DTD HTML 4.01//EN"
				doctype-system="http://www.w3.org/TR/html4/strict.dtd"
				indent="yes"/>
	
	<!-- Вывод html страницы -->
	<xsl:template match="/">
		<html>
			<head>
				<title>Пример вывода даты</title>
			</head>
			<body>
				<h1>Пример вывода даты</h1>
				<xsl:apply-templates select="/demo5/row" />
			</body>
		</html>
	</xsl:template>
	
	<!-- Вывод одного сообщения -->
	<xsl:template match="row">
		<p>
			<xsl:value-of select="@title" />
			<xsl:text> - </xsl:text>
			<xsl:value-of select="substring(@date, 9, 2)" />
			<xsl:text> </xsl:text>
			<xsl:value-of 
			select="document('')/xsl:stylesheet/a:months/a:month[@no = substring(current()/@date, 6, 2)]" />
			<xsl:text> </xsl:text>
			<xsl:value-of select="substring(@date, 1, 4)" />
		</p>
		<xsl:apply-templates select="message" />
	</xsl:template>
	
	<a:months>
		<a:month no="01">января</a:month>
		<a:month no="02">февраля</a:month>
		<a:month no="03">марта</a:month>
		<a:month no="04">апреля</a:month>
		<a:month no="05">мая</a:month>
		<a:month no="06">июня</a:month>
		<a:month no="07">июля</a:month>
		<a:month no="08">августа</a:month>
		<a:month no="09">сентября</a:month>
		<a:month no="10">октября</a:month>
		<a:month no="11">ноября</a:month>
		<a:month no="12">декабря</a:month>
	</a:months>


</xsl:stylesheet>