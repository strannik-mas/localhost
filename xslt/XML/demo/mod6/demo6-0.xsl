<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:key 
	name="mykey"
	match="/pricelist/book"
	use="price" />
	
	<xsl:template match="/">
		<html>
			<head>
				<title>Пример ключей</title>
			</head>
			<body>
				<h1>Книг за 200р 
				<xsl:value-of select="count(key('mykey', 200))" />
				<!-- <xsl:value-of select="count(/pricelist/book[price &gt; 150])" /> -->
				штук</h1>
				<hr />
				<ul>
					<!-- <xsl:apply-templates select="/pricelist/book[price &gt; 150]" /> --><xsl:apply-templates select="key('mykey', 200)" />
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