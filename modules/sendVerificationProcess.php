<?php

// echo ("Send Verificaion Process");

require "db/connection.php";

require "mail/SMTP.php";
require "mail/PHPMailer.php";
require "mail/EXCEPTion.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["username"])) {

    $username = $_POST["username"];

    if (empty($username)) {
        echo ("Please enter your Email (Username)");
    } else if (strlen($username) > 100) {
        echo ("Email (Username) must have less than 100 Characters");
    } else if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        echo ("Invalid Email format");
    } else {

        $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $username . "'");
        $admin_count = $admin_rs->num_rows;

        if ($admin_count > 0) {

            $admin_data = $admin_rs->fetch_assoc();

            if (isset($_POST["password"])) {

                $password = $_POST["password"];

                if (!empty($password)) {

                    if (strlen($password) < 4 || strlen($password) > 25) {
                        echo ("Password should be between 4 and 25 characters");
                    } else {

                        if ($admin_data["password"] == $password) {

                            $code = substr("ad", 0, 2) . substr(uniqid(), 7, 6);

                            Database::iud("UPDATE `admin` SET `verification_code`='" . $code . "' WHERE `email`='" . $username . "' AND `password`='" . $password . "'");

                            $subject = 'LMS Admin Verification Code';
                            $bodyContent = "<div>
                                                    <center>
                                                        <h2 style='color: Aqua;'>
                                                            One Time Verification Code<br/>SJ ACADEMY LMS
                                                        </h2>
                                                        <div style='background-color: hsl(230, 60%, 90%); opacity: 70%; padding: 1rem 1rem 1rem 1rem; border-radius: 50%;'>
                                                            <span style='color: black; font-weight: 300; font-size: 20px;'><code>" . $code . "</code><span>
                                                        </div>
                                                        <p>Remember: This verification code is only valid for once.</p>
                                                        <p>Don't share this code with anyone. </p>
                                                    </center>
                                                </div>";

                            $response = PHPMailer::setupMail($username, $subject, $bodyContent);

                            echo ($response);

                        } else {
                            echo ("Incorrect Password. Check again or contact Database Administrator");
                        }

                    }

                } else {
                    echo ("Please enter your Password");
                }

            } else {
                echo ("Invalid Password");
            }

        } else {
            echo ("Cannont find the relevant User with this Email (Username). Please try again.");
        }

    }

} else {
    echo ("Your a not a valid Admin");
}

?>