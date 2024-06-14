<?php

// echo ("Forgot Password Process");

require "db/connection.php";

require "mail/SMTP.php";
require "mail/PHPMailer.php";
require "mail/EXCEPTion.php";

use PHPMailer\PHPMailer\PHPMailer;

if (!empty($_GET["e"])) {

    if (isset($_GET["e"])) {

        $email = $_GET["e"];

        if (!empty($_GET["u"])) {

            if (isset($_GET["u"])) {

                $user = $_GET["u"];

                $user_rs = Database::search("SELECT * FROM `" . $user . "` WHERE `email`='" . $email . "'");
                $user_count = $user_rs->num_rows;

                if ($user_count == 1) {

                    $code = substr(uniqid(), 3, 9);

                    Database::iud("UPDATE `" . $user . "` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "'");

                    $subject = 'LMS Verification Code';
                    $content = "<div>
                                        <center>
                                            <h2 style='color: Aqua;'>
                                                Forgot Password Verification Code<br/>SJ ACADEMY LMS
                                            </h2>
                                            <div style='background-color: hsl(230, 60%, 90%); opacity: 70%; padding: 1rem 1rem 1rem 1rem; border-radius: 50%;'>
                                                <span style='color: black; font-weight: 300; font-size: 20px;'><code>" . $code . "</code><span>
                                            </div>
                                            <p>Remember: This verification code is only valid for once.</p>
                                            <p>Don't share this code with anyone. </p>
                                        </center>
                                    </div>";

                    $response = PHPMailer::setupMail($email, $subject, $content);

                    echo ($response);

                } else {
                    echo ("Invalid User. Please try agian or register");
                }
            } else {
                echo ("Invalid User");
            }
        } else {
            echo ("Cannot identify the User");
        }
    } else {
        echo ("Invalid Email");
    }
} else {
    echo ("Please enter your Email");
}
