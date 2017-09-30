<?php
$db = new SQLiteDatabase("chat.db");

$db->query(
		"CREATE TABLE chat
		(
			id INTEGER PRIMARY KEY, -- Код записи
			author TEXT,            -- Автор записи 
			message TEXT,           -- Текст сообщения
			date NUMERIC            -- Дата и время создания записи
		)"
	);

$db->query(
		"CREATE INDEX chat_date ON chat(date ASC)"
	);
?>