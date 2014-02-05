<?php
class classDb
{
	private $dbHandler = NULL;
	private $dbResult = NULL;
	
	function __construct($host, $user, $password, $dbname)
	{
		$this->dbHandler = mysql_connect($host, $user, $password);
		if(!$this->dbHandler)
		{
			die('No connect');
		}
		if(!mysql_select_db($dbname, $this->dbHandler))
		{
			die('No DB');
		}
		mysql_query('SET NAMES \''.DB_CHARSET.'\';');
	}
	function __distruct()
	{
		if($this->dbHandler != NULL)
		{
			@mysql_close($this->dbHandler);
		}
	}
	
	private function query($_com)
	{
		$this->dbResult = mysql_query($_com);
		if(!$this->dbResult)
		{
			echo '<p style="color:red">'.mysql_error().'</p>';
		}
	}
	
	private function getResultToArray()
	{
		$rows = array();
		while($row = mysql_fetch_assoc($this->dbResult))
		{
			$rows[] = $row;
		}
		return $rows;
	}
	 public function UPDATE($_com)
	 {
		$this->query($_com);
	 }
	 
	 public function DELETE($_com)
	 {
		$this->query($_com);
	 }
	 
	 public function INSERT($_com)
	 {
		$this->query($_com);
		return mysql_insert_id($this->dbHandler);
	 }
	 
	 public function SELECT($_com)
	 {
		$this->query($_com);
		return $this->getResultToArray();
	 }
}



?>