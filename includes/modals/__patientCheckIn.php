<div class="modal fade" id="checkin" tabindex="-1" role="dialog" aria-labelledby="checkin" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="viewDetails.php" class="form-group" method="POST">
                <div class="modal-body">
                    <div class="row ">
                        <div class="col-md-6">
                            <label for="pId" class="form-label">Patient Id</label>
                            <input autocomplete="off" type="text" class="form-control" id="pId" name="pId" value="<?php echo $patientDetail["patienId"]; ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="pName" class="form-label">Patient Name</label>
                            <input autocomplete="off" type="text" class="form-control" id="pName" name="pName" value="<?php echo $patientDetail["fullName"]; ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="height" class="form-label">Height</label>
                            <input autocomplete="off" type="text" class="form-control" id="height" name="height">
                        </div>
                        <div class="col-md-6">
                            <label for="weight" class="form-label">Weight</label>
                            <input autocomplete="off" type="text" class="form-control" id="weight" name="weight">
                        </div>
                        <div class="col-md-6">
                            <label for="blood_pressure" class="form-label">Blood Pressure</label>
                            <input autocomplete="off" type="text" class="form-control" id="blood_pressure" name="blood_pressure">
                        </div>

                        <div class="col-md-6">
                            <label for="attending_doctor" class="form-label">Attending Doctor</label>
                            <select id="attending_doctor" class="form-control" name="attending_doctor">
                                <?php
                                $doctors = getDoctors();
                                while ($doctor = mysqli_fetch_assoc($doctors)) { ?>
                                    <option value="<?php echo $doctor["user_id"]; ?>" selected><?php echo $doctor["Name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" name="check_in">Check In</button>
                </div>
            </form>
        </div>
    </div>
</div>