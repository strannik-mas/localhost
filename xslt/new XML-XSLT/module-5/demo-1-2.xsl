<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="/">
		<html>
			<body>
				<xsl:apply-templates select="/pricelist/book" />
			</body>
		</html>
	</xsl:template>	
	
	<xsl:template match="book">
		<div>
			<!-- Какой-то комментарий -->
			Заголовок: 
			<xsl:value-of select="title" />
			<xsl:value-of select="author" />!!!
		</div>
	</xsl:template>	
</xsl:stylesheet>

							  