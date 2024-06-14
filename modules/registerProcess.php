<?php

// echo ("Register Process");

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

if (isset($_GET["tec"])) {

    if (isset($_SESSION["admin"])) {

        $admin = $_SESSION["admin"]["email"];
        // echo ($admin);

        // echo ("Teacher Registration Process");

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $mobile = $_POST["mobile"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $subject = $_POST["subject"];

        // echo ($fname." : ".$lname." : ".$mobile." : ".$gender." : ".$email." : ".$password." : ".$subject);

        if (empty($fname)) {
            echo ("Please enter the First Name");
        } else if (empty($lname)) {
            echo ("Pleae enter the Last Name");
        } else if (empty($mobile)) {
            echo ("Please enter the Mobile Number");
        } else if (strlen($mobile) < 10) {
            echo ("Mobile Number should contain 10 characters");
        } else if (!preg_match("/07[1,2,4,5,6,7,8,0][0-9]/", $mobile)) {
            echo ("Invalid Mobile Number");
        } else if (empty($email)) {
            echo ("Please enter the Email address");
        } else if (strlen($email) > 100) {
            echo ("Email should be less than 100 characters");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo ("Invalid Email");
        } else if (empty($password)) {
            echo ("Please enter the Password");
        } else if (strlen($password) > 25 || strlen($password) < 4) {
            echo ("Password should be contain 4 to 25 characters");
        } else if ($subject == 0) {
            echo ("Please select the Subject");
        } else {

            $tec_rs = Database::search("SELECT * FROM `teacher` WHERE `email`='" . $email . "'");
            $tec_count = $tec_rs->num_rows;

            if ($tec_count == 0) {

                $code = uniqid("tec_");

                $gs_rs = Database::search("SELECT * FROM `grade_has_subject` INNER JOIN `subject` ON `grade_has_subject`.`subject_id`=`subject`.`id` INNER JOIN `grade` ON `grade_has_subject`.`grade_id`=`grade`.`id` WHERE `grade_has_subject`.`id` = '" . $subject . "'");
                $gs_count = $gs_rs->num_rows;

                if ($gs_count == 1) {

                    $gs_data = $gs_rs->fetch_assoc();

                    $mailSubject = 'LMS Teacher Registration Details';
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
                            <b>First Name:</b>
                            &nbsp;&nbsp;<br />' . $fname . '
                        </span><br />
                        <span> 
                            <b>Last Name:</b>
                            &nbsp;&nbsp;<br />' . $lname . '
                        </span><br />
                        <span>
                            <b>Email:</b>
                            &nbsp;&nbsp;<br />' . $email . '
                        </span><br />
                        <span>
                            <b>Password:</b>
                            &nbsp;&nbsp;<br /><code>' . $password . '</code>
                        </span><br />
                        <span>
                            <b>Mobile:</b>
                            &nbsp;&nbsp;<br />' . $mobile . '
                        </span><br />
                        <span>
                            <b>Subject:</b>
                            &nbsp;&nbsp;<br />' . $gs_data["name"] . '
                        </span><br />
                        <span>
                            <b>Grade:</b>
                            &nbsp;&nbsp;<br />' . $gs_data["grade"] . '
                        </span><br /><br/>

                        <span style="color: #198754; font-weight: 300;">
                            <b>One-Time Verification Code:</b>&nbsp;&nbsp;<code>' . $code . '</code>
                        <span><br/><br/>
                    </section>
                    <section style="font-size: 16px;">
                        <span>The above password is can be changed in Profile after logged in to the System.</span>
                        <span>If you have any problems with your details, you can change them on Profile</span><br/><br/>
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

                        Database::iud("INSERT INTO `teacher` (`fname`,`lname`,`mobile`,`gender_id`,`email`,`password`,`grade_has_subject_id`,`verification_code`,`registered_by`,`status_id`,`registered_datetime`) VALUES ('" . $fname . "','" . $lname . "','" . $mobile . "','" . $gender . "','" . $email . "','" . $password . "','" . $subject . "','" . $code . "','" . $admin . "','1','" . $date . "')");

                        echo ($response);
                    }
                }
            } else {
                echo ("Teacher is already registered from the given Email Address");
            }
        }
    } else {
        echo ("Couldn't find the Admin");
    }
}

