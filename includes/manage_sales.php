<?php
class Managesales
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

		//("SELECT ((SELECT SUM(qty) FROM ".$table." WHERE pid=".$id." AND entry_type='".$pk."')*1)-(SELECT SUM(qty) FROM ".$table." WHERE pid=".$id." AND entry_type='".$pk1."') as a");
	public function getstockbalance($table,$id,$pk,$pk1){
		
		$pre_stmt=$this->con->prepare("SELECT ((SELECT SUM(qty) FROM ".$table." WHERE pid=".$id." AND entry_type='".$pk."')*1)-((SELECT SUM(qty) FROM ".$table." WHERE pid=".$id." AND entry_type='".$pk1."')*1) as a");
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
 	
 	public function storesales($s_invoice_date,$customer_id,$ar_qty,$ar_price,
 		$ar_pro_name,$ar_pid,$sub_total,$gst,$discount,$net){

 				$pre_stmt=$this->con->prepare("INSERT INTO `s_invoice`(`s_invoice_date`, `customer_id`, `sub_total`, `gst`, `discount`, `net_total`) VALUES (?,?,?,?,?,?)");
				$pre_stmt->bind_param("sidsdd",$s_invoice_date,$customer_id,$sub_total,$gst,$discount,$net);
				$pre_stmt->execute() or die($this->con->error);
				
//INSERT INTO `s_invoice_details`(`inv_no`, `product_name`, `pid`, `product_price`, `qty`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
				
				$invoice_no=$pre_stmt->insert_id;
				if($invoice_no != null){
					for($i=0;$i < count($ar_price);$i++){ 
						     $insert_product=$this->con->prepare("INSERT INTO `s_invoice_details`(`inv_no`, `product_name`,`pid`,`product_price`, `qty`) VALUES (?,?,?,?,?)");
							$insert_product->bind_param("isidd",$invoice_no,$ar_pro_name[$i],$ar_pid[$i],$ar_price[$i],$ar_qty[$i]);
						$insert_product->execute()or die($this->con->error);
						
						//stock table updation

						$entry_type="SALES";
						$insert_stock=$this->con->prepare("INSERT INTO `stock1`(`entry_type`, `inv_date`, `inv_no`, `pid`, `qty`) VALUES (?,?,?,?,?)");
						$insert_stock->bind_param("ssiid",$entry_type,$s_invoice_date,$invoice_no,$ar_pid[$i],$ar_qty[$i]);
						$insert_stock->execute()or die($this->con->error);

					}
					return true;
				}
 	

 	}


 	public function manage_sales_details($table){
		
		if ($table=="s_invoice")
		{
			// $sql="SELECT p.pid,p.product_name,c.category_name,b.brand_name,p.product_price,p.product_packing,p.added_date,p.p_status FROM products p,brands b,categories c where b.bid=p.bid AND c.cid=p.cid ";


			$sql="SELECT s.s_invoice_no,s.s_invoice_date,c.customer_name,s.sub_total,s.gst,s.discount,s.net_total FROM s_invoice s,customer c where s.customer_id=c.customer_id";
			
			

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


	public function total_sales_calculate($table){
		if($table=="s_invoice")
		{
			$sql="SELECT sum(sub_total)as'sub',sum(gst)as'gst',sum(discount)as'disc',sum(net_total)as'net' FROM s_invoice";
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


		public function viewsalesrecordsouter($table,$pk,$id){

			if($table="s_invoice")
			{


	$result=$this->con->query("SELECT s.s_invoice_no,s.s_invoice_date,c.customer_name,s.sub_total,s.gst,s.discount,s.net_total FROM s_invoice s,customer c where s.customer_id=s.customer_id AND ".$pk."=".$id."") or die($this->con->error);
			
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
public function viewsalesrecordsinner($table,$pk,$id){

			if($table="s_invoice_details")
			{


		$result=$this->con->query("SELECT * FROM `s_invoice_details` WHERE ".$pk."=".$id."") or die($this->con->error);
			
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


	public function manage_sales_report($table,$sd,$ed){
	//public function manage_purchase_report($table){
		
		if ($table=="s_invoice")
		{
		$sql="SELECT s.s_invoice_no,s.s_invoice_date,c.customer_name,s.sub_total,s.gst,s.discount,s.net_total FROM s_invoice s,customer c WHERE  s.customer_id=c.customer_id AND s_invoice_date BETWEEN '$sd' AND LAST_DAY('$ed')";
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




	public function total_sales_calculate_date($table,$sd,$ed){
		if($table=="s_invoice")
		{
			$sql="SELECT sum(sub_total)as'sub',sum(gst)as'gst',sum(discount)as'disc',sum(net_total)as'net' FROM s_invoice WHERE s_invoice_date BETWEEN '$sd'AND LAST_DAY('$ed')";
	    	$result=$this->con->query($sql) or die($this->con->error);
			return $result->fetch_assoc();
		}
	}
			
							

}

//$obj = new Managesales();
//echo "<pre>";
//print_r($obj->execute($sql));
//print_r($obj->update_record("products",["pid"=>$id],["cid"=>$cat,"bid"]);
//echo $obj->deleteRecord("categories","cid",33);
//print_r ($obj->getstockbalance("stock1",1,"purchase","sales"));
//print_r ($obj->getsinglerecord("customer","customer_id",20));
//print_r ($obj->manage_sales_details("s_invoice"));
//print_r ($obj->total_calculate("s_invoice"));
//print_r($obj->total_sales_calculate_date("s_invoice",'2018-10-01','2018-10-20'));
?>