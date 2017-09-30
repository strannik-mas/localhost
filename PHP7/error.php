<?php
//declare (strict_types=1);
// Error
// Exception
/*
function my_error_handler($no, $msg, $file, $line){
    echo "$no, $msg, $file, $line\n";
}
set_error_handler("my_error_handler");
//strlen();

if(true)
    trigger_error ("MY ERROR!!!", E_USER_ERROR);	//принудительная ошибка
echo __LINE__."\n";


echo __LINE__."\n";


function exceptionHandler($e){
    echo $e->getMessage();
}
set_exception_handler("exceptionHandler");
if(true)
	throw new Exception("MY EXCEPTION!!\n");
 
//в php7 появился интерфейс Throwable --> Exception, Error --> Custom
try {
    
//    if(true)
//	throw new Exception("MY php7 EXCEPTION!\n");
//    echo 'THE END!';
//    //
//    echo __LINE__."\n";
//    //
//    echo __LINE__."\n";
    
    //echo 2 << -1;
//    echo 2 / 0;
    $result = "abc" / 0;
    if(in_array($result, [INF, NAN, -INF]))
	throw new DivisionByZeroError("DIv by ZerrO");
//    echo 'abc' / 0;
//    echo 2 % 0;
    echo 'the end';
} catch (DivisionByZeroError $ex) {
    echo $ex->getMessage()."11\n";
}
 

function foo(int $a, int $b): bool{
    return true;
}
foo([], "2");
//echo __LINE__."\n";

try {
//    foo([], "2");
} catch (TypeError $ex) {
    echo $ex->getMessage()."-2\n";
}
*/

try {
    include 'test.php';
}catch (ParseError $ex) {
    echo $ex->getMessage()."-2\n";
}
