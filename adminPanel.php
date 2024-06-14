<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Panel | SJ ACADEMY LMS</title>

    <link rel="stylesheet" href="src/css/style.css" />
    <link rel="stylesheet" href="src/css/bootstrap.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/src/js/bootstrap-icons@1.9.1/font/src/js/bootstrap-icons.css" />

    <link rel="shortcut icon" href="assets/logo/HS-Black.png" type="image/x-icon" />

</head>

<body class="home">

    <div class="container-fluid  d-flex flex-column">
        <div class="row justify-content-center">

            <?php

            include "header.php";

            if (isset($_SESSION["admin"])) {

                ?>

                <!-- Content -->
                <div class="col-12 text-center p-4">
                    <span class="fs-1 fw-bolder h1 text-success">Dashboard</span>
                </div>

                <div class="col-12 px-4 mb-2">
                    <div class="row">
                        <div class="col-12 border border-primary rounded px-lg-3 py-2">
                            <div class="row justify-content-center">

                                <!-- Analysis -->
                                <div class="col-12 py-3 border-bottom rounded-2">
                                    <div class="row">

                                        <!-- Records -->
                                        <div class="col-12 px-4 pt-3">
                                            <div class="row">

                                                <div class="col-sm-6 col-lg-3">
                                                    <div class="card text-bg-primary mb-3">
                                                        <div class="card-body">
                                                            <div class="card-title text-dark">
                                                                <div>
                                                                    <?php
                                                                    $st_rs = Database::search("SELECT * FROM `student` ORDER BY `registered_datetime` DESC");
                                                                    $st_count = $st_rs->num_rows;
                                                                    ?>
                                                                    <span class="fw-bold fs-4">
                                                                        <?php echo ($st_count); ?>
                                                                    </span><br />
                                                                    <span class="fs-3">Students</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-lg-3">
                                                    <div class="card text-bg-warning mb-3">
                                                        <div class="card-body">
                                                            <div class="card-title">
                                                                <div>
                                                                    <?php
                                                                    $tec_rs = Database::search("SELECT * FROM `teacher` ORDER BY `registered_datetime` DESC");
                                                                    $tec_count = $tec_rs->num_rows;
                                                                    ?>
                                                                    <span class="fw-bold fs-4">
                                                                        <?php echo ($tec_count); ?>
                                                                    </span><br />
                                                                    <span class="fs-3">Teachers</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-lg-3">
                                                    <div class="card text-bg-info mb-3">
                                                        <div class="card-body">
                                                            <div class="card-title">
                                                                <div>
                                                                    <?php
                                                                    $ao_rs = Database::search("SELECT * FROM `academic_officer` ORDER BY `registered_datetime` DESC");
                                                                    $ao_count = $ao_rs->num_rows;
                                                                    ?>
                                                                    <span class="fw-bold fs-4">
                                                                        <?php echo ($ao_count); ?>
                                                                    </span><br />
                                                                    <span class="fs-3">Academic Officers</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-lg-3">
                                                    <div class="card text-bg-success mb-3">
                                                        <div class="card-body">
                                                            <div class="card-title">
                                                                <div>
                                                                    <?php
                                                                    $ass_rs = Database::search("SELECT * FROM `assignments`");
                                                                    $ass_num = $ass_rs->num_rows;
                                                                    ?>
                                                                    <span class="fw-bold fs-4">
                                                                        <?php echo ($ass_num); ?>
                                                                    </span><br />
                                                                    <span class="fs-3">Assignments</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <!-- Records -->

                                    </div>
                                </div>

                                <div class="col-12 py-3 border-bottom rounded-2">
                                    <div class="row">

                                        <div class="col-12 mb-2">
                                            <span class="fw-bold text-black-50 fs-2">Recently Registered Teachers</span>
                                        </div>

                                        <div class="col-12">
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
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php

                                                        $tec_rs = Database::search("SELECT * FROM `teacher` ORDER BY `registered_datetime` DESC LIMIT 4");
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
                                                            </tr>

                                                            <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="5" class="text-center text-primary fs-5">
                                                                <button class="btn btn-danger"
                                                                    onclick="window.location = 'manageTeachers.php'">Manage</button>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- Table -->
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 py-3 border-bottom rounded-2">
                                    <div class="row">

                                        <div class="col-12 mb-2">
                                            <span class="fw-bold text-black-50 fs-2">Recently Registered Students</span>
                                        </div>

                                        <div class="col-12">
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
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php

                                                        $st_rs = Database::search("SELECT * FROM `student` ORDER BY `registered_datetime` DESC LIMIT 4");
                                                        $st_count = $st_rs->num_rows;

                                                        for ($y = 0; $y < $st_count; $y++) {

                                                            $st_data = $st_rs->fetch_assoc();

                                                            ?>

                                                            <tr class="border-bottom border-secondary">
                                                                <td>
                                                                    <?php echo ($y + 1); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo ($st_data["email"]); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo ($st_data["fname"]); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo ($st_data["mobile"]); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo ($st_data["registered_datetime"]); ?>
                                                                </td>
                                                            </tr>

                                                            <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="5" class="text-center text-primary fs-5">
                                                                <button class="btn btn-danger"
                                                                    onclick="window.location = 'manageStudents.php'">Manage</button>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- Table -->
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 py-3 rounded-2">
                                    <div class="row">

                                        <div class="col-12 mb-2">
                                            <span class="fw-bold text-black-50 fs-2">Recently Registered Academic
                                                Officers</span>
                                        </div>

                                        <div class="col-12">
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
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php

                                                        $ao_rs = Database::search("SELECT * FROM `academic_officer` ORDER BY `registered_datetime` DESC LIMIT 4");
                                                        $ao_count = $ao_rs->num_rows;

                                                        for ($y = 0; $y < $ao_count; $y++) {

                                                            $ao_data = $ao_rs->fetch_assoc();

                                                            ?>

                                                            <tr class="border-bottom border-secondary">
                                                                <td>
                                                                    <?php echo ($y + 1); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo ($ao_data["email"]); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo ($ao_data["fname"]); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo ($ao_data["mobile"]); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo ($ao_data["registered_datetime"]); ?>
                                                                </td>
                                                            </tr>

                                                            <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="5" class="text-center text-primary fs-5">
                                                                <button class="btn btn-danger"
                                                                    onclick="window.location = 'manageAcademics.php'">Manage</button>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- Table -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- Content -->

                <?php

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

    <script src="src/js/script.js"></script>
    <script src="src/js/bootstrap.js"></script>
    <script src="src/js/bootstrap.bundle.js"></script>
</body>

</html>