<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- Ключи и выборка узлов по ключу -->
	
	<xsl:output method="html" 
				encoding="utf-8"
				omit-xml-declaration="yes"
				cdata-section-elements="li"
				indent="yes"/>
	
	<!-- Ключ выбора книг по автору -->
	<xsl:key name="bookAuthor" match="/pricelist/book" use="author" />
	
	<xsl:key name="bookAuthorPrice" match="/pricelist/book" use="concat(author, ':', price)" />
	
	<xsl:template match="/">
		<html>
			<head>
				<title>Пример ключей</title>
			</head>
			<body>
				<h1>Пример ключей</h1>
				<hr />
				<ul>
					<xsl:apply-templates select="key('bookAuthorPrice', 'Алекс Гомер:200')" />
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