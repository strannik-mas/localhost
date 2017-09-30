<?php
// Класс записи чата
class GBookRecord
{
	public $id;       // Код записи
	public $author;   // Автор записи
	public $message;  // Сообщение автора
	public $date;     // Дата и время сообщения
	
	public function __construct($id=0, $author='', $message='', $date='')
	{
		$this->id = $id;
		$this->author = $author;
		$this->message = $message;
		$this->date = $this->convertDate2String($date);
	}
	
	// Преобразует дату в строковый вид
	public function convertDate2String($date)
	{
		if (is_numeric($date))
			return date('d.m.Y H:i:s', $date);
		else
			return $date;
	}
}
?>