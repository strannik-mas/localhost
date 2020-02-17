<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output 
		method="xml" 
		encoding="utf-8"
		doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
		doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
		omit-xml-declaration="yes"
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

							  