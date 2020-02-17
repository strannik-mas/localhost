<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="/">
		<mydata>
			<xsl:apply-templates select="/pricelist/book" />
		</mydata>
	</xsl:template>	
	
	<xsl:template match="book">
		<xsl:element name="item-{position()}">
			<xsl:value-of select="title" />
		</xsl:element>
	</xsl:template>	
</xsl:stylesheet>

							  