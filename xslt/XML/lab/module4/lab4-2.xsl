<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    
    <!--Шаблон корневого элемента-->
    <xsl:template match="/">
        <xsl:value-of select="count(/timeTable/week.chislitel/ponedelnik/para)" />
        <xsl:value-of select="/timeTable/week.chislitel/ponedelnik/para[1]/title" />
        <xsl:value-of select="/timeTable/week.chislitel/ponedelnik/para[2]/time" />
	</xsl:template>
 </xsl:stylesheet>
