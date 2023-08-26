<div class="modal fade" id="pEdit" tabindex="-1" role="dialog" aria-labelledby="pEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form action="#" class="form-group" method="POST">
                <div class="modal-body">
                    <div class="row ">
                        <div class="col-md-6">
                            <label for="pId" class="form-label">Patient Id</label>
                            <input type="text" class="form-control" id="pId" name="pId" value="<?php echo $patientDetail["patienId"]; ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="pName" class="form-label">Patient Name</label>
                            <input type="text" class="form-control" id="pName" name="pName" value="<?php echo $patientDetail["fullName"]; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="age" class="form-label">Age</label>
                            <input type="text" class="form-control" id="age" name="age" value="<?php echo $patientDetail["age"]; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" class="form-control" name="gender">
                                    <option value="Male" <?php if($patientDetail["gender"]=='Male'){echo 'selected';} ?>>Male</option>
                                    <option value="Female" <?php if($patientDetail["gender"]=='Female'){echo 'selected';} ?> >Female</option>
                                    <option value="Other" <?php if($patientDetail["gender"]=='Other'){echo 'selected';} ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber">
                        </div>
                        <div class="col-md-6">
                            <label for="maritialStatus" class="form-label">Maritial Status</label>
                            <select id="maritialStatus" class="form-control" name="maritialStatus">
                                    <option value="Single" <?php if($patientDetail["maritialStatus"]=='Single'){echo 'selected';} ?> >Single</option>
                                    <option value="Un-married" <?php if($patientDetail["maritialStatus"]=='Un-married'){echo 'selected';} ?> >Un Married</option>
                                    <option value="Other" <?php if($patientDetail["maritialStatus"]=='Other'){echo 'selected';} ?> >Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" name="state" value="<?php echo $patientDetail["state"]; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="district" class="form-label">District</label>
                            <input type="text" class="form-control" id="district" name="district" value="<?php echo $patientDetail["district"]; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="pinCode" class="form-label">Pincode</label>
                            <input type="text" class="form-control" id="pinCode" name="pinCode" value="<?php echo $patientDetail["pinCode"]; ?>">
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $patientDetail["address"]; ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info" name="p_Edit">EDIT</button>
                </div>
            </form>
        </div>
    </div>
</div>