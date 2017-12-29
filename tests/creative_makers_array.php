$<?php
error_reporting(E_ALL);
$a = [
    [2,1,7],
    [3,4,1],
    [6,5,8]
];
echo '<p>Исходная матрица: </p><pre>';
echo <<<LABEL
[2,1,7]
[3,4,1]
[6,5,8]
LABEL;
echo '<br>';
for($k=0; $k<3; $k++){
    for($i=0; $i<3; $i++){
        for($j=0; $j<3; $j++){
            if ($a[$i][$k] + $a[$k][$j] < $a[$i][$j]){ 
//                echo "<b>key: k=$k, i=$i, j=$j =>".$a[$i][$j].', '.$a[$i][$k].', '.$a[$k][$j].' <> ', $a[$i][$k] + $a[$k][$j].'</b><br>';
                $a[$i][$j] = $a[$i][$k] + $a[$k][$j];
                
            }
        }
    }
}
var_dump($a);
$b = [
    [2,1,7],
    [3,4,1],
    [6,5,8]
];
//оптимизация
for($k=0; $k<3; $k++){
    for($i=0; $i<3; $i++){
        for($j=0; $j<3; $j++){
            if($k === $i || $k === $j) continue ;
            if ($b[$i][$k] + $b[$k][$j] < $b[$i][$j]){ 
                $b[$i][$j] = $b[$i][$k] + $b[$k][$j];
            }
        }
    }
}
var_dump($b);
?>