<?php 
include_once('manage_sales.php');
if(isset($_GET['id'])){
 
  $manage=new Managesales();
  $result=$manage->viewsalesrecordsouter('s_invoice','s_invoice_no',$_GET['id']);

  $row=$result->fetch_assoc();
 // print_r($row);
  
  $resultinner=$manage->viewsalesrecordsinner('s_invoice_details','inv_no',$_GET['id']);

  //print_r($row1=$resultinner->fetch_assoc());
  
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   
    <title>Bill</title>
  </head>
  <style type="text/css">
    .bill{ border:1px solid grey; box-shadow:2px 2px 3px gray; }
.invoice{ border:0px solid grey; }
.ctitle{ border:1px solid grey; padding-top:15px; }
.cright{ border:1px solid grey; padding-top:15px; }
.trow{ border-bottom:1px solid grey; }
#signspace{ padding:20px; }
  </style>
  <body>
   
      <div class="container bill mt-4">
  <div class="invoice text-center">
    <h4>INVOICE</h4>
  </div>
  <div class="title">
    <div class="row mt-3">
      <div class="col-9 text-center ctitle">
        <div><h2>Sri Vishnu Agencies</h2>
          
          <p>WIP : 34 Women Sector, SIDCO Industrial Estate, Thirumudivakkam</p>
          <p>Chennai- 600 132, e-mail : srivishnuagencies@yahoo.com</p>
          <p>9840943077 , 9514937399 ,</p>
        </div>
      </div>
      <div class="col-3 cright">
        <div class="row">
          <div class="col-9">
            <b>INVOICE NO : </b>
          </div>
        <div class="col-3">
          <p id="invoice_no"><?php echo $row['s_invoice_no']; ?></p> 
        </div>
      </div>
         <div class="row">
          
          <div class="col-5">
            <b>DATE : </b>
          </div>
        <div class="col-7">
          <p id="invoice_date"><?php echo $row['s_invoice_date']; ?></p> 
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- TITLE Pharma c f over -->
 <div class="pt-3 trow">
   <div class="row">
     <div class="col-9">
       <p><b>BUYER : </b></p>
       <div class="ml-5">
         <h4><?php echo $row['customer_name']; ?></h4>
         <p class="d-none" id="buyer_address">something</p>
       </div>
     </div>
     <div class="col-3"></div>
   </div>
  </div>
  
  <div class="itemtable">
    <table class="table table-bordered">
      <thead>
      <tr>
        <th>S.NO</th>
        <th>Particulars</th>
        <th>QTY</th>
        <th>RATE</th>
        <th>AMOUNT</th>
      </tr>
     </thead>
      <tbody id="items">
      <?php 
        $n=1;
        while ($row1=$resultinner->fetch_assoc()) {
    
         echo "<tr>
            <td>".$n."</td>
            <td>".$row1['product_name']."</td>
            <td>".$row1['qty']."</td>
            <td>".$row1['product_price']."</td>
            <td>".$row1['product_price']*$row1['qty']."</td>
          </tr>";
          $n++;
       }


      ?>    
      </tbody>
    </table>
  </div>
  
  <div class="frow">
    <div class="row">
      <div class="col-7"></div>
      <div class="col-5">
        <div class="row">
          <div class="col-5 text-right font-weight-bold">
             <p>Sub total : </p>
             <p>GST :  </p>
             <p>Discount :  </p>
             <p>Total Amount :  </p>
          </div>
           <div class="col-4 pl-4 font-weight-bold">
             <p id="sub_total"><?php echo $row['sub_total']; ?> </p>
             <p id="gst"><?php echo $row['gst']; ?> </p>
             <p id="discount"><?php echo $row['discount']; ?>  </p>
             <p id="total_amount"><?php echo $row['net_total']; ?> </p>
          </div>
          <div class="col-4"></div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="footer">
    <div class="row">
      <div class="col-5">
        <h5>Declaration :</h5>
        <p>We declare that this invoice shows the actual
price of the goods</p>
      </div>
       
      <div class="col-5 text-center">
        <h6>For SRI VISHNU AGENCIES</h6>
         <div id="signspace"></div>
         <p><b>Authorized Signature</b></p>
      </div>
     
    </div>
  </div>
  
</div>
<div class="col-2-sm text-center m-2">
        <button onclick="window.print();" type="button" class="btn btn-secondary">print</button>
         <div id="print"> <script type="text/javascript" src="js/inv_bill_sales.js"></script></div>  
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


  </body>
</html>