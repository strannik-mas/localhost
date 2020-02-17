<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output 
		method="html" 
		doctype-public="-//W3C//DTD HTML 4.01//EN" 
		doctype-system="http://www.w3.org/TR/html4/strict.dtd" 
		indent="yes"/>

	<!--var-1-->		
	<!--var-2-->	
		
	<!-- Шаблон корневого элемента -->
	<xsl:template match="/">
		<html>
			<head>
				<title>Книги про XML</title>
			</head>
			<body>
				<!--helloWorld-->
				<hr />

				<h1>Книги про XML</h1>
				<p>
					<xsl:text>Найдено </xsl:text>
					<!--count()-->
					<xsl:value-of select="count(/pricelist/book[contains(title, 'XML')])" />	
					<xsl:text> книг</xsl:text>
					<br />
					<xsl:text>Средняя цена </xsl:text>
					<!--sum()-->
					<xsl:value-of select="
						sum(/pricelist/book[contains(title, 'XML')]/price) 
						div 
						count(/pricelist/book[contains(title, 'XML')])" />	
					<xsl:text> руб.</xsl:text>
				</p>
				<!--apply-templates-->
				<xsl:apply-templates select="/pricelist/book[contains(title, 'XML')]" />	
			</body>
		</html>
	</xsl:template>
	
	<!-- Вывод одной книги -->
	<xsl:template match="book">
		<div>
			<h3>
				<xsl:value-of select="title" />
			</h3>
			<strong>
				<xsl:value-of select="author" />
			</strong>
			<em>
				<xsl:value-of select="price" />
			</em>
		</div>	
	</xsl:template>
	
	
</xsl:stylesheet>

							  