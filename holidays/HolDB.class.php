<?php
include "IHolDB.class.php";
class HolDB implements IHolDB{
	const DB_NAME = 'holydays.db';
	protected $_db;
	protected $_items = array();
	function __construct(){
		try{
			if(is_file(self::DB_NAME) && filesize(self::DB_NAME) != 0){
				$this->_db = new SQLite3(self::DB_NAME);
			}else{
				$this->_db = new SQLite3(self::DB_NAME);
				$sql = "CREATE TABLE hlds(
										id INTEGER PRIMARY KEY AUTOINCREMENT,
										day INTEGER,
										month INTEGER,
										prodolzh INTEGER,
										dweek INTEGER,
										week INTEGER
									)";
							
				$this->_db->exec($sql) or die($this->_db->lastErrorMsg()); 					
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	function __destruct(){
		unset($this->_db);
	}
	function saveH($day, $month, $prodolzh, $dweek, $week){
		$sql = "INSERT INTO hlds(
					day,
					month,
					prodolzh,
					dweek,
					week
					)
				VALUES (
					$day,
					$month,
					$prodolzh,
					$dweek,
					$week
				)";
			try{
				$res = $this->_db->exec($sql);
				if (!$res)
					throw new Exception($this->_db->lastErrorMsg());
				return true;
			}catch(Exception $e){
				return false;
			}
		
	}	
	protected function db2Arr($data){
		$arr = array();
		while ($row = $data-> fetchArray(SQLITE3_ASSOC))
				$arr[] = $row;
			return $arr;	
	}
	public function getH(){
			$sql = "SELECT id, day, month, prodolzh, dweek, week
					FROM hlds
					ORDER BY hlds.id DESC";
			$result = $this->_db->query($sql) or die ('ERROR');
			return $this->db2Arr($result);
	}	
	public function deleteH($id){
		try{
			$sql = "DELETE FROM hlds WHERE id = $id";
			$result = $this->_db->query($sql);
			if (!$result)
					throw new Exception($this->_db->lastErrorMsg());
			return true;
		}catch(Exception $e){
				echo $e->getMessage();
				return false;
		}
	}
}
?>