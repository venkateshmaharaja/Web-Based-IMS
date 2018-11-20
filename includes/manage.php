<?php
class Manage
{
	private $con;

	function __construct()
	{
		include_once("../database/db.php");
		$db=new Database();
		$this->con=$db->connect();


	}
	public function manageRecord($table){
		if ($table == "categories") {
			//$sql="SELECT * FROM categories";
			$sql="SELECT * FROM ".$table;
		}
		elseif ($table=="products")
		{
			$sql="SELECT p.pid,p.product_name,c.category_name,b.brand_name,p.product_price,p.product_packing,p.added_date,p.p_status FROM products p,brands b,categories c where b.bid=p.bid AND c.cid=p.cid ";
		}
		
		else
		{
			$sql="SELECT * FROM ".$table;	
		}	
		

		$result=$this->con->query($sql) or die($this->con->error);
		$rows=array();
		if($result->num_rows > 0)
		{
			while($row=$result->fetch_assoc())
			{
				$rows[]=$row;
			}
		}
		return["rows"=>$rows]; 
	}


	public function deleteRecord($table,$pk,$id){
	
			if($table == "categories"){
		    	
					$pre_stmt=$this->con->prepare("DELETE FROM " .$table. " WHERE ".$pk." = ?");
					$pre_stmt->bind_param("i",$id);
					$result=$pre_stmt->execute()or die($this->con->error);
					if($result){
					return "CATEGORIES_DELETE";
					}
				 
				 else{
					return "ID_Not_Match";
				 }
				
			}
			
			else
			{
				$pre_stmt=$this->con->prepare("DELETE FROM " .$table. " WHERE ".$pk." = ?");
					$pre_stmt->bind_param("i",$id);
					$result=$pre_stmt->execute()or die($this->con->error);
					if($result){
					return "DELETED";

					}
				 
				else{
					return "ID_Not_Match";
				 }
			}
			
		
				
		
}
	public function getsinglerecord($table,$pk,$id){
		$pre_stmt=$this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk."= ?");
		$pre_stmt->bind_param("i",$id);
		$pre_stmt->execute() or die($this->con->error);
		$result=$pre_stmt->get_result();
		if($result->num_rows==1)
		{
			$row=$result->fetch_assoc();

		}
		return $row;
	}


	public function update_record($table,$where,$fields){
		
		$sql="";

		$condition="";

		foreach ($where as $key => $value) {
			$condition .=$key ."='" . $value . "' AND ";
		}
		$condition=substr($condition, 0,-5);
		foreach ($fields as $key => $value) {
			$sql .= $key . "='".$value."', ";
		}
		$sql=substr($sql,0,-2); 

		$sql="UPDATE ".$table." SET ".$sql." WHERE ".$condition;
		if(mysqli_query($this->con,$sql)){
			return "UPDATED";
		}
	}



}

//$obj = new Manage();
//echo "<pre>";
//print_r($obj->execute($sql));
//print_r($obj->update_record("products",["pid"=>$id],["cid"=>$cat,"bid"]);
//echo $obj->deleteRecord("categories","cid",33);

?>