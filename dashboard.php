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

    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/customer.js"></script>
    
    <body>  
    <?php include_once("./template/header.php");?>
        <br/>
        <div class="container">
          <div class="row">
            <div class="col-md-4">
                <div class="card  mx-auto" >
                <img class="card-img-top mx-auto" style="width:60%;" src="./images/user.png " alt="Card image cap">
                <div class="card-body">
                  <h4 class="card-title"><i class="fa fa-user">&nbsp;</i>Profile Info</h4>
                 
                  <p class="card-text" align="left">Admin</p>
                  <p class="card-text" align="left"><?php echo date("d/m/Y");?></p>
                  
                 
                  
                 <!-- <p class="card-text">Admin<i class="fa fa-user">&nbsp;</i></p>
                  <p class="card-text">Last Login:123455</p>
                  <a href="#" class="btn btn-primary">Edit Profile<i class="fa fa-edit">&nbsp;</i></a>  -->
                </div>
              </div>
            </div>
            <div class="col-md-8">
               <div class="jumbotron text-center p-2" style="width: 65 %;">
                <h1 class="p-1">Welcome Admin</h1>
                <br>
                <div class="row mb-5">
                  <div class="col-md-6 mx-auto text-center">
                    <iframe src="http://free.timeanddate.com/clock/i6cq8lgq/n1648/szw210/szh210/hfc099/cf100/hnce1ead6" frameborder="0" width="210" height="210"></iframe>
                  </div>
                
               </div>
             </div>
            </div>
        </div>
      </div>
        
        <div class="container mt-3">
           <div class="row">
               <div class="col-md-3">
                <div class="card " >
                    <div class="card-body">
                      <h4 class="card-title">Category</h4>
                      <p class="card-text">Manage the Categry and Add the Categry</p>
                      <a href="#" data-toggle="modal" data-target="#form_category" class="btn btn-primary">Add &nbsp;<i class="fa fa-plus"></i></a>
                      <a href="manage_categories.php" class="btn btn-primary">Manage &nbsp;<i class="fa fa-pencil-square-o"></i></a>
                    </div>
                 </div>
               </div>

                <?php 
                 //Category Form
                  include_once("./template/category.php");
                ?> 
              
             <div class="col-md-3">
                 <div class="card ">
                    <div class="card-body">
                      <h4 class="card-title">Customer / Buyer</h4>
                      <p class="card-text">Manage the Product and Add the Product</p>
                      <a href="#" data-toggle="modal" data-target="#form_customer"class="btn btn-primary">Add &nbsp;<i class="fa fa-plus"></i></a>
                      <a href="manage_customer.php" class="btn btn-primary">Manage &nbsp;<i class="fa fa-pencil-square-o"></i></a>
                    </div>
                  </div>
             </div>

             

              <div class="col-md-3">
                 <div class="card " >
                    <div class="card-body">
                      <h4 class="card-title">Brand</h4>
                      <p class="card-text">Manage the Brand and Add the Brand</p>
                      <a href="#"data-toggle="modal" data-target="#form_brand" class="btn btn-primary">Add &nbsp;<i class="fa fa-plus"></i></a>
                      <a href="manage_brands.php" class="btn btn-primary">Manage &nbsp;<i class="fa fa-pencil-square-o"></i></a>
                    </div>
                 </div>
             </div>

              <?php
                 //Brand Form
                  include_once("./template/brand.php");
                ?>  
               
              
              <div class="col-md-3">
                 <div class="card " >
                    <div class="card-body">
                      <h4 class="card-title">Product</h4>
                      <p class="card-text">Manage the Product and Add the Product</p>
                      <a href="#" data-toggle="modal" data-target="#form_product"class="btn btn-primary">Add &nbsp;<i class="fa fa-plus"></i></a>
                      <a href="manage_product.php" class="btn btn-primary">Manage &nbsp;<i class="fa fa-pencil-square-o"></i></a>
                    </div>
                 </div>
              </div>
              <?php 
                  //Category Form
                  include_once("./template/product.php");
                 ?> 
          </div>
        </div>
        <?php
                 //Product Form
                  include_once("./template/customer.php");
                ?> 
   </body> 
 </head>
</html>
