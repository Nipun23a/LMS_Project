<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <link rel="stylesheet" href="src/css/style.css" />
    <link rel="stylesheet" href="src/css/bootstrap.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/src/js/bootstrap-icons@1.9.1/font/src/js/bootstrap-icons.css" />

    <link rel="shortcut icon" href="assets/logo/HS-Black.png" type="image/x-icon" />

</head>

<body class="home">

    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">

            <?php include "header.php"; ?>

            <?php

            if (isset($_SESSION["admin"])) {

                ?>

                <article class="col-12 p-3">
                    <div class="row justify-content-center align-items-center align-content-center">

                        <div class="col-12 text-center text-uppercase mt-3 mb-3">
                            <h2 class="fw-bold text-primary">Registration</h2>
                        </div>

                        <div class="col-12 py-2 shadow rounded-2">
                            <div class="row justify-content-center align-items-center g-2">

                                <div class="col-12 p-lg-3 p-2">

                                    <?php

                                    if (isset($_GET["teacher"])) {

                                        ?>
                                        <!-- Teacher -->
                                        <div class="row justify-content-center">

                                            <div class="col-12 text-center">
                                                <label class="h3 fw-bold text-uppercase">Teacher</label>
                                            </div>

                                            <div class="col-12 p-2">
                                                <div class="row g-2 justify-content-center">

                                                    <div class="col-lg-6 col-12">
                                                        <label class="form-label">First Name</label>
                                                        <input type="text" id="fname" class="form-control" />
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <label class="form-label">Last Name</label>
                                                        <input type="text" id="lname" class="form-control" />
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <label class="form-label">Mobile</label>
                                                        <input type="text" id="mobile" class="form-control" />
                                                    </div>

                                                    <div class="col-lg-6 col-12">
                                                        <label class="form-label">Gender</label>
                                                        <select class="form-select" id="gender">
                                                            <?php

                                                            $gender_rs = Database::search("SELECT * FROM `gender` ORDER BY `id`");
                                                            $gender_count = $gender_rs->num_rows;

                                                            for ($x = 0; $x < $gender_count; $x++) {

                                                                $gender_data = $gender_rs->fetch_assoc();

                                                                ?>
                                                                <option value="<?php echo ($gender_data["id"]); ?>">
                                                                    <?php echo ($gender_data["gender"]); ?>
                                                                </option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" class="form-control" id="email" />
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">Password</label>
                                                        <div class="input-group mb-lg-2">
                                                            <input type="password" class="form-control shadow"
                                                                placeholder="Password" id="password"
                                                                value="<?php echo (uniqid("tec_")); ?>" />
                                                            <button class="btn btn-dark shadow" id="btn"
                                                                onclick="showPassword();"><i
                                                                    class="bi bi-eye-slash-fill"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label">Assign Grade</label>
                                                        <select class="form-select" id="grade" onchange="load_subject();">
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

                                                    <div class="col-12">
                                                        <label class="form-label">Assign Subject</label>
                                                        <div id="sub_area">
                                                            <select class="form-select disabled" disabled id="subject">
                                                                <option value="0">Select Grade First !!</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Alert -->
                                                    <section id="alertDiv"
                                                        class="col-11 mb-2 mt-2 px-3 rounded-2 bg-warning opacity-75 d-none">
                                                        <div class="row">
                                                            <div class="text-start mt-2 mb-2 col-10 px-2">
                                                                <span id="alert" class="fs-6 text-danger"></span>
                                                            </div>
                                                            <div class="text-end col-2 mt-1">
                                                                <span class="fs-5 cursorPointer" onclick="close_alert();"><i
                                                                        class="bi bi-x"></i></span>
                                                            </div>
                                                        </div>
                                                    </section>
                                                    <!-- Alert -->

                                                </div>
                                            </div>

                                            <div class="col-10 col-lg-6 d-grid p-2">
                                                <button class="btn btn-primary text-uppercase"
                                                    onclick="register_tec();">Register</button>
                                            </div>

                                        </div>
                                        <!-- Teacher -->

                                        <?php

                                    } else if (isset($_GET["academic_officer"])) {

                                        ?>
                                            <!-- Academic Officer -->
                                            <div class="row justify-content-center">

                                                <div class="col-12 text-center">
                                                    <label class="h3 fw-bold text-uppercase">Academic Officer</label>
                                                </div>

                                                <div class="col-12 p-2">
                                                    <div class="row g-2 justify-content-center">

                                                        <div class="col-lg-6 col-12">
                                                            <label class="form-label">First Name</label>
                                                            <input type="text" id="fname" class="form-control" />
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <label class="form-label">Last Name</label>
                                                            <input type="text" id="lname" class="form-control" />
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <label class="form-label">Mobile</label>
                                                            <input type="text" id="mobile" class="form-control" />
                                                        </div>

                                                        <div class="col-lg-6 col-12">
                                                            <label class="form-label">Gender</label>
                                                            <select class="form-select" id="gender">
                                                                <?php

                                                                $gender_rs = Database::search("SELECT * FROM `gender` ORDER BY `id`");
                                                                $gender_count = $gender_rs->num_rows;

                                                                for ($x = 0; $x < $gender_count; $x++) {

                                                                    $gender_data = $gender_rs->fetch_assoc();

                                                                    ?>
                                                                    <option value="<?php echo ($gender_data["id"]); ?>">
                                                                    <?php echo ($gender_data["gender"]); ?>
                                                                    </option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="form-label">Email</label>
                                                            <input type="text" class="form-control" id="email" />
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Password</label>
                                                            <div class="input-group mb-lg-2">
                                                                <input type="password" class="form-control shadow"
                                                                    placeholder="Password" id="password"
                                                                    value="<?php echo (uniqid("ao_")); ?>" />
                                                                <button class="btn btn-dark shadow" id="btn"
                                                                    onclick="showPassword();"><i
                                                                        class="bi bi-eye-slash-fill"></i></button>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="form-label">Assign Grades</label>
                                                            <div class="row p-3">
                                                                <div class="col-12 border rounded-3 p-3 ps-4 pt-4">
                                                                    <div class="row justify-content-center">
                                                                        <?php

                                                                        $grade_rs = Database::search("SELECT * FROM `grade` ORDER BY `id` ASC");
                                                                        $grade_count = $grade_rs->num_rows;

                                                                        for ($x = 0; $x < $grade_count; $x++) {

                                                                            $grade_data = $grade_rs->fetch_assoc();

                                                                            ?>
                                                                            <div class="col-6 col-lg-4">
                                                                                <input class="form-check-inline"
                                                                                    id="grade<?php echo ($x); ?>" type="checkbox"
                                                                                    value="<?php echo ($grade_data["id"]); ?>" />
                                                                                <label class="form-label">
                                                                                <?php echo ($grade_data["grade"]); ?>
                                                                                </label>
                                                                            </div>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Alert -->
                                                        <section id="alertDiv"
                                                            class="col-11 mb-2 mt-2 px-3 rounded-2 bg-warning opacity-75 d-none">
                                                            <div class="row">
                                                                <div class="text-start mt-2 mb-2 px-2 col-10">
                                                                    <span id="alert" class="fs-6 text-danger"></span>
                                                                </div>
                                                                <div class="text-end col-2 mt-1">
                                                                    <span class="fs-5 cursorPointer" onclick="close_alert();"><i
                                                                            class="bi bi-x"></i></span>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <!-- Alert -->

                                                    </div>
                                                </div>

                                                <div class="col-10 col-lg-6 d-grid p-2">
                                                    <button class="btn btn-primary text-uppercase"
                                                        onclick="register_ao(<?php echo ($grade_count); ?>);">Register</button>
                                                </div>

                                            </div>
                                            <!-- Academic Officer -->
                                        <?php

                                    } else {

                                        ?>
                                            <!-- Dafault -->
                                            <div class="row">
                                                <div class="col-12 py-lg-4">
                                                    <div class="row justify-content-center align-content-center">
                                                        <div class="col-lg-8 col-12 mt-3">
                                                            <!-- <img src="teacher_password/slider/img (1).jpg" class="img-fluid rounded-2"/> -->
                                                            <div class="header-logo"
                                                                style="max-height: 400px; min-height: 225px; height: auto;"></div>
                                                        </div>
                                                        <div class="col-lg-10 col-12 text-center">
                                                            <span class="fs-4 text-black">
                                                                SJ ACADEMY
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-10 col-12 text-center">
                                                            <span class="fs-5 text-black-50">
                                                                Welcome to Registration of Administation
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Dafault -->
                                        <?php

                                    }

                                    ?>

                                </div>

                                <div class="col-12 col-lg-6 text-uppercase fs-5 mb-3">
                                    <div class="row justify-content-center">
                                        <?php
                                        if (!isset($_GET["teacher"]) && !isset($_GET["academic_officer"])) {
                                            ?>
                                            <div class="col-12 col-lg-10 text-center mb-3">
                                                <span class="fs-5">Select the role you want to Assign from below</span>
                                            </div>
                                            <div class="col-lg-6 col-10 p-2 d-grid">
                                                <a class="nav-link btn btn-warning opacity-75 fw-bold py-2"
                                                    href="register.php?teacher">Teacher</a>
                                            </div>
                                            <div class="col-10 col-lg-6 p-2 d-grid">
                                                <a class="nav-link btn btn-warning opacity-75 py-2 fw-bold"
                                                    href="register.php?academic_officer">Academic Officer</a>
                                            </div>

                                            <?php
                                        } else {
                                            ?>
                                            <div class="col-6 p-2 d-grid">
                                                <a class="nav-link btn btn-warning opacity-75 py-2 fw-bold"
                                                    href="register.php">Back</a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </article>

                <?php

            } else if (isset($_SESSION["academic_officer"])) {

                ?>

                    <article class="col-12 p-3">
                        <div class="row justify-content-center align-items-center align-content-center">

                            <div class="col-12 text-center text-uppercase mt-3 mb-3">
                                <h2 class="fw-bold text-primary">Registration</h2>
                            </div>

                            <div class="col-12 py-2 shadow rounded-2">
                                <div class="row justify-content-center align-items-center g-2">

                                    <div class="col-12 p-lg-3 p-2">

                                        <?php

                                        if (isset($_GET["student"])) {

                                            ?>

                                            <!-- Student -->
                                            <div class="row justify-content-center">

                                                <div class="col-12 text-center">
                                                    <label class="h3 fw-bold text-uppercase">Student</label>
                                                </div>

                                                <div class="col-12 p-2">
                                                    <div class="row g-2 justify-content-center">

                                                        <div class="col-lg-6 col-12">
                                                            <label class="form-label">First Name</label>
                                                            <input type="text" id="fname" class="form-control" />
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <label class="form-label">Last Name</label>
                                                            <input type="text" id="lname" class="form-control" />
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="form-label">Mobile</label>
                                                            <input type="text" id="mobile" class="form-control" />
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <label class="form-label">Index No</label>
                                                            <input type="text" id="index" class="form-control" />
                                                        </div>

                                                        <div class="col-lg-6 col-12">
                                                            <label class="form-label">Gender</label>
                                                            <select class="form-select" id="gender">
                                                                <?php

                                                                $gender_rs = Database::search("SELECT * FROM `gender` ORDER BY `id`");
                                                                $gender_count = $gender_rs->num_rows;

                                                                for ($x = 0; $x < $gender_count; $x++) {

                                                                    $gender_data = $gender_rs->fetch_assoc();

                                                                    ?>
                                                                    <option value="<?php echo ($gender_data["id"]); ?>">
                                                                    <?php echo ($gender_data["gender"]); ?>
                                                                    </option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="form-label">Email</label>
                                                            <input type="text" id="email" class="form-control" />
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Password</label>
                                                            <div class="input-group mb-lg-2">
                                                                <input type="password" class="form-control shadow"
                                                                    placeholder="Password" id="password"
                                                                    value="<?php echo (uniqid("st_")); ?>" />
                                                                <button class="btn btn-dark shadow" id="btn"
                                                                    onclick="showPassword();"><i
                                                                        class="bi bi-eye-slash-fill"></i></button>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Assign Grade</label>
                                                            <select class="form-select" id="grade" onchange="load_subject();">
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

                                                        <!-- Alert -->
                                                        <section id="alertDiv"
                                                            class="col-11 mb-2 mt-2 px-3 rounded-2 bg-warning opacity-75 d-none">
                                                            <div class="row">
                                                                <div class="text-start mt-2 mb-2 px-2 col-10">
                                                                    <span id="alert" class="fs-6 text-danger"></span>
                                                                </div>
                                                                <div class="text-end col-2 mt-1">
                                                                    <span class="fs-5 cursorPointer" onclick="close_alert();"><i
                                                                            class="bi bi-x"></i></span>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <!-- Alert -->

                                                    </div>
                                                </div>

                                                <div class="col-10 col-lg-6 d-grid p-2">
                                                    <button class="btn btn-primary text-uppercase"
                                                        onclick="register_st();">Register</button>
                                                </div>

                                            </div>
                                            <!-- Student -->

                                        <?php

                                        } else {

                                            ?>

                                            <!-- Dafault -->
                                            <div class="row">
                                                <div class="col-12 py-lg-4">
                                                    <div class="row justify-content-center align-content-center">
                                                        <div class="col-lg-8 col-12 mt-3">
                                                            <!-- <img src="assets/slider/img (1).jpg" class="img-fluid rounded-2"/> -->
                                                            <div class="header-logo"
                                                                style="max-height: 400px; min-height: 225px; height: auto;"></div>
                                                        </div>
                                                        <div class="col-lg-10 col-12 text-center">
                                                            <span class="fs-4 text-black">
                                                                SJ ACADEMY
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-10 col-12 text-center">
                                                            <span class="fs-5 text-black-50">
                                                                Welcome to Registration of Administation
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Dafault -->
                                        <?php

                                        }

                                        ?>

                                    </div>

                                    <div class="col-12 col-lg-6 text-uppercase fs-5 mb-3">
                                        <div class="row justify-content-center">
                                            <?php
                                            if (!isset($_GET["student"])) {
                                                ?>
                                                <div class="col-12 col-lg-10 text-center mb-3">
                                                    <span class="fs-5">Press Student to Register new Students</span>
                                                </div>
                                                <div class="col-lg-6 col-10 p-2 d-grid">
                                                    <a class="nav-link btn btn-warning opacity-75 fw-bold py-2"
                                                        href="register.php?student">Student</a>
                                                </div>
                                            <?php
                                            } else {
                                                ?>
                                                <div class="col-6 p-2 d-grid">
                                                    <a class="nav-link btn btn-warning opacity-75 py-2 fw-bold"
                                                        href="register.php">Back</a>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </article>

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

            <footer class="col-12 header-bg p-3 sticky-bottom">
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