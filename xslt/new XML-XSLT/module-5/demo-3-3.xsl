<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" 
		xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output method="html" />


	<xsl:template match="/">
		<html>
			<head>
				<title>Пример цикла</title>
			</head>
			<body>
				<h1>Пример цикла</h1>
				<ul>
					<xsl:for-each select="/stock/item">
						<li>
							<xsl:choose>
								<xsl:when test="@color='красный'">
									<xsl:attribute name="style">
										background-color:#fcc;
									</xsl:attribute>
								</xsl:when>
								<xsl:when test="@color='синий'">
									<xsl:attribute name="style">
										background-color:#ccf;
									</xsl:attribute>
								</xsl:when>								
								<xsl:when test="@color='желный'">
									<xsl:attribute name="style">
										background-color:#ffc;
									</xsl:attribute>
								</xsl:when>
							</xsl:choose>
							<xsl:value-of select="@name" />
						</li>
					</xsl:for-each>
				</ul>
			</body>
		</html>
	</xsl:template>	

</xsl:stylesheet>

							  