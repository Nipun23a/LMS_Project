<?php

session_start();

require "db/connection.php";

require "mail/SMTP.php";
require "mail/PHPMailer.php";
require "mail/EXCEPTion.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_SESSION["admin"])) {

    $admin = $_SESSION["admin"]["email"];
    // echo ($admin);

    // echo ("Teacher Update Process");

    $email = $_POST["email"];
    $subject = $_POST["subject"];

    // echo ($email." : ".$subject);

    if ($subject == 0) {
        echo ("Please select the Subject");
    } else {

        $tec_rs = Database::search("SELECT * FROM `teacher` WHERE `email`='" . $email . "'");
        $tec_count = $tec_rs->num_rows;

        if ($tec_count == 1) {

            $gs_rs = Database::search("SELECT * FROM `grade_has_subject` INNER JOIN `subject` ON `grade_has_subject`.`subject_id`=`subject`.`id` INNER JOIN `grade` ON `grade_has_subject`.`grade_id`=`grade`.`id` WHERE `grade_has_subject`.`id` = '" . $subject . "'");
            $gs_count = $gs_rs->num_rows;

            if ($gs_count == 1) {

                $gs_data = $gs_rs->fetch_assoc();

                $mailSubject = 'LMS Teacher Update Details';
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
                        <span>
                            <b>Email:</b>
                            &nbsp;&nbsp;<br />' . $email . '
                        </span><br />
                        <span>
                            <b>Subject:</b>
                            &nbsp;&nbsp;<br />' . $gs_data["name"] . '
                        </span><br />
                        <span>
                            <b>Grade:</b>
                            &nbsp;&nbsp;<br />' . $gs_data["grade"] . '
                        </span><br /><br/>

                    </section>
                    <section style="font-size: 16px;">
                        <span>If you have any problems with your any other details, you can change them on Profile</span><br/><br/>
                        <span style="color: #dc3545;">Remember: You do not have access to change the Email or the Subject by yourself. Please contact Administation for futher changes.<br/>(You can simply find your Admin Email on Other Details section on your profile. For any problems contact the Admin via any of your Email Applications)</span>
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

                    Database::iud("UPDATE `teacher` SET `grade_has_subject_id`='" . $subject . "' WHERE `email`='" . $email . "'");

                    echo ($response);
                }
            }
        } else {
            echo ("Cannot find the Teacher. Please try again");
        }
    }
} else {
    echo ("Couldn't find the Admin");
}

?>