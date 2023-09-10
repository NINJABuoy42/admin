<div class="modal fade" id="serviceEdit" tabindex="-1" role="dialog" aria-labelledby="serviceEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal">Edit Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="services.php" class="form-group" method="POST">
                <div class="modal-body">
                    <div class="row ">
                            <input autocomplete="off" type="hidden" class="form-control" id="user_id" name="user_id"  >
                        <div class="col-md-12">
                            <label for="service_type" class="form-label">Service Type</label>
                            <input autocomplete="off" type="text" class="form-control" id="service_type" name="service_type" >
                        </div>
                        <div class="col-md-6">
                            <label for="fee" class="form-label">Fees</label>
                            <input autocomplete="off" type="number" class="form-control" id="fee" name="fee" >
                        </div>
                        <div class="col-md-6">
                            <label for="stats" class="form-label">Status</label>
                            <select name="stats" id="stats" class="form-control">
                                <option value="Available">Available</option>
                                <option value="Un-available">Un-Available</option>
                            </select>
                        </div>
                     

                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning" id="editService" name="editService">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>