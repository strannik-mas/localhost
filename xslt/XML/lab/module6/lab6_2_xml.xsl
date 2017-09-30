<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- Управление выводом документа -->

	<xsl:output method="xml" 
				encoding="utf-8"
				doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN"
				doctype-system="http://www.w3.org/1999/xhtml"
				indent="yes"/>
	
	<!-- Вывод html страницы -->
	<xsl:template match="/">
		<lab6Result>
			<xsl:apply-templates select="/lab6_1/course" />
		</lab6Result>
					
	</xsl:template>
	
	<!-- Вывод курса -->
	<xsl:template match="course">
		<xsl:copy>
			<xsl:attribute name="teacher">
				<xsl:value-of select="teachers/teacher" />
			</xsl:attribute>
			<xsl:apply-templates select="@*|node()" />
		</xsl:copy>		
	</xsl:template>
	<xsl:template match="@*|node()">

				<xsl:copy>
					<xsl:apply-templates select="@*|node()" />
				</xsl:copy>
				
	</xsl:template>

</xsl:stylesheet>