<?
class PropertyTest{
	private $data = array();
	public function exceptionHandler($e){
		echo $e->getMessage();
	}
	public function __get($name){
		set_exception_handler("exceptionHandler");
		if(array_key_exists($name, $this->data)) {
			return $this->data[$name];
		}else throw new Exception("MY EXCEPTION!!\n");
	}
}
$obj = new PropertyTest;
$obj->a = 1;
echo $obj->a."\n\n";