if (isset($_GET["ao"])) {

    if (isset($_SESSION["admin"])) {

        $admin = $_SESSION["admin"]["email"];
        // echo ($admin);

        // echo ("Academic Officer Registration Process");

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $mobile = $_POST["mobile"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $gcount = $_POST["count"];

        // echo ($fname." : ".$lname." : ".$mobile." : ".$gender." : ".$email." : ".$password." : ".$gcount);

        if (empty($fname)) {
            echo ("Please enter the First Name");
        } else if (empty($lname)) {
            echo ("Pleae enter the Last Name");
        } else if (empty($mobile)) {
            echo ("Please enter the Mobile Number");
        } else if (strlen($mobile) < 10) {
            echo ("Mobile Number should contain 10 characters");
        } else if (!preg_match("/07[1,2,4,5,6,7,8,0][0-9]/", $mobile)) {
            echo ("Invalid Mobile Number");
        } else if (empty($email)) {
            echo ("Please enter the Email address");
        } else if (strlen($email) > 100) {
            echo ("Email should be less than 100 characters");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo ("Invalid Email");
        } else if (empty($password)) {
            echo ("Please enter the Password");
        } else if (strlen($password) > 25 || strlen($password) < 4) {
            echo ("Password should be contain 4 to 25 characters");
        } else if ($gcount == 0) {
            echo ("Please select a Grade");
        } else {

            $ao_rs = Database::search("SELECT * FROM `academic_officer` WHERE `email`='" . $email . "'");
            $ao_count = $ao_rs->num_rows;

            if ($ao_count == 0) {

                $code = uniqid("ao_");

                $grades = "";
                for ($x = 1; $x <= $gcount; $x++) {

                    $grade = $_POST["grade" . $x];
                    // Database::iud("INSERT INTO `academic_officer_has_grade` (`grade_id`,`academic_officer_email`) VALUES ('".$grade."','".$email."')");

                    $g_rs = Database::search("SELECT * FROM `grade` WHERE `id` = '" . $grade . "'");
                    $g_data = $g_rs->fetch_assoc();

                    $grades .= $g_data["grade"] . ", ";
                }

                // echo($grades);

                $mailSubject = 'LMS Academic Officer Registration Details';
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
                            <b>First Name:</b>
                            &nbsp;&nbsp;<br />' . $fname . '
                        </span><br />
                        <span> 
                            <b>Last Name:</b>
                            &nbsp;&nbsp;<br />' . $lname . '
                        </span><br />
                        <span>
                            <b>Email:</b>
                            &nbsp;&nbsp;<br />' . $email . '
                        </span><br />
                        <span>
                            <b>Password:</b>
                            &nbsp;&nbsp;<br /><code>' . $password . '</code>
                        </span><br />
                        <span>
                            <b>Mobile:</b>
                            &nbsp;&nbsp;<br />' . $mobile . '
                        </span><br />
                        <span>
                            <b>No of Grades:</b>
                            &nbsp;&nbsp;<br />' . $gcount . '
                        </span><br />
                        <span>
                            <b>Grade:</b>
                            &nbsp;&nbsp;<br />' . $grades . '
                        </span><br /><br/>

                        <span style="color: #198754; font-weight: 300;">
                            <b>One-Time Verification Code:</b>&nbsp;&nbsp;<code>' . $code . '</code>
                        <span><br/><br/>
                    </section>
                    <section style="font-size: 16px;">
                        <span>The above password is can be changed in Profile after logged in to the System.</span>
                        <span>If you have any problems with your details, you can change them on Profile</span><br/><br/>
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

                    Database::iud("INSERT INTO `academic_officer` (`fname`,`lname`,`mobile`,`gender_id`,`email`,`password`,`verification_code`,`registered_by`,`status_id`,`registered_datetime`) VALUES ('" . $fname . "','" . $lname . "','" . $mobile . "','" . $gender . "','" . $email . "','" . $password . "','" . $code . "','" . $admin . "','1','" . $date . "')");

                    for ($x = 1; $x <= $gcount; $x++) {

                        $grade = $_POST["grade" . $x];
                        Database::iud("INSERT INTO `academic_officer_has_grade` (`grade_id`,`academic_officer_email`) VALUES ('" . $grade . "','" . $email . "')");
                    }

                    echo ($response);
                }
            } else {
                echo ("Academic Officer is already registered from the given Email Address");
            }
        }
    } else {
        echo ("Couldn't find the Admin");
    }
}

