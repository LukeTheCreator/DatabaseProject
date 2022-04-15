<?php
session_start();

if (isset($_POST["submit"]))
{
    $RSOname = $_POST["RSOname"];
    $uid = $_SESSION["usersid"];
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyRSO($RSOname) !== false)
    {
        header("location: ../addEvent.php?error=emptyinput");
        exit();
    }

    joinRSO($conn, $RSOname, $uid);
}
else
{
    header("location: ../addEvent.php");
}