<?php

// echo ("Pay Complete Process");

session_start();

require "db/connection.php";

if (isset($_SESSION["student"])) {

    $user = $_SESSION["student"];

    $mail = $_POST["mail"];
    $type = $_POST["type"];

    // echo ($mail);

    if ($type == "enrollment_fee") {

        Database::iud("UPDATE `student` SET `payment_status_id`='2' WHERE `email`='" . $mail . "'");

        $_SESSION["student"]["payment_status_id"] = 2;

        echo ("1");

    } else if ($type == "subscription") {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        $subscription_rs = Database::search("SELECT * FROM `subscription`");
        $subscription_data = $subscription_rs->fetch_assoc();

        Database::iud("INSERT INTO `student_has_subscription` (`student_email`,`subscription_id`,`validity`) VALUES ('" . $mail . "','" . $subscription_data["id"] . "','" . $date . "')");

        echo ("2");

    }

} else {
    echo ("Please Sign in or Register");
}

?>