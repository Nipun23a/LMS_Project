<?php

// echo ("Reset Password Process");

require "db/connection.php";

if (isset($_POST["user"])) {

    $user = $_POST["user"];

    if (isset($_POST["email"])) {

        $email = $_POST["email"];

        $user_rs = Database::search("SELECT * FROM `" . $user . "` WHERE `email`='" . $email . "'");
        $user_count = $user_rs->num_rows;

        if ($user_count == 1) {

            $user_data = $user_rs->fetch_assoc();

            $password = $_POST["password"];
            $check = $_POST["check"];

            if (empty($password)) {
                echo ("Enter your New Password");
            } else if (empty($check)) {
                echo ("Please re-enter your New Password");
            } else if (strlen($password) > 30 || strlen($password) < 3) {
                echo ("Password should contain 4 to 30 characters");
            } else if ($password != $check) {
                echo ("Passwords do not match. Please check again");
            } else if ($password == $user_data["password"]) {
                echo ("You've entered an old password. Please enter a new password.");
            } else {

                if (!empty($_POST["vcode"])) {

                    if (isset($_POST["vcode"])) {

                        $vcode = $_POST["vcode"];

                        if ($user_data["verification_code"] == $vcode) {

                            Database::iud("UPDATE `" . $user . "` SET `password`='" . $password . "' WHERE `email`='" . $email . "'");

                            echo ("success");

                        } else {
                            echo ("Invalid Verification Code. Check your inbox for latest Verification Code.");
                        }
                    } else {
                        echo ("Invalid Verification Code");
                    }
                } else {
                    echo ("Please enter your Verification Code");
                }
            }
        } else {
            echo ("Invalid User. Please try agian or register");
        }
    } else {
        echo ("Invalid Email");
    }
} else {
    echo ("Cannot identify the user");
}

?>