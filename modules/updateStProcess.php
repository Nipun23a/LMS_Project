<?php

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

if (isset($_SESSION["admin"])) {

    $admin = $_SESSION["admin"]["email"];
    // echo ($admin);

    // echo ("Student Update Process");

    $email = $_POST["email"];
    $grade = $_POST["grade"];
    $scount = $_POST["count"];

    // echo ($email." : ".$scount." : ".$grade);

    if ($grade == 0) {
        echo ("Please select a Grade");
    } else if ($scount == 0) {
        echo ("Please select Subjects");
    } else if ($scount < 3) {
        echo ("Please select atleast 3 Subjects");
    } else {

        $st_rs = Database::search("SELECT * FROM `student` WHERE `email`='" . $email . "'");
        $st_count = $st_rs->num_rows;

        if ($st_count == 1) {

            $subjects = "";
            for ($x = 1; $x <= $scount; $x++) {

                $subject = $_POST["subject" . $x];
                $gh_subject_rs = Database::search("SELECT * FROM `grade_has_subject` WHERE `id`='" . $subject . "'");
                $gh_subject_data = $gh_subject_rs->fetch_assoc();

                $s_rs = Database::search("SELECT * FROM `subject` WHERE `id` = '" . $gh_subject_data["subject_id"] . "'");
                $s_data = $s_rs->fetch_assoc();

                $subjects .= $s_data["name"] . ", ";

            }

            // echo($subjects);

            $mailSubject = 'LMS Student Update Details';
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
                        <b>Grade:</b>
                        &nbsp;&nbsp;<br />' . $grade . '
                    </span><br />
                    <span>
                        <b>No of Subjects:</b>
                        &nbsp;&nbsp;<br />' . $scount . '
                    </span><br />
                    <span>
                        <b>Subjects:</b>
                        &nbsp;&nbsp;<br />' . $subjects . '
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

                Database::iud("UPDATE `student` SET `grade_id`='" . $grade . "' WHERE `email`='" . $email . "'");

                Database::iud("DELETE FROM `student_has_gs` WHERE `student_email`='" . $email . "'");

                for ($x = 1; $x <= $scount; $x++) {

                    $subject = $_POST["subject" . $x];
                    Database::iud("INSERT INTO `student_has_gs` (`grade_has_subject_id`,`student_email`,`enrolled_on`) VALUES ('" . $subject . "','" . $email . "','" . $date . "')");

                }

                echo ($response);

            }

        } else {
            echo ("Cannot find the student. Please try again");
        }

    }

} else {
    echo ("Couldn't find the Admin");
}

?>