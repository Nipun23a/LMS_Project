<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php

require "modules/db/connection.php";

session_start();

if (isset($_SESSION["student"])) {
    $user = $_SESSION["student"];
    $type = "Student";
    $table = "student";
} else if (isset($_SESSION["teacher"])) {
    $user = $_SESSION["teacher"];
    $type = "Teacher";
    $table = "teacher";
} else if (isset($_SESSION["academic_officer"])) {
    $user = $_SESSION["academic_officer"];
    $type = "Academic Officer";
    $table = "academic_officer";
} else if (isset($_SESSION["admin"])) {
    $user = $_SESSION["admin"];
    $type = "Admin";
    $table = "admin";
} else {
    $type = "Guest";
}

$path = "assets/profile_pic/avatar.svg";

?>

<body>

    <!-- Header -->
    <header class="col-12 text-white bg-transparent header-bg">
        <div class="row g-1 align-items-center justify-content-center align-content-center">

            <div class="col-lg-10 col-4">
                <!-- Navbar -->
                <?php include "navbar.php"; ?>
                <!-- Navbar -->
            </div>

            <div class="col-4 d-lg-none">
                <div class="header-logo"></div>
            </div>

            <div class="offset-lg-0 col-4 col-lg-2 px-2">
                <div class="row align-items-center">

                    <?php

                    if (isset($user)) {

                        ?>

                        <div class="col-12">
                            <div class="dropdown d-grid">
                                <a class="btn dropdown-toggle border-0" type="button" data-bs-toggle="dropdown">
                                    <img src="<?php echo ($path); ?>" class="rounded-circle"
                                        style="height: 50px; width: 50%;">
                                </a>
                                <ul
                                    class="dropdown-menu shadow w-100 dropdown-menu-lg-end dropdown-menu-start header-dropdown">
                                    <li class="mt-1 p-2 text-center text-white">
                                        <span class="fs-5">
                                            <?php echo ($name); ?>
                                        </span>
                                        <br />
                                        <span class="fs-6 text-black fw-bold">
                                            <?php echo ($type); ?>
                                        </span>
                                    </li>
                                    <li class="mt-1">
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li class="mt-1"><a class="dropdown-item fw-bold text-dark" href="#"
                                            onclick="viewProfile();">Profile</a></li>
                                    <li class="mt-1">
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li class="p-1 text-center"><span
                                            class="fw-bold btn fs-5 dropdown-item mt-1 mb-1 text-warning"
                                            onclick="sign_out();">Sign Out</span></li>
                                </ul>
                            </div>
                        </div>

                        <?php

                    } else {

                        ?>
                        <span class="fw-bold cursor-pointer btn btn-outline-warning text-uppercase" onclick="log_in();">Sign
                            In</span>
                        <?php

                    }

                    ?>

                </div>
            </div>

        </div>
    </header>
    <!-- Header -->

</body>

</html>