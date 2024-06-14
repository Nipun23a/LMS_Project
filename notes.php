<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notes</title>

    <link rel="stylesheet" href="src/css/style.css" />
    <link rel="stylesheet" href="src/css/bootstrap.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/src/js/bootstrap-icons@1.9.1/font/src/js/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/src/js/bootstrap@5.3.0-alpha1/dist/css/src/js/bootstrap.min.css"
        rel="stylesheet">

    <link rel="shortcut icon" href="assets/logo/HS-Black.png" type="image/x-icon" />

</head>

<body class="home">

    <div class="container-fluid d-flex flex-column">
        <div class="row justify-content-center">

            <?php include "header.php"; ?>

            <article>
                <div class="col-12 text-center mt-3">
                    <h1 class="h1 fw-bold text-primary">Notes</h1>
                </div>

                <div class="col-12 mt-3 mb-3 p-3 shadow rounded-3">
                    <div class="row justify-content-center">

                        <?php

                        if (isset($_SESSION["teacher"])) {

                            $teacher = $_SESSION["teacher"];
                            $ghs_id = $teacher["grade_has_subject_id"];

                            $ghs_rs = Database::search("SELECT * FROM `grade_has_subject` WHERE `id`='" . $ghs_id . "'");
                            $ghs_data = $ghs_rs->fetch_assoc();

                            $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $ghs_data["grade_id"] . "'");
                            $grade_data = $grade_rs->fetch_assoc();

                            $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $ghs_data["subject_id"] . "'");
                            $subject_data = $subject_rs->fetch_assoc();

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
                                                <th>Date</th>
                                                <th>Download</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                            $note_rs = Database::search("SELECT * FROM `notes` WHERE `grade_has_subject_id`='" . $ghs_id . "'");
                                            $note_count = $note_rs->num_rows;

                                            for ($y = 0; $y < $note_count; $y++) {

                                                $note_data = $note_rs->fetch_assoc();

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
                                                    <td><a href="<?php echo ($note_data["path"]); ?>"
                                                            class="btn btn-info">View</a></td>
                                                </tr>

                                                <?php
                                            }
                                            ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6" class="text-center text-primary fs-5">
                                                    <div class="offset-2 offset-lg-4 col-8 col-lg-4 my-2 d-grid">
                                                        <a href="addNotes.php" class="btn btn-primary">Add Note</a>
                                                    </div>
                                                    <?php echo ($grade_data["grade"] . " - " . $subject_data["name"]); ?>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- Table -->

                            </div>

                            <?php

                        } else if (isset($_SESSION["student"])) {

                            $student = $_SESSION["student"];

                            $st_gs_rs = Database::search("SELECT * FROM `student_has_gs` WHERE `student_email`='" . $student["email"] . "'");
                            $st_gs_count = $st_gs_rs->num_rows;

                            for ($x = 0; $x < $st_gs_count; $x++) {

                                $st_gs_data = $st_gs_rs->fetch_assoc();
                                $ghs_id = $st_gs_data["grade_has_subject_id"];

                                $ghs_rs = Database::search("SELECT * FROM `grade_has_subject` WHERE `id`='" . $ghs_id . "'");
                                $ghs_data = $ghs_rs->fetch_assoc();

                                $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $ghs_data["grade_id"] . "'");
                                $grade_data = $grade_rs->fetch_assoc();

                                $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $ghs_data["subject_id"] . "'");
                                $subject_data = $subject_rs->fetch_assoc();

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
                                                        <th>Date</th>
                                                        <th>Download</th>
                                                        <th>View</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php

                                                    $note_rs = Database::search("SELECT * FROM `assignments` WHERE `grade_has_subject_id`='" . $ghs_id . "'");
                                                    $note_count = $note_rs->num_rows;

                                                    for ($y = 0; $y < $note_count; $y++) {

                                                        $note_data = $note_rs->fetch_assoc();

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
                                                            <td><a href="<?php echo ($note_data["path"]); ?>"
                                                                    class="btn btn-info">View</a></td>
                                                        </tr>

                                                    <?php
                                                    }
                                                    ?>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="6" class="text-center text-primary fs-5">
                                                        <?php echo ($subject_data["name"]); ?>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- Table -->

                                    </div>

                                <?php

                            }
                        } else if (isset($_SESSION["academic_officer"])) {

                            $academic = $_SESSION["academic_officer"];

                            $aohs_rs = Database::search("SELECT * FROM `academic_officer_has_grade` WHERE `academic_officer_email`='" . $academic["email"] . "'");
                            $aohs_count = $aohs_rs->num_rows;

                            for ($x = 0; $x < $aohs_count; $x++) {

                                $aohs_data = $aohs_rs->fetch_assoc();
                                $grade_id = $aohs_data["grade_id"];

                                $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $grade_id . "'");
                                $grade_data = $grade_rs->fetch_assoc();

                                $ghs_rs = Database::search("SELECT * FROM `grade_has_subject` WHERE `grade_id`='" . $grade_id . "'");
                                $ghs_count = $ghs_rs->num_rows;

                                ?>

                                        <div class="col-12 mt-4 text-center d-grid">
                                            <button class="btn fs-4 text-warning fw-bold collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseExample<?php echo ($x) ?>"
                                                aria-expanded="false" aria-controls="collapseExample<?php echo ($x) ?>">
                                        <?php echo ($grade_data["grade"]); ?>
                                            </button>
                                            <hr />
                                        </div>

                                    <?php

                                    for ($z = 0; $z < $ghs_count; $z++) {

                                        $ghs_data = $ghs_rs->fetch_assoc();
                                        $ghs_id = $ghs_data["id"];

                                        $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $ghs_data["subject_id"] . "'");
                                        $subject_data = $subject_rs->fetch_assoc();

                                        ?>

                                            <div class="collapse" id="collapseExample<?php echo ($x) ?>">
                                                <div class="col-12 p-3 mt-3">

                                                    <!-- Table -->
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table align-middle  bg-transparent table-hover table-responsive-sm table-striped border-bottom border-success rounded">
                                                            <thead>
                                                                <tr class="border-bottom border-1 border-primary">
                                                                    <th>#</th>
                                                                    <th>ID</th>
                                                                    <th>Name</th>
                                                                    <th>Date</th>
                                                                    <th>Download</th>
                                                                    <th>View</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php

                                                            $note_rs = Database::search("SELECT * FROM `assignments` WHERE `grade_has_subject_id`='" . $ghs_id . "'");
                                                            $note_count = $note_rs->num_rows;

                                                            for ($y = 0; $y < $note_count; $y++) {

                                                                $note_data = $note_rs->fetch_assoc();

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
                                                                        <td><a href="<?php echo ($note_data["path"]); ?>"
                                                                                class="btn btn-info">View</a></td>
                                                                    </tr>

                                                            <?php
                                                            }
                                                            ?>

                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="6" class="text-center text-primary fs-5">
                                                                <?php echo ($subject_data["name"]); ?>
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                    <!-- Table -->

                                                </div>
                                            </div>

                                    <?php

                                    }
                            }
                        } else if (isset($_SESSION["admin"])) {

                            $admin = $_SESSION["admin"];

                            $grade_rs = Database::search("SELECT * FROM `grade`");
                            $grade_count = $grade_rs->num_rows;

                            for ($x = 0; $x < $grade_count; $x++) {

                                $grade_data = $grade_rs->fetch_assoc();

                                $ghs_rs = Database::search("SELECT * FROM `grade_has_subject` WHERE `grade_id`='" . $grade_data["id"] . "'");
                                $ghs_count = $ghs_rs->num_rows;

                                ?>

                                            <div class="col-12 mt-4 text-center d-grid">
                                                <button class="btn fs-4 text-warning fw-bold collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseExample<?php echo ($x) ?>"
                                                    aria-expanded="false" aria-controls="collapseExample<?php echo ($x) ?>">
                                        <?php echo ($grade_data["grade"]); ?>
                                                </button>
                                                <hr />
                                            </div>

                                    <?php

                                    for ($z = 0; $z < $ghs_count; $z++) {

                                        $ghs_data = $ghs_rs->fetch_assoc();
                                        $ghs_id = $ghs_data["id"];

                                        $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $ghs_data["subject_id"] . "'");
                                        $subject_data = $subject_rs->fetch_assoc();

                                        ?>
                                                <div class="collapse" id="collapseExample<?php echo ($x) ?>">
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
                                                                        <th>Date</th>
                                                                        <th>Download</th>
                                                                        <th>View</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                            <?php

                                                            $note_rs = Database::search("SELECT * FROM `assignments` WHERE `grade_has_subject_id`='" . $ghs_id . "'");
                                                            $note_count = $note_rs->num_rows;

                                                            for ($y = 0; $y < $note_count; $y++) {

                                                                $note_data = $note_rs->fetch_assoc();

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
                                                                            <td><a href="<?php echo ($note_data["path"]); ?>"
                                                                                    class="btn btn-info">View</a></td>
                                                                        </tr>

                                                            <?php
                                                            }
                                                            ?>

                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="6" class="text-center text-primary fs-5">
                                                                <?php echo ($subject_data["name"]); ?>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                        <!-- Table -->

                                                    </div>
                                                </div>

                                    <?php

                                    }
                            }
                        } else {
                            ?>
                                        <script>
                                            window.onload = function () {
                                                window.location = "home.php";
                                            }
                                        </script>
                            <?php
                        }

                        ?>

                    </div>
                </div>
            </article>

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