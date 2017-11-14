<?php
$del = $_GET['del'] * 1;

$result = $hol->deleteH($del);
if(!$result){
	$errMsg = "Произошла ошибка при удалении праздника";
}else{
	header('Location: ' . $_SERVER['PHP_SELF']);
	exit;
}

?>