<?php
$cellPerRow = 3;                 //количество ячеек в строке
$rows = 3;                      //количество строк в таблице
//исходный массив
$tableArr = array(
    array('text' => 'Текст красного цвета'
        , 'cells' => '1,2,4,5'
        , 'align' => 'center'
        , 'valign' => 'middle'
        , 'color' => 'FF0000'
        , 'bgcolor' => '0000FF')
    , array('text' => 'Текст зеленого цвета'
        , 'cells' => '8,9'
        , 'align' => 'right'
        , 'valign' => 'bottom'
        , 'color' => '00FF00'
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
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script>
        var overallArr = [];
        $( function() {            
            //отрисовка новой таблицы
            drawTable();
            $('input[name=columns]').on('change', drawTable);
            $('input[name=rows]').on('change', drawTable);
            $('#text, #align, #valign').on('input',function(){
                $(this).css('border', 'gray 1px solid')
            });
        } );
        function drawTable(){
            let rowArr = [];
            let counterArr = [];
            $tableHtmlStr = '<ol id="selectable">';
            for(let i=0; i< $('input[name=rows]').val(); i++){
                
                for(let j=1; j<=$('input[name=columns]').val(); j++){
                    $tableHtmlStr += '<li class="ui-state-default">' + (i*$('input[name=columns]').val()+j) + '</li>';
                }
            }
             $tableHtmlStr += '</ol>';
            $('#newtable').html($tableHtmlStr);
            $( "#selectable" ).css('width', ($('input[name=columns]').val()*110));
            $('.ui-selected:not(.finally)').css('background', $('#bgcolor').val());
            
            $( "#selectable" ).selectable({
//                cancel: "li.finally",
                filter: "li:not(.finally)",
                unselecting: function( event, ui ) {
                    
                    $(ui.unselecting).css({
                        'background': '#f6f6f6'
                    });
                },
                selecting: function( event, ui ) {
                    $(ui.selecting).css({
                        'background': $('#bgcolor').val(),
                        'opacity': 0.5
                    });
                },
                selected: function( event, ui ) {
                    
                    $(ui.selected)
                        .each(function(index,element){
                            if(element.className.indexOf('finally') === -1)
                                rowArr.push(Math.ceil($(element).text()/$('input[name=columns]').val()));
                        })
                        .css({
                            'background': $('#bgcolor').val(),
                            'opacity': 1
                        });                    
                },
                stop: function( event, ui ) {
                    //удаляем неправильную выборку
                    for(let j=1; j<=$('input[name=columns]').val(); j++){
                        let counter =0;
                        rowArr.forEach(function(v){
                            if(v===j)
                                counter++;
                        });
                        counterArr.push(counter);
                    }
                    counterArr.sort().reverse();
                    if(counterArr[0] != counterArr[1] && counterArr[1]){
                        $('.ui-selected:not(.finally)').each(function(index,element){
                            $(element).removeClass('ui-selected').css('background', '#f6f6f6');
                        });
                        
                    }
                    rowArr = [];
                    counterArr = [];
                }
            });
            
            $('#bgcolor').on('change', function(){
                try{
                    $('.ui-selected:not(.finally)').css('background', this.value);
                }catch(e){
//                    console.log(e);
                }
            });
        }
        function add2Array(){
            $('input[name=columns]').attr('readonly', 'readonly');
            $('input[name=rows]').attr('readonly', 'readonly');            
            let $liStr = '';            //номера занимаемых ячеек    
            if(!$('#text').val()){
                $('#text').css({
                   'border': 'red 2px solid'
                });
                alert("Заполните текст");
                return;
            } 
            if($('#align').val() == 0){
                $('#align').css({
                   'border': 'red 2px solid'
                });
                alert($('#align option:selected').text());
                return;
            }    
            if($('#valign').val() == 0){
                $('#valign').css({
                   'border': 'red 2px solid'
                });
                alert($('#valign option:selected').text());
                return;
            } 
            if($('.ui-selected:not(.finally)').length <= 1){
                alert("Выберите диапазон в таблице");
                return;
            }else{
                $('.ui-selected:not(.finally)').each(function(index, element){
                    
                    
                    $liStr += $(element).text() + ',';            
                    $(element).addClass('finally').css('opacity', 0.5);
                    
                });
                $liStr = $liStr.slice(0, -1);
            }
            let tempObj = {
                'text':     $('#text').val(),
                'cells':    $liStr,  
                'align':    $('#align option:selected').val(),
                'valign':   $('#valign option:selected').val(),
                'color':    $('#color').val().slice(1),
                'bgcolor':    $('#bgcolor').val().slice(1)
            };
            overallArr.push(tempObj);
            $('input[name=newtablearr').val(JSON.stringify(overallArr));
            $('#text').val('');
        }
        </script>
        <style>
            table{
                margin: 10px;
            }
            td{
                height: 50px;
                min-width: 50px;
            }
            #newtable{
                width: 100%;
            }
            #newtable:after {
                content: ".";
                display: block;
                height: 0;
                clear: both;
                visibility: hidden;
            }
            #feedback { font-size: 1.4em; }
            #selectable .ui-selecting { background: #FECA40 }
            #selectable .ui-selected { background: #F39814; color: white; }
            #selectable { list-style-type: none; margin: 0; padding: 0; width: 350px; }
            #selectable li { margin: 3px; padding: 1px; float: left; width: 100px; height: 80px; font-size: 4em; text-align: center; }
        </style>
    </head>
    <body>
        <h1>Таблица из массива</h1>
        <div id="default">
            <h2>Исходный массив</h2>        
            <pre><? var_dump($tableArr) ?></pre>
        </div>        
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method='post'>
            <input type="hidden" name="func" value="getTable" />
            <input type="hidden" name="tablearr" value='<?= $serializeArr ?>' />
            <input type="submit" value="Отправить исходный массив" />
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['tablearr']){
                $paramsArr = unserialize($_POST['tablearr']);         
            }
            if($_POST['newtablearr']){
                $cellPerRow = $_POST['columns'];                
                $rows = $_POST['rows'];                     
                $jsonArr = json_decode($_POST['newtablearr']);
                $paramsArr = [];
                foreach ($jsonArr as $itemObj){
                    $paramsArr[] = (array)$itemObj;
                }
                echo '<h2>Новый массив</h2><pre>';
                var_dump($paramsArr);
                echo '</pre>';
            }
            //вызываем функцию и передаём туда массив
            echo $_POST['func']($paramsArr);
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
        function getTable($arr) {  
            $rowCounter = 1;
            $overallAreaArr = [];
            //получаем массив областей
            foreach ($arr as $item) {
                $tempArr = array();
                //составляем массив областей
                foreach (explode(',', $item['cells']) as $cell) {
                    $overallAreaArr[] = $cell;
                    $tempArr[ceil($cell / $GLOBALS['cellPerRow'])] ++;
                }
                $areaArr[] = $tempArr;
            }
            //проверка пересечения ячеек
            if(count($overallAreaArr) !== count(array_unique($overallAreaArr))){
                $errHtmlStr = '<h2 style="color:red;">Невозможно построить таблицу!<h2><p>Укажите непересекающиеся диапазоны ячеек</p>';
                return $errHtmlStr;
            }
            
            //составляем таблицу
            $out = '<table border="1"><tbody>';
            for ($i = 1; $i <= $GLOBALS['rows']; $i++) {
                $out .= '<tr>';
                for ($k = 1; $k <= $GLOBALS['cellPerRow']; $k++) {
                    //перебираем массив областей и смотрим есть ли в нем текущие строка и ячейка  
                    for ($j = 0; $j < count($arr); $j++) {
                        $cellsArr = explode(',', $arr[$j]['cells']);
                        //проверяем на первую ячейку диапазона
                        if (array_key_exists($i, $areaArr[$j]) && $rowCounter == $cellsArr[0]) {
                            $out .= '<td colspan="' . $areaArr[$j][$i] . '" rowspan="' . count($areaArr[$j]) . '" style="text-align:' . $arr[$j]['align'] . ';vertical-align:' . $arr[$j]['valign'] . ';color:#' . $arr[$j]['color'] . ';background-color:#' . $arr[$j]['bgcolor'] . '">' . $arr[$j]['text'] . '</td>';
                            break;
                        } elseif (in_array($rowCounter, $cellsArr) && $rowCounter != $cellsArr[0])
                            break;        //если ячейки входят в диапазон - пропускаем итерацию
                        elseif (!in_array($rowCounter, $cellsArr) && $j === count($arr) - 1) {
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
        <h2>Своя таблица</h2> 
        <div id="newtable"></div>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method='post' id="f2">
            <input type="hidden" name="func" value="getTable" />
            <input type="hidden" name="newtablearr"/>
            <label>Количество строк<input type="number" name="rows" value="3" min="3" max="20"/></label><br>
            <label>Количество столбцов<input type="number" name="columns" value="3" min="3" max="20"/></label>
            <fieldset>
                <legend>Данные диапазона</legend>
                <label>Текст для диапазона ячеек: <input type="text" id="text"/></label><br>
                <select id="align">
                    <option selected value="0">Выберите горизонтальное выравнивание</option>
                    <option value="center">Выравнивание текста по центру</option>
                    <option value="justify">Выравнивание по ширине</option>
                    <option value="left">Выравнивание текста по левому краю</option>
                    <option value="right">Выравнивание текста по правому краю</option>
                    <option value="auto">Не изменяет положение элемента</option>
                    <option value="inherit">Наследует значение родителя</option>
                    <option value="start">Start</option>
                    <option value="end">End</option>
                </select><br>
                <select id="valign">
                    <option selected value="0">Выберите вертикальное выравнивание</option>
                    <option value="baseline">По базовой линии родителя</option>
                    <option value="bottom">По нижней части элемента строки</option>
                    <option value="middle">Middle</option>
                    <option value="sub">Подстрочный</option>
                    <option value="super">Надстрочный</option>
                    <option value="text-bottom">По самому нижнему краю текущей строки</option>
                    <option value="text-top">По самому высокому текстовому элементу текущей строки</option>
                    <option value="top">По верху</option>
                    <option value="inherit">Наследует значение родителя</option>
                </select><br>
                <label>Цвет текста: 
                    <input type="color" id="color" value="#ff0000"/>
                </label>
                <label>Цвет фона: 
                    <input type="color" id="bgcolor" value="#ff0000"/>
                </label><br>
                <button type="button" onclick="add2Array()">Добавить область</button>
            </fieldset>
            <input type="submit" value="Отправить новый массив" />
        </form>
    </body>
</html>
