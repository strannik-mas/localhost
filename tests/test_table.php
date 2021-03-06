<?php
/**
 * Тестовая задача по написанию функции, которая из массива строит таблицу.
 * 
 * Результатом работы функции должна быть HTML страница, в которой текст занимает соответствующие позиции с соответствующим вырыванием и цветом фона. 
 * Разный текст не может занимать одни и те же позиции.
 * @author Александр Меренцов <s211211@ukr.net>
 */
    define(CELLPERROW, 3);          //количество ячеек в строке
    define(ROWS, 3);                //количество строк в таблице
    //исходный массив
    $tableArr = array(
        array( 'text'    => 'Текст красного цвета'
             , 'cells'   => '1,2,4,5'
             , 'align'   => 'center'
             , 'valign'  => 'middle'
             , 'color'   => 'FF0000'
             , 'bgcolor' => '0000FF')
      , array( 'text'    => 'Текст зеленого цвета'
             , 'cells'   => '8,9'
             , 'align'   => 'right'
             , 'valign'  => 'bottom'
             , 'color'   => '00FF00'
             , 'bgcolor' => 'FFFFFF')
    );
    //сериализуем массив для передачи в функцию через форму
    $serializeArr = serialize($tableArr); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Тестовая таблица</title>
        <style>
            table{
                margin: 10px;
            }
			td{
				height: 50px;
			}
		</style>
    </head>
    <body>
        <h1>Таблица из массива</h1>
        <h2>Исходный массив</h2>        
        <pre><? var_dump($tableArr) ?></pre>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method='post'>
            <input type="hidden" name="func" value="getTable" />
            <input type="hidden" name="tablearr" value='<?=$serializeArr?>' />
            <input type="submit" value="Отправить исходный массив" />
        </form>
<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if($_POST['tablearr'])
            $params = unserialize($_POST['tablearr']);
        else $params = array(
            array(
                'text'    => $_POST['text1'], 
                'cells'   => $_POST['cells1'],
                'align'   => $_POST['align1'],
                'valign'  => $_POST['valign1'],
                'color'   => substr($_POST['color1'],1),
                'bgcolor' => substr($_POST['bgcolor1'],1)
            ),
            array(
                'text'    => $_POST['text2'], 
                'cells'   => $_POST['cells2'],
                'align'   => $_POST['align2'],
                'valign'  => $_POST['valign2'],
                'color'   => substr($_POST['color2'],1),
                'bgcolor' => substr($_POST['bgcolor2'],1)
            )
        );
        //вызываем функцию и передаём туда массив
        echo $_POST['func']($params);
    }
    
    /**
     * Принимает двумерный массив и возвращает HTML-сниппет таблицы с нужными стилями и проч.
     * @param array $arr        Входящий массив
     * @var array $areaArr      Массив, определяющий область для текста
     * @var array $tempArr      Временный массив для областей
     * @var array $cellsArr     Массив ячеек области
     * @var int $rowCounter     Счётчик ячеек
     * @var string $out         Переменная, куда будет сохранятся HTML-сниппет, она и будет возвращаться
     * @return string
     */
    function getTable($arr){ 
        $rowCounter = 1;
        //получаем массив областей
        foreach ($arr as $item){
            $tempArr = array();
            //составляем массив областей
            foreach (explode(',', $item['cells']) as $cell){
                $tempArr[ceil($cell/CELLPERROW)]++;
            }                
            $areaArr[] = $tempArr;
        }
        
        //составляем таблицу
        $out = '<table border="1"><tbody>';
        for($i=1; $i<=ROWS; $i++){
            $out .= '<tr>';
            for($k=1; $k<=CELLPERROW; $k++){
                //перебираем массив областей и смотрим есть ли в нем текущие строка и ячейка  
                for($j=0; $j<count($arr); $j++){
                    $cellsArr = explode(',', $arr[$j]['cells']);
                    //проверяем на первую ячейку диапазона
                    if(array_key_exists($i, $areaArr[$j]) && $rowCounter == $cellsArr[0]){
                        $out .= '<td colspan="'.$areaArr[$j][$i].'" rowspan="'.count($areaArr[$j]).'" style="text-align:'.$arr[$j]['align'].';vertical-align:'.$arr[$j]['valign'].';color:#'.$arr[$j]['color'].';background-color:#'.$arr[$j]['bgcolor'].'">'.$arr[$j]['text'].'</td>';
                        break;
                    }elseif(in_array ($rowCounter, $cellsArr) && $rowCounter != $cellsArr[0]) break;        //если ячейки входят в диапазон - пропускаем итерацию
                    elseif(!in_array ($rowCounter, $cellsArr) && $j === count($arr)-1) {
                        $out .= '<td></td>';
                        break;
                    }
                }
                $rowCounter++;
            }
            
            $out .= '</tr>';
        }
        $out .= '</tbody></table>';
        return $out;
    }
