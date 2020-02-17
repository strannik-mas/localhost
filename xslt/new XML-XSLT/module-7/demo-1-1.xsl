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
		
		
		
	<!-- Шаблон корневого элемента -->
	<xsl:template match="/">
		<html>
			<head>
				<title>Книги про XML</title>
			</head>
			<body>
				<h1>Книги про XML</h1>
				<table>
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
								<xsl:value-of select="$currentBook/price" />
							</td>							
						</tr>
					</xsl:for-each>				
				</table>

			</body>
		</html>
	</xsl:template>
	

	
	
</xsl:stylesheet>

							  