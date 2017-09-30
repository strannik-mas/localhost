<?php
/*
** Скрипт возвращает последние записи в гостевой книге
*/

// Читаем данные, переданные в POST
$rawPost = file_get_contents('php://input');

// Заголовки ответа
header('Content-type: text/plain; charset=utf-8');
header('Cache-Control: no-store, no-cache');
header('Expires: ' . date('r'));

// Если данные были переданы...
if ($rawPost)
{
	// Разбор пакета JSON
	$record = json_decode($rawPost);
	//print_r($record);
	// Открытие БД
	$db = new SQLiteDatabase('chat.db');

	// Подготовка данных
	$author = sqlite_escape_string($record->author);
	$message = sqlite_escape_string($record->message);
	$date = time();
	
	// Запрос
	$sql = "INSERT INTO chat (author, message, date)
		VALUES ('$author', '$message', $date)";
	$db->query($sql);

	// Возврат результата
	echo json_encode(
		array
		(
			'result' => 'OK', 
			'lastInsertRowId' => $db->lastInsertRowid
		)
	);
}
else
{
	// Данные не переданы
	echo json_encode(
		array
		(
			'result' => 'No data'
		)
	);
}
?>