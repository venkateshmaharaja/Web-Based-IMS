
<div class="modal fade" id="form_category" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modifie Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_category_form" onsubmit="return false">  
          
          <div class="form-group">
            <label>Category Name</label>
            <input type="hidden" name="cid" id="cid" value=""/>
            <input type="text" class="form-control" name="update_category" id="update_category" aria-describedby="emailHelp" placeholder="Enter The Category Name">
            <small id="cat_error" class="form-text text-muted"></small>
          </div>
           
          

         <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
       </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>