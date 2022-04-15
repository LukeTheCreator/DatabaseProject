<?php

if (isset($_POST["submit"]))
{
    $university = $_POST["university"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];
    $admin = $_POST["admin"];
    $superadmin = $_POST["superadmin"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($university, $email, $username, $pwd, $pwdrepeat) !== false)
    {
        header("location: ../signUp.php?error=emptyinput");
        exit();
    }

    if(invalidUsername($username) !== false)
    {
        header("location: ../signUp.php?error=invalidusername");
        exit();
    }

    if(invalidEmail($email) !== false)
    {
        header("location: ../signUp.php?error=invalidemail");
        exit();
    }

    if(pwdMatch($pwd, $pwdrepeat) !== false)
    {
        header("location: ../signUp.php?error=passwordsdontmatch");
        exit();
    }

    if(usernameExists($conn, $username, $email) !== false)
    {
        header("location: ../signUp.php?error=usernametaken");
        exit();
    }

    if(adminSuperAdmin($admin, $superadmin) !== false)
    {
        header("location: ../signUp.php?error=adminandsuper");
        exit();
    }

    createUser($conn, $university, $email, $username, $pwd, $admin, $superadmin);
}
else
{
    header("location: ../signUp.php");
    exit();
}