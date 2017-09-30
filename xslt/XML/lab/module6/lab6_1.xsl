<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"> 
	<xsl:output method="html" 
				omit-xml-declaration="yes"
				encoding="utf-8"/>
	<xsl:key 
		name="prepod"
		match="/lab6_1/course/teachers/teacher"
		use="." />
	<xsl:key 
		name="tema"
		match="/lab6_1/course/keywords/keyword" 
		use="." />	
	<xsl:template match="/">
		<html>
			<head>
				<title>Список курсов</title>
			</head>
			<body>
				<h2>Курсы, которые читает Чебыкин</h2>
				<hr />
				<ul>
					<xsl:for-each select="key('prepod', 'Чебыкин Р.И.')">
						<li>
							<xsl:value-of select="../../title" />
						</li>
					</xsl:for-each>
				</ul>
				<h2>Курсы, в которых рассматривается XML</h2>
				<hr />
				<ul>
					<xsl:for-each select="key('tema', 'XML')">
						<li>
							<xsl:value-of select="../../title" />
						</li>
					</xsl:for-each>
				</ul>
			</body>
		</html>
	</xsl:template>
	
	<!-- <xsl:template match="course">
		<li>
			<xsl:value-of select="title" />
		</li>
	</xsl:template> -->
</xsl:stylesheet>