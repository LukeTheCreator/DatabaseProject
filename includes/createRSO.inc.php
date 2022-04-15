<?php
session_start();

if (isset($_POST["submit"]))
{
    $RSOname = $_POST["RSOname"];
    $university = $_POST["university"];
    $uid = $_SESSION["usersid"];
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyRSOcreate($RSOname, $university) !== false)
    {
        header("location: ../addEvent.php?error=emptyinput");
        exit();
    }

    if(notAdminCheck() !== false)
    {
        header("location: ../addEvent.php?error=notadmin");
        exit();
    }

    createRSO($conn, $RSOname, $university, $uid);
}
else
{
    header("location: ../addEvent.php");
}

function notAdminCheck()
{
    $result;

    if($_SESSION["admin"] == 0 || $_SESSION["admin"] == false)
    {
        $result = true;//they are not an admin
    }
    else
    {
        $result = false;//they are an admin
    }

    return $result;
}