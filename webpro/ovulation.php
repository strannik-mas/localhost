<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ovulation</title>
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
        <script>
            $(function(){
                $('#datepicker').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "dd.mm.yy"
                }); 
                $('#ov_f1').on('submit', function(){
                    var tempArr = $('#datepicker').val().split('.');
                    var d = new Date(tempArr[2], tempArr[1]-1, tempArr[0]);
                    localStorage.setItem('beginMenstrDay', d);
                    localStorage.setItem('cycle', $('input[name=cycle]').val());
                    localStorage.setItem('menstr', $('input[name=menstr]').val());
                    $htmlStr = '<tr><td><div id="datepicker2"></div></td><td><div id="datepicker3"></div></td></tr><tr><td><div id="datepicker4"></div></td><td><div id="datepicker5"></div></td></tr>';
                    $('#ovul_t1 tbody').html($htmlStr);
                    $('#datepicker2').datepicker({
                        inline:true,
                        defaultDate: d,
                        beforeShowDay:highlightOvulDays
                    });
//                    d.setMonth(d.getMonth()+1);
//                    $('#datepicker3').datepicker({
//                        defaultDate: d,
//                    });
               });
            });
            function highlightOvulDays(date) {
                var i = 4;      //количество календарей
                var d = new Date(localStorage.getItem('beginMenstrDay'));
                var dEnd = new Date(localStorage.getItem('beginMenstrDay'));
                var d2 = new Date(localStorage.getItem('beginMenstrDay'));
                var dEnd2 = new Date(localStorage.getItem('beginMenstrDay'));
                var ovulDay = new Date(localStorage.getItem('beginMenstrDay'));
                var cycle = localStorage.getItem('cycle');
                var mDays = localStorage.getItem('menstr');
                if(cycle < 25)
                    ovulDay.setDate(d.getDate()+8);
                else if (cycle > 30) {
                    ovulDay.setDate(d.getDate()+21);
                }else{
                    ovulDay.setDate(d.getDate()+14);
                }
                dEnd.setDate(d.getDate() + mDays*1);
                d2.setDate(d.getDate() + cycle*1);
                dEnd2.setDate(d2.getDate() + mDays*1);
//                console.log(ovulDay);
//                console.log(date);
                if(date.getDate() == ovulDay.getDate() && date.getMonth() == ovulDay.getMonth()){
                    return [true, 'ov_d'];
                }
                else if ((date >= d && date < dEnd) || (date >= d2 && date < dEnd2)) {
                    return [true, 'menstr_d'];
                }else
                {
                    return[true, ""];                                
                }
            }
        </script>
        <style>
            .ov_d a.ui-state-default {
                color:#000;
                background-color: green;
            }
            .menstr_d a.ui-state-default {
                color:#fff;
                background-color: red;
            }
        </style>
    </head>
    <body>
        <h1>Календарь овуляции</h1>
        <p>Как выяснить благоприятный день для зачатия? Воспользуйтесь календарем овуляции. Укажите дату последней менструации, ее продолжительность и общую длительность цикла. В вашем персональном календаре овуляции будут отмечены фертильные дни, в которые вероятность зачатия достаточно высока, а также дни овуляции, когда вероятность зачатия максимальна.</p>
        <table cellspacing="1" cellpadding="2" id="ovul_t1">
            <form id="ov_f1" onsubmit="return false">
                <input type="hidden" name="func" value="getOvulation" />

                    <caption><h3>Рассчитать овуляцию</h3></caption>
                    <tbody>
                        <tr>
                            <td colspan="2">Выберите дату начала последней менструации:</td>
                            <td colspan="2"><input type="text" name="men_d" id="datepicker" required></td>
                            <td>
                                <!--<div id="datepicker5"></div>-->
                            </td>
                        </tr>
                        <tr>
                            <td>Длительность цикла:</td>
                            <td><input type="number" name="cycle" min="21" max="35" required></td>
                            <td>Продолжительность менструации:</td>
                            <td><input type="number" name="menstr" min="3" max="7"></td>
                            <td><input type="submit" value="Рассчитать"></td>
                        </tr>
                    </tbody>
            </form>
        </table>   
    </body>
</html>
