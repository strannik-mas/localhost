<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:my="http://www.specialist.ru/demo">
	
	
	<xsl:output method="html" />

		
	<!-- Шаблон корневого элемента -->
	<xsl:template match="/">
		<html>
			<head>
				<title>Наши занятия</title>
			</head>
			<body>
				<h1>Наши занятия</h1>
				<xsl:apply-templates select="/demo6/row" />
			</body>
		</html>
	</xsl:template>
	
	
	<!-- Шаблон row -->
	<xsl:template match="row">
		<p>
			<xsl:value-of select="@title" />
			<xsl:text> - </xsl:text>
			<xsl:value-of select="substring(@date, 9, 2)" />
			<xsl:text> </xsl:text>
			<xsl:value-of select="document('')/xsl:stylesheet/my:nameOfMonth/my:month[@no = substring(current()/@date, 6, 2)]" />
			<xsl:text> </xsl:text>
			<xsl:value-of select="substring(@date, 1, 4)" />
		</p>
	</xsl:template>
	
	<!-- Справочник -->	
	<my:nameOfMonth>
		<my:month no="01">января</my:month>
		<my:month no="02">февраля</my:month>
		<my:month no="03">марта</my:month>
		<my:month no="04">апреля</my:month>
		<my:month no="05">мая</my:month>
		<my:month no="06">июня</my:month>
		<my:month no="07">июля</my:month>
		<my:month no="08">августа</my:month>
		<my:month no="09">сентября</my:month>
		<my:month no="10">октября</my:month>
		<my:month no="11">ноября</my:month>
		<my:month no="12">декабря</my:month>
	</my:nameOfMonth>
</xsl:stylesheet>

							  