if (isset($_GET["st"])) {

    if (isset($_SESSION["academic_officer"])) {

        $admin = $_SESSION["academic_officer"]["email"];

        // echo ("Student Registration Process");

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $mobile = $_POST["mobile"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $grade = $_POST["grade"];
        $index = $_POST["index"];
        $scount = $_POST["count"];

        // echo ($fname." : ".$lname." : ".$mobile." : ".$gender." : ".$email." : ".$password." : ".$scount." : ".$index." : ".$grade);

        if (empty($fname)) {
            echo ("Please enter the First Name");
        } else if (empty($lname)) {
            echo ("Pleae enter the Last Name");
        } else if (empty($mobile)) {
            echo ("Please enter the Mobile Number");
        } else if (strlen($mobile) < 10) {
            echo ("Mobile Number should contain 10 characters");
        } else if (!preg_match("/07[1,2,4,5,6,7,8,0][0-9]/", $mobile)) {
            echo ("Invalid Mobile Number");
        } else if (empty($index)) {
            echo ("Please enter Index No");
        } else if (empty($email)) {
            echo ("Please enter the Email address");
        } else if (strlen($email) > 100) {
            echo ("Email should be less than 100 characters");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo ("Invalid Email");
        } else if (empty($password)) {
            echo ("Please enter the Password");
        } else if (strlen($password) > 25 || strlen($password) < 4) {
            echo ("Password should be contain 4 to 25 characters");
        } else if ($grade == 0) {
            echo ("Please select a Grade");
        } else if ($scount == 0) {
            echo ("Please select Subjects");
        } else if ($scount < 3) {
            echo ("Please select atleast 3 Subjects");
        } else {

            $st_rs = Database::search("SELECT * FROM `student` WHERE `email`='" . $email . "'");
            $st_count = $st_rs->num_rows;

            if ($st_count == 0) {

                $code = uniqid("st_");

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

                $mailSubject = 'LMS Student Registration Details';
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
                            <b>First Name:</b>
                            &nbsp;&nbsp;<br />' . $fname . '
                        </span><br />
                        <span> 
                            <b>Last Name:</b>
                            &nbsp;&nbsp;<br />' . $lname . '
                        </span><br />
                        <span>
                            <b>Email:</b>
                            &nbsp;&nbsp;<br />' . $email . '
                        </span><br />
                        <span>
                            <b>Password:</b>
                            &nbsp;&nbsp;<br /><code>' . $password . '</code>
                        </span><br />
                        <span>
                            <b>Mobile:</b>
                            &nbsp;&nbsp;<br />' . $mobile . '
                        </span><br />
                        <span>
                            <b>Index No:</b>
                            &nbsp;&nbsp;<br />' . $index . '
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

                        <span style="color: #198754; font-weight: 300;">
                            <b>One-Time Verification Code:</b>&nbsp;&nbsp;<code>' . $code . '</code>
                        <span><br/><br/>
                    </section>
                    <section style="font-size: 16px;">
                        <span>The above password is can be changed in Profile after logged in to the System.</span>
                        <span>If you have any problems with your details, you can change them on Profile</span><br/><br/>
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

                    Database::iud("INSERT INTO `student` (`fname`,`lname`,`mobile`,`gender_id`,`email`,`password`,`verification_code`,`academic_officer_email`,`status_id`,`index_no`,`grade_id`,`registered_datetime`,`payment_status_id`) VALUES ('" . $fname . "','" . $lname . "','" . $mobile . "','" . $gender . "','" . $email . "','" . $password . "','" . $code . "','" . $admin . "','1','" . $index . "','" . $grade . "','" . $date . "','1')");

                    for ($x = 1; $x <= $scount; $x++) {

                        $subject = $_POST["subject" . $x];
                        Database::iud("INSERT INTO `student_has_gs` (`grade_has_subject_id`,`student_email`,`enrolled_on`) VALUES ('" . $subject . "','" . $email . "','" . $date . "')");
                    }

                    echo ($response);
                }
            } else {
                echo ("Student is already registered from the given Email Address");
            }
        }
    } else {
        echo ("Couldn't find the Admin");
    }
}
