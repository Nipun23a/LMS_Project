<?php

// echo ("Sign Out Process");

require "db/connection.php";

session_start();

if (isset($_SESSION["student"])) {

    $email = $_SESSION["student"]["email"];

    $_SESSION["student"] = null;

    session_destroy();

    echo ("student");

    // header("Location:index.php?student");

} else if (isset($_SESSION["teacher"])) {

    $email = $_SESSION["teacher"]["email"];

    $_SESSION["teacher"] = null;

    session_destroy();

    echo ("teacher");

    // header("Location:index.php?teacher");

} else if (isset($_SESSION["academic_officer"])) {

    $email = $_SESSION["academic_officer"]["email"];

    $_SESSION["academic_officer"] = null;

    session_destroy();

    echo ("academic_officer");

    // header("Location:index.php?academic_officer");

} else if (isset($_SESSION["admin"])) {

    $email = $_SESSION["admin"]["email"];

    $_SESSION["admin"] = null;

    session_destroy();

    echo ("admin");

    // header("Location:index.php?admin");

}

// header("Location:index.php");

?>