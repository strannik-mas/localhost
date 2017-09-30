<?php
if($_POST["month"]){
	if(!$_POST['day'] and (!$_POST['dweek'] || !$_POST['week'])){
		$errMsg = 'FIELDS are empty!</br>';
		header('holiday_calc.phtml');
	}else{
		$_POST['day'] ? $day = $_POST['day']*1 : $day = 0;
		$month = $_POST['month']*1;
		$_POST['dweek'] ? $dweek = $_POST['dweek']*1 : $dweek = 0;
		$_POST['week'] ? $week = $_POST['week']*1 : $week = 0;
		$_POST['prodolzh'] ? $prodolzh = $_POST['prodolzh']*1 : $prodolzh = 0;
		$ret = $hol->saveH($day, $month, $prodolzh, $dweek, $week);
	}

if(!$ret){
	$errMsg .= 'Save error!';
}else{
	header('holiday_calc.phtml');
}
}
?>