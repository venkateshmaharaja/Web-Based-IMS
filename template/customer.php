<div class="modal fade" id="form_customer" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <form id="customer_form" onsubmit="return false">
  <div class="form-row">
    <div class="form-group col-md-12">
     
      <label>Customer Name</label>
      <input type="text" class="form-control" name="customer_name"id="customer_name"placeholder="Enter the Customer   /  Company Name" required>
    </div>
    <div class="form-group col-md-8">
      <label>GST No</label>
      <input type="text" class="form-control" name="customer_gst"id="customer_gst"placeholder="Enter the Customer GST No" required>
    </div>
    <div class="form-group col-md-12">
      <label>Address1</label>
      <input type="text" class="form-control" name="customer_address1"id="customer_address1"placeholder="Enter the Street / Door No" required>
    </div>
    <div class="form-group col-md-12">
      <label>Address2</label>
      <input type="text" class="form-control" name="customer_address2"id="customer_address2"placeholder="Enter the City " required>
    </div>
    <div class="form-group col-md-12">
      <label>Address3</label>
      <input type="text" class="form-control" name="customer_address3"id="customer_address3"placeholder="Enter the State " required>
    </div>
  <button type="submit" class="btn btn-primary">Add Customer</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>