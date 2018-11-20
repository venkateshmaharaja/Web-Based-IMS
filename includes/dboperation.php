<?php

/**
 *  
 */
class dboperation
{
 private $con;
 
 function __construct()
 	{
 		include_once("../database/db.php");
 		$db = new Database();
 		$this->con = $db->connect();
       
 		
 	}
 
 	public function addcategory($cat){
 		$pre_stmt = $this->con->prepare("INSERT INTO `categories`(`category_name`, `status`) 
 		VALUES (?,?)");	
 		$status=1;
 		$pre_stmt->bind_param("si",$cat,$status);
		$result=$pre_stmt->execute() or die($this->con->error);
		if($result)
		{
			return 1;
		}else{
		
			return 0;
 		}

 	}
 	public function getAllRecord($table){
 		$pre_stmt=$this->con->prepare("SELECT * FROM ".$table);
 		$pre_stmt->execute() or die ($this->con->error);
 		$result=$pre_stmt->get_result();
 		$rows=array();
 		if($result->num_rows>0)
 		{
 			while ($row=$result->fetch_assoc()) {
 				$rows[]=$row;
 			}
 			return $rows;
 		}
 		return "NO_DATA";
 	}


    public function addbrand($brand){
 		$pre_stmt = $this->con->prepare("INSERT INTO `brands`(`brand_name`, `status`) 
 		VALUES (?,?)");	
 		$status=1;
 		$pre_stmt->bind_param("si",$brand,$status);
		$result=$pre_stmt->execute() or die($this->con->error);
		if($result)
		{
			return 1;
		}else{
		
			return 0;

 		}
 	}
	public function addproduct($cid,$bid,$pro_name,$price,$packing,$date){
 		$pre_stmt = $this->con->prepare("INSERT INTO `products`(`cid`, `bid`,
 		 `product_name`, `product_price`, `product_packing`, `added_date`, `p_status`) 
 		 VALUES (?,?,?,?,?,?,?)");	
 		$status=1;
 		$pre_stmt->bind_param("iisdssi",$cid,$bid,$pro_name,$price,$packing,$date,$status);
		$result=$pre_stmt->execute() or die($this->con->error);
		//$pre_stmt->execute() or die($this->con->error);
				

				//Stock table empty value 0 updation
						$pid=$pre_stmt->insert_id;
						$entry_type1="PURCHASE";
						$entry_type2="SALES";
						$inv_no=0;
						$qty=0;
						$insert_stock1=$this->con->prepare("INSERT INTO `stock1`(`entry_type`, `inv_date`, `inv_no`, `pid`, `qty`) VALUES (?,?,?,?,?)");
						$insert_stock1->bind_param("ssiid",$entry_type1,$date,$inv_no,$pid,$qty);
						$insert_stock1->execute()or die($this->con->error);


						$insert_stock2=$this->con->prepare("INSERT INTO `stock1`(`entry_type`, `inv_date`, `inv_no`, `pid`, `qty`) VALUES (?,?,?,?,?)");
						$insert_stock2->bind_param("ssiid",$entry_type2,$date,$inv_no,$pid,$qty);
						$insert_stock2->execute()or die($this->con->error);

		if($result)
		{
			return 1;
		}else{ 
		
			return 0;

 		}
 	}
//Add Customer
 	public function addcustomer($customer_name,$customer_gst,$customer_address1,$customer_address2,$customer_address3){
 		$pre_stmt = $this->con->prepare("INSERT INTO `customer`(`customer_name`,`customer_gst`,`customer_address1`, `customer_address2`, `customer_address3`) VALUES (?,?,?,?,?)"); 
 		$pre_stmt->bind_param("sssss",$customer_name,$customer_gst,$customer_address1,$customer_address2,$customer_address3);
		$result=$pre_stmt->execute() or die($this->con->error);
		if($result)
		{
			return "New_Customer_Added";
		}else{ 
		
			return 0;

 		}
 	}


}

//$opr=new dboperation();
//echo $opr->addproduct(1,1,"Georgia",7000,1000,28-07-2018);
//echo "<pre>";
//print_r($opr->getAllRecord("categories"));

?>