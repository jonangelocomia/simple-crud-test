
<div class="row">
    <div class="col">
        <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col action">ACTION</th>
                <th scope="col">STAFF</th>
                <th scope="col">STATUS</th>
            </tr>
        </thead>
        <tbody id="controlstaffmainoutput">
            <?php 
                $staff = new staff();
                $staff->startreadstaff();

                $staff_all = $staff->get_staff_credential("all");

                if($staff_all !== null) {
                    for( $r=0; $r < count($staff_all["staff_id"]); $r++ ) {
                        if ( !$staff_all["status"][$r] ) continue;
                        ?>
                        <tr>
                            <th scope="row"><?php echo $staff_all["staff_id"][$r] ?></th>
                            <td>
                                <button class="btn btn-sm btn-outline-warning staff-record-table-row" data-toggle="modal" data-target="#updatestaffmodal" data-staffdata='{ "staff_id" : "<?php echo $staff_all["staff_id"][$r] ?>", "lname" : "<?php echo $staff_all["lname"][$r] ?>", "fname" : "<?php echo $staff_all["fname"][$r] ?>", "mname" : "<?php echo $staff_all["mname"][$r] ?>", "age" : "<?php echo $staff_all["age"][$r] ?>", "birthday" : "<?php echo $staff_all["birthday"][$r] ?>", "address" : "<?php echo $staff_all["address"][$r] ?>", "contact" : "<?php echo $staff_all["contact"][$r] ?>", "date_added" : "<?php echo $staff_all["date_added"][$r] ?>",  "status" : "<?php echo $staff_all["status"][$r] ?>" }'>
                                    <span data-feather="edit"></span>
                                    Update
                                </button>
                                <a class="btn btn-sm btn-outline-info" data-toggle="collapse" href="#staff-<?php echo $staff_all["staff_id"][$r] ?>">
                                    <span data-feather="book-open"></span>
                                    Read
                                </a>
                            </td>
                            <td>
                                <?php echo $staff_all["lname"][$r] . ", " . $staff_all["fname"][$r] . " " . $staff_all["mname"][$r] ?>
                                <div class="collapse" id="staff-<?php echo $staff_all["staff_id"][$r] ?>">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th scope="row" rowspan="2">Bio:</th>
                                                <td><?php echo $staff_all["birthday"][$r] ?></td>
                                                <td><?php echo $staff_all["age"][$r] ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><?php echo $staff_all["contact"][$r] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Address:</th>
                                                <td colspan="2"><?php echo $staff_all["address"][$r] ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Added:</th>
                                                <td colspan="2"><?php echo $staff_all["date_added"][$r] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                            <td>
                                <?php
                                    if ( $staff_all["status"][$r] ) echo '<span class="badge badge-success">ACTIVATED</span>';
                                    else  echo '<span class="badge badge-danger">DEACTIVATED</span>';
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
            ?>
        </tbody>
        </table>
    </div>
</div>
<div class="modal_container">
    <div class="modal fade" id="createstaffmodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Staff Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <small class="form-text text-muted">*advisory: staff Code is always unique.</small>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12"><label class="text-sm">Name</label></div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <input type="text" class="form-control form-control-sm" id="createstaffmodal_lname" placeholder="Enter Lastname">
                            </div>
                            <div class="col-5">
                                <input type="text" class="form-control form-control-sm" id="createstaffmodal_fname" placeholder="Enter Firstname">
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control form-control-sm" id="createstaffmodal_mname" placeholder="Enter Middlename">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-sm">Age</label>
                        <input type="text" class="form-control form-control-sm" id="createstaffmodal_age" placeholder="Enter Age">
                    </div>
                    <div class="form-group">
                        <label class="text-sm">Birthday</label>
                        <input type="date" class="form-control form-control-sm" id="createstaffmodal_birthday" placeholder="Enter Birthday">
                    </div>
                    <div class="form-group">
                        <label class="text-sm">Address</label>
                        <input type="text" class="form-control form-control-sm" id="createstaffmodal_address" placeholder="Enter Address">
                    </div>
                    <div class="form-group">
                        <label class="text-sm">Contact</label>
                        <input type="text" class="form-control form-control-sm" id="createstaffmodal_contact" placeholder="Enter Contact">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="createstaffmodalbutton">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updatestaffmodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Staff Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <small class="form-text text-muted">*advisory: staff Code is always unique.</small>
                        <input type="hidden" id="updatestaffmodal_staffid">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12"><label class="text-sm">Name</label></div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <input type="text" class="form-control form-control-sm" id="updatestaffmodal_lname" placeholder="Enter Lastname">
                            </div>
                            <div class="col-5">
                                <input type="text" class="form-control form-control-sm" id="updatestaffmodal_fname" placeholder="Enter Firstname">
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control form-control-sm" id="updatestaffmodal_mname" placeholder="Enter Middlename">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-sm">Age</label>
                        <input type="text" class="form-control form-control-sm" id="updatestaffmodal_age" placeholder="Enter Age">
                    </div>
                    <div class="form-group">
                        <label class="text-sm">Birthday</label>
                        <input type="date" class="form-control form-control-sm" id="updatestaffmodal_birthday" placeholder="Enter Birthday">
                    </div>
                    <div class="form-group">
                        <label class="text-sm">Address</label>
                        <input type="text" class="form-control form-control-sm" id="updatestaffmodal_address" placeholder="Enter Address">
                    </div>
                    <div class="form-group">
                        <label class="text-sm">Contact</label>
                        <input type="text" class="form-control form-control-sm" id="updatestaffmodal_contact" placeholder="Enter Contact">
                    </div>
                    <div class="form-group">
                        <label class="text-sm"><b>DELETE THIS</b></label>
                        <select class="custom-select form-control-sm" id="updatestaffmodal_status">
                            <option value="1">NO</option>
                            <option value="0">YES</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="updatestaffmodalbutton">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>