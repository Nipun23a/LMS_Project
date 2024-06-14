<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Horizon LMS</title>

    <link rel="stylesheet" href="src/css/style.css" />
    <link rel="stylesheet" href="src/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="shortcut icon" href="assets/logo/HS-Black.png" type="image/x-icon" />
</head>

<?php

session_start();

$email = "";
$password = "";
$remember = "";

if (isset($_GET["student"])) {
    $user = "student"; // student
} else if (isset($_GET["teacher"])) {
    $user = "teacher"; // teacher
} else if (isset($_GET["academic_officer"])) {
    $user = "academic_officer"; // academic officer
} else if (isset($_GET["admin"])) {
    $user = "admin"; // admin
} else {
    header("Location:home.php");
}

if (isset($_SESSION[$user])) {
    header("Location:home.php");
}

if (isset($_COOKIE[$user . "email"])) {
    $email = $_COOKIE[$user . "email"];
    $remember = "true";
}
if (isset($_COOKIE[$user . "password"])) {
    $password = $_COOKIE[$user . "password"];
}

?>

<body class="body index" onload="index();">

    <div class="w-100 vh-100 d-flex">
        <div class="row g-0 align-items-center">

            <!-- Login -->
            <div class="col-12 col-lg-6 p-lg-5 p-3 pt-1 login">
                <div class="row justify-content-center">

                    <!-- Header -->
                    <header class="col-12 col-lg-6 fixed-top mt-lg-1 d-none d-lg-grid">
                        <div class="side-logo"></div>
                    </header>
                    <header class="col-12 offset-lg-6 col-lg-6 fixed-top mt-lg-1">
                        <div class="logo"></div>
                    </header>
                    <!-- Header -->

                    <!-- Content -->

                    <article class="col-12 p-2 ps-3 mt-5 pt-5 pt-lg-3">
                        <div class="row align-items-center justify-content-center">

                            <!-- Title -->
                            <section class="col-12 mb-2">
                                <span class="fs-2 text-black-50">
                                    <?php echo (isset($_GET['admin']) ? "Admin" : (isset($_GET["teacher"]) ? "Teacher" : (isset($_GET["academic_officer"]) ? "Adademic Officer" : "Student"))) ?>
                                    Login
                                </span>
                            </section>
                            <!-- Title -->

                            <!-- Description -->
                            <section class="col-12 mb-lg-4 mb-2">
                                <span class="text-black-50 fs-7">
                                    The SJ ACADEMY Student Management System is developed for avoid the distruptions of
                                    pandemic
                                    situations on the education field and to continue education under any condition or
                                    circumstance.
                                </span>
                            </section>
                            <!-- Description -->

                            <?php
                            if (!isset($_GET['admin'])) {
                                ?>
                                <!-- Feilds -->
                                <section class="col-12 mt-lg-3 mt-2 mb-lg-2 pe-3">
                                    <div class="row g-3">

                                        <div class="col-12 mb-lg-2">
                                            <input type="text" class="form-control shadow" placeholder="Email (Username)"
                                                id="username" value="<?php echo ($email); ?>" />
                                        </div>
                                        <div class="col-12 input-group mb-lg-2">
                                            <input type="password" class="form-control shadow" placeholder="Password"
                                                id="password" value="<?php echo ($password); ?>" />
                                            <button class="btn btn-dark shadow" id="btn" onclick="showPassword();"><i
                                                    class="bi bi-eye-slash-fill"></i></button>
                                        </div>

                                        <div class="col-6 ps-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember" <?php if ($remember == "true") {
                                                    ?> checked <?php
                                                } ?> />
                                                <label class="form-check-label text-black-50">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end pe-2 pt-lg-1">
                                            <a href="#" class="link-danger fw-bold text-decoration-none"
                                                onclick="forgotPass('<?php echo ($user); ?>');">Forgot Password?</a>
                                        </div>

                                    </div>
                                </section>
                                <!-- Feilds -->

                                <!-- Alert -->
                                <section id="alertDiv" class="col-11 mb-2 mt-2 px-2 rounded-2 bg-warning opacity-75 d-none">
                                    <div class="row">
                                        <div class="text-start mt-2 mb-2 col-10">
                                            <span id="alert" class="fs-6 text-danger"></span>
                                        </div>
                                        <div class="text-end col-2 mt-1">
                                            <span class="fs-5 cursorPointer" id="close"><i class="bi bi-x"></i></span>
                                        </div>
                                    </div>
                                </section>
                                <!-- Alert -->

                                <!-- Nav -->
                                <nav class="col-12 mt-3 mb-lg-4 mb-3 pe-3">
                                    <div class="row g-2 justify-content-center">

                                        <div class="col-12 col-lg-9 d-grid mb-3">
                                            <button class="btn btn-primary fs-5"
                                                onclick="sign_in('<?php echo ($user); ?>');">Log In</button>
                                        </div>

                                        <?php
                                        if (isset($_GET["student"])) {
                                            ?>

                                            <!-- Student -->
                                            <section class="col-12">
                                                <a class="fs-6 link-dark" href="index.php?teacher">Not a Student?</a>
                                            </section>
                                        </div>
                                    </nav>
                                    <!-- Nav -->
                                    <!-- Student -->

                                    <?php
                                        } else if (isset($_GET["teacher"])) {
                                            ?>

                                        <!-- Teacher -->
                                        <div class="col-4 d-grid">
                                            <a href="index.php?student">Student?</a>
                                        </div>
                                        <div class="col-4 d-grid text-center">
                                            <a href="index.php?academic_officer" class="link-dark">Academic Officer</a>
                                            <!-- <button class="btn btn-success" onclick="window.location='index.php?academic'">Academic Officer</button> -->
                                        </div>
                                        <div class="col-4 d-grid text-end">
                                            <a href="index.php?admin" class="link-danger">Admin</a>
                                            <!-- <button class="btn btn-success" onclick="window.location='index.php?admin'">Admin</button> -->
                                        </div>

                                    </div>
                                    </nav>
                                    <!-- Nav -->
                                    <!-- Teacher -->

                                <?php
                                        } else if (isset($_GET["academic_officer"])) {
                                            ?>

                                        <!-- Academic Officer -->
                                        <div class="col-4 d-grid">
                                            <a href="index.php?student">Student?</a>
                                        </div>
                                        <div class="col-4 d-grid text-center">
                                            <a href="index.php?teacher" class="link-dark">Teacher</a>
                                            <!-- <button class="btn btn-success" onclick="window.location='index.php?teacher'">Academic Officer</button> -->
                                        </div>
                                        <div class="col-4 d-grid text-end">
                                            <a href="index.php?admin" class="link-danger">Admin</a>
                                            <!-- <button class="btn btn-success" onclick="window.location='index.php?admin'">Admin</button> -->
                                        </div>

                                </div>
                                </nav>
                                <!-- Nav -->
                                <!-- Academic Officer -->

                        <?php
                                        }
                            } else if (isset($_GET["admin"])) {
                                ?>

                        <!-- Admin -->
                        <!-- Feilds -->
                        <section class="col-12 mt-lg-3 mt-2 mb-lg-2 pe-3">
                            <div class="row g-3">

                                <div class="col-12" id="field_box">
                                    <div class="row">
                                        <div class="col-12 mb-lg-2 mb-1">
                                            <input type="text" class="form-control shadow" placeholder="Email (Username)"
                                                id="username" value="<?php echo ($email); ?>" />
                                        </div>
                                        <div class="col-12 input-group mb-lg-2">
                                            <input type="password" class="form-control shadow" placeholder="Password"
                                                id="password" value="<?php echo ($password); ?>" />
                                            <button class="btn btn-dark shadow" id="btn" onclick="showPassword();"><i
                                                    class="bi bi-eye-slash-fill"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-3 d-none" id="vcode_box">
                                    <label class="form-label text-black-50">Verification Code</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control w-75" id="ad_vcode" disabled />
                                        <button class="btn btn-primary w-25" type="button" id="re_send_btn"
                                            disabled>ReSend</button>
                                    </div>
                                </div>

                                <div class="col-6 ps-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" <?php if ($remember == "true") {
                                            ?> checked <?php
                                        } ?> />
                                        <label class="form-check-label text-black-50">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-6 text-end pe-2 pt-lg-1">
                                    <a href="#" class="link-danger fw-bold text-decoration-none"
                                        onclick="forgotPass('<?php echo ($user); ?>');">Forgot Password?</a>
                                </div>

                            </div>
                        </section>
                        <!-- Feilds -->

                        <!-- Alert -->
                        <section id="alertDiv" class="col-11 mb-2 mt-2 px-2 rounded-2 bg-warning opacity-75 d-none">
                            <div class="row">
                                <div class="text-start mt-2 mb-2 col-10">
                                    <span id="ad_alert" class="fs-6 text-danger"></span>
                                </div>
                                <div class="text-end col-2 mt-1">
                                    <span class="fs-5 cursorPointer" id="close"><i class="bi bi-x"></i></span>
                                </div>
                            </div>
                        </section>
                        <!-- Alert -->

                        <!-- Nav -->
                        <nav class="col-12 mt-3 mb-lg-4 mb-3 pe-3">
                            <div class="row g-2 justify-content-center">

                                <div class="col-12 col-lg-9 d-grid mb-3">
                                    <button class="btn btn-primary fs-5 d-none" id="ad_log_in">Log In</button>
                                    <button class="btn btn-primary fs-5" id="send_btn" onclick="sendVerification();">Send
                                        Verification Code</button>
                                </div>

                                <div class="col-4 d-grid">
                                    <a href="index.php?student">Student?</a>
                                </div>
                                <div class="col-4 d-grid text-center">
                                    <a href="index.php?academic_officer" class="link-dark">Academic Officer</a>
                                    <!-- <button class="btn btn-success" onclick="window.location='index.php?academic_officer'">Academic Officer</button> -->
                                </div>
                                <div class="col-4 d-grid text-end">
                                    <a href="index.php?teacher" class="link-danger">Teacher</a>
                                    <!-- <button class="btn btn-success" onclick="window.location='index.php?teacher'">Admin</button> -->
                                </div>

                            </div>
                        </nav>
                        <!-- Nav -->
                        <!-- Admin -->

                    <?php
                            }
                            ?>
            </div>
            </article>
            <!-- Content -->

            <!-- Footer -->
            <footer class="offset-lg-6 col-lg-6 col-12 fixed-bottom d-none d-lg-block text-center mb-2">
                <span class="fs-6 text-black-50">
                    2024 &copy; SJ ACADEMY | Developed by Shanu Jayasinghe &trade;
                </span>
            </footer>
            <!-- Footer -->

        </div>
    </div>
    <!-- Login -->

    <!-- Cover -->
    <aside class="col-lg-6 d-none d-lg-block cover">
        <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/slider/img (1).jpg" class="d-block w-100 slider_img" />
                </div>
                <div class="carousel-item">
                    <img src="assets/slider/img (2).jpg" class="d-block w-100 slider_img" />
                </div>
                <div class="carousel-item">
                    <img src="assets/slider/img (3).jpg" class="d-block w-100 slider_img" />
                </div>
                <div class="carousel-item">
                    <img src="assets/slider/img (4).jpg" class="d-block w-100 slider_img" />
                </div>
            </div>
        </div>
    </aside>
    <!-- Cover -->

    <!-- Forgot Password Modal -->
    <div class="modal" tabindex="-1" id="forgotPasswordModal">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content"
                style="background-image: linear-gradient(90deg, hsl(140, 60%, 75%) 100%, hsl(222, 70%, 75%) 0%);">
                <div class="modal-header shadow px-3">
                    <h5 class="modal-title text-uppercase text-primary fs-3">Reset
                        <?php echo (isset($_GET['admin']) ? "Admin Log" : (isset($_GET["teacher"]) ? "Teacher Log" : (isset($_GET["academic_officer"]) ? "Adademic Officer Log" : "Student Sign"))); ?>
                        In Password
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-3 pt-5 mb-3 pe-5">

                    <div class="row g-3 text-white justify-content-center pt-3 pe-4 ps-3">

                        <!-- alert box -->
                        <div class="col-12 col-lg-8 px-2 py-2 d-none rounded rounded-4" id="alertDiv2">
                            <div class="bg-warning text-center text-danger fs-5 rounded rounded-2" id="msgDiv2">
                            </div>
                        </div>
                        <!-- alert box -->

                        <div class="col-lg-6 col-12">
                            <label class="form-label">New Passwod</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="unpi" />
                                <button class="btn btn-danger" type="button" id="unpb" onclick="showPassN();"><i
                                        class="bi bi-eye-slash-fill"></i></button>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <label class="form-label">Re-type Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="urnpi" onkeyup="checkPass();" />
                                <button class="btn btn-danger" type="button" id="urnpb" onclick="showPassR();"><i
                                        class="bi bi-eye-slash-fill"></i></button>
                            </div>
                        </div>

                        <!-- password box -->
                        <div class="col-12 col-lg-8 px-2 py-2 d-none rounded rounded-4" id="alertBox">
                            <div class="text-center text-warning fs-5 rounded rounded-2" id="msgBox">
                                <span class="text danger">Fill Password Fields</span>
                            </div>
                        </div>
                        <!-- password box -->

                        <div class="col-12">
                            <label class="form-label">Verification Code</label>
                            <input type="text" class="form-control" id="fvcode" />
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"
                        onclick="resetPassword('<?php echo ($user); ?>');">Reset Password</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Forgot Password Modal -->

    <!-- Verify Modal -->
    <div class="modal" tabindex="-1" id="verifyModal">
        <div class="modal-dialog text-dark">
            <div class="modal-content" style="background-color: hsl(212, 50%, 75%);">
                <div class="modal-header shadow px-3">
                    <h5 class="modal-title text-uppercase text-primary fs-3">
                        <?php echo (isset($_GET["teacher"]) ? "Teacher" : (isset($_GET["academic_officer"]) ? "Adademic Officer" : "Student")); ?>
                        Verification
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-5">

                    <div class="row g-3 text-white justify-content-center pt-3">

                        <!-- alert box -->
                        <div class="col-11 col-lg-9 ps-3 pe-2 py-2 d-none bg-warning text-dark rounded-4 opacity-75"
                            id="v_alertDiv">
                            <div class="row justify-content-center">
                                <div class="col-10 fs-6 px-3 mt-2 rounded-2" id="v_msgDiv">
                                </div>
                                <div class="text-end col-2 col-lg-1">
                                    <span class="fs-5 cursorPointer" id="v_close"><i class="bi bi-x"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- alert box -->

                        <!-- Field -->
                        <div class="col-12 text-center text-lg-start">

                            <!-- Label -->
                            <?php
                            if (isset($_GET["student"])) {
                                ?>
                                <label class="fs-6 form-label">Enter your verification code received to your email
                                    via the Academic Officer</label>
                                <!-- <label class="form-label">Student Verification Code</label> -->
                                <?php
                            } else {
                                ?>
                                <label class="form-label">
                                    <?php echo (isset($_GET["teacher"]) ? "Teacher" : "Adademic Officer"); ?>Verification
                                    Code
                                </label>
                                <?php
                            }
                            ?>
                            <!-- Label -->

                            <input type="text" class="form-control mt-2" id="vcode"
                                placeholder="Enter the Verification Code" />
                        </div>
                        <!-- Field -->

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"
                        onclick="verify('<?php echo ($user); ?>');">Verify</button>
                    <button type="button" class="btn btn-danger" onclick="request('<?php echo ($user); ?>');">Request New
                        Code</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Verify Modal -->

    </div>
    </div>

    <script src="src/js/script.js"></script>
    <script src="src/js/bootstrap.js"></script>
    <script src="src/js/bootstrap.bundle.js"></script>
</body>

</html>