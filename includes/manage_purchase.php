<?php
class Managepurchase
{
	private $con;

	function __construct()
	{
		include_once("../database/db.php");
		$db=new Database();
		$this->con=$db->connect();


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

		
	public function getstockbalance($table,$id,$pk,$pk1){
		
		$pre_stmt=$this->con->prepare("SELECT (SELECT SUM(qty) FROM ".$table." WHERE pid=".$id." AND entry_type='".$pk."')-(SELECT SUM(qty) FROM ".$table." WHERE pid=".$id." AND entry_type='".$pk1."') as a");
				$pre_stmt->execute() or die($this->con->error);
				$result=$pre_stmt->get_result();
				if($result->num_rows==1)
				{
					$row= $result->fetch_assoc();

				}
					return $row;
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
 	//		$bill_date,$invoice_no,$invoice_date,$customer_id,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net
 	public function storepurchase($bill_date,$invoice_no,$invoice_date,$customer_id,$ar_qty,$ar_price,
 		$ar_pro_name,$ar_pid,$sub_total,$gst,$discount,$net){

 				$pre_stmt=$this->con->prepare("INSERT INTO `p_invoice`(`bill_date`, `p_invoice_no`, `p_invoice_date`, `customer_id`, `sub_total`, `gst`, `discount`, `net_total`) VALUES 
 					(?,?,?,?,?,?,?,?)");
				$pre_stmt->bind_param("sssidsdd",$bill_date,$invoice_no,$invoice_date,$customer_id,$sub_total,$gst,$discount,$net);
				$pre_stmt->execute() or die($this->con->error);
				

				$invoice_no=$pre_stmt->insert_id;
				if($invoice_no != null){
					for($i=0;$i < count($ar_price);$i++){ 
						$insert_product=$this->con->prepare("INSERT INTO `p_invoice_details`(`inv_no`, `product_name`,`pid`,`product_price`, `qty`) VALUES (?,?,?,?,?)");
						$insert_product->bind_param("isidd",$invoice_no,$ar_pro_name[$i],$ar_pid[$i],$ar_price[$i],$ar_qty[$i]);
						$insert_product->execute()or die($this->con->error);
						
						//stock table updation

						$entry_type="PURCHASE";
						$insert_stock=$this->con->prepare("INSERT INTO `stock1`(`entry_type`, `inv_date`, `inv_no`, `pid`, `qty`) VALUES (?,?,?,?,?)");
						$insert_stock->bind_param("ssiid",$entry_type,$invoice_date,$invoice_no,$ar_pid[$i],$ar_qty[$i]);
						$insert_stock->execute()or die($this->con->error);

					}
					return true;
				}
 	

 	}




 	public function manageRecord($table){
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




 	public function manage_purchase_details($table){
		
		if ($table=="p_invoice")
		{
			// $sql="SELECT p.pid,p.product_name,c.category_name,b.brand_name,p.product_price,p.product_packing,p.added_date,p.p_status FROM products p,brands b,categories c where b.bid=p.bid AND c.cid=p.cid ";


			$sql="SELECT p.bill_no,p.bill_date,p.p_invoice_no,p.p_invoice_date,c.customer_name,p.sub_total,p.gst,p.discount,p.net_total FROM p_invoice p,customer c where p.customer_id=c.customer_id";
			
			

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


	public function total_purchase_calculate($table){
		if($table=="p_invoice")
		{
			$sql="SELECT sum(sub_total)as'sub',sum(gst)as'gst',sum(discount)as'disc',sum(net_total)as'net' FROM p_invoice";
	    	$result=$this->con->query($sql) or die($this->con->error);
			
			return $result->fetch_assoc();
		}
	}
	 
	 public function deleteRecord($table,$table1,$table2,$pk,$pk1,$pk2,$id){
	// $result=$m->deleteRecord("p_invoice","p_invoice_details","stock1","bill_no","inv_no","inv_no",$_POST["id"]);
   
	 				
				$pre_stmt=$this->con->prepare("DELETE FROM " .$table. " WHERE ".$pk." = ?");
					$pre_stmt->bind_param("i",$id);
					$pre_stmt->execute()or die($this->con->error);	
					
						$pk1="inv_no";
					$pre_stmt1=$this->con->prepare("DELETE FROM " .$table1. " WHERE ".$pk1." = ?");
					$pre_stmt1->bind_param("i",$id);
					$pre_stmt1->execute()or die($this->con->error);
					
					
						$pk2="inv_no";
					$pre_stmt2=$this->con->prepare("DELETE FROM " .$table2. " WHERE ".$pk2." = ?");
					$pre_stmt2->bind_param("i",$id);
					$result=$pre_stmt2->execute()or die($this->con->error);
					

					if($result)
					{
					return 1;
					}
				 
				 else{
					return 0;
				 }	
				}
				 //$result=$m->viewpurchaserecords("p_invoice","p_invoice_details","bill_no","inv_no",$_POST["id"]);
	public function viewpurchaserecordsouter($table,$pk,$id){

			if($table="p_invoice")
			{


		$result=$this->con->query("SELECT p.bill_no,p.bill_date,p.p_invoice_no,p.p_invoice_date,c.customer_name,p.sub_total,p.gst,p.discount,p.net_total FROM p_invoice p,customer c where p.customer_id=c.customer_id AND ".$pk."=".$id."") or die($this->con->error);
			
				return $result;					

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
}
public function viewpurchaserecordsinner($table,$pk,$id){

			if($table="p_invoice_details")
			{


		$result=$this->con->query("SELECT * FROM `p_invoice_details` WHERE ".$pk."=".$id."") or die($this->con->error);
			
				return $result;					

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
}
	
	
	public function manage_purchase_report($table,$sd,$ed){
	//public function manage_purchase_report($table){
		
		if ($table=="p_invoice")
		{
		$sql="SELECT p.bill_no,p.bill_date,p.p_invoice_no,p.p_invoice_date,c.customer_name,p.sub_total,p.gst,p.discount,p.net_total FROM p_invoice p,customer c WHERE  p.customer_id=c.customer_id AND p_invoice_date BETWEEN '$sd' AND LAST_DAY('$ed')";
		//$sql="SELECT * FROM $table WHERE p_invoice_date BETWEEN ('$sd') AND LAST_DAY('$ed')";
		//$sql="SELECT * from $table";
		

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




	public function total_purchase_calculate_date($table,$sd,$ed){
		if($table=="p_invoice")
		{
			$sql="SELECT sum(sub_total)as'sub',sum(gst)as'gst',sum(discount)as'disc',sum(net_total)as'net' FROM p_invoice WHERE p_invoice_date BETWEEN '$sd'AND LAST_DAY('$ed')";
	    	$result=$this->con->query($sql) or die($this->con->error);
			return $result->fetch_assoc();
		}
	}



														
		

}

//$obj = new Managepurchase();
//echo "<pre>";
//print_r($obj->execute($sql));
//print_r($obj->update_record("products",["pid"=>$id],["cid"=>$cat,"bid"]);
//echo $obj->deleteRecord("categories","cid",33);
//print_r ($obj->getstockbalance("stock1",1,"purchase","sales"));
//print_r ($obj->getsinglerecord("customer","customer_id",20));
//print_r ($obj->deleteRecord("p_invoice","p_invoice_details","stock1",""));
//public function viewpurchaserecords($table,$table1,$pk,$pk1,$id)
//print_r ($obj->viewpurchaserecordsinner("p_invoice_details","inv_no",13));
//print_r ($obj-> manage_purchase_report("p_invoice",'2018-10-20','2018-10-20'));
//print_r ($obj-> manage_purchase_report("p_invoice"));
//print_r($obj->total_purchase_calculate_date("p_invoice",'2018-10-10','2018-10-20'));
?>