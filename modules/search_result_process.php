<?php

// echo ("Search Result Process");

require "db/connection.php";

$email = $_POST["email"];
$grade = $_POST["grade"];

echo ($email . " : " . $grade);

if (empty($email)) {

    if ($grade == 0) {

        $query = "SELECT * FROM `student`";
    } else {

        $query = "SELECT * FROM `student` WHERE `grade_id` = '" . $grade . "'";
    }

    $st_rs = Database::search($query);
    $st_count = $st_rs->num_rows;

    ?>
    <!-- Table -->
    <div class="table-responsive">
        <table
            class="table align-middle  bg-transparent table-hover table-responsive-sm table-striped border-bottom border-success rounded">
            <thead>
                <tr class="border-bottom border-1 border-primary">
                    <th>#</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Mobile Number</th>
                    <th>Registered On</th>
                    <th>Grade</th>
                    <th>Marks</th>
                    <th>Average</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $submitted = 0;
                for ($x = 0; $x < $st_count; $x++) {

                    $st_data = $st_rs->fetch_assoc();

                    $assignment_rs = Database::search("SELECT * FROM `student_has_assignments` WHERE `student_email`='" . $st_data["email"] . "'");
                    $assignment_count = $assignment_rs->num_rows;

                    if ($assignment_count > 0) {

                        $submitted += 1;
                        $marks = 0;
                        for ($y = 0; $y < $assignment_count; $y++) {

                            $assignment_data = $assignment_rs->fetch_assoc();

                            $marks += $assignment_data["marks"];
                        }

                        $average = $marks / $assignment_count;

                        ?>

                        <?php

                        $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $st_data["grade_id"] . "'");
                        $grade_data = $grade_rs->fetch_assoc();

                        $name = $st_data["fname"] . " " . $st_data["lname"];

                        ?>

                        <tr class="border-bottom border-secondary">
                            <td>
                                <?php echo ($y + 1); ?>
                            </td>
                            <td>
                                <?php echo ($st_data["email"]); ?>
                            </td>
                            <td>
                                <?php echo ($name); ?>
                            </td>
                            <td>
                                <?php echo ($st_data["mobile"]); ?>
                            </td>
                            <td>
                                <?php echo ($st_data["registered_datetime"]); ?>
                            </td>
                            <td>
                                <?php echo ($grade_data["grade"]); ?>
                            </td>
                            <td>
                                <?php echo ($marks); ?>
                            </td>
                            <td>
                                <?php echo ($average); ?>
                            </td>
                            <td><button class="btn btn-danger"
                                    onclick="manage('<?php echo ($st_data['email']); ?>');">Manage</button></td>
                        </tr>

                        <div class="modal modal-fullscreen" tabindex="-1" id="manageModal<?php echo ($st_data["email"]); ?>">
                            <div class="modal-dialog-center modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <?php echo ($name); ?>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12">
                                            <div class="row justify-content-center">
                                                <div class="col-12 mb-3">

                                                    <?php

                                                    $stghs_rs = Database::search("SELECT * FROM `student_has_gs` WHERE `student_email`='" . $st_data["email"] . "'");
                                                    $stghs_count = $stghs_rs->num_rows;

                                                    $subjects = "";
                                                    for ($x = 0; $x < $stghs_count; $x++) {

                                                        $stghs_data = $stghs_rs->fetch_assoc();

                                                        $ghs_rs = Database::search("SELECT * FROM `grade_has_subject` INNER JOIN `subject` ON `grade_has_subject`.`subject_id`=`subject`.`id` WHERE `grade_has_subject`.`id`='" . $stghs_data["grade_has_subject_id"] . "'");
                                                        $ghs_data = $ghs_rs->fetch_assoc();

                                                        $subjects .= $ghs_data["name"] . ", ";
                                                    }

                                                    ?>

                                                    <span class="fw-bold fs-5">Email:
                                                        <?php echo ($st_data["email"]); ?>
                                                    </span><br />
                                                    <span class="fw-bold fs-5">First Name:
                                                        <?php echo ($st_data["fname"]); ?>
                                                    </span><br />
                                                    <span class="fw-bold fs-5">Last Name:
                                                        <?php echo ($st_data["lname"]); ?>
                                                    </span><br />
                                                    <span class="fw-bold fs-5">Mobile:
                                                        <?php echo ($st_data["mobile"]); ?>
                                                    </span><br />
                                                    <span class="fw-bold fs-5">Grade:
                                                        <?php echo ($grade_data["grade"]); ?>
                                                    </span><br />
                                                    <span class="fw-bold fs-5">Subjects:
                                                        <?php echo ($subjects); ?>
                                                    </span><br />
                                                </div>
                                                <div class="col-12 border-top p-3">
                                                    <div class="row justify-content-center">
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Assign Grade</label>
                                                            <select class="form-select" id="grade" onchange="load_subject_st();">
                                                                <option value="0" selected>Select Grade</option>
                                                                <?php

                                                                $grade_rs = Database::search("SELECT * FROM `grade` ORDER BY `id` ASC");
                                                                $grade_count = $grade_rs->num_rows;

                                                                for ($x = 0; $x < $grade_count; $x++) {

                                                                    $grade_data = $grade_rs->fetch_assoc();

                                                                    ?>
                                                                    <option value="<?php echo ($grade_data["id"]); ?>">
                                                                        <?php echo ($grade_data["grade"]); ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-12" id="sub_area">
                                                        </div>
                                                        <div class="col-8 d-grid mt-3 mb-3">
                                                            <button class="btn btn-danger"
                                                                onclick="update_st('<?php echo ($st_data['email']); ?>');">Update</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>


                    <?php

                }

                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9" class="text-center text-primary fs-5">
                        <span class="fw-bold">Resulted Students:
                            <?php echo ($submitted); ?>
                        </span><br />
                        <span class="fw-bold">Total Students:
                            <?php echo ($st_count); ?>
                        </span>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- Table -->
    <?php

} else {

    if ($grade == 0) {

        $query = "SELECT * FROM `student` WHERE `email`='" . $email . "'";
    } else {

        $query = "SELECT * FROM `student` WHERE `email`='" . $email . "' AND `grade_id` = '" . $grade . "'";
    }

    $st_rs = Database::search($query);
    $st_count = $st_rs->num_rows;

    ?>
    <!-- Table -->
    <div class="table-responsive">
        <table
            class="table align-middle  bg-transparent table-hover table-responsive-sm table-striped border-bottom border-success rounded">
            <thead>
                <tr class="border-bottom border-1 border-primary">
                    <th>#</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Mobile Number</th>
                    <th>Registered On</th>
                    <th>Grade</th>
                    <th>Marks</th>
                    <th>Average</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>

                <?php

                if ($st_count > 0) {

                    $submitted = 0;
                    for ($x = 0; $x < $st_count; $x++) {

                        $st_data = $st_rs->fetch_assoc();

                        $assignment_rs = Database::search("SELECT * FROM `student_has_assignments` WHERE `student_email`='" . $st_data["email"] . "'");
                        $assignment_count = $assignment_rs->num_rows;

                        if ($assignment_count > 0) {

                            $submitted += 1;
                            $marks = 0;
                            for ($y = 0; $y < $assignment_count; $y++) {

                                $assignment_data = $assignment_rs->fetch_assoc();

                                $marks += $assignment_data["marks"];
                            }

                            $average = $marks / $assignment_count;

                            ?>

                            <?php

                            $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $st_data["grade_id"] . "'");
                            $grade_data = $grade_rs->fetch_assoc();

                            $name = $st_data["fname"] . " " . $st_data["lname"];

                            ?>

                            <tr class="border-bottom border-secondary">
                                <td>
                                    <?php echo ($y + 1); ?>
                                </td>
                                <td>
                                    <?php echo ($st_data["email"]); ?>
                                </td>
                                <td>
                                    <?php echo ($name); ?>
                                </td>
                                <td>
                                    <?php echo ($st_data["mobile"]); ?>
                                </td>
                                <td>
                                    <?php echo ($st_data["registered_datetime"]); ?>
                                </td>
                                <td>
                                    <?php echo ($grade_data["grade"]); ?>
                                </td>
                                <td>
                                    <?php echo ($marks); ?>
                                </td>
                                <td>
                                    <?php echo ($average); ?>
                                </td>
                                <td><button class="btn btn-danger"
                                        onclick="manage('<?php echo ($st_data['email']); ?>');">Manage</button></td>
                            </tr>

                            <div class="modal modal-fullscreen" tabindex="-1" id="manageModal<?php echo ($st_data["email"]); ?>">
                                <div class="modal-dialog-center modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                <?php echo ($name); ?>
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <div class="row justify-content-center">
                                                    <div class="col-12 mb-3">

                                                        <?php

                                                        $stghs_rs = Database::search("SELECT * FROM `student_has_gs` WHERE `student_email`='" . $st_data["email"] . "'");
                                                        $stghs_count = $stghs_rs->num_rows;

                                                        $subjects = "";
                                                        for ($x = 0; $x < $stghs_count; $x++) {

                                                            $stghs_data = $stghs_rs->fetch_assoc();

                                                            $ghs_rs = Database::search("SELECT * FROM `grade_has_subject` INNER JOIN `subject` ON `grade_has_subject`.`subject_id`=`subject`.`id` WHERE `grade_has_subject`.`id`='" . $stghs_data["grade_has_subject_id"] . "'");
                                                            $ghs_data = $ghs_rs->fetch_assoc();

                                                            $subjects .= $ghs_data["name"] . ", ";
                                                        }

                                                        ?>

                                                        <span class="fw-bold fs-5">Email:
                                                            <?php echo ($st_data["email"]); ?>
                                                        </span><br />
                                                        <span class="fw-bold fs-5">First Name:
                                                            <?php echo ($st_data["fname"]); ?>
                                                        </span><br />
                                                        <span class="fw-bold fs-5">Last Name:
                                                            <?php echo ($st_data["lname"]); ?>
                                                        </span><br />
                                                        <span class="fw-bold fs-5">Mobile:
                                                            <?php echo ($st_data["mobile"]); ?>
                                                        </span><br />
                                                        <span class="fw-bold fs-5">Grade:
                                                            <?php echo ($grade_data["grade"]); ?>
                                                        </span><br />
                                                        <span class="fw-bold fs-5">Subjects:
                                                            <?php echo ($subjects); ?>
                                                        </span><br />
                                                    </div>
                                                    <div class="col-12 border-top p-3">
                                                        <div class="row justify-content-center">
                                                            <div class="col-12 mb-3">
                                                                <label class="form-label">Assign Grade</label>
                                                                <select class="form-select" id="grade" onchange="load_subject_st();">
                                                                    <option value="0" selected>Select Grade</option>
                                                                    <?php

                                                                    $grade_rs = Database::search("SELECT * FROM `grade` ORDER BY `id` ASC");
                                                                    $grade_count = $grade_rs->num_rows;

                                                                    for ($x = 0; $x < $grade_count; $x++) {

                                                                        $grade_data = $grade_rs->fetch_assoc();

                                                                        ?>
                                                                        <option value="<?php echo ($grade_data["id"]); ?>">
                                                                            <?php echo ($grade_data["grade"]); ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-12" id="sub_area">
                                                            </div>
                                                            <div class="col-8 d-grid mt-3 mb-3">
                                                                <button class="btn btn-danger"
                                                                    onclick="update_st('<?php echo ($st_data['email']); ?>');">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                        ?>


                        <?php

                    }

                } else {

                    ?>
                    <tr>
                        <td colspan="9" class="text-center text-danger fs-5">Cannot find the student</td>
                    </tr>
                    <?php

                }

                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9" class="text-center text-primary fs-5">
                        <span class="fw-bold">Resulted Students:
                            <?php echo ($submitted); ?>
                        </span><br />
                        <span class="fw-bold">Total Students:
                            <?php echo ($st_count); ?>
                        </span>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- Table -->
    <?php

}

?>