<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" 
		xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
		xmlns:ns1="http://igor-borisov.ru/namespace1"
		xmlns:ns2="http://igor-borisov.ru/namespace2">


	<xsl:template match="/">
		<xsl:value-of select="/demo/ns2:test/@message" />
		<br />
		<xsl:value-of select="/demo/comment()" />
		<br />
		<xsl:value-of select="/processing-instruction()" />
	</xsl:template>

</xsl:stylesheet>

							  