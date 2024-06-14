<?php

// echo ("Update Profile Student Process");

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$mname = $_POST["mname"];
$sname = $_POST["sname"];
$id = $_POST["id"];
$bday = $_POST["bday"];
$gender = $_POST["gender"];

$gfname = $_POST["gfname"];
$glname = $_POST["glname"];
$gmname = $_POST["gmname"];
$gsname = $_POST["gsname"];
$gnic = $_POST["gnic"];
$relation = $_POST["relation"];
$gmobile = $_POST["gmobile"];

$mobile = $_POST["mobile"];
$line1 = $_POST["line1"];
$line2 = $_POST["line2"];
$country = $_POST["country"];
$province = $_POST["province"];
$district = $_POST["district"];
$city = $_POST["city"];
$pcode = $_POST["pcode"];

// echo ($fname." : ".$lname." : ".$mname." : ".$sname." : ".$id." : ".$bday." : ".$gender." : "
// .$gfname." : ".$glname." : ".$gmname." : ".$gsname." : ".$gnic." : ".$relation." : ".$gmobile." : "
// .$mobile." : ".$line1." : ".$line2." : ".$country." : ".$province." : ".$district." : ".$city." : ".$pcode);

require "db/connection.php";

session_start();

if (isset($_SESSION["student"])) {

    $user = $_SESSION["student"];

    Database::iud("UPDATE `student` SET `fname`='" . $fname . "', `lname`='" . $lname . "', `mname`='" . $mname . "', `surname`='" . $sname . "', `birthday`='" . $bday . "', `index_no`='" . $id . "', `mobile`='" . $mobile . "' WHERE `email`='" . $user["email"] . "'");

    $address_rs = Database::search("SELECT * FROM `address` WHERE `student_email`='" . $user["email"] . "'");
    $address_count = $address_rs->num_rows;

    if ($address_count == 1) {
        Database::iud("UPDATE `address` SET `city_id`='" . $city . "', `line1`='" . $line1 . "', `line2`='" . $line2 . "', `postal_code`='" . $pcode . "' WHERE `student_email`='" . $user["email"] . "'");
    } else {
        Database::iud("INSERT INTO `address` (`city_id`,`line1`,`line2`,`postal_code`,`student_email`) VALUES ('" . $city . "','" . $line1 . "','" . $line2 . "','" . $pcode . "','" . $user["email"] . "')");
    }

    $student_rs = Database::search("SELECT * FROM `student` WHERE `email`='" . $user["email"] . "'");
    $student_count = $student_rs->num_rows;

    if ($student_count == 1) {

        $student_data = $student_rs->fetch_assoc();

        $guardian_id;
        if ($student_data["guardian_id"] != 0 || $student_data["guardian_id"] != null || $student_data["guardian_id"] != NULL) {

            Database::iud("UPDATE `guardian` SET `fname`='" . $gfname . "', `lname`='" . $glname . "', `mname`='" . $gmname . "', `surname`='" . $gsname . "', `mobile`='" . $gmobile . "', `nic`='" . $gnic . "', `relationship_id`='" . $relation . "' WHERE `id` = '" . $student_data["guardian_id"] . "'");
            $guardian_id = $student_data["guardian_id"];
            echo ("Profile Update Success");

        } else {

            Database::iud("INSERT INTO `guardian` (`fname`, `lname`, `mname`, `surname`, `mobile`, `nic`, `relationship_id`) VALUES('" . $gfname . "', '" . $glname . "', '" . $gmname . "', '" . $gsname . "', '" . $gmobile . "', '" . $gnic . "', '" . $relation . "')");
            $guardian_id = Database::$connection->insert_id;
            Database::iud("UPDATE `student` SET `guardian_id`='" . $guardian_id . "' WHERE `email`='" . $user["email"] . "'");

            echo ("Profile Update Success");

        }

        $_SESSION["student"] = $student_data;
        $_SESSION["student"]["guardian_id"] = $guardian_id;

    } else {
        echo ("System cannot find the relevant Student");
    }

} else {
    echo ("System cannot recognize you as an student.");
}

?>