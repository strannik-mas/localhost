<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output method="xml" />


	<xsl:template match="/">
		<mytable>
			<xsl:apply-templates select="/mydata/table/row" />
		</mytable>
	</xsl:template>	
	
	
	<xsl:template match="row">
		<row>
			<xsl:apply-templates select="col" />
		</row>
	</xsl:template>	
	
	<xsl:template match="col">
		<xsl:element name="{/mydata/types/type[@col = @no]/@name}">
			<xsl:value-of select="." />
		</xsl:element>
	</xsl:template>	
</xsl:stylesheet>

							  