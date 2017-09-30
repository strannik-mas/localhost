<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- Переменные variable -->
	
	<xsl:output method="html" 
				encoding="utf-8"
				omit-xml-declaration="yes"
				cdata-section-elements="li"
				indent="yes"/>
				
	<xsl:variable name="helloWorld">Hello, World!</xsl:variable>
				
<!-- 	<xsl:variable name="catCollection">
		<cats>
			<cat name="Барсик" />
			<cat name="Мурка" />
		</cats>
	</xsl:variable> -->			
				
	<xsl:variable name="myBooks" select="pricelist/book[contains(title, 'XML')]" />			
	
	
	<xsl:template match="/">
		<html>
			<head>
				<title>Книги про XML</title>
			</head>
			<body>
				<h2>Пример вывода переменных</h2>
				<xsl:value-of select="$helloWorld" />
				<xsl:value-of select="$myBooks" />
				<hr />
<!-- 				<xsl:value-of select="$catCollection/cats/cat[1]/@name" /> -->
				<hr />
				
				<h2>Книги про XML</h2>
				<hr />
				<p>
					<xsl:text>Найдено </xsl:text>
					<xsl:value-of select="count($myBooks)" />
					<xsl:text> книг</xsl:text>
					<br />
					<xsl:text>Средняя цена </xsl:text>
					<xsl:value-of select="sum($myBooks/price)
					div
					count($myBooks)" />
					<xsl:text> руб.</xsl:text>
					<xsl:apply-templates select="$myBooks" />
				</p>
			</body>
		</html>
	</xsl:template>
	
	<xsl:template match="book">
		<div>
			<h3>
				<xsl:value-of select="title" />
			</h3>
			<strong>
				<xsl:value-of select="author" />
			</strong>
			<xsl:text> </xsl:text>
			<em>
				<xsl:value-of select="price" />
			</em>
		</div>
	</xsl:template>


</xsl:stylesheet>