<?php
/**
 * 
 */
class Database
{
	private $con;
	public function connect()

	{
	include_once("constants.php");
	$this->con = new mysqli(HOST,USER,PASS,DB);
	if($this->con)
	{
		//echo("connected");
		return $this->con;
		
	}	# code...
	return "Database connection failed";
}	
}
//$db=new Database();
//$db->connect();
?>