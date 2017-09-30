<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" 
				encoding="utf-8"
				doctype-public="-//W3C//DTD HTML 4.01//EN"
				doctype-system="http://www.w3.org/TR/html4/strict.dtd"
				indent="yes"/>	
	<xsl:key name="xCity" match="/lab7/item/@city" use="." />	
	<xsl:key name="xOrg" match="/lab7/item/@org" use="concat(./../@city, ':', .)" />
	<xsl:template match="/">
		<html>
			<head>
				<title>Товары по группам</title>
			</head>
			<body>
				<h1>Товары по группам</h1>
				<table border="1" cellpadding="1" cellspacing="1">
					<xsl:variable name="cityes" 
					select="/lab7/item/@city[generate-id(.) = generate-id(key('xCity', .))]" />
					<xsl:for-each select="$cityes">
						<xsl:variable name="currCity" select="." />
						<xsl:variable name="companies" 
						select="/lab7/item/@org[generate-id(.) = generate-id(key('xOrg', concat($currCity, ':', .)))]" />
						<xsl:for-each select="$companies">
							<xsl:variable name="currOrg" select="." />
								<xsl:for-each select="/lab7/item[@city = $currCity][@org = $currOrg]">
									<xsl:sort select="@title" data-type="text" />
									<tr>
										<td>
											<xsl:value-of select="@title" />
										</td>
										<td>
											<xsl:value-of select="@org" />
										</td>
										<td>
											<xsl:value-of select="@city" />
										</td>
									</tr>							
								</xsl:for-each>
							<tr>
								<td colspan="4" style="background-color:#12ccaa">
									<xsl:text>В ассортименте компании </xsl:text>
									<xsl:value-of select="$currOrg" />
									<xsl:text> </xsl:text>
									<xsl:value-of select="count(/lab7/item[@city = $currCity][@org = $currOrg])" />
									<xsl:text> товара(ов)</xsl:text>
								</td>
							</tr>
						</xsl:for-each>
						<tr>
							<td colspan="3" style="background-color:#33ffa2">
									<xsl:text>В городе </xsl:text>
									<xsl:value-of select="$currCity" />
									<xsl:text> </xsl:text>
									<xsl:value-of select="count(/lab7/item[@city = $currCity])" />
									<xsl:text> товара(ов)</xsl:text>
								</td>
						</tr>
					</xsl:for-each>
				</table>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>