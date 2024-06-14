<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage</title>

    <link rel="stylesheet" href="src/css/style.css" />
    <link rel="stylesheet" href="src/css/bootstrap.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/src/js/bootstrap-icons@1.9.1/font/src/js/bootstrap-icons.css" />

    <link rel="shortcut icon" href="assets/logo/HS-Black.png" type="image/x-icon" />

</head>

<body class="bg-info bg-opacity-25">

    <div class="container-fluid vh-100">
        <div class="row align-items-center justify-content-center">

            <?php include "header.php"; ?>

            <div class="col-12 p-3 p-lg-4">
                <div class="row">

                    <div class="col-12 p-3 shadow rounded-3 homex">
                        <div class="row justify-content-center">

                            <div class="col-12 text-center text-primary">
                                <span class="h2">Manage Teachers</span>
                            </div>

                            <div class="col-12 border rounded mt-3 pt-3">
                                <div>
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
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                $tec_rs = Database::search("SELECT * FROM `teacher` ORDER BY `registered_datetime` DESC");
                                                $tec_count = $tec_rs->num_rows;

                                                for ($y = 0; $y < $tec_count; $y++) {

                                                    $tec_data = $tec_rs->fetch_assoc();

                                                    ?>

                                                        <tr class="border-bottom border-secondary">
                                                            <td>
                                                                <?php echo ($y + 1); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo ($tec_data["email"]); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo ($tec_data["fname"]); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo ($tec_data["mobile"]); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo ($tec_data["registered_datetime"]); ?>
                                                            </td>
                                                            <td><button class="btn btn-danger"
                                                                    onclick="manage('<?php echo ($tec_data['email']); ?>');">Manage</button>
                                                            </td>
                                                        </tr>

                                                        <div class="modal modal-fullscreen" tabindex="-1"
                                                            id="manageModal<?php echo ($tec_data["email"]); ?>">
                                                            <div class="modal-dialog-center modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            <?php echo ($tec_data["fname"] . " " . $tec_data["lname"]); ?>
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-12">
                                                                            <div class="row justify-content-center">
                                                                                <div class="col-12 mb-3">

                                                                                    <?php
                                                                                    $ghs_id = $tec_data["grade_has_subject_id"];

                                                                                    $ghs_rs = Database::search("SELECT * FROM `grade_has_subject` WHERE `id`='" . $ghs_id . "'");
                                                                                    $ghs_data = $ghs_rs->fetch_assoc();

                                                                                    $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $ghs_data["grade_id"] . "'");
                                                                                    $grade_data = $grade_rs->fetch_assoc();

                                                                                    $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $ghs_data["subject_id"] . "'");
                                                                                    $subject_data = $subject_rs->fetch_assoc();
                                                                                    ?>

                                                                                    <span class="fw-bold fs-5">Email:
                                                                                        <?php echo ($tec_data["email"]); ?>
                                                                                    </span><br />
                                                                                    <span class="fw-bold fs-5">First Name:
                                                                                        <?php echo ($tec_data["fname"]); ?>
                                                                                    </span><br />
                                                                                    <span class="fw-bold fs-5">Last Name:
                                                                                        <?php echo ($tec_data["lname"]); ?>
                                                                                    </span><br />
                                                                                    <span class="fw-bold fs-5">Mobile:
                                                                                        <?php echo ($tec_data["mobile"]); ?>
                                                                                    </span><br />
                                                                                    <span class="fw-bold fs-5">Subject:
                                                                                        <?php echo ($subject_data["name"]); ?>
                                                                                    </span><br />
                                                                                    <span class="fw-bold fs-5">Grade:
                                                                                        <?php echo ($grade_data["grade"]); ?>
                                                                                    </span><br />
                                                                                </div>
                                                                                <div class="col-12 p-3 border-top">
                                                                                    <div class="row justify-content-center">
                                                                                        <div class="col-12">
                                                                                            <label class="form-label">Change
                                                                                                Grade</label>
                                                                                            <select class="form-select"
                                                                                                id="grade"
                                                                                                onchange="load_subject();">
                                                                                                <option value="0" selected>
                                                                                                    Select Grade</option>
                                                                                                <?php

                                                                                                $grade_rs = Database::search("SELECT * FROM `grade` ORDER BY `id` ASC");
                                                                                                $grade_count = $grade_rs->num_rows;

                                                                                                for ($x = 0; $x < $grade_count; $x++) {

                                                                                                    $grade_data = $grade_rs->fetch_assoc();

                                                                                                    ?>
                                                                                                        <option
                                                                                                            value="<?php echo ($grade_data["id"]); ?>">
                                                                                                            <?php echo ($grade_data["grade"]); ?>
                                                                                                        </option>
                                                                                                        <?php
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-12">
                                                                                            <label class="form-label">Assign
                                                                                                Subject</label>
                                                                                            <div id="sub_area">
                                                                                                <select
                                                                                                    class="form-select disabled"
                                                                                                    disabled id="subject">
                                                                                                    <option value="0">Select
                                                                                                        Grade First !!</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-8 d-grid mt-3 mb-3">
                                                                                            <button class="btn btn-danger"
                                                                                                onclick="update_tec('<?php echo ($tec_data['email']); ?>');">Update</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php
                                                }
                                                ?>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6" class="text-center text-primary fs-5">
                                                        <span class="fw-bold">Total Teachers:
                                                            <?php echo ($tec_count); ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- Table -->

                                </div>
                            </div>

                            <div class="col-12 mt-3 p-3">
                                <div class="row">

                                    <?php

                                    $ghs_rs = Database::search("SELECT * FROM `grade_has_subject`");
                                    $ghs_count = $ghs_rs->num_rows;

                                    $grade_rs = Database::search("SELECT * FROM `grade`");
                                    $grade_count = $grade_rs->num_rows;

                                    $subject_rs = Database::search("SELECT * FROM `subject`");
                                    $subject_count = $subject_rs->num_rows;

                                    ?>

                                    <div class="col-12 col-lg-4">
                                        <div class="card text-bg-dark mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Total Subjects</h5>
                                                <p class="card-text">
                                                    <?php echo ($subject_count); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="card text-bg-dark mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Total Grades</h5>
                                                <p class="card-text">
                                                    <?php echo ($grade_count); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="card text-bg-dark mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Teachers Required</h5>
                                                <p class="card-text">
                                                    <?php echo ($ghs_count); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 mt-3 mb-3 d-grid p-2 px-4">
                                <a class="btn btn-outline-warning fs-5 p-3" href="register.php?teacher">Register new
                                    Teacher</a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <footer class="col-12 header-bg p-3">
                <div class="row justify-content-center">

                    <div class="col-lg-5 col-12 text-center">
                        <span class="text-black-50 fs-6">
                            2024 &copy; SJ ACADEMY | Developed by Shanu Jayasinghe &trade;
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