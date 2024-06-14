<?php

// echo ("Request Code Process");

require "db/connection.php";

require "mail/SMTP.php";
require "mail/PHPMailer.php";
require "mail/EXCEPTion.php";

use PHPMailer\PHPMailer\PHPMailer;

$user = $_POST["user"];
$username = $_POST["username"];
$password = $_POST["password"];

// echo ($user." ".$username." ".$password);

if (isset($user)) {

    if (empty($username)) {
        echo ("Please enter your Username");
    } else if (empty($password)) {
        echo ("Please enter your Password");
    } else {

        $super;
        if ($user == "student") {
            $super = "academic_officer";
        } else if ($user == "teacher") {
            $super = "admin";
        } else if ($user == "academic_officer") {
            $super = "admin";
        }

        $result = Database::search("SELECT * FROM `" . $user . "` WHERE `email`='" . $username . "'");

        $count = $result->num_rows;

        if ($count > 0) {

            $data = $result->fetch_assoc();

            if ($data["password"] == $password) {

                $new_code = substr($user, 0, 2) . substr(uniqid(), 9, 4);

                if ($data["status_id"] == 1) {

                    $d = new DateTime();
                    $tz = new DateTimeZone("Asia/Colombo");
                    $d->setTimezone($tz);
                    $date = $d->format("Y-m-d H:i:s");

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

                    if ($response == "success") {
                        Database::iud("UPDATE `" . $user . "` SET `verification_code`='" . $new_code . "' WHERE `email`='" . $username . "'");
                        echo ("success");
                    } else {
                        echo ("Failed to send new Verification Code to the user");
                    }

                } else {

                    if ($user == "student") {
                        if (!empty($data["academic_officer_email"])) {
                            $registered_by = $data["admin_email"];
                            $super = "academic_officer";
                        } else if (!empty($data["admin_email"])) {
                            $registered_by = $data["academic_officer_email"];
                            $super = "admin";
                        }
                    } else {
                        $registered_by = $data["registered_by"];
                    }

                    $super_rs = Database::search("SELECT * FROM `" . $super . "` WHERE `email`='" . $registered_by . "'");
                    $super_data = $super_rs->fetch_assoc();
                    $name = $super_data["fname"] . " " . $super_data["lname"];

                    echo ("You have been already verified by the System. Please try again (reload) or contact your Administrator: <br/> &nbsp;&nbsp;&nbsp;" . $name . " - " . $registered_by);
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

?>