<?php

// echo ("Add Notes Process");

session_start();

require "db/connection.php";

require "mail/SMTP.php";
require "mail/PHPMailer.php";
require "mail/EXCEPTion.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_SESSION["teacher"])) {

    $teacher = $_SESSION["teacher"];

    $title = $_POST["title"];
    $count = $_POST["count"];
    $grade = $_POST["grade"];
    $subject = $_POST["subject"];

    // echo ($title." : ".$count." : ".$grade." : ".$subject);

    if ($count == sizeof($_FILES)) {

        $allowed_file_extentions = array("text/plain", "application/pdf");

        for ($x = 0; $x < $count; $x++) {

            $file = $_FILES["file" . $x];
            $file_ex = $file["type"];

            if (!in_array($file_ex, $allowed_file_extentions)) {
                echo ("Selected file type is unsupported! " . $file_ex . " . Please select a valid file.");
            } else {

                $new_file_extention;
                if ($file_ex == "application/pdf") {
                    $new_file_extention = ".pdf";
                } else if ($file_ex == "text/plain") {
                    $new_file_extention = ".txt";
                }

                if (!is_dir("shared")) {
                    // mkdir("shared", 0600);
                    mkdir("shared", 0755);
                    // mkdir("shared", 0777);
                }
                if (!is_dir("shared/notes")) {
                    // mkdir("shared/notes", 0600);
                    mkdir("shared/notes", 0755);
                    // mkdir("shared/notes", 0777);
                }
                if (!is_dir("shared/notes/" . $subject)) {
                    // mkdir("shared/notes/".$subject, 0600);
                    mkdir("shared/notes/" . $subject, 0755);
                    // mkdir("shared/notes/".$subject, 0777);
                }

                $file_name = "shared/notes/" . $subject . "/" . $grade . "_" . $subject . "_" . uniqid("note_") . "_" . $title . $new_file_extention;

                move_uploaded_file($file["tmp_name"], $file_name);

                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d H:i:s");

                Database::iud("INSERT INTO `notes` (`path`,`time`,`title`,`grade_has_subject_id`,`teacher_email`) VALUES ('" . $file_name . "','" . $date . "','" . $title . "','" . $subject . "','" . $teacher["email"] . "')");

                $st_rs = Database::search("SELECT * FROM `student_has_gs` WHERE `grade_has_subject_id`='" . $subject . "'");
                $st_count = $st_rs->num_rows;

                if (!isset($mail)) {

                    $ghs_rs = Database::search("SELECT * FROM `grade_has_subject` WHERE `id`='" . $subject . "'");
                    $ghs_data = $ghs_rs->fetch_assoc();

                    $subject_rs = Database::search("SELECT * FROM `subject` WHERE `id`='" . $ghs_data["subject_id"] . "'");
                    $subject_data = $subject_rs->fetch_assoc();

                    $mailSubject = 'LMS New Note Alert';
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
                                                        <b>Lesson Title:</b>
                                                        &nbsp;&nbsp;<br />' . $title . '
                                                    </span><br /><br/>
                                                    <span>
                                                        <b>Time:</b>
                                                        &nbsp;&nbsp;<br />' . $date . '
                                                    </span><br />

                                                </section>
                                                <section style="font-size: 16px;">
                                                    <span>A new Note has been added by your teacher. Please check the Notes section for the new Note.</span><br/><br/>
                                                    <span style="color: #dc3545;">Please ignore this email. If you have already seen it.</span>
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

                    for ($y = 0; $y < $st_count; $y++) {
                        $st_data = $st_rs->fetch_assoc();
                        $mailSetup->addAddress($st_data["student_email"]);
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
        }
    } else {
        echo ("Invalid file count");
    }
} else {
    header("Location:home.php");
}

?>