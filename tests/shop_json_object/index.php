<?php
define ("DIR_PREFIX", 'new'); //константа для корневой директории новой структкры
define ("DIR_IMAGE", 'img'); //константа для директории с изображениями
define ("IMG_FILE_MINI", '_mini.'); //константа для директории с изображениями

//класс реализует поиск всех файлов по расширению в текущей директории и подпапках
class FileExtensionFinder extends FilterIterator {
	protected $predicate, $path;
	public function __construct($path, $predicate) {
		$this->predicate = $predicate;
		$this->path = $path;
		$it = new RecursiveDirectoryIterator($path);
		$flatIterator = new RecursiveIteratorIterator($it);
			parent::__construct($flatIterator);
	}
	public function accept() {
		$pathInfo = pathinfo($this->current());
		$extension = $pathInfo['extension'];
		return ($extension == $this->predicate);
	}
}
	//функция, удаляющая пустые значения и лишние пробелы в массивах
	function array_item_trim($arr) {
		if (!is_array($arr)) return;
		foreach ($arr as $k=>$v){
			if(is_array($v))
				$arr[$k] = array_item_trim($v);
			if(is_object($v)) object_item_trim($v);
			if($v==='') unset ($arr[$k]);
			if(is_string($v) && $v) $arr[$k] = trim($arr[$k]);
		}
		return $arr;
    }
		//функция, удаляющая пустые значения и лишние пробелы в объектах
	function object_item_trim($obj) {
		if (!is_object($obj)) return;
		foreach ($obj as $name=>$v){		
			
			
			if(is_array($v)) $obj->$name = array_item_trim($v);			
				
			if(is_object($v)) object_item_trim($v);
			
			if($obj->$name === '') unset($obj->$name);
			
			if(is_string($v) && $v) $obj->$name = trim($v);
			
		}
		return $obj;
    }

	//функция создает структуру каталогов и сохраняет json файлы
	function build($path, $jobj, $names){
		if (explode("\\",$path)[3] == 'clothes')
			$realpath = DIR_PREFIX ."\\". explode("\\",$path)[3] . "\\" . $jobj->clothes->name ."\\". $names[(explode("\\",$path)[2])-1];
		else $realpath = DIR_PREFIX ."\\". explode("\\",$path)[1] . "\\" . $jobj->name;
	
		//создаём директорию, если её нет
		if(!file_exists(rus2translit($realpath))){
			if(!mkdir(rus2translit($realpath), 0777, true)){
				echo('Не удалось создать директории');
			}
		}				
					
		//получаем пути для изображений
		if($jobj->images) {
		
			foreach($jobj->images as $image){
				$pathimages[] = $image->image; 
			}
			//создаем директорию для картинок и копируем туда исходники
			for($i=0; $i<count($pathimages); $i++){
				if(!file_exists(rus2translit($realpath) . "\\".DIR_IMAGE)){			
					if(!mkdir(rus2translit($realpath) . "\\".DIR_IMAGE, 0777, true)){
						echo('Не удалось создать директорию');
					}
					
				}
				
				
				$newfile = rus2translit($realpath) . "\\". DIR_IMAGE. "\\" . array_pop(explode("/", $pathimages[$i]));
				
				if (!copy(rus2translit($pathimages[$i]), $newfile)) {
					echo "не удалось скопировать $file...\n";
				}
				//var_dump($jobj->images);
				
				//добавляем в json файлы информацию о путях к картинкам
				$jobj->images[$i]->newpath = str_replace("\\", "/", $newfile);
				$jobj->images[$i]->thumb = str_replace("\\", "/", copyImage($pathimages[$i], substr($newfile, 0, -4)));
			}
		}
		
		
		//создаем json-файлы
		file_put_contents(rus2translit($realpath) . '\\main.json', 
					json_encode($jobj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
			
	}
	
	//функция сохраняет миниатюры изображений
	function copyImage($path, $path_output){
		// задание максимальной ширины и высоты
		$width = 500;
		$height = 500;
		
		// получение новых размеров
		list($width_orig, $height_orig, $type) = getimagesize($path);
		$types = array('','gif','jpeg','png');
        $ext = $types[$type];
		
		//масштаб
		$ratio_orig = $width_orig/$height_orig;

		if ($width/$height > $ratio_orig) {
		   $newwidth = $height*$ratio_orig;
		   $newheight = $height;
		} else {
		   $newheight = $width/$ratio_orig;
		   $newwidth = $width;
		}
		// ресэмплирование
		$image_p = imagecreatetruecolor($newwidth, $newheight);
		
		//получаем цвет для полей
		$im = imagecreatetruecolor($width, $height);
		$white = imagecolorallocate($image_p, 255, 255, 255);
		imagefilledrectangle($im, 0, 0, $width, $height, $white);
		
		//$image = imagecreatefromjpeg($path);
		if ($ext) {
    	        $func = 'imagecreatefrom'.$ext;
    	        $image = $func($path);
        } else {
    	        echo 'Некорректный формат файла';
		return;
        }
		
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $newwidth, $newheight, $width_orig, $height_orig);
		
		// накладываем на белый квадрат получившуюся миниатюру для получения полей
		imagecopymerge($im, $image_p, ($width-$newwidth)/2, ($height-$newheight)/2, 0,0, $newwidth, $newheight,100);
		
		// вывод
		$file_output = $path_output.IMG_FILE_MINI.$ext;
		if($type == 2){
			imagejpeg($im, $file_output, 100);
		}else{
			$func = 'image'.$ext;
			$func($im, $file_output);
		}
		return $file_output;
	}
	
	
	//транслит
	function rus2translit($string) {
		$converter = array(
			'а' => 'a',   'б' => 'b',   'в' => 'v',
			'г' => 'g',   'д' => 'd',   'е' => 'e',
			'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
			'и' => 'i',   'й' => 'y',   'к' => 'k',
			'л' => 'l',   'м' => 'm',   'н' => 'n',
			'о' => 'o',   'п' => 'p',   'р' => 'r',
			'с' => 's',   'т' => 't',   'у' => 'u',
			'ф' => 'f',   'х' => 'h',   'ц' => 'c',
			'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
			'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
			'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
			
			'А' => 'A',   'Б' => 'B',   'В' => 'V',
			'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
			'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
			'И' => 'I',   'Й' => 'Y',   'К' => 'K',
			'Л' => 'L',   'М' => 'M',   'Н' => 'N',
			'О' => 'O',   'П' => 'P',   'Р' => 'R',
			'С' => 'S',   'Т' => 'T',   'У' => 'U',
			'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
			'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
			'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
			'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
		);
		return strtr($string, $converter);
	}
	
	$it = new FileExtensionFinder('.','json');
	$filepath = iterator_to_array($it);
	foreach($filepath as $k=>$v){
		//получаем массив массивов распарсеных json файлов
		//исправление ошибок в json файлах
		$string = $v->openFile('rb')->fread(filesize($k));
		$pattern = '/(.*)\\\\"(риба)\\\\"(.*)\"(рибою)\"(.*)\"(Риба)\"(.*)/';
		$replacement = "\\1'\\2'\\3'\\4'\\5'\\6'\\7";
		
		$data = json_decode(preg_replace($pattern, $replacement, $string));
		//плучаем объект с удалёнными лишними пробелами и удаленными пустыми данными
		$newdata[$k] = object_item_trim($data);
		//var_dump($data);
		
		//найдем названия магазинов
		if($data->contacts) $shop_names[] = $data->name;
		
	}
	
		//создаём новую структуру если ее еще нет
	if(!file_exists(DIR_PREFIX)){
		foreach($newdata as $key=>$jsonObject){
			build($key, $jsonObject, $shop_names);
		}
		echo "<h3>Структура создана в папке /". DIR_PREFIX."/</h3>";
	}else echo "<h3>Структура уже была создана в папке /". DIR_PREFIX."/ !</h3>";	
	
	
?>