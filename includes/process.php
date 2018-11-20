<?php
include_once("../database/constants.php");
include_once("dboperation.php");
include_once("manage.php");
//include_once("../template/update_brand.php");

//To  Get Category
if(isset($_POST["getcategory"])){
	$obj=new dboperation();
	$rows=$obj->getAllRecord("categories");
	foreach ($rows as $row ) {
		echo "<option value='".$row["cid"]."'>".$row["category_name"]."</option>";
		
	}
exit(); 
}

//Add Categories

if(isset($_POST["category_name"])){
	$obj=new dboperation();
	$result=$obj->addcategory($_POST["category_name"]);
	echo $result;
	exit();
	}

//Add Brands

if(isset($_POST["brand_name"])){
	$obj=new dboperation();
	$result=$obj->addbrand($_POST["brand_name"]);
	echo $result;
	exit();
	}



//To  Get Brands
if(isset($_POST["getbrand"])){
	$obj=new dboperation();
	$rows=$obj->getAllRecord("brands");
	foreach ($rows as $row ) {
		echo "<option value='".$row["bid"]."'>".$row["brand_name"]."</option>";
		
	}
exit(); 
}


//Add Product

	if(isset($_POST["added_date"]) And isset($_POST["product_name"])){
		$obj=new dboperation();
		$result=$obj->addproduct($_POST["select_cat"],
								$_POST["select_brand"],
								$_POST["product_name"],
								$_POST["product_price"],
								$_POST["product_packing"],
								$_POST["added_date"]); 	
		echo $result;
		exit();
		}
	 //Manage_category
	
	 if(isset($_POST["managecategory"])){
		$M=new Manage();
		$result=$M->manageRecord("categories");
		$rows=$result["rows"];
		if(count($rows)>0){
			$n=0;
			foreach ($rows as $row) {
				?>
				  <tr>

					<td><?php echo ++$n; ?></td>
					<td><?php echo $row["category_name"]; ?></td>
				   <!--<td><?php //echo $row["cid"]; ?></td>-->
					<td><a href="#" class="btn btn-success btn-sm">Active</a></td>
	                  <td>
	                    <a href="#" eid="<?php echo $row['cid'];?>"data-toggle="modal" data-target="#form_category"class="btn btn-info btn-sm edit_cat">Edit</a>
	                    <a href="#" did="<?php echo $row['cid'];?>"class="btn btn-danger btn-sm del_cat">Delete</a>
				    </td>
				  </tr>
				<?php
			}
			exit();
			
		}
	 }
  
	
	//Delete category

		if (isset($_POST["deletecategory"])){
		$m=new Manage();
		$result=$m->deleteRecord("categories","cid",$_POST["id"]);
		echo $result;
		}


	//update category

		if (isset($_POST["updatecategory"])) {
			$m=new Manage();
			$result=$m->getsinglerecord("categories","cid",$_POST["id"]);
			echo json_encode($result);
			
			exit();
		}


		//update record after getting data

		if(isset($_POST["update_category"])){
			$m=new Manage();
			$id=$_POST["cid"];
			$name=$_POST["update_category"];
			$result=$m->update_record("categories",["cid"=>$id],["category_name"=>$name,"status"=>1]);
			echo $result;
		}


	//------brand---------//

	//Manage_brand
	
	 if(isset($_POST["managebrand"])){
		$M=new Manage();
		$result=$M->manageRecord("brands");
		$rows=$result["rows"];
		if(count($rows)>0){
			$n=0;
			foreach ($rows as $row) {
				?>
				  <tr>

					<td><?php echo ++$n; ?></td>
					<td><?php echo $row["brand_name"]; ?></td>
				   <!--<td><?php //echo $row["cid"]; ?></td>-->
					<td><a href="#" class="btn btn-success btn-sm">Active</a></td>
	                  <td>
	                    <a href="#" eid="<?php echo $row['bid'];?>"data-toggle="modal" data-target="#form_brand"class="btn btn-info btn-sm edit_brand">Edit</a>
	                    <a href="#" did="<?php echo $row['bid'];?>"class="btn btn-danger btn-sm del_brand">Delete</a>
				    </td>
				  </tr>
				<?php
			}
			exit();
			
		}
	}

	
	//Delete Brand

	if (isset($_POST["deletebrand"])){
	$m=new Manage();
	$result=$m->deleteRecord("brands","bid",$_POST["id"]);
	echo $result;
	exit();
	}


	
	//update brand

		if (isset($_POST["updatebrand"])) {
			$m=new Manage();
			$result=$m->getsinglerecord("brands","bid",$_POST["id"]);
			echo json_encode($result);
			exit();
		}

	//update record after getting data

		if(isset($_POST["update_brand"])){
			$m=new Manage();
			$id=$_POST["bid"];
			$name=$_POST["update_brand"];
			$result=$m->update_record("brands",["bid"=>$id],["brand_name"=>$name,"status"=>1]);
			echo $result;
			exit();
		}






	//---------------------Product---------------------------------
		if(isset($_POST["manageproduct"])){
		$M=new Manage();
		$result=$M->manageRecord("products");
		$rows=$result["rows"];
		if(count($rows)>0){
			$n=0;
			foreach ($rows as $row) {
				?>
				  <tr>

					<td><?php echo ++$n; ?></td>
					<td><?php echo $row["product_name"]; ?></td>
				    <td><?php echo $row["category_name"]; ?></td>
				   	<td><?php echo $row["brand_name"]; ?></td>
				    <td><?php echo $row["product_price"]; ?></td>
				    <td><?php echo $row["product_packing"]; ?></td>
				    <td><?php echo $row["added_date"]; ?></td>
				     
				   
				   <!--<td><?php //echo $row["cid"]; ?></td>-->
					<td><a href="#" class="btn btn-success btn-sm">Active</a></td>
	                  <td>
	                    <a href="#" eid="<?php echo $row['pid'];?>"data-toggle="modal" data-target="#form_products"class="btn btn-info btn-sm edit_product">Edit</a>
	                    <a href="#" did="<?php echo $row['pid'];?>"class="btn btn-danger btn-sm del_product">Delete</a>
				    </td>
				  </tr>
				<?php
			}
			exit();
			
		}
	} 




	//Delete Product

	if (isset($_POST["deleteproduct"])){
	$m=new Manage();
	$result=$m->deleteRecord("products","pid",$_POST["id"]);
	echo $result;
	exit();
	}



	//Update Product

		if (isset($_POST["updateproduct"])) {
			$m=new Manage();
			$result=$m->getsinglerecord("products","pid",$_POST["id"]);
			echo json_encode($result);
			exit();
		}

	//update record after getting data

		if(isset($_POST["update_product"])){
			
			$m=new Manage();
			$id=$_POST["pid"];
			$name=$_POST["update_product"];
			$cat=$_POST["select_cat"];
			$brand=$_POST["select_brand"];
			$price=$_POST["product_price"];
			$packing=$_POST["product_packing"];
			$date=$_POST["added_date"];
			$result = $m->update_record("products",["pid"=>$id],["cid"=>$cat,"bid"=>$brand,"product_name"=>$name,"product_price"=>$price,"product_packing"=>$packing,"added_date"=>$date]);
			echo $result;
			exit();
		}




		//------------customer-----------

		//Add Customer

	if(isset($_POST["customer_name"]) And isset($_POST["customer_gst"]) And isset($_POST["customer_address1"]) And isset($_POST["customer_address2"]) And isset($_POST["customer_address3"])){
		$obj=new dboperation();
		$result=$obj->addcustomer($_POST["customer_name"],
								$_POST["customer_gst"],
								$_POST["customer_address1"],
								$_POST["customer_address2"],
								$_POST["customer_address3"]); 	
		echo $result;
		exit();
		}




		//---------------------Customer---------------------------------
		if(isset($_POST["managecustomer"])){
		$M=new Manage();
		$result=$M->manageRecord("customer");
		$rows=$result["rows"];
		if(count($rows)>0){
			$n=0;
			foreach ($rows as $row) {
				?>
				  <tr>

					<td><?php echo ++$n; ?></td>
					<td><?php echo $row["customer_name"]; ?></td>
				    <td><?php echo $row["customer_gst"]; ?></td>
				   	<td><?php echo $row["customer_address1"]; ?></td>
				    <td><?php echo $row["customer_address2"]; ?></td>
				    <td><?php echo $row["customer_address3"]; ?></td>
				   <td> <a href="#" eid="<?php echo $row['customer_id'];?>"data-toggle="modal" data-target="#form_customer"class="btn btn-info btn-sm edit_customer">Edit</a>
	                    <a href="#" did="<?php echo $row['customer_id'];?>"class="btn btn-danger btn-sm del_customer">Delete</a>
				    </td>
				  </tr>
				<?php
			}
			exit();
			
		}
	}

	//Delete Customer

	if (isset($_POST["deletecustomer"])){
	$m=new Manage();
	$result=$m->deleteRecord("customer","customer_id",$_POST["id"]);
	echo $result;
	exit();
	}

	if (isset($_POST["updatecustomer"])) {
			$m=new Manage();
			$result=$m->getsinglerecord("customer","customer_id",$_POST["id"]);
			echo json_encode($result);
			exit();
		}

	//-------update aftergetting the customer ------

	if(isset($_POST["update_customer_name"])){
			
			$m=new Manage();
			$id=$_POST["update_customer_id"];
			$customer_name=$_POST["update_customer_name"];
			$customer_gst=$_POST["update_customer_gst"];
			$customer_address1=$_POST["update_customer_address1"];
			$customer_address2=$_POST["update_customer_address2"];
			$customer_address3=$_POST["update_customer_address3"];
			$result = $m->update_record("customer",["customer_id"=>$id],["customer_name"=>$customer_name,"customer_gst"=>$customer_gst,"customer_address1"=>$customer_address1,"customer_address2"=>$customer_address2,"customer_address3"=>$customer_address3]);
			//$result = $m->update_record("customer",["customer_id"=>$id],["customer_name"=>$customer_name]);
			echo $result;


		}
 		



?>