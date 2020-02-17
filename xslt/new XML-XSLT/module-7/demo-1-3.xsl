<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output 
		method="html" 
		doctype-public="-//W3C//DTD HTML 4.01//EN" 
		doctype-system="http://www.w3.org/TR/html4/strict.dtd" 
		indent="yes"/>

		<xsl:variable name="myBooks" 
			select="/pricelist/book[contains(title, 'XML')]" />		
		
		
		
	<!-- Шаблон корневого элемента -->
	<xsl:template match="/">
		<html>
			<head>
				<title>Книги про XML</title>
			</head>
			<body>
				<h1>Книги про XML</h1>
					<xsl:call-template name="textBlock">
						<xsl:with-param name="title" select="'Найдено'" />
						<xsl:with-param name="text" select="concat(count($myBooks), ' книг.')" />
						<xsl:with-param name="background" select="'#ffd'" />
					</xsl:call-template>				

					<xsl:call-template name="textBlock">
						<xsl:with-param name="title" select="'Средняя цена'" />
						<xsl:with-param name="text" select="concat(sum($myBooks/price) div count($myBooks), ' руб.')" />
						<xsl:with-param name="background" select="'#f99'" />
					</xsl:call-template>				
				<xsl:apply-templates select="$myBooks" />
			</body>
		</html>
	</xsl:template>
	
	<!-- Вывод одной книги -->
	<xsl:template match="book">
		<xsl:call-template name="textBlock">
			<xsl:with-param name="title" select="title" />
			<xsl:with-param name="text" select="concat(author, ' ', price, ' руб.')" />
		</xsl:call-template>
	</xsl:template>
	
	<!-- Шаблон красивой отрисовки текста -->
	<xsl:template name="textBlock">
		<xsl:param name="title" />
		<xsl:param name="text" />
		<xsl:param name="background" select="'#fff'" />
		
		<div style="border-bottom:1px dotted black;background-color:{$background}">
			<h4>
				<xsl:value-of select="$title" />
			</h4>
			<p>
				<xsl:value-of select="$text" />
			</p>
		</div>
	</xsl:template>
	
	
	
	
</xsl:stylesheet>

							  