<?php

// echo ("Upload     Assignments Process");

session_start();

require "db/connection.php";

if (isset($_SESSION["student"])) {

    $student = $_SESSION["student"];

    $count = $_POST["count"];

    if ($count == sizeof($_FILES)) {

        $allowed_file_extentions = array("text/plain", "application/pdf", "application/zip", "application/7z", "application/msword");

        $email = $_POST["email"];
        $a_id = $_POST["id"];

        $assignment_rs = Database::search("SELECT * FROM `assignments` WHERE `id`='" . $a_id . "'");
        $assignment_data = $assignment_rs->fetch_assoc();

        $subject = $assignment_data["grade_has_subject_id"];

        for ($x = 0; $x < $count; $x++) {

            $file = $_FILES["file" . $x];
            $file_ex = $file["type"];

            if (!in_array($file_ex, $allowed_file_extentions)) {
                echo ("Selected file type is unsupported! " . $file_ex . " . Please select a valid file.");
            } else {

                $new_file_extention;
                if ($file_ex == "application/pdf") {
                    $new_file_extention = ".pdf";
                } else if ($file_ex == "application/zip") {
                    $new_file_extention = ".zip";
                } else if ($file_ex == "application/7z") {
                    $new_file_extention = ".7z";
                } else if ($file_ex == "application/msword") {
                    $new_file_extention = ".docx";
                } else if ($file_ex == "text/plain") {
                    $new_file_extention = ".txt";
                }

                if (!is_dir("shared")) {
                    // mkdir("shared", 0600);
                    mkdir("shared", 0755);
                    // mkdir("shared", 0777);
                }
                if (!is_dir("shared/assignments")) {
                    // mkdir("shared/notes", 0600);
                    mkdir("shared/assignments", 0755);
                    // mkdir("shared/assignments", 0777);
                }
                if (!is_dir("shared/assignments/answers")) {
                    // mkdir("shared/assignments/answers, 0600);
                    mkdir("shared/assignments/answers", 0755);
                    // mkdir("shared/assignments/answers", 0777);
                }
                if (!is_dir("shared/assignments/answers/" . $subject)) {
                    // mkdir("shared/assignments/answers/".$subject, 0600);
                    mkdir("shared/assignments/answers/" . $subject, 0755);
                    // mkdir("shared/assignments/answers/".$subject, 0777);
                }
                if (!is_dir("shared/assignments/answers/" . $subject . "/" . $a_id)) {
                    // mkdir("shared/assignments/answers/".$subject . "/" . $a_id, 0600);
                    mkdir("shared/assignments/answers/" . $subject . "/" . $a_id, 0755);
                    // mkdir("shared/assignments/answers/".$subject . "/" . $a_id, 0777);
                }

                $file_name = "shared/assignments/answers/" . $subject . "/" . $a_id . "/" . uniqid($email . "_") . "_" . $new_file_extention;

                move_uploaded_file($file["tmp_name"], $file_name);

                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d H:i:s");

                $stha_rs = Database::search("SELECT * FROM `student_has_assignments` WHERE `student_email`='" . $email . "' AND `assignments_id`='" . $a_id . "'");
                $stha_count = $stha_rs->num_rows;

                if ($stha_count == 0) {
                    Database::iud("INSERT INTO `student_has_assignments` (`student_email`,`time`,`upload_status_id`,`assignments_id`,`path`) VALUES ('" . $email . "','" . $date . "','2','" . $a_id . "','" . $file_name . "')");
                } else {
                    Database::iud("UPDATE `student_has_assignments` SET `time`='" . $date . "', `path`='" . $file_name . "' WHERE `student_email`='" . $email . "' AND `assignments_id`='" . $a_id . "'");
                }

                echo ("success");

            }
        }
    } else {
        echo ("Invalid file count");
    }
} else {
    header("Location:home.php");
}

?>