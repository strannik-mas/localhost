<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output 
		method="html" 
		encoding="utf-8"
		doctype-public="-//W3C//DTD HTML 4.01//EN"
		doctype-system="http://www.w3.org/TR/html4/strict.dtd"
		indent="yes"/>

	<!-- Ключ выбора книг по автору -->
	<xsl:key name="bookAutor" match="/pricelist/book" use="author" />

	<xsl:key name="bookAutorPrice" 
		match="/pricelist/book" 
		use="concat(author,':', price)" />
	
	
	
	<xsl:template match="/">
		<html>
			<head><title>Пример ключей</title></head>
			<body>
				<ul>
					<xsl:apply-templates 
						select="key('bookAutorPrice', 'Алекс Гомер:200')" />
				</ul>
			</body>
		</html>
	</xsl:template>

	
	<xsl:template match="book">
		<li>
			<xsl:for-each select="*">
				<xsl:value-of select="name()" />
				<xsl:text>: </xsl:text>
				<xsl:value-of select="." />
				<br />
			</xsl:for-each>
		</li>
	</xsl:template>		
</xsl:stylesheet>

							  