<?php
	// получаем данные
	if($_POST["calendar"]){
		$arrStr = explode('.', $_POST["calendar"]);
		$day = $arrStr[0];
		$month = $arrStr[1];
		$year = $arrStr[2];
		if(checkdate($month, $day, $year)){
			$allHolydays = $hol->getH(); // массив массивов праздников	
			if(checkDay($day, $month, $year, $allHolydays))
				$resCurDate = "Это праздник!";
			else{
				$resCurDate = "Это не праздник";
				header('holiday_calc.phtml');
			}
		}else $errMsg = "Произошла ошибка при вводе даты";
	}else $errMsg = "Нужно выбрать дату!";
	
	
	//функция, возвращающая массив с выходными выбранного года
	function getCurrentNumdays($visBool, $curMonth){
		if($curMonth == 2) 
			if($visBool)
				return 29;
			else return 28;
		switch($curMonth){
			case 1: 
			case 3: 
			case 5: 
			case 7: 
			case 8: 
			case 10: 
			case 12: return 31;
			case 4:
			case 6:
			case 9:
			case 11: return 30;			
		}
	}
	
	//функция, которая проверяет является ли выбранная дата выходным днём
	function checkDay($d, $m, $y, $allHolydays){
		//проверка високосного года:
		$leap = $y%4 ==0 && ($y%100!=0 || $y%400 ==0);
		
		foreach($allHolydays as $daysHolyday){
			$numDays = getCurrentNumdays($leap, $daysHolyday[month]);	
			//находим число месяца, если его нет
			if(!$daysHolyday[day]){
				$firstdayOfHolMonth = getdate(mktime(0,0,0,$daysHolyday[month], 1, $y));
				if($daysHolyday[week]<5){
					$firstdayOfHolMonth[wday] ? ($daysHolyday[day] = ($daysHolyday[week] -2 )*7 + 8 -$firstdayOfHolMonth[wday] + $daysHolyday[dweek]) : ($daysHolyday[day] = ($daysHolyday[week] -2 )*7 + 1 + $daysHolyday[dweek]);
				}else {
				//для последней недели
				//последний день текущего месяца:					
					$lastdayOfCurMonth = getdate(mktime(0,0,0,$daysHolyday[month], $numDays, $y));
					if($daysHolyday[dweek] < $lastdayOfCurMonth[wday]){
						$daysHolyday[day] = $numDays - $lastdayOfCurMonth[wday] +$daysHolyday[dweek];
					}elseif($daysHolyday[dweek] > $lastdayOfCurMonth[wday]){
						$daysHolyday[day] = $numDays - $lastdayOfCurMonth[wday] - (7 - $daysHolyday[dweek]);
					}else $daysHolyday[day] = $numDays;
				}	
				
			}
			
			// создаем метки времени Unix для всех дат праздников	
			
			//если праздники-период времени, то добавим еще элементы по количеству дней
			$i=0;
			do
			{	
				$curDay = $daysHolyday[day]+$i;
				if($curDay>0 && $curDay<=$numDays)
				{
					$metka = mktime(0,0,0,$daysHolyday[month],$curDay, $y);
					$curAllHolydays[] = getdate($metka);
					
				}
				if($curDay>$numDays){
					if($daysHolyday[month]==12)
						$daysHolyday[month] = 0;
					
					$curDay -= $numDays;
					$metka = mktime(0,0,0,$daysHolyday[month]+1,$curDay, $y);
					$curAllHolydays[] = getdate($metka);
				}
				
				
				$i++;
			}
			while($i<$daysHolyday[prodolzh]);
		}
		//выделяем из общего массива порядковые дни в году из праздников
//var_dump($curAllHolydays);exit;
		if($curAllHolydays){
			foreach($curAllHolydays as $curH){
				$curHolydays[]= $curH[yday];
			}
			$curData = getdate(mktime(0,0,0,$m,$d,$y));
			return in_array($curData[yday], $curHolydays);
		}
		
	}
?>
