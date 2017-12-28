<?php
$a = [
    [2,1,7],
    [3,4,1],
    [6,5,8]
];
echo '<p>Исходная матрица: </p><pre>';
var_dump($a);
echo '</pre>';

for($k=0; $k<3; $k++){
    for($i=0; $i<3; $i++){
        for($j=0; $j<3; $j++){
            if ($a[$i][$k] + $a[$k][$j] < $a[$i][$j]){ 
                echo "<b>key: k=$k, i=$i, j=$j =>".$a[$i][$j].' <> ', $a[$i][$k] + $a[$k][$j].'</b><br>';
                $a[$i][$j] = $a[$i][$k] + $a[$k][$j];
                
            }
            echo $a[$i][$j].' <> ', $a[$i][$k] + $a[$k][$j].'<br>';
        }
    }
}
var_dump($a);
$a = [
    [2,1,7],
    [3,4,1],
    [6,5,8]
];
//оптимизация
$k = 0;
foreach ( $a as $i=>$arr){
    foreach ($arr as $j=>$val){
        $a[$i][$j] = (($a[$i][$k] + $a[$k][$j]) < $val ? ($a[$i][$k] + $a[$k][$j]) : $val);
        $k++;
    }
}
var_dump($a);