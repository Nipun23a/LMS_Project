<?php
require "db/connection.php";

session_start();

$_SESSION["student"] = null;
$_SESSION["teacher"] = null;
$_SESSION["academic_officer"] = null;
$_SESSION["admin"] = null;

session_destroy();

$user = $_POST["user"];
$username = $_POST["username"];
$password = $_POST["password"];
$remember = $_POST["remember"];
if (isset($user)) {

    if (empty($username)) {
        echo ("Please enter your Email (Username)");
    } else if (strlen($username) > 100) {
        echo ("Email (Username) must have less than 100 Characters");
    } else if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        echo ("Invalid Email format");
    } else {

        $result = Database::search("SELECT * FROM `" . $user . "` WHERE `email`='" . $username . "'");

        $count = $result->num_rows;

        if ($count == 1) {

            $data = $result->fetch_assoc();

            if (empty($password)) {
                echo ("Please enter your Password");
            } else if (strlen($password) < 4 || strlen($password) > 25) {
                echo ("Password should be between 4 and 25 characters");
            } else {

                if ($data["password"] == $password) {

                    if ($data["status_id"] == 2) {
                        // Verified

                        session_start();

                        $_SESSION[$user] = $data;

                        $d = new DateTime();
                        $tz = new DateTimeZone("Asia/Colombo");
                        $d->setTimezone($tz);
                        $date = $d->format("Y-m-d H:i:s");

                        Database::iud("UPDATE `" . $user . "` SET `last_login`='" . $date . "' WHERE `email`='" . $username . "' AND `password`='" . $password . "'");

                        if ($remember == "true") {

                            setcookie($user . "_email", $username, time() + (60 * 60 * 24 * 365));
                            setcookie($user . "_password", $password, time() + (60 * 60 * 24 * 365));

                        } else {

                            setcookie($user . "_email", "", -1);
                            setcookie($user . "_password", "", -1);

                        }

                        echo ("success");

                    } else {
                        echo ("unverified");
                    }

                } else {
                    echo ("Incorrect Password. Please try again");
                }

            }

        } else {
            echo ("Cannont find the relevant User with this Email (Username). Please try again or Contact your Administrator.");
        }

    }

} else {
    echo ("Something went wrong");
}
