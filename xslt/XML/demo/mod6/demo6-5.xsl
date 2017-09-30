<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:a="myNamespace">
<!-- построить гистограмму колличества животных -->

	<xsl:output method="html" 
				encoding="utf-8"
				doctype-public="-//W3C//DTD HTML 4.01//EN"
				doctype-system="http://www.w3.org/TR/html4/strict.dtd"
				indent="yes"/>
	
	<!-- Вывод html страницы -->
	<xsl:template match="/">
		<html>
			<head>
				<title>Пример вывода простой гистограммы</title>
			</head>
			<body>
				<h1>Пример вывода простой гистограммы</h1>
				<div style="position:relative; height:300px">
				
					<!-- Считаем кошек -->
					<div style="position:absolute;left:50px;bottom:40px; width:40px;height:{count(/demo6/row[@animal = 'Кошка']) * 40}px;background-color:#f00;">
						<xsl:text disable-output-escaping="yes">
						<!-- <![CDATA[&nbsp;]]> -->
						</xsl:text>
					</div>
				
					<div style="position:absolute;left:50px;bottom:0px;">
						кошки
					</div>
				
					<!-- Считаем собак -->
					<div style="position:absolute;left:140px;bottom:40px; width:40px;height:{count(/demo6/row[@animal = 'Собака']) * 40}px;background-color:#0f0;">
						<xsl:text disable-output-escaping="yes">
						<!-- <![CDATA[&nbsp;]]> -->
						</xsl:text>
					</div>
				
					<div style="position:absolute;left:140px;bottom:0px;">
						собаки
					</div>
				
					<!-- Считаем слонов -->
					<div style="position:absolute;left:230px;bottom:40px; width:40px;height:{count(/demo6/row[@animal = 'Слон']) * 40}px;background-color:#00f;">
						<xsl:text disable-output-escaping="yes">
						<!-- <![CDATA[&nbsp;]]> -->
						</xsl:text>
					</div>
				
					<div style="position:absolute;left:230px;bottom:0px;">
						слоны
					</div>
				
				</div>
				<xsl:apply-templates select="/demo5/row" />
			</body>
		</html>
	</xsl:template>
	
	<!-- Вывод одного сообщения -->
	<xsl:template match="row">
		<p>
			<xsl:value-of select="@title" />
			<xsl:text> - </xsl:text>
			<xsl:value-of select="substring(@date, 9, 2)" />
			<xsl:text>.</xsl:text>
			<xsl:value-of select="substring(@date, 6, 2)" />
			<xsl:text>.</xsl:text>
			<xsl:value-of select="substring(@date, 1, 4)" />
		</p>
		<xsl:apply-templates select="message" />
	</xsl:template>


</xsl:stylesheet>