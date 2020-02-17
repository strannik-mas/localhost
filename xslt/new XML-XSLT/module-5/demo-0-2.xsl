<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="/">
		<html>
			<body>
				<xsl:apply-templates />
			</body>
		</html>
	</xsl:template>	

	<xsl:template match="processing-instruction()">
		<div style="color:blue">
			<xsl:value-of select="." />
		</div>
	</xsl:template>		
	
	<xsl:template match="comment()">
		<div style="color:green">
			<xsl:value-of select="." />
		</div>
	</xsl:template>	

	<xsl:template match="pricelist">
			<xsl:apply-templates select="/pricelist/book" />
	</xsl:template>
	
	
	<xsl:template match="book[price &gt; 200]">
		<div style="color:red">
			<xsl:value-of select="title" />
		</div>
	</xsl:template>	
	
	<xsl:template match="book">
		<div>
			<xsl:value-of select="title" />
		</div>
	</xsl:template>	
</xsl:stylesheet>
