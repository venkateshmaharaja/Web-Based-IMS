<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SVA INVENTORY</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="js/purchase_entry.js"></script>
    
    <body>  
      <div class="overlay"><div class="loader"></div></div>
        <!--nav bar-->
      <?php include_once("./template/header.php");?>
        <br/>

        <div class="container">
          <div class="row"> 
            <div class="col-md-12 mx-auto">
              <div class="card" style="box-shadow: 0 0 15px 0 lightgray;">
                <div class="card-header">
                  <h4>New Purchase</h4>
                </div>
                  <div class="card-body">
                    <form id="purchase_entry_form" onsubmit="return false">
                       
                       <!--Customer Details start -->
                        <div class="form-row">
                          <div class="form-group col-sm-">
                            <label for="Bil_date">Billing Date :</label>
                            </div>
                             <div class="form-group col-sm-">
                            <input type="date"  class="form-control" id="bill_date" name="bill_date" value="<?php echo date("Y-m-d");?>" Readonly/>
                            </div>
                          <div class="form-group col-sm-">
                            <label for="inputbillnumber">Invoice No :</label>
                          </div>
                          <div class="form-group col-sm-">
                            <input type="text" class="form-control" id="invoice_no" name="invoice_no" placeholder="Pur Invoice No" required>
                          </div>
                          <div class="form-group col-sm-">
                            <label for="inputinvoicenumber">Invoice Date :</label>
                          </div>
                          <div class="form-group col-sm-4">
                            <input type="date" class="form-control" id="invoice_date" name="invoice_date"placeholder="Like (d-m-y) example : 02-10-1996" required>
                          </div>

                          <div class="form-group col-sm-">
                            <label for="customer">Buyer / Supplier Name :</label>
                          </div>  
                          <div class="form-group col-sm-8">
                            <select id="customer" name="customer" class="form-control">
                              <option value=1>Supplier / Buyer Name</option>
                           </select>
                          </div>
                         </div>

                         <table align="center" style="box-shadow:0 0 15px 0 lightblue; width:1000px">
                           <tbody id="customer_details"> 
                             <tr align="center">
                             <td class="gst" ></td>
                             <td class="address1"> </td>
                              <td class="address2"> </td>
                              <td class="address3"> </td>
                             </tr>   
                           </tbody>
                         </table>
                       </br>
                      <!--cusomer Details End -->
                        

                      <div class="card" style="box-shadow: 0 0 15px 0 lightgray;">
                        <div class="card-body">
                          <h4>Place the product</h4>
                          <table align="center" style="width: 800px"> 
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th style="text-align:center;">Item Name</th>
                                  <th style="text-align:center;">Total Quanity</th>
                                  <th style="text-align:center;">Quanity</th>
                                  <th style="text-align:center;">Price</th>
                                  <th>Total</th>
                                </tr>
                              </thead>
                              <tbody id="invoice_item">
                               <!-- <tr>
                                  <td><b id="number">1</b></td>
                                  <td>
                                    <select name="pid[]" class="form-control form-control-sm" required>
                                    <option>Biscutes</option>
                                    </select>
                                  </td>
                                    <td><input name="tqty[]" type="text" class="form-control form-control-sm" readonly></td>
                                    <td><input name="qty[]" type="text" class="form-control form-control-sm"required></td>
                                    <td><input name="price[]" type="text" class="form-control form-control-sm" readonly></td>
                                    <td>Rs.1500</td>
                                </tr> --->
                              </tbody>
                            </table>
                            <center style="padding:10px";>
                              <button id="add" style="width:150px;" class="btn btn-success">Add</button>
                              <button id="remove" style="width:150px;" class="btn btn-danger">Remove</button>
                            </center>
                        </div> <!-- Card Body End-->
                      </div>  <!-- Product List Close-->
                     <br>
                    
                     <div class="form-group row">
                      <label for="Sub total" class="col-sm-3 col-form-label" align="Right">Sub Total</label>
                      <div class="col-sm-6">
                        <input type="text" name="sub_total" class="form-control form-control-sm" id="sub_total"required/>
                      </div>
                   </div>  
                   <div class="form-group row">
                      <label for="Gst" class="col-sm-3 col-form-label" align="Right">GST (18%)</label>
                      <div class="col-sm-6">
                        <input type="text" name="gst" class="form-control form-control-sm" id="gst"required/>
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="discount" class="col-sm-3 col-form-label" align="Right">Discount</label>
                      <div class="col-sm-6">
                        <input type="text" name="discount" class="form-control form-control-sm" id="discount"required/>
                      </div>
                   </div>
                   <div class="form-group row">
                      <label for="Netamount" class="col-sm-3 col-form-label" align="Right">Net Amount</label>
                      <div class="col-sm-6">
                        <input type="text" name="Net_Amount" class="form-control form-control-sm" id="Net_Amount"required/>
                      </div>
                   </div>

                   <center>
                     <input type="submit" id="purchase_entry"name="submit" style="width:200px;" class="btn btn-info" value="Entry purchase">
                   </center>    
                   </form>
               </div>
              </div>
           </div> 
         </div>
  </body> 
 </head>
</html>
