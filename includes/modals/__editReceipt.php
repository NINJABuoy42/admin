<div class="modal fade" id="receiptEdit" tabindex="-1" role="dialog" aria-labelledby="receiptEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal">Edit Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="invoiceList.php" class="form-group" method="POST">
                <div class="modal-body">
                    <div class="row ">
                            <input autocomplete="off" type="hidden" class="form-control" id="user_id" name="user_id"  >
                        <div class="col-sm-4">
                            <label for="receiptId" class="form-label">Receipt ID</label>
                            <input autocomplete="off" type="text" class="form-control" id="receiptId" name="receiptId" readonly >
                        </div>
                        <div class="col-md-8">
                            <label for="name" class="form-label">Name</label>
                            <input autocomplete="off" type="text" class="form-control" id="name" name="name" >
                        </div>
                        <div class="col-md-4">
                            <label for="amount" class="form-label">Amount</label>
                            <input autocomplete="off" type="number" class="form-control" id="amount" name="amount" >
                        </div>
                        
                        <div class="col-md-8">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="paid">Paid</option>
                                <option value="void">Void</option>
                                <!-- <option value="Refund">Refund</option> -->
                            </select>
                        </div>
                     

                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning" id="editReceipt" name="editReceipt">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>