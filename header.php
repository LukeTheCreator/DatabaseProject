<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Database Project</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <div class="wrapper">
            <ul>
                <li class="nav"><a href="index.php">Home</a></li>
                <li class="nav"><a href="eventFeed.php">Event Feed</a></li>
                <?php
                    if(isset($_SESSION["usersid"]))
                    {
                        echo "<li class='nav'><a href='addEvent.php'>Add Event</a></li>";
                        echo "<li class='nav'><a href='includes/logout.inc.php'>Log Out</a></li>";
                    }
                    else
                    {
                        echo "<li class='nav'><a href='signUp.php'>Sign Up</a></li>";
                        echo "<li class='nav'><a href='login.php'>Log In</a></li>";
                    }
                ?>
            </ul>
        </div>
    </nav>
    <div class="wrapper">