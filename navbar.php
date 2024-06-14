<!-- Navbar -->
<nav class="navbar row" style="background-color: transparent;">
    <div class="container-fluid">
        <div class="col-6 col-lg-1">
            <button class="navbar-toggler btn-dark" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="col-lg-9 d-none d-lg-block">
            <div class="row">
                <div class="col-11">
                    <div class="header-logo mb-1"></div>
                </div>
            </div>
        </div>

        <div class="offcanvas text-uppercase offcanvas-start" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">

            <div class="offcanvas-header bg-dark">
                <?php
                if (isset($user)) {

                    $name = $user["fname"] . " " . $user["lname"];
                    $email = $user["email"];

                    ?>
                    <h5 class="offcanvas-title text-info" id="offcanvasNavbarLabel">
                        <?php echo ($name); ?>
                    </h5>
                    <h6 class="offcanvas-title text-primary">
                        <?php echo ($type); ?>
                    </h6>
                    <?php

                } else {

                    ?>
                    <h5 class="offcanvas-title text-info" id="offcanvasNavbarLabel">SJ ACADEMY LMS</h5>
                    <h6 class="offcanvas-title text-primary">
                        <?php echo ($type); ?>
                    </h6>
                    <?php

                }

                ?>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body bg-dark">

                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item"><a class="nav-link  text-white" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="notes.php">Notes</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="assignments.php">Assignments</a></li>

                    <?php
                    if (isset($_SESSION["academic_officer"]) || isset($_SESSION["admin"])) {
                        ?>

                        <li class="nav-item mt-3"><a class="nav-link text-white" href="register.php">Register</a></li>

                        <?php
                    }

                    if (isset($_SESSION["admin"])) {
                        ?>

                        <li class="nav-item"><a class="nav-link text-white" href="adminPanel.php">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="results.php">Results</a></li>
                        <li class="nav-item mt-1 dropdown">
                            <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Manage
                            </a>
                            <ul class="dropdown-menu-dark border border-white rounded">
                                <li><a class="nav-link dropdown-item text-white" href="manageTeachers.php">Teachers</a>
                                </li>
                                <li><a class="nav-link dropdown-item text-white" href="manageStudents.php">Students</a>
                                </li>
                                <li><a class="nav-link dropdown-item text-white" href="manageAcademics.php">Academic
                                        Officers</a></li>
                            </ul>
                        </li>

                        <?php
                    }
                    ?>

                    <?php
                    if (isset($user)) {
                        ?>

                        <li class="p-1 mt-3 nav-item text-center"><span class="fw-bold btn fs-5 mt-1 mb-1 text-warning"
                                onclick="sign_out();">Sign Out</span></li>

                        <?php
                    } else {
                        ?>

                        <li class="p-1 mt-3 nav-item text-center"><span class="fw-bold btn fs-5 mt-1 mb-1 text-warning"
                                onclick="log_in();">Sign In</span></li>

                        <?php
                    }
                    ?>
                </ul>

            </div>
        </div>
        <!-- Offcanvas -->
    </div>
</nav>
<!-- Navbar -->