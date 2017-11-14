<?php
/**
*	inerface IHolDB
*		содержит основные методы для работы с праздниками
*/
interface IHolDB{
	/**
	*	Добавление новой записи к ленте праздников
	*	
	*	@param int $day - число месяца
	*	@param int $month - Месяц
	*	@param int $prodolzh - продолжительность, дней
	*	@param int $dweek - день недели
	*	@param int $week - неделя
	*	
	*	@return boolean - результат успех/ошибка
	*/
	function saveH($day, $month, $prodolzh, $dweek, $week);
	/**
	*	Выборка всех праздников
	*	
	*	@return array - результат выборки в виде массива
	*/
	function getH();
	/**
	*	Удаление праздника
	*	
	*	@param integer $id - идентификатор удаляемой записи
	*	
	*	@return boolean - результат успех/ошибка
	*/
	function deleteH($id);
}
?>