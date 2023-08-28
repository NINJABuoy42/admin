<div class="modal fade" id="docEdit" tabindex="-1" role="dialog" aria-labelledby="docEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal">Edit Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="docList.php" class="form-group" method="POST">
                <div class="modal-body">
                    <div class="row ">
                        <div class="col-md-12">
                            <label for="user_id" class="form-label">User Id</label>
                            <input autocomplete="off" type="text" class="form-control" id="user_id" name="user_id" readonly>
                        </div>
                        <div class="col-md-12">
                            <label for="Name" class="form-label">Name</label>
                            <input autocomplete="off" type="text" class="form-control" id="Name" name="Name" >
                        </div>
                        <div class="col-md-12">
                            <label for="regNo" class="form-label">RegNo</label>
                            <input autocomplete="off" type="text" class="form-control" id="regNo" name="regNo" >
                        </div>
                        <div class="col-md-12">
                            <label for="qualification" class="form-label">Qualification</label>
                            <input autocomplete="off" type="text" class="form-control" id="qualification" name="qualification"  >
                        </div>
                        <div class="col-md-12">
                            <label for="current" class="form-label">Current</label>
                            <input autocomplete="off" type="text" class="form-control" id="current" name="current" >
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input autocomplete="off" type="text" class="form-control" id="email" name="email" >
                        </div>

                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning" id="editDoc" name="editDoc">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>