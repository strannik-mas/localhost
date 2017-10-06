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
            var db;
            var dbName = 'graph';
            var dbVersion = 1;     
            var tableName = "dataFromDays_"+dbVersion;
            var cellWidth = 20;                 //размер ячейки
            //начало координат на холсте
            var x_begin = 200;
            var y_begin = 100;            
            $(function(){
                $('#datepicker, #datepicker1').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "dd.mm.yy"
                });
                if(localStorage.getItem('database'))
                    drawGraph();
                $('#bazal_f1').on('submit', function(){
                    var kol_x = parseInt($('input[name=cycle]').val())+1;
                    //19-из-за пустой строки и добавочных пунктов
                    var kol_y = 19+(parseFloat($('input[name=temp]').attr('max'))-parseFloat($('input[name=temp]').attr('min')))/parseFloat($('input[name=temp]').attr('step'));
                    var gridHeight = cellWidth*kol_y;
                    var gridWidth = cellWidth*kol_x;
                    
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
//                    console.log(now.getDate());
                    $('#datepicker1').val((parseInt(now.getDate())<=9 ? '0' + now.getDate(): now.getDate()) +'.'+((parseInt(now.getMonth())+1)<=9 ? '0'+ (parseInt(now.getMonth())+1) : (parseInt(now.getMonth())+1)) +'.'+now.getFullYear());
                    $('input[name=cycle_day]').val(1);
                    $('input[name=temp]').val(36.4);
                    $('input[name=cron]').val((parseInt(now.getHours())<=9 ? '0' + now.getHours() : now.getHours()) +":"+(parseInt(now.getMinutes())<=9 ? '0' + now.getMinutes() : now.getMinutes()));
                    $('input[name=sleep_length]').val(8);
                    if($('input[name=cycle_day]').val()<4)
                        $('select[name=menstr_day] option').eq(2).attr("selected", "selected");
                    //функция отрисовки сетки и разметки координатных осей
                    grid(gridWidth, gridHeight, x_begin, y_begin, kol_x, kol_y, cellWidth, color);
                });
                //сохранение данных о дне (точки на графике) в indexedDB
                $('#bazal_f2').on('submit', function(){           
                    //объект записи в бд
                    var dayData = {
                        cycle_day : $('input[name=cycle_day]').val(),
                        cur_date : $('input[name=cur_date]').val(),
                        temp : $('input[name=temp]').val(),
                        cron : $('input[name=cron]').val(),
                        uchit : $('input[name=uchit]').is(':checked'),
                        ovul_date : $('input[name=ovul_date]').is(':checked'),
                        migren : $('select[name=migren]').val(),
                        givot : $('select[name=givot]').val(),
                        menstr_day : $('select[name=menstr_day]').val(),
                        sleep_length : $('input[name=sleep_length]').val(),
                        sleep_cond : $('input[name=sleep_cond]').val(),
                        illness : $('input[name=illness]').val(),
                        sex : $('input[name=sex]').is(':checked'),
                        alcohol : $('input[name=alcohol]').is(':checked'),
                        snotv : $('input[name=snotv]').is(':checked'),
                        pill_name : $('input[name=pill_name]').val(),
                        pill_rec : $('input[name=pill_rec]').val(),
                        pill_doza : $('input[name=pill_doza]').val(),
                        pill_desc : $('input[name=pill_desc]').val(),
                        pill_reason : $('input[name=pill_reason]').val(),
                        pill_eff : $('input[name=pill_eff]').val(),
                        comment : $('textarea[name=comment]').val(),
                    };
//                    console.log(dayData);
                    var openRequest = indexedDB.open(dbName, dbVersion);
                    openRequest.onupgradeneeded = function (e){
                        //тут только создаем таблицу данных для текущего дня, если её нет
                        var thisDB = e.target.result;
                        if(!thisDB.objectStoreNames.contains(tableName))
                            thisDB.createObjectStore(tableName, {keyPath: "cycle_day"});
                        console.log("Upgrading");
                    };
                    openRequest.onsuccess = function(e){
                        db = e.target.result;
                        console.log("Success!!!");
                        var transaction = db.transaction([tableName], "readwrite");
                        var store = transaction.objectStore(tableName);
                        var request = store.add(dayData);
                        request.onsuccess = function(e){
                            console.log("Record added");
                            drawGraph();
                        };
                        request.onerror = function(e){
                            var err = e.target.error;
                            console.log("Error: ", err.name+": "+err.message);
                            console.dir(err);
                        };  
                    };
                    openRequest.onerror = function(e){
                        var err = e.target.error;
                        console.log("Error: ", err.name+": "+err.message);
                    };
                                      
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
                var textOrdArr = ["гол. боль: слабая","гол. боль: сильная","гол. боль: мигрень","боль живота: тупая","боль живота: резкая","боль живота: ноющая","боль живота: другое","выд-я скудные","выд-я умеренные","выд-я обильные",'бесс. ночь', 'сон в необычн. усл.', 'болезнь', 'пол. акт', 'алкоголь', 'снотворное'];
                var now = new Date();
//                console.log(textOrdArr);
                
                ctx.font = fontSize + fontName;
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
                        ctx.fillText(i, i * w+xb-5, ch+yb+40);
                        ctx.fillText(beginDay.getDate(), i * w+xb-5, ch+yb+50);
                        
                        beginDay.setDate(beginDay.getDate()+1);
                    }
                    ctx.strokeStyle = c;
                    ctx.stroke(); 
                    if(beginDay.getDate() == now.getDate() && beginDay.getMonth() == now.getMonth()){
                        ctx.beginPath();
                        ctx.globalAlpha = 0.5;
                        ctx.fillStyle = "#fff990";
                        ctx.fillRect(i * w+xb+7, ch+yb+20, w, w*2);
                        ctx.fillStyle = '#000000';
                        ctx.globalAlpha = 1;
                    }
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
            function deleteGraph(){
                indexedDB.deleteDatabase('graph');
                
            }
            function drawGraph(){
                var canvas = document.getElementById("graph");
                var ctx = canvas.getContext('2d');                
                var transaction = db.transaction([tableName], "readonly");
                var store = transaction.objectStore(tableName);
                var cursor = store.openCursor();
                var i = 0;
                cursor.onsuccess = function(e){
                    var res = e.target.result;
                    if(res){
                        var obj = res.value;
                        var y0 = y_begin + cellWidth*(((parseFloat($('input[name=temp]').attr('max')) - parseFloat(obj.temp))/parseFloat($('input[name=temp]').attr('step')))+1);
                        console.log("Key:", res.key, y0);
                        console.dir(obj);
                        ctx.lineWidth = 3;
                        //точки графика
                        addPoint(ctx, res.key*cellWidth+x_begin, y0, "#08088A");
                        //отрисовка точек дополнительных полей
                        if(obj.migren !== '0'){
                            addPoint(ctx, res.key*cellWidth+x_begin, y_begin+cellWidth*obj.migren, "#FF00BF");
                        }
                        if(obj.givot !== '0'){
                            addPoint(ctx, res.key*cellWidth+x_begin, y_begin+cellWidth*obj.givot, "#B43104");
                        }
                        if(obj.sleep_length == '0'){
                            addPoint(ctx, res.key*cellWidth+x_begin, y_begin+cellWidth*38, "#2EFEF7");
                        }
                        if(obj.sleep_cond){
                            addPoint(ctx, res.key*cellWidth+x_begin, y_begin+cellWidth*39, "#D7DF01");
                        }
                        if(obj.illness){
                            addPoint(ctx, res.key*cellWidth+x_begin, y_begin+cellWidth*40, "#0B4C5F");
                        }
                        if(obj.sex){
                            addPoint(ctx, res.key*cellWidth+x_begin, y_begin+cellWidth*41, "#FF00FF");
                        }
                        if(obj.alcohol){
                            addPoint(ctx, res.key*cellWidth+x_begin, y_begin+cellWidth*42, "#40FF00");
                        }
                        if(obj.snotv){
                            addPoint(ctx, res.key*cellWidth+x_begin, y_begin+cellWidth*43, "#819FF7");
                        }
                        
                        //заливка при критических днях
                        if(obj.menstr_day !== '0'){
                            addPoint(ctx, res.key*cellWidth+x_begin, y_begin+cellWidth*obj.menstr_day, "#DF01A5");
                            //19-из-за пустой строки и добавочных пунктов
                            var kol_y = 19+(parseFloat($('input[name=temp]').attr('max'))-parseFloat($('input[name=temp]').attr('min')))/parseFloat($('input[name=temp]').attr('step'));
                            var height = cellWidth*kol_y;
                            ctx.beginPath();
                            ctx.globalAlpha = 0.3;
                            ctx.fillStyle = "#fadaee";
                            ctx.fillRect(x_begin+i*cellWidth, y_begin, cellWidth, height);
                            ctx.fillStyle = '#000000';
                            ctx.globalAlpha = 1;
                        }
                        i++;
                        res.continue();
                    }else{
                        console.log(res);
                    }

                };
                cursor.onerror = function(e){
                    var err = e.target.error;
                    console.log("Error: ", err.name+": "+err.message);
                };
            }
            function addPoint(context, x, y, color){
                context.beginPath();
                context.moveTo(x, y);
                context.strokeStyle = color;
                context.arc(x, y,5,0,2*Math.PI, false);
                context.stroke();
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
                                    <option value="0" selected>нет</option>
                                    <option value="28">слабая</option>
                                    <option value="29">сильная</option>
                                    <option value="30">мигрень</option>
                                </select>
                            </label><br>
                            <label>Боль внизу живота: 
                                <select name="givot">
                                    <option value="0" selected>нет</option>
                                    <option value="31">тупая</option>
                                    <option value="32">резкая</option>
                                    <option value="33">ноющая</option>
                                    <option value="34">свой вариант</option>
                                </select>
                            </label><br>
                            <label>Критические дни: 
                                <select name="menstr_day">
                                    <option value="0" selected>нет</option>
                                    <option value="35">скудные</option>
                                    <option value="36">умеренные</option>
                                    <option value="37">обильные</option>
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
                    <div style="clear: both; text-align: center; vertical-align: bottom">
                        <a href="" onclick="return deleteGraph()">Удалить график</a>
                        <input type="submit" value="Сохранить">
                    </div>
                </fieldset>
            </form>
        </div>
    </body>
</html>
