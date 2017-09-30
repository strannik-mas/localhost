<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- Группировка Мюнха(быстрая группировка неповторяющихся элементов) -->
<!-- Задача: сгруппировать набор по автору без повторений -->
	
	<xsl:output method="html" 
				encoding="utf-8"
				doctype-public="-//W3C//DTD HTML 4.01//EN"
				doctype-system="http://www.w3.org/TR/html4/strict.dtd"
				indent="yes"/>		
				
	<xsl:key name="ixAuthor" match="/pricelist/book/author" use="." />			
	
	<!-- key('ixAuthor', 'Пупкин') -->
	
	<xsl:template match="/">
		<html>
			<head>
				<title>Наши книги</title>
			</head>
			<body>
				<h1>Наши книги</h1>
				<ul>
					<!-- Выборка неповторяющихся авторов -->
					<xsl:variable name="authors" 
					select="/pricelist/book/author[generate-id(.) = generate-id(key('ixAuthor', .))]" />
					
					<xsl:for-each select="$authors">
						<li>
							<xsl:variable name="currAuthor" select="." />
							<xsl:value-of select="." />
							<!-- Выберем книги этого автора -->
							<ul>
								<!-- <xsl:for-each select="/pricelist/book[author = $currAuthor]/title"> -->
								<xsl:for-each select="key('ixAuthor', $currAuthor)/../title">
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