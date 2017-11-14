<HTML>
<HEAD>
<TITLE>gmdate</TITLE>
</HEAD>
<BODY>
<?
	print("Local: ");
	print(date("h:i A l "));
	print(date("F dS, Y"));
	print("<BR>\n");

	print("GMT: ");
	print(gmdate("h:i A l "));
	print(gmdate("F dS, Y"));
	print("<BR>\n");
?>
</BODY>
</HTML>