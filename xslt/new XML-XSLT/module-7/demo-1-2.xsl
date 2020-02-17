<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	
	<xsl:output 
		method="html" 
		doctype-public="-//W3C//DTD HTML 4.01//EN" 
		doctype-system="http://www.w3.org/TR/html4/strict.dtd" 
		indent="yes"/>
		
		
	<xsl:variable name="myBooks" 
		select="/pricelist/book[contains(title, 'XML')]" />		
	
	<xsl:variable name="USD">28.3</xsl:variable>	
		
	<!-- Шаблон корневого элемента -->
	<xsl:template match="/">
		<html>
			<head>
				<title>Книги про XML</title>
			</head>
			<body>
				<h1>Книги про XML</h1>
				<table>
					<xsl:call-template name="tableHeader" />
					<xsl:for-each select="$myBooks">
						<xsl:variable name="currentBook" select="." />
						<tr>
							<td>
								<xsl:value-of select="$currentBook/title" />
							</td>
							<td>
								<xsl:value-of select="$currentBook/author" />
							</td>							
							<td>
								<xsl:call-template name="price">
									<xsl:with-param name="value" select="$currentBook/price" />
								</xsl:call-template>
								<xsl:text> (</xsl:text>
								<xsl:call-template name="price">
									<xsl:with-param name="value" select="$currentBook/price div $USD" />
									<xsl:with-param name="symbol" select="'$'" />
								</xsl:call-template>								
								<xsl:text>)</xsl:text>
								
							</td>							
						</tr>
					</xsl:for-each>				
				</table>

			</body>
		</html>
	</xsl:template>
	
	<xsl:template name="tableHeader">
		<tr>
			<td>Название</td>
			<td>Автор</td>
			<td>Цена</td>
		</tr>
	</xsl:template>
	
	<xsl:template name="price">
		<xsl:param name="value" />
		<xsl:param name="symbol">руб.</xsl:param>
		<span>
			<xsl:value-of select="format-number($value, '#.00')" />
			<xsl:text> </xsl:text>
			<xsl:value-of select="$symbol" />
		</span>
	</xsl:template>	
	
</xsl:stylesheet>

							  