?>    
        <hr>
        <!--для ввода нового массива-->
        <h2>Новые данные</h2> 
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method='post'>
            <input type="hidden" name="func" value="getTable" />
            <fieldset>
                <legend>Данные первого диапазона</legend>
                <label>Текст для диапазона ячеек: <input type="text" name="text1" required /></label><br>
                <label>Номера ячеек 1 диапазона:   
                    <input type="text" name="cells1" pattern="\d{1}(\,\d)+" placeholder="1,2" required/></label><br>
                <label>Горизонтальное выравнивание:
                    <select name="align1">
                        <option value="center">Выравнивание текста по центру</option>
                        <option value="justify">Выравнивание по ширине</option>
                        <option value="left">Выравнивание текста по левому краю</option>
                        <option value="right">Выравнивание текста по правому краю</option>
                        <option value="auto">Не изменяет положение элемента</option>
                        <option value="inherit">Наследует значение родителя</option>
                        <option value="start">Start</option>
                        <option value="end">End</option>
                    </select>
                </label><br>
                <label>Вертикальное выравнивание:
                    <select name="valign1">
                        <option value="baseline">По базовой линии родителя</option>
                        <option value="bottom">По нижней части элемента строки</option>
                        <option value="middle">Middle</option>
                        <option value="sub">Подстрочный</option>
                        <option value="super">Надстрочный</option>
                        <option value="text-bottom">По самому нижнему краю текущей строки</option>
                        <option value="text-top">По самому высокому текстовому элементу текущей строки</option>
                        <option value="top">По верху</option>
                        <option value="inherit">Наследует значение родителя</option>
                    </select>
                </label><br>
                <label>Цвет текста: 
                    <input type="color" name="color1" />
                </label>
                <label>Цвет фона: 
                    <input type="color" name="bgcolor1" />
                </label>
            </fieldset>
            <fieldset>
                <legend>Данные второго диапазона</legend>
                <label>Текст для диапазона ячеек: <input type="text" name="text2" required /></label><br>
                <label>Номера ячеек 1 диапазона:   
                    <input type="text" name="cells2" pattern="\d{1}\,\d" placeholder="1,2" required/></label><br>
                <label>Горизонтальное выравнивание:
                    <select name="align2">
                        <option value="center">Выравнивание текста по центру</option>
                        <option value="justify">Выравнивание по ширине</option>
                        <option value="left">Выравнивание текста по левому краю</option>
                        <option value="right">Выравнивание текста по правому краю</option>
                        <option value="auto">Не изменяет положение элемента</option>
                        <option value="inherit">Наследует значение родителя</option>
                        <option value="start">Start</option>
                        <option value="end">End</option>
                    </select>
                </label><br>
                <label>Вертикальное выравнивание:
                    <select name="valign2">
                        <option value="baseline">По базовой линии родителя</option>
                        <option value="bottom">По нижней части элемента строки</option>
                        <option value="middle">Middle</option>
                        <option value="sub">Подстрочный</option>
                        <option value="super">Надстрочный</option>
                        <option value="text-bottom">По самому нижнему краю текущей строки</option>
                        <option value="text-top">По самому высокому текстовому элементу текущей строки</option>
                        <option value="top">По верху</option>
                        <option value="inherit">Наследует значение родителя</option>
                    </select>
                </label><br>
                <label>Цвет текста: 
                    <input type="color" name="color2" />
                </label>
                <label>Цвет фона: 
                    <input type="color" name="bgcolor2" />
                </label>
            </fieldset>
            <input type="submit" value="Отправить новый массив" />
        </form>
        <hr>
    </body>
</html>
