<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	
	<xsl:output
		method="html"
		encoding="UTF-8" />
	<xsl:template match="/">
		<html>
			<head>
				<title>Лаба 5_2</title>
			</head>
			<body>
				<h1>Список элементов</h1>
				<ul>
					<xsl:apply-templates select="/lab5_2/element" />
				</ul>
			</body>
		</html>
	</xsl:template>
	<xsl:template match="element">
		<li>
			<xsl:if test="position() mod 2 = 1">
				<xsl:attribute name="style">
					background-color:#fcc;
				</xsl:attribute>
			</xsl:if> 
			<xsl:value-of select="@name" />
			<xsl:text>: </xsl:text>
			<xsl:value-of select="@value" />
			
		</li>
	</xsl:template>
</xsl:stylesheet>