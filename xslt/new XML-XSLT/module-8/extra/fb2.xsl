<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:fb2="http://www.gribuser.ru/xml/fictionbook/2.0">
	
	
	<xsl:output 
		method="html"
		encoding="windows-1251"
		indent="yes" />
	<!--
		Коренвой шаблон
	-->
	<xsl:template match="/">
		<div id="fb2">
			 <xsl:apply-templates select="/fb2:FictionBook/fb2:description/fb2:title-info/fb2:author" />
			 <h1>
				<xsl:value-of select="/fb2:FictionBook/fb2:description/fb2:title-info/fb2:book-title" />
			 </h1>
			 <xsl:apply-templates select="/fb2:FictionBook/fb2:body/fb2:epigraph" />
			 <xsl:apply-templates select="/fb2:FictionBook/fb2:body/fb2:section" />
		</div>
	</xsl:template>
	<!--
		Шаблон: автор
	-->
	<xsl:template match="fb2:author">
		<div class="author">
			<xsl:value-of select="fb2:last-name" />
			<![CDATA[ ]]>
			<xsl:value-of select="fb2:first-name" />
			<![CDATA[ ]]> 
			<xsl:value-of select="fb2:middle-name" />
		</div>
	</xsl:template>
	<!--
		Шаблон: эпиграф
	-->
	<xsl:template match="fb2:epigraph">
		<div class="epigraph">
			<xsl:apply-templates select="fb2:p" />
			<xsl:apply-templates select="fb2:text-author" />
		</div>
	</xsl:template>	
	<!--
		Шаблон: параграф эпиграфа
	-->
	<xsl:template match="fb2:epigraph/fb2:p">
		<p>
			<xsl:value-of select="." />
		</p>
	</xsl:template>	
	<!--
		Шаблон: автор эпиграфа
	-->
	<xsl:template match="fb2:epigraph/fb2:text-author">
		<p class="author">
			<xsl:value-of select="." />
		</p>
	</xsl:template>	
	<!--
		Шаблон: глава
	-->
	<xsl:template match="fb2:section">
		<div class="chapter">
			<xsl:apply-templates select="./fb2:*" />
		</div>
	</xsl:template>
	<!--
		Шаблон: Заголовок глава
	-->
	<xsl:template match="fb2:section/fb2:title">
		<h2>
			<xsl:value-of select="." />
		</h2>
	</xsl:template>
	<!--
		Шаблон: Заголовок глава
	-->
	<xsl:template match="fb2:section/fb2:section/fb2:title">
		<h2>
			<xsl:value-of select="." />
		</h2>
	</xsl:template>
	<!--
		Шаблон: Параграф главы
	-->
	<xsl:template match="fb2:section/fb2:p">
		<p>
			<xsl:value-of select="." />
		</p>
	</xsl:template>
	<!--
		Шаблон: Пустая линия
	-->
	<xsl:template match="fb2:section/fb2:empty-line">
		<br />
	</xsl:template>
	<!--
		Шаблон: Цитата
	-->
	<xsl:template match="fb2:section/fb2:cite">
		<div class="cite">
			<xsl:apply-templates select="fb2:p" />
			<xsl:apply-templates select="fb2:text-author" />
		</div>
	</xsl:template>	
	<!--
		Шаблон: параграф эпиграфа
	-->
	<xsl:template match="fb2:cite/fb2:p">
		<p class="cite">
			<xsl:value-of select="." />
		</p>
	</xsl:template>	
	<!--
		Шаблон: автор эпиграфа
	-->
	<xsl:template match="fb2:cite/fb2:text-author">
		<p class="citeAuthor">
			<xsl:value-of select="." />
		</p>
	</xsl:template>
	<!--
		Шаблон: Стихи
	-->
	<xsl:template match="fb2:section/fb2:poem">
		<div class="poem">
			<xsl:apply-templates select="fb2:stanza" />
		</div>
	</xsl:template>		
	<!--
		Шаблон: блок стихов
	-->
	<xsl:template match="fb2:poem/fb2:stanza">
		<div class="stanza">
			<xsl:apply-templates select="fb2:v" />
		</div>
	</xsl:template>
	<!--
		Шаблон: блок стихов
	-->
	<xsl:template match="fb2:stanza/fb2:v">
		<p>
			<xsl:value-of select="." />
		</p>
	</xsl:template>		
</xsl:stylesheet>

  