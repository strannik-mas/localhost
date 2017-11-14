<HTML>
<HEAD>
<TITLE>strtotime</TITLE>
</HEAD>
<BODY>
<?
	
	$time = "Feb 18, 1970 3AM";

	
	$ts = strtotime($time);
	
	
	print(date("h:i A l F dS, Y", $ts));
?>
</BODY>
</HTML>