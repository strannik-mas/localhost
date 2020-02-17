<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output 
		method="html" 
		doctype-public="-//W3C//DTD HTML 4.01//EN" 
		doctype-system="http://www.w3.org/TR/html4/strict.dtd" 
		indent="yes"/>
		
	<xsl:key name="ixAuthor" match="/pricelist/book/author" use="." />	
	
	<!-- Шаблон корневого элемента -->
	<xsl:template match="/">
		<html>
			<head>
				<title>Наши книги</title>
			</head>
			<body>
				<ul>
					<!-- Выборка неповторяющихся авторов -->
					<xsl:variable name="authors" 
						select="/pricelist/book/author[generate-id(.) = generate-id(key('ixAuthor', .))]" />
					
					
					<xsl:for-each select="$authors">
						<li>
							<xsl:variable name="currAuthor" select="." />
							<xsl:value-of select="." />
							
							<!-- Выберем книжки этого автора -->
							<ul>
							<xsl:for-each select="/pricelist/book[author = $currAuthor]/title">
								<li>
									<xsl:value-of select="." />
								</li>
							</xsl:for-each>
							</ul>
						</li>
					</xsl:for-each>
				</ul>
			</body>
		</html>
	</xsl:template>
	
</xsl:stylesheet>

							  