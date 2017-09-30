<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- Узнать сколько книжек дороже 200 и вывести их на экран -->
	
	<xsl:template match="/">
		<html>
			<head>
				<title>Книжек дороже 200</title>
			</head>
			<body>
				<h1>Книжек дороже 200 - 
				<xsl:value-of select="count(/pricelist/book[price &gt; 200])" />
				шт.</h1>
				<hr />
				<ul>
					<xsl:apply-templates select="/pricelist/book[price &gt; 200]" />
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