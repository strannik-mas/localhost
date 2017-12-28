<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Отправка формы</title>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script>
            $(function(){
                $('#f1').on('submit',function(){
                   $.post("func.php", {name:$('#fname').val(), tel:$('#tel').val()})
                    .done(function(data){
                        if(data == 1){
                            $('#f1').hide();
                            $('body').append('<h2>Данные добавлены</h2>');
                        }
                     })
                    .fail(function(data){
                        alert('error');
                        console.log(data);   
                    });
                });
            })
        </script>
    </head>
    <body>
        <form id="f1" onsubmit="return false">
            <label for="fname">Ваше имя: </label>
            <input type="text" id="fname" pattern="^[A-Za-zА-Яа-яЁё\s]+$" required><br>
            <label for="tel">Телефон: </label>
            <input type="number" id="tel"><br>
            <input type="submit" value="Отправить" />
        </form>
    </body>
</html>