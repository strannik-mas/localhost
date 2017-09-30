<?php
/*
** Сценарий возвращает текущее время
*/

// Установка типа данных и кодировки
header("Content-type: "."text/plain; charset=utf-8");

// Текущее время
header("Current-Time: ".date("H:i:s"));
?>
Данные в заголовках