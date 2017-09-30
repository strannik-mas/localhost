<!DOCTYPE html>
<html>
<head>
 <title>Курсы валют</title>
</head>
<body>
<?php
 require("cbr.class.php");
 $currency = "USD";
 $date = time();
 $result = "";
 $cbr = new CBR();
 $result = $cbr->getRate($currency, $date);
?>
 <h1>Курсы валют</h1>
<?php 
	if ($result) 
		echo "<div>", $result, "</div>" 
?>
</body>
</html>