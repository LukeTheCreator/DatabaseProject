<?php
session_start();

if (isset($_POST["submit"]))
{
    $eventID = $_POST["eventID"];
    $text = $_POST["text"];
    $rating = $_POST["rating"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyComment($eventID, $text, $rating) !== false)
    {
        header("location: ../eventFeed.php?error=emptyinput");
        exit();
    }

    if(isset($_SESSION["usersid"]))//check if user is logged in
    {
        $uid = $_SESSION["usersid"];//get the logged in users ID
    }
    else
    {
        header("location: ../eventFeed.php?error=notloggedin");
        exit();
    }

    createComment($conn, $eventID, $uid, $text, $rating);
}
else
{
    header("location: ../eventFeed.php");
    exit();
}