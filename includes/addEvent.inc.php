<?php

if (isset($_POST["submit"]))
{
    $name = $_POST["name"];
    $category = $_POST["category"];
    $description = $_POST["description"];
    $time = $_POST["time"];
    $date = $_POST["date"];
    $location = $_POST["location"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputEvent($name, $category, $description, $time, $date, $location, $phone, $email) !== false)
    {
        header("location: ../signUp.php?error=emptyinput");
        exit();
    }

    if(invalidEmail($email) !== false)
    {
        header("location: ../signUp.php?error=invalidemail");
        exit();
    }

    createEvent($name, $category, $description, $time, $date, $location, $phone, $email);
}
else
{
    header("location: ../addEvent.php");
    exit();
}