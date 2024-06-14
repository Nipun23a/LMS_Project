<?php

// echo ("Verify User Process");

require "db/connection.php";

require "mail/SMTP.php";
require "mail/PHPMailer.php";
require "mail/EXCEPTion.php";

use PHPMailer\PHPMailer\PHPMailer;

$user = $_POST["user"];
$username = $_POST["username"];
$password = $_POST["password"];
$remember = $_POST["remember"];
$vcode = $_POST["vcode"];

// echo ($user." ".$username." ".$password." ".$vcode);

if (isset($user)) {

    if (empty($username)) {
        echo ("Please enter your Username");
    } else if (empty($password)) {
        echo ("Please enter your Password");
    } else if (empty($vcode)) {
        echo ("Please enter your Verification Code");
    } else {

        $super;
        if ($user == "teacher") {
            $super = "admin";
        } else if ($user == "academic_officer") {
            $super = "admin";
        }

        $result = Database::search("SELECT * FROM `" . $user . "` WHERE `email`='" . $username . "'");

        $count = $result->num_rows;

        if ($count > 0) {

            $data = $result->fetch_assoc();

            if ($data["password"] == $password) {

                if ($data["verification_code"] == $vcode) {

                    $new_code = substr($user, 0, 2) . substr(uniqid(), 9, 4);

                    if ($data["status_id"] == 1) {

                        $d = new DateTime();
                        $tz = new DateTimeZone("Asia/Colombo");
                        $d->setTimezone($tz);
                        $date = $d->format("Y-m-d H:i:s");

                        Database::iud("UPDATE `" . $user . "` SET `status_id`='2', `verification_code`='" . $new_code . "', `last_login`='" . $date . "' WHERE `email`='" . $username . "' AND `password`='" . $password . "'");

                        $subject = 'LMS Verification Code';
                        $bodyContent = "<div>
                                            <center>
                                                <h2 style='color: Aqua;'>
                                                    One Time Verification Code<br/>SJ ACADEMY LMS
                                                </h2>
                                                <div style='background-color: hsl(230, 60%, 90%); opacity: 70%; padding: 1rem 1rem 1rem 1rem; border-radius: 50%;'>
                                                    <span style='color: black; font-weight: 300; font-size: 20px;'><code>" . $new_code . "</code><span>
                                                </div>
                                                <p>Remember: This verification code is only valid for once.</p>
                                                <p>Don't share this code with anyone. </p>
                                            </center>
                                        </div>";

                        $response = PHPMailer::setupMail($data["email"], $subject, $bodyContent);

                        session_start();

                        $data["status_id"] = 2;

                        $_SESSION[$user] = $data;

                        if ($remember == "true") {

                            setcookie($user . "_email", $username, time() + (60 * 60 * 24 * 365));
                            setcookie($user . "_password", $password, time() + (60 * 60 * 24 * 365));
                        } else {

                            setcookie($user . "_email", "", -1);
                            setcookie($user . "_password", "", -1);
                        }

                        if ($response == "success") {
                            echo ("success");
                        } else {
                            echo ("Failed to send new Verification Code to the user");
                        }
                    } else {

                        if ($user == "student") {
                            $super = "academic_officer";
                            $registered_by = $data["academic_officer_email"];
                        } else {
                            $registered_by = $data["registered_by"];
                        }

                        $super_rs = Database::search("SELECT * FROM `" . $super . "` WHERE `email`='" . $registered_by . "'");
                        $super_data = $super_rs->fetch_assoc();
                        $name = $super_data["fname"] . " " . $super_data["lname"];

                        echo ("You have been already verified by the System. Please try again (reload) or contact your Administrator: <br/> &nbsp;&nbsp;&nbsp;" . $name . " - " . $registered_by);
                    }
                } else {
                    echo ("Invalid Verification Code");
                }
            } else {
                echo ("Invalid Password");
            }
        } else {
            echo ("Cannont find the relevant User with this Email (Username). Please try again");
        }
    }
} else {
    echo ("Something went wrong");
}
