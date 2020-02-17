<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output 
		method="html" 
		encoding="utf-8"
		doctype-public="-//W3C//DTD HTML 4.01//EN"
		doctype-system="http://www.w3.org/TR/html4/strict.dtd"
		indent="yes"/>

	<!-- Вывод HTML страницы -->
	<xsl:template match="/">
		<html>
			<head>
				<title>Пример вывода даты</title>
			</head>
			<body>
				<h1>Пример вывода даты</h1>
				<xsl:apply-templates select="/demo6/row" />
			</body>
		</html>
	</xsl:template>
	
	<!-- Вывод одного сообщения -->
	<xsl:template match="row">
		<p>
			<xsl:value-of select="@title" />
			<xsl:text> - </xsl:text>
			<xsl:value-of select="substring(@date, 9, 2)" />
			<xsl:text>.</xsl:text>
			<xsl:value-of select="substring(@date, 6, 2)" />
			<xsl:text>.</xsl:text>
			<xsl:value-of select="substring(@date, 1, 4)" />
		</p>
	</xsl:template>	
	
</xsl:stylesheet>

							  