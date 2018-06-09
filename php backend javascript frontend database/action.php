<?php
    include 'functions.php';

    date_default_timezone_set('Asia/Singapore');
    $date = date('m/d/Y h:i:s a', time());

    $staff = new Staff();

    switch($_POST["type_r"]) {
        case "refresh_tab":
            ob_start();
            include $_POST["tab"];
            echo ob_get_clean();
        break;
        case "staff_create":
            $staff->set_staff_credential("lname",$_POST["lname"]);
            $staff->set_staff_credential("fname",$_POST["fname"]);
            $staff->set_staff_credential("mname",$_POST["mname"]);
            $staff->set_staff_credential("age",$_POST["age"]);
            $staff->set_staff_credential("birthday",$_POST["birthday"]);
            $staff->set_staff_credential("address",$_POST["address"]);
            $staff->set_staff_credential("contact",$_POST["contact"]);
            $staff->set_staff_credential("date_added",$date);
            $staff->set_staff_credential("status",$_POST["status"]);
            
            if($staff->startcreatestaff()) echo "Oooh! successfully added a new staff";
            else echo "Ooops! something went wrong."; 
        break;
        case "staff_update": 
            $staff->set_staff_credential("staff_id",$_POST["staffid"]);
            $staff->set_staff_credential("lname",$_POST["lname"]);
            $staff->set_staff_credential("fname",$_POST["fname"]);
            $staff->set_staff_credential("mname",$_POST["mname"]);
            $staff->set_staff_credential("age",$_POST["age"]);
            $staff->set_staff_credential("birthday",$_POST["birthday"]);
            $staff->set_staff_credential("address",$_POST["address"]);
            $staff->set_staff_credential("contact",$_POST["contact"]);
            $staff->set_staff_credential("date_added",$date);
            $staff->set_staff_credential("status",$_POST["status"]);
            
            if($staff->startupdatestaff()) echo "Oooh! successfully updated the staff number " . $_POST["staffid"];
            else echo "Ooops! something went wrong."; 
        break;
        case "staff_find": 
            ob_start();
            $staff = new staff();
            $staff->startfindstaff($_POST["key"]);

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
            echo ob_get_clean();
        break;
    }
?>