<?php
/*
** Скрипт возвращает последние записи в гостевой книге
*/

require_once('gbookrecord.class.php');

define('MAX_RECORDS', 10);

$db = new SQLiteDatabase('chat.db');
$res = $db->query('SELECT * FROM chat ORDER BY date DESC');
$lastMod = $db->singleQuery('SELECT MAX(date) AS max_date FROM chat');

$records = array();
$recordCount = 0;
while ($row = $res->fetch(SQLITE_ASSOC))
{
	$records[] = new GBookRecord(
			$row['id'],
			$row['author'],
			$row['message'],
			$row['date']
		);
	$recordCount++;
	if ($recordCount >= MAX_RECORDS) break;
}

// Передаем заголовки и JSON пакет данных
header('Content-type: text/plain; charset=utf-8');
header('Cache-Control: no-store, no-cache');
header('Expires: ' . date('r'));
header('Last-Modified: ' . date('r', $lastMod));
echo json_encode($records);

?>