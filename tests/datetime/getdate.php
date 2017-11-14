<HTML>
<HEAD>
<TITLE>getdate</TITLE>
</HEAD>
<BODY>
<?
	
	$dateInfo = getdate();

	
	foreach($dateInfo as $key=>$value)
	{
		print("$key: $value<BR>\n");
	}
?>
</BODY>
</HTML>