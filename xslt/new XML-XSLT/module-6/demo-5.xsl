<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output 
		method="html" 
		encoding="UTF-8"
		omit-xml-declaration="yes"
		doctype-public="-//W3C//DTD HTML 4.01//EN"
		doctype-system="http://www.w3.org/TR/html4/strict.dtd"
		indent="yes"/>

	<!-- Вывод HTML страницы -->
	<xsl:template match="/">
		<html>
			<head>
				<title>Сообщения форума</title>
			</head>
			<body>
				<h1>Сообщения форума</h1>
				<hr />
				<h2>
					<xsl:value-of select="/forum/message/topic" />
				</h2>
				<xsl:apply-templates select="/forum/message" />
			</body>
		</html>
	</xsl:template>
	
	<!-- Вывод одного сообщения -->
	<xsl:template match="message">
		<div style="border-bottom:1px dotted black">
			<xsl:text>Автор: </xsl:text>
			
			<xsl:value-of 
				select="document('user-data.xml')/users/user[@login = current()/@author]/name" />
			<p>
				<xsl:value-of select="text" />
			</p>
		</div>
		<xsl:apply-templates select="message" />
	</xsl:template>	
	
</xsl:stylesheet>

							  