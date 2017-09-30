/*
** Функции XSLT преобразования
*/ 

// Функция выполняет XSLT преобразование в объект
function xsltTransform(domXML, domXSL)
{
	try
	{
		if (window.XSLTProcessor)
		{
			// Это Mozilla...
			var xsltProcessor = new XSLTProcessor(); 
			xsltProcessor.importStylesheet(domXSL); 
			var resultDOM = xsltProcessor.transformToDocument(domXML); 
			var serializer = new XMLSerializer();
			return serializer.serializeToString(resultDOM);
		}
		else if (window.ActiveXObject && typeof(domXML.transformNode) != "undefined")
		{
			// Это Internet Explorer 9 и ниже
			//var result = new ActiveXObject("Msxml2.DOMDocument.3.0"); эта строка не нужна
			return domXML.transformNode(domXSL);
		}
		else if (typeof(domXML.transformNode) == "undefined")
		{
			// Это Internet Explorer 10 и выше
			
			//alert("this IE10-11"); 
			var xslt = new ActiveXObject("Msxml2.XSLTemplate.6.0");
			var xslDoc = new ActiveXObject("Msxml2.FreeThreadedDOMDocument.6.0");
			var xslProc;
			xslDoc.async = false;
			xslDoc.load(domXSL);
			if (xslDoc.parseError.errorCode != 0) {
			   var myErr = xslDoc.parseError;
			   alert("You have error " + myErr.reason);
			} else {
			   xslt.stylesheet = xslDoc;
			   var xmlDoc = new ActiveXObject("Msxml2.DOMDocument.6.0");
			   xmlDoc.async = false;
			   xmlDoc.load(domXML);
			if (xmlDoc.parseError.errorCode != 0) {
			   var myErr = xmlDoc.parseError;
			   alert("You have error " + myErr.reason);
			} else {
				  xslProc = xslt.createProcessor();
				  xslProc.input = xmlDoc;
				  xslProc.transform();
				  return(xslProc.output);
			   }
			}

					
		}
		else
		{
			// Преобразования не поддерживаются...
			alert("К сожалению, Ваш браузер не поддерживает XSLT преобразования!");
			return null;
		}
	}
	catch (ex)
	{
		alert("Ошибка xsltTransform:\n" + ex);
	}
	
}