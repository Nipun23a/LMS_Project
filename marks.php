<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Assignment | SJ ACADEMY LMS</title>

    <link rel="stylesheet" href="src/css/style.css" />
    <link rel="stylesheet" href="src/css/bootstrap.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/src/js/bootstrap-icons@1.9.1/font/src/js/bootstrap-icons.css" />

    <link rel="shortcut icon" href="assets/logo/HS-Black.png" type="image/x-icon" />
</head>

<body class="homex2">

    <?php
    if (isset($_GET["id"])) {
        ?>

            <div class="container-fluid">
                <div class="row justify-content-center">

                    <?php include "header.php"; ?>

                    <div class="col-12 p-3 px-lg-4">
                        <div class="row justify-content-center">

                            <div class="col-12 text-center p-2 mb-3">
                                <span class="h1 text-warning">Assignment Answers & marks</span>
                            </div>

                            <div class="col-12 shadow rounded-3 p-3 py-4 homex">

                                <?php

                                $assignment_rs = Database::search("SELECT * FROM `assignments` WHERE `id`='" . $_GET["id"] . "'");
                                $assignment_data = $assignment_rs->fetch_assoc();

                                $ghs_rs = Database::search("SELECT * FROM `grade_has_subject` WHERE `id`='" . $assignment_data["grade_has_subject_id"] . "'");
                                $ghs_data = $ghs_rs->fetch_assoc();

                                $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $ghs_data["grade_id"] . "'");
                                $grade_data = $grade_rs->fetch_assoc();

                                $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $ghs_data["subject_id"] . "'");
                                $subject_data = $subject_rs->fetch_assoc();

                                if (isset($_SESSION["teacher"])) {

                                    ?>

                                        <div class="row p-lg-3 mb-3 justify-content-center justify-content-lg-between">
                                            <div class="col-lg-6 col-12">
                                                <span class="fs-6 fw-bold">Assignment ID:
                                                    <?php echo ($_GET["id"]) ?>
                                                </span><br />
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <span class="fs-6 fw-bold">Assignment Name:
                                                    <?php echo ($assignment_data["title"]) ?>
                                                </span><br />
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <span class="fs-6 fw-bold">Assignment Grade:
                                                    <?php echo ($grade_data["grade"]) ?>
                                                </span><br />
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <span class="fs-6 fw-bold">Assignment Subject:
                                                    <?php echo ($subject_data["name"]) ?>
                                                </span><br />
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <span class="fs-6 fw-bold">Assignment Start Date: <br />
                                                    <?php echo ($assignment_data["time"]) ?>
                                                </span>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <span class="fs-6 fw-bold">Assignment End Date: <br />
                                                    <?php echo ($assignment_data["period"]) ?>
                                                </span>
                                            </div>
                                            <div class="col-12 col-lg-4 mt-3 d-grid">
                                                <a href="<?php echo ($assignment_data["path"]); ?>" class="btn btn-outline-warning"
                                                    download="<?php echo ($assignment_data["path"]); ?>">Download</a>
                                            </div>
                                            <div class="col-12">
                                                <hr />
                                            </div>
                                        </div>

                                        <!-- Table -->
                                        <div class="table-responsive">
                                            <table
                                                class="table align-middle  bg-transparent table-hover table-responsive-sm table-striped border-bottom border-success rounded">
                                                <thead>
                                                    <tr class="border-bottom border-1 border-primary">
                                                        <th>#</th>
                                                        <th>ID</th>
                                                        <th>Submitted Time</th>
                                                        <th>Student Email</th>
                                                        <th>Answers Download</th>
                                                        <th>Marks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php

                                                    $sha_rs = Database::search("SELECT * FROM `student_has_assignments` WHERE `assignments_id`='" . $_GET["id"] . "' ORDER BY `time` ASC");
                                                    $sha_count = $sha_rs->num_rows;

                                                    $y;
                                                    for ($y = 0; $y < $sha_count; $y++) {

                                                        $sha_data = $sha_rs->fetch_assoc();

                                                        $st_rs = Database::search("SELECT * FROM `student` WHERE `email`='" . $sha_data["student_email"] . "'")

                                                            ?>

                                                            <tr class="border-bottom border-secondary">
                                                                <td>
                                                                    <?php echo ($y + 1); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo ($sha_data["id"]); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo ($sha_data["time"]); ?>
                                                                </td>
                                                                <td>
                                                                    <input type="text" id="email<?php echo ($y); ?>"
                                                                        class="form-control bg-transparent text-white border-0 disabled"
                                                                        disabled value="<?php echo ($sha_data["student_email"]); ?>">
                                                                </td>
                                                                <td>
                                                                    <a href="<?php echo ($sha_data["path"]); ?>"
                                                                        download="<?php echo ($sha_data["path"]); ?>"
                                                                        class="btn btn-warning">Download</a>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="number" style="min-width: 120px;" id="mark<?php echo ($y); ?>"
                                                                        value="<?php echo ($sha_data["marks"]); ?>" class="form-control"
                                                                        placeholder="Enter Marks" min="0" max="100" />
                                                                </td>
                                                            </tr>

                                                            <?php
                                                    }
                                                    ?>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="8" class="text-center text-primary fs-5">
                                                            <?php

                                                            $total_rs = Database::search("SELECT * FROM `student_has_gs` WHERE `grade_has_subject_id`='" . $assignment_data["grade_has_subject_id"] . "'");
                                                            $total_count = $total_rs->num_rows;

                                                            ?>
                                                            <div class="row g-0 py-3 justify-content-center">
                                                                <div class="col-lg-5 col-12">
                                                                    <span>Submitted By:
                                                                        <?php echo ($sha_count); ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-lg-5 col-12">
                                                                    <span>Students Left:
                                                                        <?php echo ($total_count - $sha_count); ?>
                                                                    </span>
                                                                </div>
                                                                <div class="col-12">
                                                                    <hr />
                                                                </div>
                                                                <div class="col-5 mt-3 d-grid">
                                                                    <button class="btn btn-success"
                                                                        onclick="submit_marks(<?php echo ($y . ', ' . $_GET['id']); ?>);">Submit
                                                                        Marks</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- Table -->

                                        <?php

                                } else if (isset($_SESSION["academic_officer"])) {

                                    ?>

                                                <div class="row p-lg-3 mb-3 justify-content-center justify-content-lg-between">
                                                    <div class="col-lg-6 col-12">
                                                        <span class="fs-6 fw-bold">Assignment ID:
                                                    <?php echo ($_GET["id"]) ?>
                                                        </span><br />
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <span class="fs-6 fw-bold">Assignment Name:
                                                    <?php echo ($assignment_data["title"]) ?>
                                                        </span><br />
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <span class="fs-6 fw-bold">Assignment Grade:
                                                    <?php echo ($grade_data["grade"]) ?>
                                                        </span><br />
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <span class="fs-6 fw-bold">Assignment Subject:
                                                    <?php echo ($subject_data["name"]) ?>
                                                        </span><br />
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <span class="fs-6 fw-bold">Assignment Start Date: <br />
                                                    <?php echo ($assignment_data["time"]) ?>
                                                        </span>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <span class="fs-6 fw-bold">Assignment End Date: <br />
                                                    <?php echo ($assignment_data["period"]) ?>
                                                        </span>
                                                    </div>
                                                    <div class="col-12 col-lg-4 mt-3 d-grid">
                                                        <a href="<?php echo ($assignment_data["path"]); ?>" class="btn btn-outline-warning"
                                                            download="<?php echo ($assignment_data["path"]); ?>">Download</a>
                                                    </div>
                                                    <div class="col-12">
                                                        <hr />
                                                    </div>
                                                </div>

                                                <!-- Table -->
                                                <div class="table-responsive">
                                                    <table
                                                        class="table align-middle  bg-transparent table-hover table-responsive-sm table-striped border-bottom border-success rounded">
                                                        <thead>
                                                            <tr class="border-bottom border-1 border-primary">
                                                                <th>#</th>
                                                                <th>ID</th>
                                                                <th>Submitted Time</th>
                                                                <th>Student Email</th>
                                                                <th>Answers Download</th>
                                                                <th>Marks</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php

                                                            $sha_rs = Database::search("SELECT * FROM `student_has_assignments` WHERE `assignments_id`='" . $_GET["id"] . "' ORDER BY `time` ASC");
                                                            $sha_count = $sha_rs->num_rows;

                                                            $y;
                                                            for ($y = 0; $y < $sha_count; $y++) {

                                                                $sha_data = $sha_rs->fetch_assoc();

                                                                $st_rs = Database::search("SELECT * FROM `student` WHERE `email`='" . $sha_data["student_email"] . "'")

                                                                    ?>

                                                                    <tr class="border-bottom border-secondary">
                                                                        <td>
                                                                    <?php echo ($y + 1); ?>
                                                                        </td>
                                                                        <td>
                                                                    <?php echo ($sha_data["id"]); ?>
                                                                        </td>
                                                                        <td>
                                                                    <?php echo ($sha_data["time"]); ?>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" id="email<?php echo ($y); ?>"
                                                                                class="form-control bg-transparent text-white border-0 disabled"
                                                                                disabled value="<?php echo ($sha_data["student_email"]); ?>">
                                                                        </td>
                                                                        <td>
                                                                            <a href="<?php echo ($sha_data["path"]); ?>"
                                                                                download="<?php echo ($sha_data["path"]); ?>"
                                                                                class="btn btn-warning">Download</a>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover"
                                                                                data-bs-trigger="hover focus"
                                                                                data-bs-content="<?php echo ($sha_data["teacher_email"]); ?>">
                                                                                <input type="number" style="min-width: 120px;"
                                                                                    id="mark<?php echo ($y); ?>"
                                                                                    value="<?php echo ($sha_data["marks"]); ?>" class="form-control"
                                                                                    placeholder="Enter Marks" min="0" max="100" />
                                                                            </span>
                                                                        </td>
                                                                    </tr>

                                                            <?php
                                                            }
                                                            ?>

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="8" class="text-center text-primary fs-5">
                                                                    <?php

                                                                    $total_rs = Database::search("SELECT * FROM `student_has_gs` WHERE `grade_has_subject_id`='" . $assignment_data["grade_has_subject_id"] . "'");
                                                                    $total_count = $total_rs->num_rows;

                                                                    ?>
                                                                    <div class="row g-0 py-3 justify-content-center">
                                                                        <div class="col-lg-5 col-12">
                                                                            <span>Submitted By:
                                                                        <?php echo ($sha_count); ?>
                                                                            </span>
                                                                        </div>
                                                                        <div class="col-lg-5 col-12">
                                                                            <span>Students Left:
                                                                        <?php echo ($total_count - $sha_count); ?>
                                                                            </span>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <hr />
                                                                        </div>
                                                                        <div class="col-8">
                                                                            <input type="number" class="form-control" id="extra"
                                                                                placeholder="Add Extra Marks" min="0" max="5" />
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <hr />
                                                                        </div>
                                                                        <div class="col-5 mt-3 d-grid">
                                                                            <button class="btn btn-success"
                                                                                onclick="release_marks(<?php echo ($y . ', ' . $_GET['id']); ?>);">Submit
                                                                                Marks</button>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                <!-- Table -->

                                        <?php
                                } else if (isset($_SESSION["admin"])) {

                                    ?>

                                                        <div class="row p-lg-3 mb-3 justify-content-center justify-content-lg-between">
                                                            <div class="col-lg-6 col-12">
                                                                <span class="fs-6 fw-bold">Assignment ID:
                                                    <?php echo ($_GET["id"]) ?>
                                                                </span><br />
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <span class="fs-6 fw-bold">Assignment Name:
                                                    <?php echo ($assignment_data["title"]) ?>
                                                                </span><br />
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <span class="fs-6 fw-bold">Assignment Grade:
                                                    <?php echo ($grade_data["grade"]) ?>
                                                                </span><br />
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <span class="fs-6 fw-bold">Assignment Subject:
                                                    <?php echo ($subject_data["name"]) ?>
                                                                </span><br />
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <span class="fs-6 fw-bold">Assignment Start Date: <br />
                                                    <?php echo ($assignment_data["time"]) ?>
                                                                </span>
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <span class="fs-6 fw-bold">Assignment End Date: <br />
                                                    <?php echo ($assignment_data["period"]) ?>
                                                                </span>
                                                            </div>
                                                            <div class="col-12 col-lg-4 mt-3 d-grid">
                                                                <a href="<?php echo ($assignment_data["path"]); ?>" class="btn btn-outline-warning"
                                                                    download="<?php echo ($assignment_data["path"]); ?>">Download</a>
                                                            </div>
                                                            <div class="col-12">
                                                                <hr />
                                                            </div>
                                                        </div>

                                                        <!-- Table -->
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table align-middle  bg-transparent table-hover table-responsive-sm table-striped border-bottom border-success rounded">
                                                                <thead>
                                                                    <tr class="border-bottom border-1 border-primary">
                                                                        <th>#</th>
                                                                        <th>ID</th>
                                                                        <th>Submitted Time</th>
                                                                        <th>Student Email</th>
                                                                        <th>Answers Download</th>
                                                                        <th>Marks</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                            <?php

                                                            $sha_rs = Database::search("SELECT * FROM `student_has_assignments` WHERE `assignments_id`='" . $_GET["id"] . "' ORDER BY `time` ASC");
                                                            $sha_count = $sha_rs->num_rows;

                                                            $y;
                                                            for ($y = 0; $y < $sha_count; $y++) {

                                                                $sha_data = $sha_rs->fetch_assoc();

                                                                $st_rs = Database::search("SELECT * FROM `student` WHERE `email`='" . $sha_data["student_email"] . "'")

                                                                    ?>

                                                                            <tr class="border-bottom border-secondary">
                                                                                <td>
                                                                    <?php echo ($y + 1); ?>
                                                                                </td>
                                                                                <td>
                                                                    <?php echo ($sha_data["id"]); ?>
                                                                                </td>
                                                                                <td>
                                                                    <?php echo ($sha_data["time"]); ?>
                                                                                </td>
                                                                                <td>
                                                                    <?php echo ($sha_data["student_email"]); ?>
                                                                                </td>
                                                                                <td>
                                                                                    <a href="<?php echo ($sha_data["path"]); ?>"
                                                                                        download="<?php echo ($sha_data["path"]); ?>"
                                                                                        class="btn btn-warning">Download</a>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover"
                                                                                        data-bs-trigger="hover focus"
                                                                                        data-bs-content="<?php echo ($sha_data["teacher_email"]); ?>">
                                                                                        <button class="btn btn-danger disabled" disabled>
                                                                            <?php echo ($sha_data["marks"]); ?>
                                                                                        </button>
                                                                                    </span>
                                                                                </td>
                                                                            </tr>

                                                            <?php
                                                            }
                                                            ?>

                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="8" class="text-center text-primary fs-5">
                                                                    <?php

                                                                    $total_rs = Database::search("SELECT * FROM `student_has_gs` WHERE `grade_has_subject_id`='" . $assignment_data["grade_has_subject_id"] . "'");
                                                                    $total_count = $total_rs->num_rows;

                                                                    ?>
                                                                            <div class="row g-0 py-3 justify-content-center">
                                                                                <div class="col-lg-5 col-12">
                                                                                    <span>Submitted By:
                                                                        <?php echo ($sha_count); ?>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="col-lg-5 col-12">
                                                                                    <span>Students Left:
                                                                        <?php echo ($total_count - $sha_count); ?>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                        <!-- Table -->

                                        <?php
                                } else {
                                    ?>
                                                        <script>
                                                            window.onload = function () {
                                                                window.location = "home.php";
                                                            };
                                                        </script>
                                        <?php
                                }
                                ?>

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

            <?php
    } else {
        ?>
            <script>
                window.onload = function () {
                    window.location = "assignments.php";
                };
            </script>
            <?php
    }
    ?>

    <script src="src/js/script.js"></script>
    <script src="src/js/bootstrap.js"></script>
    <script src="src/js/bootstrap.bundle.js"></script>
</body>

</html>