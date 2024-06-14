<?php

// echo ("Update Profile Process");

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$mname = $_POST["mname"];
$sname = $_POST["sname"];
$id = $_POST["id"];
$bday = $_POST["bday"];
$gender = $_POST["gender"];

$mobile = $_POST["mobile"];
$line1 = $_POST["line1"];
$line2 = $_POST["line2"];
$country = $_POST["country"];
$province = $_POST["province"];
$district = $_POST["district"];
$city = $_POST["city"];
$pcode = $_POST["pcode"];

// echo ($fname." : ".$lname." : ".$mname." : ".$sname." : ".$id." : ".$bday." : ".$gender." : "
// .$mobile." : ".$line1." : ".$line2." : ".$country." : ".$province." : ".$district." : ".$city." : ".$pcode);

require "db/connection.php";

session_start();

if (isset($_SESSION["academic_officer"])) {

    $user = $_SESSION["academic_officer"];

    $result = Database::search("SELECT * FROM `academic_officer` WHERE `email`='" . $user["email"] . "'");
    $count = $result->num_rows;

    if ($count > 0) {

        Database::iud("UPDATE `academic_officer` SET `fname`='" . $fname . "', `lname`='" . $lname . "', `mname`='" . $mname . "', `surname`='" . $sname . "', `birthday`='" . $bday . "', `nic`='" . $id . "', `mobile`='" . $mobile . "' WHERE `email`='" . $user["email"] . "'");

        $address_rs = Database::search("SELECT * FROM `address` WHERE `academic_officer_email`='" . $user["email"] . "'");
        $address_count = $address_rs->num_rows;

        if ($address_count == 1) {
            Database::iud("UPDATE `address` SET `city_id`='" . $city . "', `line1`='" . $line1 . "', `line2`='" . $line2 . "', `postal_code`='" . $pcode . "' WHERE `academic_officer_email`='" . $user["email"] . "'");
        } else {
            Database::iud("INSERT INTO `address` (`city_id`,`line1`,`line2`,`postal_code`,`academic_officer_email`) VALUES ('" . $city . "','" . $line1 . "','" . $line2 . "','" . $pcode . "','" . $user["email"] . "')");
        }

        $result = Database::search("SELECT * FROM `academic_officer` WHERE `email`='" . $user["email"] . "'");
        $count = $result->num_rows;

        if ($count == 1) {

            $data = $result->fetch_assoc();
            $_SESSION["academic_officer"] = $data;

        }

        echo ("Profile Update Success");

    } else {
        echo ("System cannot find the Relevant Academic Officer");
    }

} else if (isset($_SESSION["teacher"])) {

    $user = $_SESSION["teacher"];

    $result = Database::search("SELECT * FROM `teacher` WHERE `email`='" . $user["email"] . "'");
    $count = $result->num_rows;

    if ($count > 0) {

        Database::iud("UPDATE `teacher` SET `fname`='" . $fname . "', `lname`='" . $lname . "', `mname`='" . $mname . "', `surname`='" . $sname . "', `birthday`='" . $bday . "', `nic`='" . $id . "', `mobile`='" . $mobile . "' WHERE `email`='" . $user["email"] . "'");

        $address_rs = Database::search("SELECT * FROM `address` WHERE `teacher_email`='" . $user["email"] . "'");
        $address_count = $address_rs->num_rows;

        if ($address_count == 1) {
            Database::iud("UPDATE `address` SET `city_id`='" . $city . "', `line1`='" . $line1 . "', `line2`='" . $line2 . "', `postal_code`='" . $pcode . "' WHERE `teacher_email`='" . $user["email"] . "'");
        } else {
            Database::iud("INSERT INTO `address` (`city_id`,`line1`,`line2`,`postal_code`,`teacher_email`) VALUES ('" . $city . "','" . $line1 . "','" . $line2 . "','" . $pcode . "','" . $user["email"] . "')");
        }

        $result = Database::search("SELECT * FROM `teacher` WHERE `email`='" . $user["email"] . "'");
        $count = $result->num_rows;

        if ($count == 1) {

            $data = $result->fetch_assoc();
            $_SESSION["teacher"] = $data;

        }

        echo ("Profile Update Success");

    } else {
        echo ("System cannot find the Relevant Teacher");
    }

} else if (isset($_SESSION["admin"])) {

    $user = $_SESSION["admin"];

    $result = Database::search("SELECT * FROM `admin` WHERE `email`='" . $user["email"] . "'");
    $count = $result->num_rows;

    if ($count > 0) {

        Database::iud("UPDATE `admin` SET `fname`='" . $fname . "', `lname`='" . $lname . "', `mname`='" . $mname . "', `surname`='" . $sname . "', `birthday`='" . $bday . "', `nic`='" . $id . "', `mobile`='" . $mobile . "' WHERE `email`='" . $user["email"] . "'");

        $address_rs = Database::search("SELECT * FROM `address` WHERE `admin_email`='" . $user["email"] . "'");
        $address_count = $address_rs->num_rows;

        if ($address_count == 1) {
            Database::iud("UPDATE `address` SET `city_id`='" . $city . "', `line1`='" . $line1 . "', `line2`='" . $line2 . "', `postal_code`='" . $pcode . "' WHERE `admin_email`='" . $user["email"] . "'");
        } else {
            Database::iud("INSERT INTO `address` (`city_id`,`line1`,`line2`,`postal_code`,`admin_email`) VALUES ('" . $city . "','" . $line1 . "','" . $line2 . "','" . $pcode . "','" . $user["email"] . "')");
        }

        $result = Database::search("SELECT * FROM `admin` WHERE `email`='" . $user["email"] . "'");
        $count = $result->num_rows;

        if ($count == 1) {

            $data = $result->fetch_assoc();
            $_SESSION["admin"] = $data;

        }

        echo ("Profile Update Success");

    } else {
        echo ("System cannot find the Relevant Admin");
    }

} else {
    echo ("System cannot recognize you as an Valid User.");
}

?>