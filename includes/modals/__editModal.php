<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal">Edit Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="user.php" class="form-group" method="POST">
                <div class="modal-body">
                    <div class="row ">
                        <div class="col-md-12">
                            <label for="user_id" class="form-label">User Id</label>
                            <input autocomplete="off" type="text" class="form-control" id="user_id" name="user_id" readonly>
                        </div>
                        <div class="col-md-12">
                            <label for="fullName" class="form-label">Name</label>
                            <input autocomplete="off" type="text" class="form-control" id="fullName" name="fullName" readonly>
                        </div>
                        <div class="col-md-12">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" class="form-control" name="status">
                                <option value="" selected>Select Status</option>
                                <option value="unverfied" >Un-verified</option>
                                <option value="verified">Verified</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="role" class="form-label">Role</label>
                            <select id="role" class="form-control" name="role">
                                <option value="" selected>Choose role...</option>
                                <option value="register" >Register</option>
                                <option value="doctor">Doctor</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning" id="editRecord" name="editRecord">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>