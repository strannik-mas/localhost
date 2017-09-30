<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- Лаба 6-1-->

	<xsl:output method="html"
				omit-xml-declaration="yes"
				encoding="utf-8" />

	<xsl:key name="ixTeacher" match="/lab6_1/course/teachers/teacher" use="." />
	<xsl:key name="ixKeyword" match="/lab6_1/course/keywords/keyword" use="." />

	<xsl:template match="/lab6_1">
		<html>
			<body>
				<h1>Какие курсы читает Чебыкин Р.И.</h1>
				<ul>
					<xsl:for-each select="key('ixTeacher', 'Чебыкин Р.И.')">
						<li>
							<xsl:value-of select="../../title" />
						</li>
					</xsl:for-each>
				</ul>
				
				<h1>Какие курсы используют XML</h1>
				<ul>
					<xsl:for-each select="key('ixKeyword', 'XML')">
						<li>
							<xsl:value-of select="../../title" />
						</li>
					</xsl:for-each>
				</ul>
				
			</body>
		</html>
	</xsl:template>
	

</xsl:stylesheet>