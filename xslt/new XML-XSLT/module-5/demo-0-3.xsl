<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="/">
		<xsl:call-template name="mytemplate" />
	
		<xsl:apply-templates 
			select="/pricelist/book[position() mod 2 = 0]" 
			mode="red"/>
			
		<xsl:apply-templates 
			select="/pricelist/book[position() mod 2 != 0]" 
			mode="green"/>
			
	</xsl:template>	

	<xsl:template match="book" mode="red">
		<div style="color:red">
			<xsl:value-of select="title" />
		</div>
	</xsl:template>

	<xsl:template match="book" mode="green">
		<div style="color:green">
			<xsl:value-of select="title" />
		</div>
	</xsl:template>	
	
	<xsl:template name="mytemplate">
		<h1>Используем атрибут mode</h1>
	</xsl:template>		
</xsl:stylesheet>

							  