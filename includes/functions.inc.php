<?php

function emptyInputSignup($email, $username, $pwd, $pwdrepeat)
{
    $result;

    if(empty($email) || empty($username) || empty($pwd) || empty($pwdrepeat))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function invalidUsername($username)
{
    $result;

    if(!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function invalidEmail($email)
{
    $result;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function pwdMatch($pwd, $pwdrepeat)
{
    $result;

    if($pwd !== $pwdrepeat)
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function usernameExists($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../signUp.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData))
    {
        mysqli_stmt_close($stmt);
        return $row;
    }
    else
    {
        $result = false;
        mysqli_stmt_close($stmt);
        return $result;
    }
}

function createUser($conn, $email, $username, $pwd, $pwdrepeat)
{
    $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../signUp.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPwd, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../signUp.php?error=none");
    exit();
}

function emptyInputLogin($username, $pwd)
{
    $result;

    if(empty($username) || empty($pwd))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function loginUser($conn, $username, $pwd)
{
    $usernameExists = usernameExists($conn, $username, $username);

    if($usernameExists === false)
    {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $usernameExists["password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false)
    {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if($checkPwd === true)
    {
        session_start();
        $_SESSION["usersid"] = $usernameExists["uid"];
        $_SESSION["usersname"] = $usernameExists["username"];
        header("location: ../index.php");
        exit();
    }
}