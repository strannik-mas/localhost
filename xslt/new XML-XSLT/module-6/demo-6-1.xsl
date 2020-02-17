<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
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
	
	
	<!-- Шаблон занятия -->
	<xsl:template match="row">
		<p>
			<!-- Красивая отрисовка даты -->
			<xsl:value-of select="@title" />
			<xsl:text> - </xsl:text>
			<xsl:value-of select="substring(@date, 9, 2)" />
			<xsl:text>.</xsl:text>
			<xsl:value-of select="document('month.xml')/months/month[@no = substring(current()/@date, 6, 2)]" />
			<xsl:text>.</xsl:text>
			<xsl:value-of select="substring(@date, 1, 4)" />
		</p>
	</xsl:template>

</xsl:stylesheet>

							  