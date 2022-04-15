<?php

if (isset($_POST["submit"]))
{
    $name = $_POST["name"];
    $category = $_POST["category"];
    $description = $_POST["description"];
    $time = $_POST["time"];
    $date = $_POST["date"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $university = $_POST["university"];
    $rsoname = $_POST["rsoname"];
    $location = $_POST["location"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputEvent($name, $category, $description, $time, $date, $phone, $email, $university, $location, $latitude, $longitude) !== false)
    {
        header("location: ../signUp.php?error=emptyinput");
        exit();
    }

    if(invalidEmail($email) !== false)
    {
        header("location: ../signUp.php?error=invalidemail");
        exit();
    }

    createEvent($conn, $name, $category, $description, $time, $date, $phone, $email, $university, $rsoname, $location, $latitude, $longitude);
}
else
{
    header("location: ../addEvent.php");
    exit();
}