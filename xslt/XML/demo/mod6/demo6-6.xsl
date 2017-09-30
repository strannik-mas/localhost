<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- Ключи и выборка узлов по ключу -->
	
	<xsl:output method="html" 
				encoding="utf-8"
				omit-xml-declaration="yes"
				cdata-section-elements="li"
				indent="yes"/>
	
	<!-- Ключи выбора книг -->
	<xsl:key name="ixBookId" match="/pricelist/book" use="position()" />
	<xsl:key name="ixBookTitle" match="/pricelist/book" use="title" />
	<xsl:key name="ixBookPrice" match="/pricelist/book" use="price" />
	<xsl:key name="ixBookTitleAuthor" match="/pricelist/book" use="concat(title, ':', author)" />
	
	<xsl:template match="/">
		<html>
			<head>
				<title>Наши книги</title>
			</head>
			<body>
				<xsl:value-of select="generate-id(/pricelist/book)" />
				<h2>Книга № 4</h2>
				<xsl:apply-templates select="key('ixBookId', '4')" />
				<h2>Книги XML</h2>
				<xsl:apply-templates select="key('ixBookTitle', 'XML')" />
				<h2>Книги стоимостью 200 руб.</h2>
				<xsl:apply-templates select="key('ixBookPrice', '200')" />
				<h2>Книги XML, написанные Хоумером</h2>
				<xsl:apply-templates select="key('ixBookTitleAuthor', 'XML:Алекс Хоумер')" />
			</body>
		</html>
	</xsl:template>
	
	<xsl:template match="book">
		<li>
			ID: <xsl:value-of select="generate-id()" /><br />
			<xsl:value-of select="author" />
			<xsl:text>, </xsl:text>
			<xsl:value-of select="title" />
			<xsl:text>, </xsl:text>
			<xsl:value-of select="price" />
			<xsl:text> руб.</xsl:text>
		</li>
	</xsl:template>


</xsl:stylesheet>