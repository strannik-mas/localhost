<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Basal_temperature</title>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script>/* Russian (UTF-8) initialisation for the jQuery UI date picker plugin. */
/* Written by Andrew Stromnov (stromnov@gmail.com). */
( function( factory ) {
	if ( typeof define === "function" && define.amd ) {

		// AMD. Register as an anonymous module.
		define( [ "../widgets/datepicker" ], factory );
	} else {

		// Browser globals
		factory( jQuery.datepicker );
	}
}( function( datepicker ) {

datepicker.regional.ru = {
	closeText: "Закрыть",
	prevText: "&#x3C;Пред",
	nextText: "След&#x3E;",
	currentText: "Сегодня",
	monthNames: [ "Январь","Февраль","Март","Апрель","Май","Июнь",
	"Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь" ],
	monthNamesShort: [ "Янв","Фев","Мар","Апр","Май","Июн",
	"Июл","Авг","Сен","Окт","Ноя","Дек" ],
	dayNames: [ "воскресенье","понедельник","вторник","среда","четверг","пятница","суббота" ],
	dayNamesShort: [ "вск","пнд","втр","срд","чтв","птн","сбт" ],
	dayNamesMin: [ "Вс","Пн","Вт","Ср","Чт","Пт","Сб" ],
	weekHeader: "Нед",
	dateFormat: "dd.mm.yy",
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: "" };
datepicker.setDefaults( datepicker.regional.ru );

return datepicker.regional.ru;

} ) );
        </script>
        <script type="text/javascript">
            $(function(){
                $('#datepicker, #datepicker1').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "dd.mm.yy"
                });
                if(localStorage.getItem('graph_data'))
                    drawGraph();
                $('#bazal_f1').on('submit', function(){
                    
                    var cellWidth = 20;                 //размер ячейки
                    var kol_x = parseInt($('input[name=cycle]').val())+1;
                    var kol_y = 19+(parseFloat($('input[name=temp]').attr('max'))-parseFloat($('input[name=temp]').attr('min')))/parseFloat($('input[name=temp]').attr('step'));
                    var gridWidth = cellWidth*kol_x;
                    var gridHeight = cellWidth*kol_y;
                    var x_begin = 200;
                    var y_begin = 100;
                    var canvasWidth = gridWidth+x_begin*2;             //ширина холста
                    var canvasHeight = gridHeight+y_begin*2;             //высота холста
                    var color = '#000'
                    $('#container1').css('display','none');
                    $('#container2').css('display','block');
                    $htmlCanvas = '<canvas id="graph" width="' + canvasWidth + '" height="' + canvasHeight + '"></canvas><span class="left red"></span><span class="left">Линия овуляции</span><span class="left grey"></span><span class="left">Средняя линия</span><span class="left" id="cycle_length"></span>';
                    $('div.graph').html($htmlCanvas);
                    $('#cycle_length').text('Длина цикла: ' + $('input[name=cycle]').val() + ' дней');
                    //значения по умолчанию
                    var now = new Date();
                    $('#datepicker1').val((parseInt(now.getDay())<=9 ? '0' + now.getDay(): now.getDay()) +'.'+((parseInt(now.getMonth())+1)<=9 ? '0'+ (parseInt(now.getMonth())+1) : (parseInt(now.getMonth())+1)) +'.'+now.getFullYear());
                    $('input[name=cycle_day]').val(1);
                    $('input[name=temp]').val(36.4);
                    $('input[name=cron]').val((parseInt(now.getHours())<=9 ? '0' + now.getHours() : now.getHours()) +":"+(parseInt(now.getMinutes())<=9 ? '0' + now.getMinutes() : now.getMinutes()));
                    if($('input[name=cycle_day]').val()<4)
                        $('select[name=menstr_day] option').eq(2).attr("selected", "selected");
                    
                    grid(gridWidth, gridHeight, x_begin, y_begin, kol_x, kol_y, cellWidth, color);
                });
                var icons = {
                    header: "ui-icon-circle-plus",
                    activeHeader: "ui-icon-circle-minus"
                };
                $( "#accordion" ).accordion({
                    collapsible: true,
                    icons: icons,
                    heightStyle: "content"
                });
                $('input[name=cron]').on('input',function(){
                    var tempArr = this.value.split(':');
                    if(tempArr[0]>24 || tempArr[1]>60)
                        this.value = this.value.substr(0,this.value.length-1)
                });
            });
            function grid(cw, ch, xb, yb, kolichestvo_x, kolichestvo_y, w, c){
                var canvas = document.getElementById("graph");
                var ctx = canvas.getContext("2d");
                var fontName = "Courier";
                var fontSize = "10pt";
                var tempDateArr = $('#datepicker').val().split('.');
                var beginDay = new Date(tempDateArr[2], tempDateArr[1]-1, tempDateArr[0]);
                var textOrd = '';
                var textOrdArr = [];
                $('#samoch option').each(function(index,element){                     if(element.value !== 'нет')
                        textOrdArr.push(element.value);
                });
                textOrdArr.push('бесс. ночь', 'сон в необ. усл.', 'болезнь', 'пол. акт', 'алкоголь', 'снотворное');    
//                console.log(textOrdArr);
                
                ctx.font = fontSize + fontName;
//                console.log(kolichestvo_x);
                for (var i = 0; i <= kolichestvo_x; i++) {
                    //вертикальные линии
                    ctx.beginPath();
                    ctx.moveTo(i * w+xb, 0+yb);
                    ctx.lineTo(i * w+xb, ch+yb);
                    if(i == 0 || i == kolichestvo_x)
                        ctx.lineWidth = 1;
                    else {
                        ctx.lineWidth = 0.5;
                        //рисуем текст к сетке на оси абсцисс
                        ctx.fillText(i, i * w+xb-5, ch+yb+20);
                        ctx.fillText(beginDay.getDate(), i * w+xb-5, ch+yb+30);
                        beginDay.setDate(beginDay.getDate()+1);
                    }
                    ctx.strokeStyle = c;
                    ctx.stroke(); 
                }
                for (var i = 0; i <= kolichestvo_y; i++) {
                    //горизонтальные линии
                    ctx.beginPath();
                    ctx.moveTo(0+xb, i * w+yb);
                    ctx.lineTo(cw+xb, i * w+yb);
                    if(i == 0 || i == kolichestvo_y)
                        ctx.lineWidth = 1;
                    else {
                        ctx.lineWidth = 0.3;
                        textOrd = parseFloat($('input[name=temp]').attr('max'))-parseFloat($('input[name=temp]').attr('step'))*(i-1);
                        if(i < (kolichestvo_y-17))
                            ctx.fillText(textOrd, xb-25, i * w+yb+4);
                        else if (i == (kolichestvo_y-17)) {
                            continue;
                        }else{
                            ctx.fillText(textOrdArr[i-28], xb-105, i * w+yb+3);
//                            console.log(kolichestvo_y-17);
                        }

                    }
                    ctx.strokeStyle = c;
                    ctx.stroke();
                }

            }
        </script>
        <style>
            h3 {
                text-align: center;
            }
            .month{
                display: none;
            }
            canvas {
                display: block;
                margin: 20px auto 0;
                border: 1px dotted #ccc;
            }
            .left{
                float: left;
                height: 30px;
                margin: 20px 10px;
                vertical-align: text-bottom
            }
            .red{
                background-color: red;
                width: 30px;
                border: 1px solid black;
                margin-top: 10px
            }
            .grey{
                background-color: gray;
                width: 30px;
                border: 1px solid black;
                margin-top: 10px
            }
            .graph{
                overflow: hidden;
            }
            #accordion{
                float: right;
                width: 40%
            }
            #bazal_f2 fieldset{
                min-height: 300px
            }
            #container2{
                display: none
            }
        </style>
    </head>
    <body>
        <h1>Базальная температура</h1>
        <p>Известно, что в зависимости от фазы менструального цикла в организме колеблется уровень гормонов, а вместе с ним и базальная температура.</p>
        <p>Наш сервис поможет Вам построить Ваш личный график базальной температуры, отследить изменения самочувствия, прием таблеток и, при желании, посоветоваться с подругами!</p>
        <!--все значения аттрибутов полей нужны для скрипта (min, max, step итд), т.е. при их изменении будут разные результаты-->
        <div id="container1">
            <form id="bazal_f1" onsubmit="return false">
                <table cellspacing="1" cellpadding="2" id="bazal_t1">
                    <caption><h3><i>Создать график измерения базальной температуры</i></h3></caption>
                    <tbody>
                        <tr>
                            <td>Название графика</td>
                            <td colspan="3"><input type="text" name="name" pattern="^[0-9A-Za-zА-Яа-яЁё\-\s]+$" size="50" required placeholder="Только буквы, цифры и знак -" value="График1"></td>
                        </tr>
                        <tr>
                            <td>Выберите дату начала последней менструации:</td>
                            <td><input type="text" name="menstr_date" id="datepicker" required value="01.10.2017"></td>
                            <td>Длительность цикла:</td>
                            <td><input type="number" name="cycle" min="21" max="35" required value="28"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input name="auto_date" type="checkbox">Определять дату овуляции автоматически</td>
                            <td><input type="checkbox" name="show_graph">Показывать график подругам</td>
                            <td><input type="submit" value="Рассчитать"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div id="container2">            
            <h3><i>Текущий график</i></h3>
            <div class="month">
                <label for="bazal_month">Показать другой ваш график</label>
                <input type="text" name="month" id="bazal_month">
            </div>
            <div class="graph"></div>
            <form id="bazal_f2" onsubmit="return false">
                <fieldset>
                    <legend><i>Ввод ежедневных данных</i></legend>                    
                    <div style="float: left">
                        <label>Дата:<input type="text" name="cur_date" id="datepicker1" required maxlength="2" size="10"></label>                    
                        <label>День цикла:<input name="cycle_day" type="number" min="1"max="35" required></label><br><br>
                        <label>Температура:<input name="temp" type="number" min="35.5" max="38" required step="0.1"></label><br><br>
                        <label>Время измерения: <input type="time" name="cron" pattern="[0-9]{2}[:0-9]{3}" placeholder="--:--"></label><br><br>
                        <label><input type="checkbox" name="uchit">Учитывать при расчёте овуляции</label><br><br>
                        <label><input type="checkbox" name="ovul_date">Это дата овуляции</label><br>                        
                    </div>
                    <div id="accordion">
                        <h3>Самочувствие</h3>
                        <div id="samoch">
                            <label>Головная боль: 
                                <select name="migren">
                                    <option value="нет" selected>нет</option>
                                    <option value="гол. боль: слабая">слабая</option>
                                    <option value="гол. боль: сильная">сильная</option>
                                    <option value="гол. боль: мигрень">мигрень</option>
                                </select>
                            </label><br>
                            <label>Боль внизу живота: 
                                <select name="givot">
                                    <option value="нет" selected>нет</option>
                                    <option value="боль живота: тупая">тупая</option>
                                    <option value="боль живота: резкая">резкая</option>
                                    <option value="боль живота: ноющая">ноющая</option>
                                    <option value="боль живота: свой вариант">свой вариант</option>
                                </select>
                            </label><br>
                            <label>Критические дни: 
                                <select name="menstr_day">
                                    <option value="нет" selected>нет</option>
                                    <option value="выд-я скудные">скудные</option>
                                    <option value="выд-я умеренные">умеренные</option>
                                    <option value="выд-я обильные">обильные</option>
                                </select>
                            </label><br>
                            <label>Длительность сна: 
                                <input name="sleep_length" type="number" min="0" max="15"> часов
                            </label><br>
                            <label>Сон в необычных условиях: 
                                <input name="sleep_cond" type="text">
                            </label><br>
                            <label>Болезнь: 
                                <input name="illness" type="text">
                            </label><br>
                            <label><input type="checkbox" name="sex">Половой акт</label>
                            <label><input type="checkbox" name="alcohol">Алкоголь</label>
                            <label><input type="checkbox" name="snotv">Снотворное</label>
                        </div>
                        <h3>Приём лекарств</h3>
                        <div>
                            <label>Наименование: 
                                <input name="pill_name" type="text">
                            </label><br>
                            <label>Доза:  
                                <input name="pill_rec" type="text">
                                <input name="pill_doza" type="number" min="1" max="5"> раз в день
                            </label><br>
                            <label>Описание: 
                                <input name="pill_desc" type="text">
                            </label><br>
                            <label>Причина приёма: 
                                <input name="pill_reason" type="text">
                            </label><br>
                            <label>Побочные эффекты: 
                                <input name="pill_eff" type="text">
                            </label>
                        </div>
                        <h3>Комментарий</h3>
                        <div>
                            <textarea name="comment" rows="4" cols="20"></textarea>
                        </div>
                    </div>
                    <div style="clear: both; text-align: center; vertical-align: bottom"><input type="submit" value="Сохранить"></div>
                </fieldset>
            </form>
        </div>
    </body>
</html>
