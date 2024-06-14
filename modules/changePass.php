<?php

// echo ("Change Pass Process");

session_start();

require "db/connection.php";

require "mail/SMTP.php";
require "mail/PHPMailer.php";
require "mail/EXCEPTion.php";

use PHPMailer\PHPMailer\PHPMailer;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$user;
if (isset($_SESSION["student"])) {
    $user = "student";
} else if (isset($_SESSION["academic_officer"])) {
    $user = "academic_officer";
} else if (isset($_SESSION["teacher"])) {
    $user = "teacher";
} else if (isset($_SESSION["admin"])) {
    $user = "admin";
} else {
    echo ("Something went wrong");
    return;
}
$email = $_SESSION[$user]["email"];

if (isset($email) && isset($user)) {

    $umail = $_POST["email"];
    $cpass = $_POST["cpass"];
    $npass = $_POST["npass"];

    // echo ($umail . " : " . $cpass . " : " . $npass . " : " . $user . " : " . $email);

    if ($umail == $email) {

        $result = Database::search("SELECT * FROM `" . $user . "` WHERE `email`='" . $email . "'");
        $count = $result->num_rows;

        if ($count == 1) {

            $data = $result->fetch_assoc();

            if ($data["password"] == $cpass) {

                $mailSubject = 'LMS Password Changed Alert';
                $bodyContent = '<div style="padding: 3%; background-image: linear-gradient(90deg, #0d6efd 0%, #dc3545 100%);">
            <center>
            <header>
                <h1 style="color: #0d6efd;">
                    SJ ACADEMY LMS
                </h1>
            </header>
            </center>
            <article style="background-color: hsl(170, 60%, 95%); opacity: 70%; padding: 4%; border-radius: 10%;"">
                <section style="letter-spacing: 0.1rem; font-size: 18px; padding: 2%;">
                    <span style="color: #198754; font-weight: 300;">
                        <b>Your Password is changed on:</b>&nbsp;&nbsp;<code>' . $date . '</code>
                    <span><br/><br/>
                </section>
                <section style="font-size: 16px;">
                    <span style="color: #dc3545;">Remember: If you have not changed the password, Please contact Administation Immediatly.<br/>(You can simply find your Admin Email on Other Details section on your profile. For any problems contact the Admin via any of your Email Applications)</span>
                </section>
            </article>
            <center>
            <footer style="padding: 2%;">
                <span>
                    2024 &copy; SJ ACADEMY | Developed by Shanu Jayasinghe &trade;
                </span>
            </footer>
            </center>
            </div>';

                $response = PHPMailer::setupMail($email, $mailSubject, $bodyContent);

                if ($response == "success") {

                    Database::iud("UPDATE `" . $user . "` SET `password`='" . $npass . "' WHERE `email`='" . $email . "'");

                    echo ($response);
                } else {
                    echo ($response);
                }
            } else {
                echo ("Invalid current Password");
            }
        } else {
            echo ("Cannot find the user");
        }
    } else {
        echo ("Something is wrong with identifing the user");
    }
} else {
    echo ("Something went wrong");
}

?>