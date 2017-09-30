<?
//declare (strict_types=1);	//строгий режим для тайпхинтинга
echo PHP_VERSION."\n";
/*
class Foo{
    //тут будет ошибка
    //public function Foo(){}

    //public function __construct(){}
    function list(){
    return "OK";
    }
}

$x = 1;
switch ($x){
    default: echo "1";

	//тут будет ошибка
    //default: echo "2";
}
$nums =[2,3,5,25,6,7];
usort($nums, function($a, $b){
    return $a <=> $b;
});
echo $_GET['x'] ? $_GET['x'] : "default","\n";
echo $_GET['x'] ?? "default","\n";   //isset

echo (new Foo)->list();

echo preg_replace_callback(["/PHP5/","/PHP7/"], 
    function($matches){
	if(strpos($matches[0], "PHP5") === 0)
	return "NO";
	else return "OK";
    }, 
    "PHP7"
);

//появилось
echo preg_replace_callback_array(
    [
    "/PHP6/" => function(){return "oh no!";},
    "/PHP8/" => function(){return "yes";}
    ],
    "PHP6"        
);
 */
/*
interface Message{
public function getText();
}
class Logger{
    public static function log(Message $message){
	echo $message->getText();
    }
}

class MyMessage implements Message{
    public function getText(){
	return "OKEY!";
    }
}
Logger::log(new MyMessage());

//появились безымянные классы
$message = (new class() implements Message{
    public function getText(){
	return "OKEYushki!";
    }
});
Logger::log($message);
 

//появился расширенный тайпхинтинг
function add(int $x, int $y): int{
    return $x + $y;
}

//var_dump(add(2, "3"));
echo strlen(111);


class Super{}
class Sub extends Super{}

abstract class A {
    abstract public function foo(): Super;
}
class B extends A{
    public function foo(): Super{	//тут только класс Super, нельзя Sub
	return new Sub;
    }
}


function gen(){
    yield 1;
    yield 2;
    //yield from gen2();
    return true;
}

//function gen2(){
//    yield 3;
//    yield 4;
//    yield "The end.";
//}

$g = gen();
//foreach ($g as $v);

//if ($g -> getReturn() === true) echo "O";
$g->next();
echo $g->getReturn();

//foreach (gen() as $v) echo $v."\n";


function foo(){return function(){echo "OK\n";};}
//в php5:
$x = foo(); $x();
//в PHP7
foo()();

$arr = ["a" => "b"];
$b = "OK";
//echo $$arr["a"];	//OK PHP5
echo ${$arr["a"]};

//php5:
try {
    foo();
} catch (Exception $e) {
    echo "oh no";
}
//php7
//add('2',"3");
try {
    //add('2',"3");
    foo();
}catch (TypeError $e) {
    echo "oh no";
} 
catch (Error $e) {
    echo "oh neeet";
}


try {
    if(false) throw new Exception("");
    foo();
} catch (Throwable $ex) {
   echo "ok";
}


try {
    $x = 10/0;
} catch (DivisionByZeroError $e) {
   echo $e->getMessage();
}
*/

$arr = ["user" => "root", "password" => "12345"];

define("DB", $arr);
const ARR = ['1','2','3','4'];	    

echo DB["user"]."\n";
echo ARR[1];
