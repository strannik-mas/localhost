<?php
$result = $hol->getH();
if($result === false){
	$errMsg = "Произошла ошибка при выводе ленты праздников";
}else{
	foreach($result as $item){
		$id = $item['id'];
		$item['day'] ? $day = $item['day'] : $day = null;
		$month = $item['month'];
		$item['prodolzh'] ? $prodolzh = $item['prodolzh'] : $prodolzh = null;
		$item['dweek'] ? $dweek = $item['dweek'] : $dweek = null;
		$item['week'] ? $week = $item['week'] : $week = null;
		echo <<<LABEL
		<hr>
		<p>Число: 
			<b>$day</b> <br>
			Месяц: <b>$month</b>
			<br />Продолжительность: $prodolzh дней
		</p>
		<p>
			День недели: $dweek <br>
			Неделя в месяце: $week
		</p>
		<p align="right">
			<a href="{$_SERVER['PHP_SELF']}?del=$id">Удалить</a>
		</p>
LABEL;
	}
}
?>