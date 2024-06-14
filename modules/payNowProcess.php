<?php

// echo ("Pay Now Process");

session_start();

require "db/connection.php";

if (isset($_SESSION["student"])) {

    $user = $_SESSION["student"];
    $email = $user["email"];

    if ($_GET["e"] == $email) {

        $umail = $_GET["e"];
        $type = $_GET["type"];

        $array;
        $order_id = uniqid();

        $st_rs = Database::search("SELECT * FROM `student` WHERE `email`='" . $email . "'");
        $st_count = $st_rs->num_rows;

        if ($st_count == 1) {

            $st_data = $st_rs->fetch_assoc();

            $condition;
            if ($type == "enrollment_fee") {

                $condition = ($st_data["payment_status_id"] == 2);

            } else if ($type == "subscription") {

                $shs_rs = Database::search("SELECT * FROM `student_has_subscription` WHERE `student_email`='" . $umail . "'");
                $shs_count = $shs_rs->num_rows;

                $condition;
                if ($shs_count == 0) {
                    $condition = false;
                }

            }

            if ($condition) {
                echo ("4");
            } else {

                $city_rs = Database::search("SELECT * FROM `address` WHERE `student_email`='" . $email . "'");
                $city_count = $city_rs->num_rows;

                if ($city_count == 1) {

                    $city_data = $city_rs->fetch_assoc();

                    $city_id = $city_data["city_id"];
                    $address = $city_data["line1"] . $city_data["line2"];

                    $district_rs = Database::search("SELECT * FROM `city` WHERE `c_id`='" . $city_id . "'");
                    $district_data = $district_rs->fetch_assoc();

                    $amount;
                    $item;
                    if ($type == "enrollment_fee") {

                        $grade = $_GET["grd"];
                        $grade_rs = Database::search("SELECT * FROM `grade` WHERE `id`='" . $grade . "'");
                        $grade_data = $grade_rs->fetch_assoc();

                        $item = "Enrollment Fee : " . $grade_data["grade"];

                        $amount = (int) $grade_data["fee"];

                    } else if ($type == "subscription") {

                        $subscription_rs = Database::search("SELECT * FROM `subscription`");
                        $subscription_data = $subscription_rs->fetch_assoc();

                        $item = "Portal Fee : " . $subscription_data["fee"];

                        $amount = (int) $subscription_data["fee"];

                    }

                    $fname = $user["fname"];
                    $lname = $user["lname"];
                    $mobile = $user["mobile"];
                    $user_address = $address;
                    $city = $district_data["cname"];

                    $array["id"] = $order_id;
                    $array["item"] = $item;
                    $array["amount"] = $amount;
                    $array["fname"] = $fname;
                    $array["lname"] = $lname;
                    $array["mobile"] = $mobile;
                    $array["adress"] = $address;
                    $array["city"] = $city;
                    $array["mail"] = $email;

                    echo (json_encode($array));

                } else {
                    echo ("3");
                }

            }

        }

    } else {
        echo ("2");
    }

} else {
    echo ("1");
}

?>