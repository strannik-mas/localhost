<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- Узнать сколько книжек за 250 и вывести их на экран 
используя выборку по ключу-->

	<xsl:key name="myKey" match="/pricelist/book" use="price" />
	
	<xsl:template match="/">
		<html>
			<head>
				<title>Книжек за 250</title>
			</head>
			<body>
				<h1>Книжек за 250 - 
				<xsl:value-of select="count(key('myKey', 250))" />
				шт.</h1>
				<hr />
				<ul>
					<xsl:apply-templates select="key('myKey', 250)" />
				</ul>
			</body>
		</html>
	</xsl:template>
	
	<xsl:template match="book">
		<li>
			<xsl:for-each select="*">
				<xsl:value-of select="name()" />
				<xsl:text>:</xsl:text>
				<xsl:value-of select="." />
				<br />
			</xsl:for-each>
		</li>
	</xsl:template>


</xsl:stylesheet>