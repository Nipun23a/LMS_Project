<?php

// echo ("Admin Log In Process");

require "db/connection.php";

$username = $_POST["username"];
$password = $_POST["password"];
$remember = $_POST["remember"];
$vcode = $_POST["vcode"];

// echo ($remember." ".$username." ".$password." ".$vcode);

if (empty($username)) {
    echo ("Please enter your Username");
} else if (empty($password)) {
    echo ("Please enter your Password");
} else if (empty($vcode)) {
    echo ("Please enter your Verification Code");
} else {

    $result = Database::search("SELECT * FROM `admin` WHERE `email`='" . $username . "'");

    $count = $result->num_rows;

    if ($count > 0) {

        $data = $result->fetch_assoc();

        if ($data["password"] == $password) {

            if ($data["verification_code"] == $vcode) {

                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d H:i:s");

                Database::iud("UPDATE `admin` SET `last_login`='" . $date . "' WHERE `email`='" . $username . "' AND `password`='" . $password . "'");

                session_start();

                $data["status_id"] = 2;

                $_SESSION["admin"] = $data;

                if ($remember == "true") {

                    setcookie("admin_email", $username, time() + (60 * 60 * 24 * 365));
                    setcookie("admin_password", $password, time() + (60 * 60 * 24 * 365));

                } else {

                    setcookie("admin_email", "", -1);
                    setcookie("admin_password", "", -1);

                }

                echo ("success");

            } else {
                echo ("Invalid Verification Code. Try again");
            }

        } else {
            echo ("Invalid Password");
        }

    } else {
        echo ("Cannont find the relevant User with this Email (Username). Please try again");
    }

}

?>