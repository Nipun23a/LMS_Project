<?php

// echo ("Submit Marks Process");

session_start();

require "db/connection.php";

require "mail/SMTP.php";
require "mail/PHPMailer.php";
require "mail/EXCEPTion.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_SESSION["teacher"])) {

    $teacher = $_SESSION["teacher"];

    $count = $_POST["count"];
    $a_id = $_POST["id"];

    for ($x = 0; $x < $count; $x++) {

        $email = $_POST["email" . $x];
        $mark = $_POST["mark" . $x];

        // echo ($count." : ".$a_id." : ".$email." : ".$mark." : ");

        if ($mark >= 0 && $mark <= 100) {

            Database::iud("UPDATE `student_has_assignments` SET `marks`='" . $mark . "', `teacher_email`='" . $teacher["email"] . "' WHERE `assignments_id`='" . $a_id . "' AND `student_email`='" . $email . "'");

            $response = "success";

        } else {
            $response = "Mark should be between 0 to 100";
        }

    }

    if ($response == "success") {

        if (!isset($mail)) {

            $assignment_rs = Database::search("SELECT * FROM `assignments` WHERE `id`='" . $a_id . "'");
            $assignment_data = $assignment_rs->fetch_assoc();

            $ghs_rs = Database::search("SELECT * FROM `grade_has_subject` WHERE `id`='" . $assignment_data["grade_has_subject_id"] . "'");
            $ghs_data = $ghs_rs->fetch_assoc();

            $academic_rs = Database::search("SELECT * FROM `academic_officer_has_grade` WHERE `grade_id`='" . $ghs_data["grade_id"] . "'");
            $academic_count = $academic_rs->num_rows;

            $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $ghs_data["subject_id"] . "'");
            $subject_data = $subject_rs->fetch_assoc();

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            $mailSubject = 'LMS Assignment Marks Submitted';
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
                                                <b>Subject:</b>
                                                &nbsp;&nbsp;<br />' . $subject_data["name"] . '
                                            </span><br />
                                            <span>
                                                <b>Assignment Name:</b>
                                                &nbsp;&nbsp;<br />' . $assignment_data["title"] . '
                                            </span><br />

                                            <span>
                                                <b>Released Time:</b>
                                                &nbsp;&nbsp;<br />' . $date . '
                                            </span><br />

                                        </section>
                                        <section style="font-size: 16px;">
                                            <span>Assignment marks has been submitted by ' . $teacher["email"] . '. Please check the Assignments section for review the marks to release.</span><br/><br/>
                                            <span style="color: #dc3545;">Please ignore this email, If you have already seen it.</span>
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

            $mailSetup = new PHPMailer();
            $mailSetup->IsSMTP();
            $mailSetup->Mailer = "smtp";
            $mailSetup->Host = 'smtp.gmail.com';
            $mailSetup->SMTPAuth = true;
            $mailSetup->Username = 'horizon.csr.official@gmail.com';
            $mailSetup->Password = 'mlmcubnlzxtoxjew';
            $mailSetup->SMTPSecure = 'ssl';
            $mailSetup->Port = 465;
            $mailSetup->setFrom('horizon.csr.official@gmail.com', 'SJ ACADEMY');
            $mailSetup->addReplyTo('horizon.csr.official@gmail.com', 'SJ ACADEMY');

            for ($y = 0; $y < $academic_count; $y++) {
                $academic_data = $academic_rs->fetch_assoc();
                $mailSetup->addAddress($academic_data["academic_officer_email"]);
            }

            $mailSetup->isHTML(true);
            $mailSetup->Subject = $mailSubject;
            $mailSetup->Body = $bodyContent;

            if (!$mailSetup->send()) {
                $response = 'Mail sending failed';
            } else {
                $response = 'success';
            }

            echo ($response);

        }
    }

} else {
    header("Location:home.php");
}

?>