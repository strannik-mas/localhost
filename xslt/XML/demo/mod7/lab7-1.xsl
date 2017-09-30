<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<!-- Выборка узлов с множественной группировкой -->

	<xsl:output method="html" 
				encoding="utf-8"
				doctype-public="-//W3C//DTD HTML 4.01//EN"
				doctype-system="http://www.w3.org/TR/html4/strict.dtd"
				indent="yes"/>

	<xsl:key name="ixCity" match="/lab7/item/@city" use="." />
	<xsl:key name="ixOrg" match="/lab7/item/@org" use="concat(./../@city, ':', .)" />

	<xsl:template match="/">
		<html>
			<head>
				<title>Товары по группам</title>
			</head>
			<body>
				<h1>Товары по группам</h1>
				<table border="1" cellpadding="1" cellspacing="1">
					<xsl:variable name="Cities"
				select="/lab7/item/@city[generate-id(.) = generate-id(key('ixCity', .))]" />

					<xsl:for-each select="$Cities">
						<xsl:variable name="currCity" select="." />
						<xsl:variable name="Org" 
					select="/lab7/item/@org[generate-id(.) = generate-id(key('ixOrg', concat($currCity, ':', .)))]" />

						<xsl:for-each select="$Org">
							<xsl:variable name="currOrg" select="." />

							<xsl:for-each select="/lab7/item[@city = $currCity][@org = $currOrg]">
								<xsl:sort select="@title" data-type="text" />
								<tr>
									<td>
										<xsl:value-of 
									select="@title" />
									</td>
									<td>
										<xsl:value-of 
									select="@org" />
									</td>
									<td>
										<xsl:value-of 
									select="@city" />
									</td>
								</tr>
							</xsl:for-each>

							<tr>
								<td colspan="3" style="background-color:#ccc;">
									<xsl:text>В ассортименте компании: </xsl:text>
									<xsl:value-of 
									select="count(/lab7/item[@city = $currCity][@org = $currOrg])" />
									<xsl:text> товара</xsl:text>		
								</td>
							</tr>						
						</xsl:for-each>

						<tr>
							<td colspan="3" style="background-color:#fcc;">
								<xsl:text>В ассортименте компаний города: </xsl:text>
								<xsl:value-of 
									select="count(/lab7/item[@city = $currCity])" />
								<xsl:text> товаров</xsl:text>		
							</td>
						</tr>

					</xsl:for-each>
				</table>
			</body>
		</html>
	</xsl:template>

</xsl:stylesheet>