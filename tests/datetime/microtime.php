<HTML>
<HEAD>
<TITLE>microtime</TITLE>
</HEAD>
<BODY>
<?
	
	print("Start:". microtime() . "<BR>\n");

	
	usleep(rand(100,5000));

	
	print("Stop: " . microtime() . "<BR>\n");
?>
</BODY>
</HTML>