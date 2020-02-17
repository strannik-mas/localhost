<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" 
		xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
		xmlns:html="http://www.w3.org/1999/xhtml">

	<xsl:output method="html" />


	<xsl:template match="/">
		<html>
			<head>
				<title>Что есть на складе</title>
			</head>
			<body>
				<h1>Что есть на складе</h1>
				<ul>
					<xsl:apply-templates select="/stock/item" />
				</ul>
			</body>
		</html>
	</xsl:template>	

	
	<xsl:template match="item">
		<li>
			<xsl:value-of select="@name" />
			<xsl:if test="@onstore = 'yes'">
				НА СКЛАДЕ
			</xsl:if>
		</li>
	</xsl:template>
	
	
</xsl:stylesheet>
