<div class="modal fade" id="form_products" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <form id="update_product_form" onsubmit="return false">
  <div class="form-row">
    <div class="form-group col-md-6">
      <input type="hidden" name="pid" id="pid" value=""/>
      <label>Date</label>
      <input type="text" class="form-control" name="added_date"id="added_date" value="<?php echo date('d-m-y');?>" readonly>
    </div>
    <div class="form-group col-md-6">
      <label>Product Name</label>
      <input type="text" class="form-control" name="update_product"id="update_product" placeholder="Enter The Product Name" required>
    </div>
  </div>
  <div class="form-group">
    <label >Category</label>
    <select class="form-control" id="select_cat" name="select_cat" required>
      
    </select>
  </div>
  <div class="form-group">
    <label >Brand</label>
    <select class="form-control" id="select_brand" name="select_brand" required>
      
    </select>
    <label>Product Price</label>
    <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter The Product Price" required >
    <label>Quantity</label>
    <input type="text" class="form-control" id="product_packing" name="product_packing" placeholder="Enter The Packing type" required >
 
  <button type="submit" class="btn btn-primary">Update Product</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>