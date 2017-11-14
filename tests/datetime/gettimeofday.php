<HTML>
<HEAD>
<TITLE>gettimeofday</TITLE>
</HEAD>
<BODY>
<?
	$timeOfDay = gettimeofday();
	
	foreach($timeOfDay as $key=>$value)
	{
		print("$key = $value<BR>\n");
	}
?>
</BODY>
</HTML>