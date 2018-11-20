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

    <script type="text/javascript" src="js/manage_sales.js"></script>
    
    <body>  
        <!--nav bar-->

      <?php include_once("./template/header.php");?>
        <br/>
        <div class="container">
          <div class="card-header"style="background-color: #b3b3cc">
                    <h4>Sales Report:</h4>
                   <div class="form-row">
                   <div class="form-group col-sm-3">
                    <label>FROM</label>
                    <input type="date" class="form-control" name="s_std"id="s_std"placeholder="" required>
                  </div>
                 
                  <div class="form-group col-sm-3">
                    <label>TO</label>
                    <input type="date" class="form-control" name="s_etd"id="s_etd"placeholder="" required>
                  </div>

                  <div class="form-group col-sm-3">
                    </br>
                    <button id="s_searchbt" name="s_searchbt" style="width:150px;" class="btn btn-info">Search</button>
                    <!--<input type="date" class="form-control" name="std"id="std"placeholder="" required> -->
                  </div>
                   
                </div>
            </div>
               
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Invoice No</th>
                  <th>Invoice Date</th>
                  <th>Customer Name</th>
                  <th>Sub Total</th>
                  <th>Gst</th>
                  <th>Discount</th>
                  <th>Net Amount</th>
                </tr>
                </thead>
                <tbody id="get_sales_report">
                <!--<tr>
                  <td>1</td> 
                  <td>Laptop</td>  
                  <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                  <td>
                    <a href="#" class="btn btn-info btn-sm">Edit</a>
                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                  -->     
               </tr> 
              </tbody>
              <tfoot id="total_calc_date" class="font-weight-bold">

              </tfoot> 
            </table>

        </div>

        <?php 
      //   include_once("./template/update_product.php");
        ?>

  </body> 
 </head>
</html>
