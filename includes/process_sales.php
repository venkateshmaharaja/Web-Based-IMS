<?php
include_once("../database/constants.php");
include_once("dboperation.php");
include_once("manage_sales.php");

//get the purchase item

if (isset($_POST["getsalesitem"])) {
	$obj=new dboperation();
	$rows=$obj->getAllRecord("products");
	?>
	<tr>
          <td><b class="number">1</b></td>
           <td>
             <select name="pid[]" class="form-control form-control-sm pid" required>
             	<option value="">Choose Product</option>
              <?php
                foreach ($rows as $row ) {
                 ?><option value="<?php echo $row['pid']; ?>"><?php echo $row["product_name"]; ?></option><?php
                }
               ?>
                     </select>
                       </td>
                     <td><input name="tqty[]" type="text" class="form-control form-control-sm tqty" readonly></td>     
                 <td><input name="qty[]" type="text" class="form-control form-control-sm qty"required></td>
            <td><input name="price[]" type="text" class="form-control form-control-sm price" readonly></td>
            <td><span><input name="pro_name[]" type="hidden" class="form-control form-control-sm pro_name"></span></td>
                        <td>Rs.<span class="amt">0</span></td>
  </tr>
   <?php 
   exit();
}


//get price of one item
if (isset($_POST["getprice"])) {
	$m=new Managesales();
	$result=$m->getsinglerecord("products","pid",$_POST["id"]);
 	echo json_encode($result);
	exit();

 		# code...
 	} 	
if (isset($_POST["getstockbalance"])) {
	$m=new Managesales();
	//$sales="sales";
	$result=$m->getstockbalance("stock1",$_POST["id"],"PURCHASE","SALES");
	echo json_encode($result);
	}

  //Get the Customer or Buyer name
  if(isset($_POST["getcustomeraddress"])){
  $obj=new Managesales();
  $rows=$obj->getAllRecord("customer");
  foreach ($rows as $row ) {
    echo "<option value='".$row["customer_id"]."'>".$row["customer_name"]."</option>";
    //echo ($rows);
  }
  exit(); 
}

//fetch the customer address 
if(isset($_POST["fetchcustomeraddress"])){
  
  $obj=new Managesales();
  $result=$obj->getsinglerecord("customer","customer_id",$_POST["id"]);
  echo json_encode($result);
  
  exit(); 
}


//sales form entry

  if(isset($_POST["invoice_date"])And isset($_POST["customer"]))
  {

    
    $invoice_date=date($_POST["invoice_date"]);
   // echo'<script>alert("' . $invoice_date . '")</script>';
    
    $customer_id=$_POST["customer"];
   // echo'<script>alert("' . $customer_id . '")</script>';

    $ar_qty=$_POST["qty"];
   // echo'<script>alert("' . $ar_qty . '")</script>';

    $ar_price=$_POST["price"];
   // echo'<script>alert("' . $ar_price . '")</script>';

    $ar_pro_name=$_POST["pro_name"];
  //  echo'<script>alert("' . $ar_pro_name . '")</script>';

     $ar_pid=$_POST["pid"];
  //  echo'<script>alert("' . $ar_pid . '")</script>';

    $sub_total=$_POST["sub_total"];
  //  echo'<script>alert("' . $sub_total . '")</script>';

    $gst=$_POST["gst"];
  //  echo'<script>alert("' . $gst . '")</script>';

    $discount=$_POST["discount"];
  //  echo'<script>alert("' . $discount . '")</script>';

    $net=$_POST["Net_Amount"];
  //  echo'<script>alert("' . $net . '")</script>';
    


    $m=new Managesales();
    echo $result=$m->storesales($invoice_date,$customer_id,$ar_qty,$ar_price,$ar_pro_name,$ar_pid,$sub_total,$gst,$discount,$net);
    //die( $result=$m->storepurchase($bill_date,$invoice_no,$invoice_date,$customer_id,$invoice_no,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net));


    
  }


  if(isset($_POST["managesales"])){
    $M=new Managesales();
    $result=$M->manage_sales_details("s_invoice");
    $rows=$result["rows"];
    if(count($rows)>0){
      $n=0;
      foreach ($rows as $row) {
        ?>
          <tr>

          <td><?php echo ++$n; ?></td>
           <td><?php echo $row["s_invoice_no"]; ?></td>
           <td><?php echo $row["s_invoice_date"]; ?></td>
           <td><?php echo $row["customer_name"]; ?></td>
            <td><?php echo $row["sub_total"]; ?></td>
            <td><?php echo $row["gst"]; ?></td>
            <td><?php echo $row["discount"]; ?></td>
            <td><?php echo $row["net_total"]; ?></td>
             
                    <td>
                      <a href="http://localhost/Mini_Project/includes/inv_bill_sales.php?id=<?php echo $row['s_invoice_no'];?>"class="btn btn-info btn-sm edit_sales">View</a>
                      <a href="#" did="<?php echo $row['s_invoice_no'];?>"class="btn btn-danger btn-sm del_sales">Delete</a>
            </td>
          </tr>
        <?php
      }
      exit();
      
    }
  }

  if(isset($_POST["total_sales_calculate"])){

      $M=new Managesales();
      $result=$M->total_sales_calculate("s_invoice");
        ?>
        
         <tr bgcolor="#429ef4">
          <td colspan="4">TOTAL </td>
            <td><?php echo $result["sub"];?></td>
            <td><?php echo $result["gst"];?></td>
            <td><?php echo $result["disc"];?></td>
            <td><?php echo $result["net"];?></td>
          <td></td>
          </tr>
<?php
      exit();

      
        }



        //Delete Sales Entry

    if (isset($_POST["deletesales"])){
        $m=new Managesales();
        $result=$m->deleteRecord("s_invoice","s_invoice_details","stock1","s_invoice_no","inv_no","inv_no",$_POST["id"]);
    echo $result;
    exit();
  }




   if(isset($_POST["total_sales_calculate_date"])){
         $M=new Managesales();
         $result=$M->total_sales_calculate_date("s_invoice",$_POST["sd"],$_POST["ed"]);
        ?>
        
         <tr bgcolor="#429ef4">
          <td colspan="4">TOTAL </td>
            <td><?php echo $result["sub"];?></td>
            <td><?php echo $result["gst"];?></td>
            <td><?php echo $result["disc"];?></td>
            <td><?php echo $result["net"];?></td>
          <td></td>
        </tr>
<?php
      exit();

      
        } 






   if(isset($_POST["managesalesreport"])){
    $M=new Managesales();
    $result=$M->manage_sales_report("s_invoice",$_POST["sd"],$_POST["ed"]);
    
    $rows=$result["rows"];
    if(count($rows)>0){
      $n=0;
      foreach ($rows as $row) {
        ?>
          <tr>

          <td><?php echo ++$n; ?></td>
           <td><?php echo $row["s_invoice_no"]; ?></td>
           <td><?php echo $row["s_invoice_date"]; ?></td>
           <td><?php echo $row["customer_name"]; ?></td>
            <td><?php echo $row["sub_total"]; ?></td>
            <td><?php echo $row["gst"]; ?></td>
            <td><?php echo $row["discount"]; ?></td>
            <td><?php echo $row["net_total"]; ?> </td>     
           
          </tr>
        <?php
      }
      exit();
      
    }
  }



?>