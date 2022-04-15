<?php

function emptyInputSignup($university, $email, $username, $pwd, $pwdrepeat)
{
    $result;

    if(empty($university) || empty($email) || empty($username) || empty($pwd) || empty($pwdrepeat))
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

    if(!preg_match("/^[a-zA-Z0-9 ]*$/", $username))
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

function adminSuperAdmin($admin, $superadmin)
{
    $result;

    if($admin == $superadmin && $admin == true)
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function createUser($conn, $university, $email, $username, $pwd, $admin, $superadmin)
{
    $sql = "INSERT INTO users (university, username, password, email, admin, superadmin) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../signUp.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    if(is_null($admin))
    {
        $admin = 0;
    }
    else
    {
        $admin = 1;
    }
    if(is_null($superadmin))
    {
        $superadmin = 0;
    }
    else
    {
        $superadmin = 1;
    }

    mysqli_stmt_bind_param($stmt, "ssssss", $university, $username, $hashedPwd, $email, $admin, $superadmin);
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

function emptyInputEvent($name, $category, $description, $time, $date, $phone, $email, $university, $location, $latitude, $longitude)
{
    $result;

    if(empty($name) || empty($category) || empty($description) || empty($time) || empty($date) || empty($location) || empty($phone) || empty($email) || empty($university) || empty($latitude) || empty($longitude))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function createEvent($conn, $name, $category, $description, $time, $date, $phone, $email, $university, $rsoname, $location, $latitude, $longitude)
{
    $sql = "INSERT INTO events (name, category, description, time, date, phone, email, university, rsoname, location, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../signUp.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssssssss", $name, $category, $description, $time, $date, $phone, $email, $university, $rsoname, $location, $latitude, $longitude);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../addEvent.php?error=none");
    exit();
}

function getEvents($conn)
{
    $sql = "SELECT * FROM events ORDER BY eventID ASC;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../signUp.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    return $resultData;
}

function emptyComment($eventID, $text, $rating)
{
    $result;

    if(empty($eventID) || empty($text) || empty($rating))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function createComment($conn, $eventID, $uid, $text, $rating)
{
    $sql = "INSERT INTO comments (eventID, uid, text, rating) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../eventFeed.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss", $eventID, $uid, $text, $rating);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../eventFeed.php?error=none");
    exit();
}

function getComments($conn)
{
    $sql = "SELECT * FROM comments ORDER BY commentID ASC;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: ../signUp.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    return $resultData;
}