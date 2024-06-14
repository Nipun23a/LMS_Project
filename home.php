<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home</title>

    <link rel="stylesheet" href="src/css/style.css" />
    <link rel="stylesheet" href="src/css/bootstrap.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/src/js/bootstrap-icons@1.9.1/font/src/js/bootstrap-icons.css" />

    <link rel="shortcut icon" href="assets/logo/HS-Black.png" type="image/x-icon" />

</head>

<body class="home">

    <div class="container-fluid d-flex flex-column">
        <div class="row justify-content-center">

            <?php

            include "header.php";

            if (isset($_SESSION["student"])) {

                $student = $_SESSION["student"];

                $today = date("Y-m-d");

                $isActive = false;
                if ($student['payment_status_id'] == 2) {
                    $shs_rs = Database::search("SELECT * FROM `student_has_subscription` WHERE `student_email`='" . $student["email"] . "' ORDER BY `validity` DESC");
                    $shs_count = $shs_rs->num_rows;

                    if ($shs_count != 0) {
                        $shs_data = $shs_rs->fetch_assoc();

                        if (strtotime($today) > strtotime($shs_data['validity'])) {
                            Database::iud("UPDATE `student` SET `payment_status_id`='1' WHERE `email`='" . $student["email"] . "'");
                        } else {
                            $isActive = true;
                        }
                    }

                } else {

                    $registered_on = explode(" ", $student["registered_datetime"]);
                    $reg_date = $registered_on[0];
                    $reg = explode("-", $reg_date);
                    $reg_month = $reg[1];

                    $end_date;
                    if ($reg_month == 12) {
                        $end_month = "1";
                        $reg_year = $reg[0];
                        $next_year = (int) $reg_year + 1;
                        $end_year = strval($next_year);

                        $end_date = $end_year . "-" . $end_month . "-" . $reg[2];
                    } else {
                        $next_month = (int) $reg_month + 1;
                        $end_month = strval($next_month);

                        $end_date = $reg[0] . "-" . $end_month . "-" . $reg[2];
                    }

                    if (strtotime($today) < strtotime($end_date)) {
                        $isActive = true;
                    }

                }

                if (!$isActive) {
                    ?>
                    <script>
                        window.onload = function () {
                            alert("Your one month free trial on the portal is over. To continue ");
                            window.location = "payPortalFee.php";
                        };
                    </script>
                    <?php
                }
            }

            ?>

            <!-- Heading -->
            <div class="col-12 p-3 text-center">
                <span class="h1 fw-bold text-success">Welcome to SJ ACADEMY</span>
            </div>
            <!-- Heading -->

            <!-- Content -->
            <div class="col-12 px-4 mb-2">
                <div class="row">
                    <div class="col-12 border border-primary rounded px-lg-3 py-2">
                        <div class="row justify-content-center">

                            <!-- Assignments -->
                            <div class="col-12 py-3 border-bottom rounded-2">
                                <div class="row">

                                    <div class="col-12 mb-2">
                                        <span class="fw-bold text-black-50 fs-2">Recently Added Assignments</span>
                                    </div>

                                    <?php

                                    if (isset($_SESSION["student"])) {

                                        $student = $_SESSION["student"];

                                        $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $student["grade_id"] . "'");
                                        $grade_data = $grade_rs->fetch_assoc();

                                        ?>

                                        <div class="col-12 mt-3 p-3">

                                            <!-- Table -->
                                            <div class="table-responsive">
                                                <table
                                                    class="table align-middle bg-transparent table-hover table-responsive-sm table-striped border-bottom border-success rounded">
                                                    <thead>
                                                        <tr class="border-bottom border-1 border-primary">
                                                            <th>#</th>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Subject</th>
                                                            <th>Start Date</th>
                                                            <th>End Date</th>
                                                            <th>Download</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php

                                                        $assignment_rs = Database::search("SELECT * FROM `assignments` INNER JOIN `grade_has_subject` ON `assignments`.`grade_has_subject_id`=`grade_has_subject`.`id` WHERE `grade_id`='" . $student["grade_id"] . "' LIMIT 4");
                                                        $assignment_count = $assignment_rs->num_rows;

                                                        if ($assignment_count > 0) {
                                                            for ($y = 0; $y < $assignment_count; $y++) {

                                                                $assignment_data = $assignment_rs->fetch_assoc();

                                                                $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $assignment_data["subject_id"] . "'");
                                                                $subject_data = $subject_rs->fetch_assoc();

                                                                ?>

                                                                <tr class="border-bottom border-secondary">
                                                                    <td>
                                                                        <?php echo ($y + 1); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo ($assignment_data["id"]); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo ($assignment_data["title"]); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo ($subject_data["name"]) ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo ($assignment_data["time"]); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo ($assignment_data["period"]); ?>
                                                                    </td>
                                                                    <td><a href="<?php echo ($assignment_data["path"]); ?>"
                                                                            download="<?php echo ($assignment_data["path"]); ?>"
                                                                            class="btn btn-warning">Download</a></td>
                                                                </tr>

                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <tr class="border-bottom border-secondary">
                                                                <td colspan="7" class="text-center fs-5 p-3">
                                                                    <span class="text-primary fw-bold">You have 0 assignments
                                                                        yet</span>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="7" class="text-center fs-5">
                                                                <button class="btn btn-warning"
                                                                    onclick="window.location = 'assignments.php'">View
                                                                    All</button>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- Table -->

                                        </div>

                                        <?php

                                    } else if (isset($_SESSION["teacher"])) {

                                        $teacher = $_SESSION["teacher"];

                                        ?>

                                            <div class="col-12 mt-3 p-3">

                                                <!-- Table -->
                                                <div class="table-responsive">
                                                    <table
                                                        class="table align-middle  bg-transparent table-hover table-responsive-sm table-striped border-bottom border-success rounded">
                                                        <thead>
                                                            <tr class="border-bottom border-1 border-primary">
                                                                <th>#</th>
                                                                <th>ID</th>
                                                                <th>Name</th>
                                                                <th>Start Date</th>
                                                                <th>End Date</th>
                                                                <th>Download</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php

                                                            $assignment_rs = Database::search("SELECT * FROM `assignments` INNER JOIN `grade_has_subject` ON `assignments`.`grade_has_subject_id`=`grade_has_subject`.`id` WHERE `grade_has_subject_id`='" . $teacher["grade_has_subject_id"] . "' LIMIT 4");
                                                            $assignment_count = $assignment_rs->num_rows;

                                                            if ($assignment_count > 0) {
                                                                for ($y = 0; $y < $assignment_count; $y++) {

                                                                    $assignment_data = $assignment_rs->fetch_assoc();

                                                                    $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $assignment_data["subject_id"] . "'");
                                                                    $subject_data = $subject_rs->fetch_assoc();


                                                                    ?>

                                                                    <tr class="border-bottom border-secondary">
                                                                        <td>
                                                                        <?php echo ($y + 1); ?>
                                                                        </td>
                                                                        <td>
                                                                        <?php echo ($assignment_data["id"]); ?>
                                                                        </td>
                                                                        <td>
                                                                        <?php echo ($assignment_data["title"]); ?>
                                                                        </td>
                                                                        <td>
                                                                        <?php echo ($assignment_data["time"]); ?>
                                                                        </td>
                                                                        <td>
                                                                        <?php echo ($assignment_data["period"]); ?>
                                                                        </td>
                                                                        <td><a href="<?php echo ($assignment_data["path"]); ?>"
                                                                                download="<?php echo ($assignment_data["path"]); ?>"
                                                                                class="btn btn-warning">Download</a></td>
                                                                    </tr>

                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="6" class="text-center fs-5">
                                                                        <button class="btn btn-warning"
                                                                            onclick="window.location = 'assignments.php'">View
                                                                            All</button>
                                                                    </td>
                                                                </tr>
                                                            </tfoot>

                                                        <?php
                                                            } else {
                                                                ?>
                                                            <tr class="border-bottom border-secondary">
                                                                <td colspan="6" class="text-center fs-5 p-3">
                                                                    <span class="text-primary fw-bold">0 assignments yet</span>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="6" class="text-center fs-5">
                                                                        <button class="btn btn-warning"
                                                                            onclick="window.location = 'addAssignments.php'">Add
                                                                            Assignment</button>
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        <?php
                                                            }
                                                            ?>
                                                    </table>
                                                </div>
                                                <!-- Table -->

                                            </div>

                                        <?php

                                    } else if (isset($_SESSION["academic_officer"])) {

                                        $academic = $_SESSION["academic_officer"];

                                        $aohs_rs = Database::search("SELECT * FROM `academic_officer_has_grade` WHERE `academic_officer_email`='" . $academic["email"] . "'");
                                        $aohs_count = $aohs_rs->num_rows;

                                        ?>

                                                <div class="col-12 mt-3 p-3">

                                                    <!-- Table -->
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table align-middle  bg-transparent table-hover table-responsive-sm table-striped border-bottom border-success rounded">
                                                            <thead>
                                                                <tr class="border-bottom border-1 border-primary">
                                                                    <th>#</th>
                                                                    <th>ID</th>
                                                                    <th>Name</th>
                                                                    <th>Grade</th>
                                                                    <th>Start Date</th>
                                                                    <th>End Date</th>
                                                                    <th>Download</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php

                                                            $query = "SELECT * FROM `assignments` INNER JOIN `grade_has_subject` ON `assignments`.`grade_has_subject_id`=`grade_has_subject`.`id`";

                                                            for ($x = 0; $x < $aohs_count; $x++) {
                                                                $aohs_data = $aohs_rs->fetch_assoc();

                                                                if ($x == 0) {
                                                                    $query .= " WHERE `grade_id`='" . $aohs_data["grade_id"] . "'";
                                                                } else {
                                                                    $query .= " OR `grade_id`='" . $aohs_data["grade_id"] . "'";
                                                                }
                                                            }

                                                            $assignment_rs = Database::search($query . " LIMIT 4");
                                                            $assignment_count = $assignment_rs->num_rows;

                                                            if ($assignment_count > 0) {
                                                                for ($y = 0; $y < $assignment_count; $y++) {

                                                                    $assignment_data = $assignment_rs->fetch_assoc();

                                                                    $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $assignment_data["grade_id"] . "'");
                                                                    $grade_data = $grade_rs->fetch_assoc();

                                                                    ?>

                                                                        <tr class="border-bottom border-secondary">
                                                                            <td>
                                                                        <?php echo ($y + 1); ?>
                                                                            </td>
                                                                            <td>
                                                                        <?php echo ($assignment_data["id"]); ?>
                                                                            </td>
                                                                            <td>
                                                                        <?php echo ($assignment_data["title"]); ?>
                                                                            </td>
                                                                            <td>
                                                                        <?php echo ($grade_data["grade"]); ?>
                                                                            </td>
                                                                            <td>
                                                                        <?php echo ($assignment_data["time"]); ?>
                                                                            </td>
                                                                            <td>
                                                                        <?php echo ($assignment_data["period"]); ?>
                                                                            </td>
                                                                            <td><a href="<?php echo ($assignment_data["path"]); ?>"
                                                                                    download="<?php echo ($assignment_data["path"]); ?>"
                                                                                    class="btn btn-warning">Download</a></td>
                                                                        </tr>

                                                                <?php
                                                                }
                                                                ?>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                    <tr class="border-bottom border-secondary">
                                                                        <td colspan="7" class="text-center fs-5 p-3">
                                                                            <span class="text-primary fw-bold">0 assignments yet</span>
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="7" class="text-center fs-5">
                                                                        <button class="btn btn-warning"
                                                                            onclick="window.location = 'assignments.php'">View
                                                                            All</button>
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                    <!-- Table -->

                                                </div>

                                        <?php

                                    } else if (isset($_SESSION["admin"])) {

                                        $admin = $_SESSION["admin"];

                                        ?>

                                                    <div class="col-12 mt-3 p-3">

                                                        <!-- Table -->
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table align-middle  bg-transparent table-hover table-responsive-sm table-striped border-bottom border-success rounded">
                                                                <thead>
                                                                    <tr class="border-bottom border-1 border-primary">
                                                                        <th>#</th>
                                                                        <th>ID</th>
                                                                        <th>Name</th>
                                                                        <th>Grade</th>
                                                                        <th>Subject</th>
                                                                        <th>Start Date</th>
                                                                        <th>End Date</th>
                                                                        <th>Download</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                            <?php

                                                            $query = "SELECT * FROM `assignments` INNER JOIN `grade_has_subject` ON `assignments`.`grade_has_subject_id`=`grade_has_subject`.`id`";

                                                            $assignment_rs = Database::search($query . " LIMIT 4");
                                                            $assignment_count = $assignment_rs->num_rows;

                                                            if ($assignment_count > 0) {
                                                                for ($y = 0; $y < $assignment_count; $y++) {

                                                                    $assignment_data = $assignment_rs->fetch_assoc();

                                                                    $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $assignment_data["grade_id"] . "'");
                                                                    $grade_data = $grade_rs->fetch_assoc();

                                                                    $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $assignment_data["subject_id"] . "'");
                                                                    $subject_data = $subject_rs->fetch_assoc();

                                                                    ?>

                                                                            <tr class="border-bottom border-secondary">
                                                                                <td>
                                                                        <?php echo ($y + 1); ?>
                                                                                </td>
                                                                                <td>
                                                                        <?php echo ($assignment_data["id"]); ?>
                                                                                </td>
                                                                                <td>
                                                                        <?php echo ($assignment_data["title"]); ?>
                                                                                </td>
                                                                                <td>
                                                                        <?php echo ($grade_data["grade"]); ?>
                                                                                </td>
                                                                                <td>
                                                                        <?php echo ($subject_data["name"]); ?>
                                                                                </td>
                                                                                <td>
                                                                        <?php echo ($assignment_data["time"]); ?>
                                                                                </td>
                                                                                <td>
                                                                        <?php echo ($assignment_data["period"]); ?>
                                                                                </td>
                                                                                <td><a href="<?php echo ($assignment_data["path"]); ?>"
                                                                                        download="<?php echo ($assignment_data["path"]); ?>"
                                                                                        class="btn btn-warning">Download</a></td>
                                                                            </tr>

                                                                <?php
                                                                }
                                                                ?>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                        <tr class="border-bottom border-secondary">
                                                                            <td colspan="8" class="text-center fs-5 p-3">
                                                                                <span class="text-primary fw-bold">0 assignments yet</span>
                                                                            </td>
                                                                        </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="8" class="text-center fs-5">
                                                                            <button class="btn btn-warning"
                                                                                onclick="window.location = 'assignments.php'">View
                                                                                All</button>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                        <!-- Table -->

                                                    </div>

                                        <?php

                                    }

                                    ?>
                                </div>
                            </div>
                            <!-- Assignments -->

                            <!-- Notes -->
                            <div class="col-12 py-3 rounded-2">
                                <div class="row">

                                    <div class="col-12 mb-2">
                                        <span class="fw-bold text-black-50 fs-2">Recently Added Notes</span>
                                    </div>

                                    <?php

                                    if (isset($_SESSION["student"])) {

                                        $student = $_SESSION["student"];

                                        $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $student["grade_id"] . "'");
                                        $grade_data = $grade_rs->fetch_assoc();

                                        ?>

                                        <div class="col-12 mt-3 p-3">

                                            <!-- Table -->
                                            <div class="table-responsive">
                                                <table
                                                    class="table align-middle  bg-transparent table-hover table-responsive-sm table-striped border-bottom border-success rounded">
                                                    <thead>
                                                        <tr class="border-bottom border-1 border-primary">
                                                            <th>#</th>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Subject</th>
                                                            <th>Start Date</th>
                                                            <th>Download</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php

                                                        $note_rs = Database::search("SELECT * FROM `notes` INNER JOIN `grade_has_subject` ON `notes`.`grade_has_subject_id`=`grade_has_subject`.`id` WHERE `grade_id`='" . $student["grade_id"] . "' LIMIT 4");
                                                        $note_count = $note_rs->num_rows;

                                                        if ($note_count > 0) {
                                                            for ($y = 0; $y < $note_count; $y++) {

                                                                $note_data = $note_rs->fetch_assoc();

                                                                $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $note_data["subject_id"] . "'");
                                                                $subject_data = $subject_rs->fetch_assoc();

                                                                ?>

                                                                <tr class="border-bottom border-secondary">
                                                                    <td>
                                                                        <?php echo ($y + 1); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo ($note_data["id"]); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo ($note_data["title"]); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo ($subject_data["name"]) ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo ($note_data["time"]); ?>
                                                                    </td>
                                                                    <td><a href="<?php echo ($note_data["path"]); ?>"
                                                                            download="<?php echo ($note_data["path"]); ?>"
                                                                            class="btn btn-warning">Download</a></td>
                                                                </tr>

                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <tr class="border-bottom border-secondary">
                                                                <td colspan="6" class="text-center fs-5 p-3">
                                                                    <span class="text-primary fw-bold">You have 0 notes
                                                                        yet</span>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="6" class="text-center fs-5">
                                                                <button class="btn btn-warning"
                                                                    onclick="window.location = 'notes.php'">View
                                                                    All</button>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- Table -->

                                        </div>

                                        <?php

                                    } else if (isset($_SESSION["teacher"])) {

                                        $teacher = $_SESSION["teacher"];

                                        ?>

                                            <div class="col-12 mt-3 p-3">

                                                <!-- Table -->
                                                <div class="table-responsive">
                                                    <table
                                                        class="table align-middle  bg-transparent table-hover table-responsive-sm table-striped border-bottom border-success rounded">
                                                        <thead>
                                                            <tr class="border-bottom border-1 border-primary">
                                                                <th>#</th>
                                                                <th>ID</th>
                                                                <th>Name</th>
                                                                <th>Start Date</th>
                                                                <th>Download</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php

                                                            $note_rs = Database::search("SELECT * FROM `notes` INNER JOIN `grade_has_subject` ON `notes`.`grade_has_subject_id`=`grade_has_subject`.`id` WHERE `grade_has_subject_id`='" . $teacher["grade_has_subject_id"] . "' LIMIT 4");
                                                            $note_count = $note_rs->num_rows;

                                                            if ($note_count > 0) {
                                                                for ($y = 0; $y < $note_count; $y++) {

                                                                    $note_data = $note_rs->fetch_assoc();

                                                                    $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $note_data["subject_id"] . "'");
                                                                    $subject_data = $subject_rs->fetch_assoc();


                                                                    ?>

                                                                    <tr class="border-bottom border-secondary">
                                                                        <td>
                                                                        <?php echo ($y + 1); ?>
                                                                        </td>
                                                                        <td>
                                                                        <?php echo ($note_data["id"]); ?>
                                                                        </td>
                                                                        <td>
                                                                        <?php echo ($note_data["title"]); ?>
                                                                        </td>
                                                                        <td>
                                                                        <?php echo ($note_data["time"]); ?>
                                                                        </td>
                                                                        <td><a href="<?php echo ($note_data["path"]); ?>"
                                                                                download="<?php echo ($note_data["path"]); ?>"
                                                                                class="btn btn-warning">Download</a></td>
                                                                    </tr>

                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="5" class="text-center fs-5">
                                                                        <button class="btn btn-warning"
                                                                            onclick="window.location = 'notes.php'">View
                                                                            All</button>
                                                                    </td>
                                                                </tr>
                                                            </tfoot>

                                                        <?php
                                                            } else {
                                                                ?>
                                                            <tr class="border-bottom border-secondary">
                                                                <td colspan="5" class="text-center fs-5 p-3">
                                                                    <span class="text-primary fw-bold">0 notes yet</span>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="5" class="text-center fs-5">
                                                                        <button class="btn btn-warning"
                                                                            onclick="window.location = 'addNotes.php'">Add
                                                                            Note</button>
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        <?php
                                                            }
                                                            ?>
                                                    </table>
                                                </div>
                                                <!-- Table -->

                                            </div>

                                        <?php

                                    } else if (isset($_SESSION["academic_officer"])) {

                                        $academic = $_SESSION["academic_officer"];

                                        $aohs_rs = Database::search("SELECT * FROM `academic_officer_has_grade` WHERE `academic_officer_email`='" . $academic["email"] . "'");
                                        $aohs_count = $aohs_rs->num_rows;

                                        ?>

                                                <div class="col-12 mt-3 p-3">

                                                    <!-- Table -->
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table align-middle  bg-transparent table-hover table-responsive-sm table-striped border-bottom border-success rounded">
                                                            <thead>
                                                                <tr class="border-bottom border-1 border-primary">
                                                                    <th>#</th>
                                                                    <th>ID</th>
                                                                    <th>Name</th>
                                                                    <th>Grade</th>
                                                                    <th>Start Date</th>
                                                                    <th>Download</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php

                                                            $query = "SELECT * FROM `notes` INNER JOIN `grade_has_subject` ON `notes`.`grade_has_subject_id`=`grade_has_subject`.`id`";

                                                            for ($x = 0; $x < $aohs_count; $x++) {
                                                                $aohs_data = $aohs_rs->fetch_assoc();

                                                                if ($x == 0) {
                                                                    $query .= " WHERE `grade_id`='" . $aohs_data["grade_id"] . "'";
                                                                } else {
                                                                    $query .= " OR `grade_id`='" . $aohs_data["grade_id"] . "'";
                                                                }
                                                            }

                                                            $note_rs = Database::search($query . " LIMIT 4");
                                                            $note_count = $note_rs->num_rows;

                                                            if ($note_count > 0) {
                                                                for ($y = 0; $y < $note_count; $y++) {

                                                                    $note_data = $note_rs->fetch_assoc();

                                                                    $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $note_data["grade_id"] . "'");
                                                                    $grade_data = $grade_rs->fetch_assoc();

                                                                    ?>

                                                                        <tr class="border-bottom border-secondary">
                                                                            <td>
                                                                        <?php echo ($y + 1); ?>
                                                                            </td>
                                                                            <td>
                                                                        <?php echo ($note_data["id"]); ?>
                                                                            </td>
                                                                            <td>
                                                                        <?php echo ($note_data["title"]); ?>
                                                                            </td>
                                                                            <td>
                                                                        <?php echo ($grade_data["grade"]); ?>
                                                                            </td>
                                                                            <td>
                                                                        <?php echo ($note_data["time"]); ?>
                                                                            </td>
                                                                            <td><a href="<?php echo ($note_data["path"]); ?>"
                                                                                    download="<?php echo ($note_data["path"]); ?>"
                                                                                    class="btn btn-warning">Download</a></td>
                                                                        </tr>

                                                                <?php
                                                                }
                                                                ?>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                    <tr class="border-bottom border-secondary">
                                                                        <td colspan="6" class="text-center fs-5 p-3">
                                                                            <span class="text-primary fw-bold">0 notes yet</span>
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="6" class="text-center fs-5">
                                                                        <button class="btn btn-warning"
                                                                            onclick="window.location = 'notes.php'">View
                                                                            All</button>
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                    <!-- Table -->

                                                </div>

                                        <?php

                                    } else if (isset($_SESSION["admin"])) {

                                        $admin = $_SESSION["admin"];

                                        ?>

                                                    <div class="col-12 mt-3 p-3">

                                                        <!-- Table -->
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table align-middle  bg-transparent table-hover table-responsive-sm table-striped border-bottom border-success rounded">
                                                                <thead>
                                                                    <tr class="border-bottom border-1 border-primary">
                                                                        <th>#</th>
                                                                        <th>ID</th>
                                                                        <th>Name</th>
                                                                        <th>Grade</th>
                                                                        <th>Subject</th>
                                                                        <th>Start Date</th>
                                                                        <th>Download</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                            <?php

                                                            $query = "SELECT * FROM `notes` INNER JOIN `grade_has_subject` ON `notes`.`grade_has_subject_id`=`grade_has_subject`.`id`";

                                                            $note_rs = Database::search($query . " LIMIT 4");
                                                            $note_count = $note_rs->num_rows;

                                                            if ($note_count > 0) {
                                                                for ($y = 0; $y < $note_count; $y++) {

                                                                    $note_data = $note_rs->fetch_assoc();

                                                                    $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $note_data["grade_id"] . "'");
                                                                    $grade_data = $grade_rs->fetch_assoc();

                                                                    $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $note_data["subject_id"] . "'");
                                                                    $subject_data = $subject_rs->fetch_assoc();

                                                                    ?>

                                                                            <tr class="border-bottom border-secondary">
                                                                                <td>
                                                                        <?php echo ($y + 1); ?>
                                                                                </td>
                                                                                <td>
                                                                        <?php echo ($note_data["id"]); ?>
                                                                                </td>
                                                                                <td>
                                                                        <?php echo ($note_data["title"]); ?>
                                                                                </td>
                                                                                <td>
                                                                        <?php echo ($grade_data["grade"]); ?>
                                                                                </td>
                                                                                <td>
                                                                        <?php echo ($subject_data["name"]); ?>
                                                                                </td>
                                                                                <td>
                                                                        <?php echo ($note_data["time"]); ?>
                                                                                </td>
                                                                                <td><a href="<?php echo ($note_data["path"]); ?>"
                                                                                        download="<?php echo ($note_data["path"]); ?>"
                                                                                        class="btn btn-warning">Download</a></td>
                                                                            </tr>

                                                                <?php
                                                                }
                                                                ?>
                                                            <?php
                                                            } else {
                                                                ?>
                                                                        <tr class="border-bottom border-secondary">
                                                                            <td colspan="7" class="text-center fs-5 p-3">
                                                                                <span class="text-primary fw-bold">0 notes yet</span>
                                                                            </td>
                                                                        </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="7" class="text-center fs-5">
                                                                            <button class="btn btn-warning"
                                                                                onclick="window.location = 'notes.php'">View
                                                                                All</button>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                        <!-- Table -->

                                                    </div>

                                        <?php

                                    }

                                    ?>
                                </div>
                            </div>
                            <!-- Notes -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- Content -->

            <!-- <div class="fixed-bottom text-center text-warning">Home section is still on Developement</div> -->

            <footer class="col-12 header-bg p-3">
                <div class="row justify-content-center">

                    <div class="col-lg-5 col-12 text-center">
                        <span class="text-black-50 fs-6">
                            2024 &copy; SJ ACADEMY | Developed by I Chapa &trade;
                        </span>
                    </div>

                </div>
            </footer>

        </div>
    </div>

    <script src="src/js/script.js"></script>
    <script src="src/js/bootstrap.js"></script>
    <script src="src/js/bootstrap.bundle.js"></script>
</body>

</html>