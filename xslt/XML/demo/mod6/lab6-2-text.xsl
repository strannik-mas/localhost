<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- Лаба 6-2-->

	<xsl:output method="text" 
				encoding="utf-8"/>
				

	<xsl:template match="/">
		<html>
			<head>
				<title></title>
			</head>
			<body>
				<xsl:apply-templates select="/lab6_1/course" />
			</body>
		</html>
	</xsl:template>
	
	<xsl:template match="course">
	
	<h2>Название курса: <xsl:value-of select="title" /></h2>
	<p>Ключевые слова: <xsl:variable name="count" select="count(keywords/keyword)" />
		<xsl:for-each select="keywords/keyword">
							<xsl:value-of select="." />
							<xsl:if test="position() &lt; $count">
								<xsl:text>, </xsl:text>
							</xsl:if>
							
		</xsl:for-each>
	</p>
	<p>Преподаватели: <xsl:variable name="count" select="count(teachers/teacher)" />
		<xsl:for-each select="teachers/teacher">
							<xsl:value-of select="." />
							<xsl:if test="position() &lt; $count">
								<xsl:text>, </xsl:text>
							</xsl:if>
							
		</xsl:for-each>
	</p>
	
	</xsl:template>

</xsl:stylesheet>