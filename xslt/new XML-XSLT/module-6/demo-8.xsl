<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output 
		method="html" 
		encoding="utf-8"
		doctype-public="-//W3C//DTD HTML 4.01//EN"
		doctype-system="http://www.w3.org/TR/html4/strict.dtd"
		indent="yes"/>

	<xsl:template match="/">
		<xsl:apply-templates select="/pricelist/book" />
	</xsl:template>
	<xsl:template match="book">
		<li>
			<xsl:value-of select="author" />
			<xsl:text>, </xsl:text>
			<xsl:value-of select="title" />
			<xsl:text>, </xsl:text>
			<xsl:value-of select="price" />
			<xsl:text> руб.</xsl:text>
		</li>
	</xsl:template>	
</xsl:stylesheet>