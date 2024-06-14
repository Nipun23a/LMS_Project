<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile</title>

    <link rel="stylesheet" href="src/css/style.css" />
    <link rel="stylesheet" href="src/css/bootstrap.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/src/js/bootstrap-icons@1.9.1/font/src/js/bootstrap-icons.css" />

    <link rel="shortcut icon" href="assets/logo/HS-Black.png" type="image/x-icon" />
</head>

<body>

    <div class="container-fluid d-flex flex-column header-bg">
        <div class="row justify-content-center">

            <?php

            include "header.php";

            if ($type != "Guest") {

                $result = Database::search("SELECT * FROM `" . $table . "` INNER JOIN `gender` ON `" . $table . "`.`gender_id`=`gender`.`id` WHERE `email`='" . $email . "'");
                $count = $result->num_rows;

                if ($count == 1) {

                    $data = $result->fetch_assoc();

                    ?>

                    <div class="col-12 p-lg-4 p-2">
                        <div class="row align-items-center mx-auto my-auto">
                            <div class="col-12 bg-body rounded-2 p-3 pe-lg-4">
                                <!-- <div class="row align-items-center justify-content-center"> -->
                                <div class="row justify-content-center">

                                    <!-- Panel -->
                                    <div class="col-12 col-lg-4 border rounded-3">
                                        <!-- <div class="row justify-content-center"> -->
                                        <div class="row align-items-center justify-content-center">

                                            <div class="col-lg-10 col-sm-10 col-md-7 p-3 mt-3 mb-2 px-5">
                                                <img src="assets/profile_pic/avatar.svg" class="img-fluid rounded-circle" />
                                            </div>

                                            <div class="col-12 text-center mb-3">
                                                <span class="fs-3 fw-bold text-black">
                                                    <?php echo ($name); ?>
                                                </span>
                                                <br />
                                                <span class="fs-4 fw-bold text-black-50">[
                                                    <?php echo ($type); ?> ]
                                                </span>
                                            </div>

                                            <div class="text-start col-12 px-4 mt-1 mb-3 rounded-5">
                                                <div class="py-1 px-2 text-black border-bottom rounded-3">
                                                    <i class="bi bi-envelope"></i>&nbsp;&nbsp;&nbsp;<span class="fs-6">
                                                        <?php echo ($email); ?>
                                                    </span>
                                                </div>
                                                <div class="py-1 px-2 text-black border-bottom rounded-3">
                                                    <i class="bi bi-phone"></i>&nbsp;&nbsp;&nbsp;<span class="fs-6">
                                                        <?php echo ($data["mobile"]); ?>
                                                    </span>
                                                </div>

                                                <?php

                                                if (isset($_SESSION["student"])) {

                                                    ?>

                                                    <div class="py-1 px-2 text-black border-bottom rounded-3">
                                                        <i class="bi bi-key"></i>&nbsp;&nbsp;&nbsp;<span class="fs-6">
                                                            <?php echo ($user["index_no"]); ?>
                                                        </span>
                                                    </div>

                                                    <?php

                                                }

                                                ?>

                                            </div>

                                        </div>
                                    </div>
                                    <!-- Panel -->

                                    <!-- Content -->
                                    <div class="col-12 col-lg-8 border-start shadow rounded-4 p-4">
                                        <div class="row align-items-center">

                                            <div class="col-12">
                                                <div class="row g-0 align-content-center">

                                                    <!-- Navigations -->
                                                    <nav class="col-12">
                                                        <div class="nav nav-tabs d-lg-inline-flex flex-lg-row flex-column d-grid"
                                                            id="nav-tab" role="tablist">
                                                            <button class="nav-link bg-primary bg-opacity-50" id="nav-home-tab"
                                                                data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
                                                                role="tab" aria-controls="nav-home"
                                                                aria-selected="false">Personal Information</button>
                                                            <button class="nav-link bg-info" id="nav-contact-tab"
                                                                data-bs-toggle="tab" data-bs-target="#nav-contact" type="button"
                                                                role="tab" aria-controls="nav-contact"
                                                                aria-selected="false">Contact Details</button>
                                                            <?php

                                                            if (isset($_SESSION["student"])) {
                                                                $guardian_rs = Database::search("SELECT * FROM `guardian` WHERE `id`='" . $user["guardian_id"] . "'");
                                                                $guardian_count = $guardian_rs->num_rows;
                                                            ?>
                                                                <button class="nav-link bg-warning" id="nav-profile-tab"
                                                                    data-bs-toggle="tab" data-bs-target="#nav-profile" type="button"
                                                                    role="tab" aria-controls="nav-profile"
                                                                    aria-selected="false">Enrollments</button>

                                                                <button class="nav-link bg-danger bg-opacity-50"
                                                                    id="nav-guardian-tab" data-bs-toggle="tab"
                                                                    data-bs-target="#nav-guardian" type="button" role="tab"
                                                                    aria-controls="nav-guardian" aria-selected="false">Guardian
                                                                    Details</button>
                                                            <?php
                                                            }
                                                            ?>
                                                            <button class="nav-link bg-warning bg-opacity-75" id="nav-lms-tab"
                                                                data-bs-toggle="tab" data-bs-target="#nav-lms" type="button"
                                                                role="tab" aria-controls="nav-lms" aria-selected="true">Other
                                                                Details</button>
                                                            <button class="nav-link active d-none" id="nav-disabled-tab"
                                                                data-bs-toggle="tab" data-bs-target="#nav-disabled"
                                                                type="button" role="tab" aria-controls="nav-disabled"
                                                                aria-selected="false" disabled>Default</button>
                                                        </div>
                                                    </nav>
                                                    <!-- Navigations -->

                                                    <!-- Related Contents -->
                                                    <div class="tab-content border rounded-bottom" id="nav-tabContent">

                                                        <!-- Personal Information -->
                                                        <div class="tab-pane fade p-lg-4 p-3" id="nav-home" role="tabpanel"
                                                            aria-labelledby="nav-home-tab" tabindex="0">
                                                            <div class="col-12">
                                                                <div class="row g-2">
                                                                    <div class="col-12 col-lg-6">
                                                                        <label class="form-label">First Name</label>
                                                                        <input type="text" class="form-control" id="fname"
                                                                            value="<?php echo ($data["fname"]); ?>" />
                                                                    </div>
                                                                    <div class="col-12 col-lg-6">
                                                                        <label class="form-label">Last Name</label>
                                                                        <input type="text" class="form-control" id="lname"
                                                                            value="<?php echo ($data["lname"]); ?>" />
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label class="form-label">Middle Name</label>
                                                                        <input type="text" class="form-control" id="mname"
                                                                            value="<?php echo ($data["mname"]); ?>" />
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label class="form-label">Surname</label>
                                                                        <input type="text" class="form-control" id="sname"
                                                                            value="<?php echo ($data["surname"]); ?>" />
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label class="form-label">Email</label>
                                                                        <input type="email" class="form-control disabled"
                                                                            id="umail" disabled
                                                                            value="<?php echo ($data["email"]); ?>" />
                                                                    </div>

                                                                    <?php

                                                                    if (isset($_SESSION["student"])) {

                                                                        ?>
                                                                        <div class="col-12">
                                                                            <label class="form-label">Index No</label>
                                                                            <input type="text" class="form-control disabled" id="id"
                                                                                disabled
                                                                                value="<?php echo ($data["index_no"]); ?>" />
                                                                        </div>
                                                                        <?php

                                                                    } else {

                                                                        ?>
                                                                        <div class="col-12">
                                                                            <label class="form-label">NIC</label>
                                                                            <input type="text" class="form-control" id="id"
                                                                                value="<?php echo ($data["nic"]); ?>" />
                                                                        </div>
                                                                        <?php

                                                                    }

                                                                    ?>
                                                                    <div class="col-12 col-lg-6">
                                                                        <label class="form-label">Birthday</label>
                                                                        <input type="date" class="form-control" id="bday"
                                                                            value="<?php echo ($data["birthday"]); ?>" />
                                                                    </div>
                                                                    <div class="col-12 col-lg-6">
                                                                        <label class="form-label">Gender</label>
                                                                        <input type="text" class="form-control disabled"
                                                                            id="gender" disabled
                                                                            value="<?php echo ($data["gender"]); ?>" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Personal Information -->

                                                        <?php

                                                        if (isset($_SESSION["student"])) {

                                                            $g_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $data["grade_id"] . "'");
                                                            $g_data = $g_rs->fetch_assoc();

                                                            $e_rs = Database::search("SELECT * FROM `student_has_gs` INNER JOIN `grade_has_subject` ON `student_has_gs`.`grade_has_subject_id`=`grade_has_subject`.`id` INNER JOIN `subject` ON `grade_has_subject`.`subject_id`=`subject`.`id` WHERE `student_email`='" . $data["email"] . "'");
                                                            $e_count = $e_rs->num_rows;

                                                            $enroll_rs = Database::search("SELECT * FROM `payment_status` WHERE `id`='" . $data["payment_status_id"] . "'");
                                                            $enroll_data = $enroll_rs->fetch_assoc();

                                                            if ($e_count > 0) {

                                                                ?>
                                                                <!-- Enrollments -->
                                                                <div class="tab-pane fade p-lg-4 p-3" id="nav-profile" role="tabpanel"
                                                                    aria-labelledby="nav-profile-tab" tabindex="0">
                                                                    <div class="col-12 py-lg-5">
                                                                        <div class="row g-2">
                                                                            <div class="col-12">
                                                                                <label class="form-label fs-4">Enrollments</label>
                                                                            </div>

                                                                            <div class="col-12 p-3">
                                                                                <input type="text"
                                                                                    class="form-control bg-primary bg-opacity-25 disabled"
                                                                                    disabled
                                                                                    value="<?php echo ($g_data["grade"]); ?>" />
                                                                                <ul
                                                                                    class="list-group border bg-warning bg-opacity-25 p-2">

                                                                                    <?php

                                                                                    for ($x = 0; $x < $e_count; $x++) {

                                                                                        $e_data = $e_rs->fetch_assoc();

                                                                                        ?>

                                                                                        <li class="list-group-item">
                                                                                            <?php echo ($e_data["name"]); ?>
                                                                                        </li>

                                                                                        <?php

                                                                                    }

                                                                                    $e_data = $e_rs->fetch_assoc();

                                                                                    ?>

                                                                                </ul>
                                                                            </div>
                                                                            <?php

                                                                            if ($data["payment_status_id"] == 1) {

                                                                                ?>
                                                                                <div class="col-4 col-lg-6 ps-5 fs-5">
                                                                                    <span>Enrollment Fee: Rs.
                                                                                        <?php echo ($g_data["fee"]); ?>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="col-lg-6 col-8 d-grid">
                                                                                    <button class="btn btn-danger"
                                                                                        onclick="payNow('<?php echo ($data['email']); ?>', '<?php echo ($g_data['id']); ?>', 'enrollment_fee')">Pay</button>
                                                                                </div>
                                                                                <?php

                                                                            } else if ($data["payment_status_id"] == 2) {

                                                                                ?>
                                                                                    <div class="col-lg-4 offset-lg-8 col-8 offset-4 d-grid">
                                                                                        <button class="btn btn-danger disabled"
                                                                                            disabled>Paid</button>
                                                                                    </div>
                                                                                <?php
                                                                            } else {
                                                                                echo ("Something went wrong");
                                                                            }

                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Enrollments -->

                                                                <?php

                                                            }

                                                            if ($guardian_count > 0) {

                                                                $guardian_data = $guardian_rs->fetch_assoc();

                                                                ?>
                                                                <!-- Guardian -->
                                                                <div class="tab-pane fade p-lg-4 p-3" id="nav-guardian" role="tabpanel"
                                                                    aria-labelledby="nav-guardian-tab" tabindex="0">
                                                                    <div class="col-12">
                                                                        <div class="row g-2">
                                                                            <div class="col-12 col-lg-6">
                                                                                <label class="form-label">First Name</label>
                                                                                <input type="text" id="gfname" class="form-control"
                                                                                    value="<?php echo ($guardian_data["fname"]); ?>" />
                                                                            </div>
                                                                            <div class="col-12 col-lg-6">
                                                                                <label class="form-label">Last Name</label>
                                                                                <input type="text" id="glname" class="form-control"
                                                                                    value="<?php echo ($guardian_data["lname"]); ?>" />
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <label class="form-label">Middle Name</label>
                                                                                <input type="text" id="gmname" class="form-control"
                                                                                    value="<?php echo ($guardian_data["mname"]); ?>" />
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <label class="form-label">Surname</label>
                                                                                <input type="text" id="gsname" class="form-control"
                                                                                    value="<?php echo ($guardian_data["surname"]); ?>" />
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <label class="form-label">Mobile Number</label>
                                                                                <input type="text" id="gmobile" class="form-control"
                                                                                    value="<?php echo ($guardian_data["mobile"]); ?>" />
                                                                            </div>
                                                                            <div class="col-12 col-lg-6">
                                                                                <label class="form-label">NIC</label>
                                                                                <input type="text" id="gnic" class="form-control"
                                                                                    value="<?php echo ($guardian_data["nic"]); ?>" />
                                                                            </div>
                                                                            <div class="col-12 col-lg-6">
                                                                                <label class="form-label">Relation</label>
                                                                                <select id="relation"
                                                                                    class="form-select <?php if (!isset($guardian_data["relationship_id"])) { ?>"
                                                                                    <?php } else { ?> disabled" disabled<?php } ?>>
                                                                                    <?php

                                                                                    $relation_rs = Database::search("SELECT * FROM `relationship` ORDER BY `relation`");
                                                                                    $relation_count = $relation_rs->num_rows;

                                                                                    for ($x = 0; $x < $relation_count; $x++) {

                                                                                        $relation_data = $relation_rs->fetch_assoc();

                                                                                        ?>
                                                                                        <option
                                                                                            value="<?php echo ($relation_data["id"]); ?>"
                                                                                            <?php if ($relation_data["id"] == $guardian_data["relationship_id"]) { ?> selected <?php } ?>>
                                                                                            <?php echo ($relation_data["relation"]); ?>
                                                                                        </option>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Guardian -->

                                                                <?php

                                                            } else {
                                                                ?>
                                                                                                <!-- Guardian -->
                                                                                                <div class="tab-pane fade p-lg-4 p-3" id="nav-guardian" role="tabpanel"
                                                                                                    aria-labelledby="nav-guardian-tab" tabindex="0">
                                                                                                    <div class="col-12">
                                                                                                        <div class="row g-2">
                                                                                                            <div class="col-12 col-lg-6">
                                                                                                                <label class="form-label">First Name</label>
                                                                                                                <input type="text" id="gfname" class="form-control" />
                                                                                                            </div>
                                                                                                            <div class="col-12 col-lg-6">
                                                                                                                <label class="form-label">Last Name</label>
                                                                                                                <input type="text" id="glname" class="form-control" />
                                                                                                            </div>
                                                                                                            <div class="col-12">
                                                                                                                <label class="form-label">Middle Name</label>
                                                                                                                <input type="text" id="gmname" class="form-control" />
                                                                                                            </div>
                                                                                                            <div class="col-12">
                                                                                                                <label class="form-label">Surname</label>
                                                                                                                <input type="text" id="gsname" class="form-control" />
                                                                                                            </div>
                                                                                                            <div class="col-12">
                                                                                                                <label class="form-label">Mobile Number</label>
                                                                                                                <input type="text" id="gmobile" class="form-control" />
                                                                                                            </div>
                                                                                                            <div class="col-12 col-lg-6">
                                                                                                                <label class="form-label">NIC</label>
                                                                                                                <input type="text" id="gnic" class="form-control" />
                                                                                                            </div>
                                                                                                            <div class="col-12 col-lg-6">
                                                                                                                <label class="form-label">Relation</label>
                                                                                                                <select id="relation" class="form-select">
                                                                                                                    <?php
                                                                                                                    $relation_rs = Database::search("SELECT * FROM `relationship` ORDER BY `relation`");
                                                                                                                    $relation_count = $relation_rs->num_rows;

                                                                                                                    for ($x = 0; $x < $relation_count; $x++) {

                                                                                                                        $relation_data = $relation_rs->fetch_assoc();

                                                                                                                        ?>
                                                                                                                                    <option value="<?php echo ($relation_data["id"]); ?>">
                                                                                                                                        <?php echo ($relation_data["relation"]); ?>
                                                                                                                                    </option>
                                                                                                                                    <?php
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!-- Guardian -->

                                                                                                <?php
                                                            }
                                                        }

                                                        ?>
                                                        <!-- Contact Details -->
                                                        <div class="tab-pane fade p-lg-4 p-3" id="nav-contact" role="tabpanel"
                                                            aria-labelledby="nav-contact-tab" tabindex="0">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <label class="form-label">Mobile Number</label>
                                                                        <input type="text" class="form-control" id="mobile"
                                                                            value="<?php echo ($data["mobile"]); ?>" />
                                                                    </div>
                                                                    <?php

                                                                    $col;
                                                                    if (isset($_SESSION["student"])) {
                                                                        $col = "student_";
                                                                    } else if (isset($_SESSION["teacher"])) {
                                                                        $col = "teacher_";
                                                                    } else if (isset($_SESSION["academic_officer"])) {
                                                                        $col = "academic_officer_";
                                                                    } else if (isset($_SESSION["admin"])) {
                                                                        $col = "admin_";
                                                                    }

                                                                    $address_rs = Database::search("SELECT * FROM `address` INNER JOIN `city` ON `address`.`city_id`=`city`.`c_id` INNER JOIN `district` ON `city`.`district_id`=`district`.`d_id` INNER JOIN `province` ON `district`.`province_id`=`province`.`p_id` INNER JOIN `country` ON `province`.`country_id`=`country`.`cid` WHERE `" . $col . "email" . "`='" . $email . "'");
                                                                    $address_count = $address_rs->num_rows;

                                                                    if ($address_count > 0) {

                                                                        $address_data = $address_rs->fetch_assoc();

                                                                        ?>
                                                                        <div class="col-12">
                                                                            <label class="form-label">Line 01</label>
                                                                            <input type="text" class="form-control" id="line1"
                                                                                value="<?php echo ($address_data["line1"]); ?>" />
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label class="form-label">Line 02</label>
                                                                            <input type="text" class="form-control" id="line2"
                                                                                value="<?php echo ($address_data["line2"]); ?>" />
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label class="form-label">Country</label>
                                                                            <select class="form-select" id="country">
                                                                                <?php
                                                                                $country_rs = Database::search("SELECT * FROM `country` ORDER BY `name`");
                                                                                $country_count = $country_rs->num_rows;

                                                                                for ($x = 0; $x < $country_count; $x++) {
                                                                                    $country_data = $country_rs->fetch_assoc();
                                                                                    ?>
                                                                                    <option
                                                                                        value="<?php echo ($country_data["cid"]); ?>"
                                                                                        <?php if ($country_data["cid"] == $address_data["cid"]) { ?> selected <?php } ?>>
                                                                                        <?php echo ($country_data["name"]); ?>
                                                                                    </option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label class="form-label">Province</label>
                                                                            <select class="form-select" id="province">
                                                                                <?php
                                                                                $province_rs = Database::search("SELECT * FROM `province` ORDER BY `pname`");
                                                                                $province_count = $province_rs->num_rows;

                                                                                for ($x = 0; $x < $province_count; $x++) {
                                                                                    $province_data = $province_rs->fetch_assoc();
                                                                                    ?>
                                                                                    <option
                                                                                        value="<?php echo ($province_data["p_id"]); ?>"
                                                                                        <?php if ($province_data["p_id"] == $address_data["p_id"]) { ?> selected <?php } ?>>
                                                                                        <?php echo ($province_data["pname"]); ?>
                                                                                    </option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label class="form-label">Distict</label>
                                                                            <select class="form-select" id="district">
                                                                                <?php
                                                                                $district_rs = Database::search("SELECT * FROM `district` ORDER BY `dname`");
                                                                                $district_count = $district_rs->num_rows;

                                                                                for ($x = 0; $x < $district_count; $x++) {
                                                                                    $district_data = $district_rs->fetch_assoc();
                                                                                    ?>
                                                                                    <option
                                                                                        value="<?php echo ($district_data["d_id"]); ?>"
                                                                                        <?php if ($district_data["d_id"] == $address_data["d_id"]) { ?> selected <?php } ?>>
                                                                                        <?php echo ($district_data["dname"]); ?>
                                                                                    </option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label class="form-label">City</label>
                                                                            <select class="form-select" id="city">
                                                                                <?php
                                                                                $city_rs = Database::search("SELECT * FROM `city` ORDER BY `cname`");
                                                                                $city_count = $city_rs->num_rows;

                                                                                for ($x = 0; $x < $city_count; $x++) {
                                                                                    $city_data = $city_rs->fetch_assoc();
                                                                                    ?>
                                                                                    <option value="<?php echo ($city_data["c_id"]); ?>"
                                                                                        <?php if ($city_data["c_id"] == $address_data["c_id"]) { ?>
                                                                                            selected <?php } ?>>
                                                                                        <?php echo ($city_data["cname"]); ?>
                                                                                    </option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label class="form-label">Postal Code</label>
                                                                            <input type="text" class="form-control" id="pcode"
                                                                                value="<?php echo ($address_data["postal_code"]); ?>" />
                                                                        </div>
                                                                        <?php

                                                                    } else {

                                                                        ?>
                                                                        <div class="col-12">
                                                                            <label class="form-label">Line 01</label>
                                                                            <input type="text" class="form-control" id="line1"
                                                                                value="" />
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label class="form-label">Line 02</label>
                                                                            <input type="text" class="form-control" id="line2"
                                                                                value="" />
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label class="form-label">Country</label>
                                                                            <select class="form-select" id="country">
                                                                                <?php
                                                                                $country_rs = Database::search("SELECT * FROM `country` ORDER BY `name`");
                                                                                $country_count = $country_rs->num_rows;

                                                                                for ($x = 0; $x < $country_count; $x++) {
                                                                                    $country_data = $country_rs->fetch_assoc();
                                                                                    ?>
                                                                                    <option
                                                                                        value="<?php echo ($country_data["cid"]); ?>">
                                                                                        <?php echo ($country_data["name"]); ?>
                                                                                    </option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label class="form-label">Province</label>
                                                                            <select class="form-select" id="province">
                                                                                <?php
                                                                                $province_rs = Database::search("SELECT * FROM `province` ORDER BY `pname`");
                                                                                $province_count = $province_rs->num_rows;

                                                                                for ($x = 0; $x < $province_count; $x++) {
                                                                                    $province_data = $province_rs->fetch_assoc();
                                                                                    ?>
                                                                                    <option
                                                                                        value="<?php echo ($province_data["p_id"]); ?>">
                                                                                        <?php echo ($province_data["pname"]); ?>
                                                                                    </option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label class="form-label">Distict</label>
                                                                            <select class="form-select" id="district">
                                                                                <?php
                                                                                $district_rs = Database::search("SELECT * FROM `district` ORDER BY `dname`");
                                                                                $district_count = $district_rs->num_rows;

                                                                                for ($x = 0; $x < $district_count; $x++) {
                                                                                    $district_data = $district_rs->fetch_assoc();
                                                                                    ?>
                                                                                    <option
                                                                                        value="<?php echo ($district_data["d_id"]); ?>">
                                                                                        <?php echo ($district_data["dname"]); ?>
                                                                                    </option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label class="form-label">City</label>
                                                                            <select class="form-select" id="city">
                                                                                <?php
                                                                                $city_rs = Database::search("SELECT * FROM `city` ORDER BY `cname`");
                                                                                $city_count = $city_rs->num_rows;

                                                                                for ($x = 0; $x < $city_count; $x++) {
                                                                                    $city_data = $city_rs->fetch_assoc();
                                                                                    ?>
                                                                                    <option value="<?php echo ($city_data["c_id"]); ?>">
                                                                                        <?php echo ($city_data["cname"]); ?>
                                                                                    </option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label class="form-label">Postal Code</label>
                                                                            <input type="text" id="pcode" class="form-control"
                                                                                value="" />
                                                                        </div>
                                                                        <?php

                                                                    }

                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Contact Details -->

                                                        <!-- Other Details -->
                                                        <div class="tab-pane fade p-lg-4 p-3" id="nav-lms" role="tabpanel"
                                                            aria-labelledby="nav-lms-tab" tabindex="0">
                                                            <div class="col-12">
                                                                <div class="row g-2 py-lg-5">
                                                                    <?php

                                                                    if (isset($_SESSION["student"])) {

                                                                        ?>
                                                                        <div class="col-12">
                                                                            <label class="form-label">Registerd On</label>
                                                                            <input type="text" class="form-control disabled"
                                                                                disabled
                                                                                value="<?php echo ($user["registered_datetime"]); ?>" />
                                                                        </div>
                                                                        <?php

                                                                    }

                                                                    if (!isset($_SESSION["admin"])) {

                                                                        if (isset($_SESSION["student"])) {

                                                                            ?>
                                                                            <div class="col-12">
                                                                                <label class="form-label">Registered By</label>
                                                                                <input type="text" class="form-control disabled"
                                                                                    disabled
                                                                                    value="<?php echo ($data["academic_officer_email"] . $data["admin_email"]); ?>" />
                                                                            </div>
                                                                            <?php

                                                                        } else {

                                                                            ?>
                                                                            <div class="col-12">
                                                                                <label class="form-label">Registered By</label>
                                                                                <input type="text" class="form-control disabled"
                                                                                    disabled
                                                                                    value="<?php echo ($data["registered_by"]); ?>" />
                                                                            </div>
                                                                            <?php

                                                                        }
                                                                    }

                                                                    ?>

                                                                    <div class="col-12">
                                                                        <label class="form-label">Last Login</label>
                                                                        <input type="text" class="form-control disabled"
                                                                            disabled
                                                                            value="<?php echo ($data["last_login"]); ?>" />
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label class="form-label">Current Password</label>
                                                                    </div>
                                                                    <div class="col-12 input-group">
                                                                        <input type="password" class="form-control disabled"
                                                                            placeholder="Password"
                                                                            value="<?php echo ($data['password']); ?>"
                                                                            disabled />
                                                                        <button class="btn btn-dark disabled" disabled><i
                                                                                class="bi bi-eye-slash-fill"></i></button>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <a href="#" class="link-danger"
                                                                            onclick="change_password();">Change Password</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Other Details -->

                                                        <!-- Default -->
                                                        <div class="tab-pane fade show active p-lg-3 p-2" id="nav-disabled"
                                                            role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">
                                                            <div class="col-12 d-none d-lg-block py-lg-4">
                                                                <div class="row justify-content-center align-content-center">
                                                                    <div class="col-lg-8 col-12 mt-3">
                                                                        <!-- <img src="assets/slider/img (1).jpg" class="img-fluid rounded-2"/> -->
                                                                        <div class="header-logo"
                                                                            style="max-height: 400px; min-height: 250px; height: auto;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-10 col-12 text-center">
                                                                        <span class="fs-4 text-black">
                                                                            SJ ACADEMY
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-lg-10 col-12 text-center">
                                                                        <span class="fs-5 text-black-50">
                                                                            Have a look at your profile
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Default -->

                                                    </div>
                                                    <!-- Related Contents -->

                                                    <!-- Update -->
                                                    <div class="col-12 p-2 p-lg-4">
                                                        <div class="row justify-content-center">
                                                            <div class="col-12 col-lg-8 d-grid">
                                                                <?php
                                                                if (isset($_SESSION["student"])) {
                                                                    ?>
                                                                    <button class="btn btn-primary bg-opacity-75"
                                                                        onclick="update_profile_st();">Update</button>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <button class="btn btn-primary bg-opacity-75"
                                                                        onclick="update_profile();">Update</button>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Update -->

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- Content -->

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <footer class="col-12 header-bg p-3">
                        <div class="row justify-content-center">

                            <div class="col-lg-5 col-12 text-center">
                                <span class="text-black-50 fs-6">
                                    2024 &copy; SJ ACADEMY | Developed by Shanu Jayasinghe &trade;
                                </span>
                            </div>

                        </div>
                    </footer>
                    <!-- Footer -->

                    <!-- Change Pass Modal -->
                    <div class="modal" tabindex="-1" id="changePassModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Change Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12 p-3">
                                        <div class="row justify-content-center">

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

                                            <div class="col-12">
                                                <label class="form-label">Current Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" placeholder="Password"
                                                        id="password" />
                                                    <button class="btn btn-dark" id="btn" onclick="showPassword();"><i
                                                            class="bi bi-eye-slash-fill"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">New Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" placeholder="New Password"
                                                        id="npass" />
                                                    <button class="btn btn-dark" id="nbtn" onclick="n_show_password();"><i
                                                            class="bi bi-eye-slash-fill"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Retype New Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control"
                                                        placeholder="Retype New Password" id="rnpass" />
                                                    <button class="btn btn-dark" id="rnbtn" onclick="rn_show_password();"><i
                                                            class="bi bi-eye-slash-fill"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="update_password();">Change</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Change Pass Modal -->

                    <?php

                } else {

                    ?>
                    <div class="col-12 vh-100 pt-5">
                        <div class="row justify-content-center">
                            <div class="col-12 text-center col-lg-8 mb-3 text-uppercase">
                                <span class="fs-3 fw-bold">Something Went Wrong</span>
                            </div>
                        </div>
                    </div>
                    <?php

                }
            } else {

                ?>

                <div class="col-12 vh-100 pt-5">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center col-lg-8 mb-3 text-uppercase">
                            <span class="fs-3 fw-bold">Looks like you are a
                                <?php echo ($type); ?>
                            </span>
                        </div>
                        <div class="col-lg-6 col-12 d-grid">
                            <button class="btn btn-outline-warning fs-4 p-5 fw-bold text-uppercase" onclick="log_in();">Sign
                                In</button>
                        </div>
                    </div>
                </div>

                <?php

            }

            ?>

        </div>
    </div>

    <script src="src/js/script.js"></script>
    <script src="src/js/bootstrap.js"></script>
    <script src="src/js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>