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
    <div>

<section>
    <h1>Current Events</h1>
    <table>
        <tr>
            <th>Event Num</th>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Time</th>
            <th>Date</th>
            <th>Phone</th>
            <th>Email</th>
            <th>University</th>
            <th>RSO Name</th>
            <th>Location</th>
            <th>Latitude</th>
            <th>Longitude</th>
        </tr>
        <?php
        require_once 'includes/dbh.inc.php';
        require_once 'includes/functions.inc.php';
        $events = getEvents($conn);
        while($rows=$events->fetch_assoc())
        {
        ?>
        <tr>
            <td>
                <?php echo $rows['eventID'];?>
            </td>
            <td>
                <?php echo $rows['name'];?>
            </td>
            <td>
                <?php echo $rows['category'];?>
            </td>
            <td>
                <?php echo $rows['description'];?>
            </td>
            <td>
                <?php echo $rows['time'];?>
            </td>
            <td>
                <?php echo $rows['date'];?>
            </td>
            <td>
                <?php echo $rows['phone'];?>
            </td>
            <td>
                <?php echo $rows['email'];?>
            </td>
            <td>
                <?php echo $rows['university'];?>
            </td>
            <td>
                <?php echo $rows['RSOname'];?>
            </td>
            <td>
                <?php echo $rows['location'];?>
            </td>
            <td>
                <?php echo $rows['latitude'];?>
            </td>
            <td>
                <?php echo $rows['longitude'];?>
            </td>
        </tr>
        <?php
                }
        ?>
    </table>
    <br />
    <h1>Comment on an event!</h1>
    <div class="wrapper">
        <form action="includes/eventFeed.inc.php" method="post">            
            <input type="number" name="eventID" placeholder="Event num..." />
            <input type="text" name="text" placeholder="Comment..." /><br />
            <label for="rating">Rate the event! 1-5</label><br />
            <input type="number" name="rating" placeholder="Rating..." /><br />
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
    <?php
    if(isset($_GET["error"]))
    {
        if($_GET["error"] == "emptyinput")
        {
            echo "<p>Fill in all fields</p>";
        }
        if($_GET["error"] == "notloggedin")
        {
            echo "<p>You must be logged in to leave a comment</p>";
        }
        else if($_GET["error"] == "none")
        {
            echo "<p>Comment creation successful!</p>";
        }
    }
    ?>
    <br />
    <h1>Comments</h1>
    <table>
        <tr>
            <th>Comment Num</th>
            <th>Event Num</th>
            <th>User ID</th>
            <th>Text</th>
            <th>Rating</th>
        </tr>
        <?php
        require_once 'includes/dbh.inc.php';
        require_once 'includes/functions.inc.php';
        $comments = getComments($conn);
        while($rows=$comments->fetch_assoc())
        {
        ?>
        <tr>
            <td>
                <?php echo $rows['commentID'];?>
            </td>
            <td>
                <?php echo $rows['eventID'];?>
            </td>
            <td>
                <?php echo $rows['uid'];?>
            </td>
            <td>
                <?php echo $rows['text'];?>
            </td>
            <td>
                <?php echo $rows['rating'];?>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    
</section>

<?php include_once 'footer.php'; ?>