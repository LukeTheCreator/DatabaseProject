<?php include_once 'header.php' ?>

<section>
    <h1>Add Event</h1>
    <div>
        <form action="includes/addEvent.inc.php" method="post">
            <input type="text" name="name" placeholder="Event name..." />
            <input type="text" name="category" placeholder="Category..." />
            <input type="text" name="description" placeholder="Description..." />
            <input type="time" name="time" placeholder="Time..." />
            <input type="date" name="date" placeholder="Date..." />
            <input type="text" name="location" placeholder="Location..." />
            <input type="tel" name="phone" placeholder="Contact phone num..." />
            <input type="email" name="email" placeholder="Contact email..." />
            <button type="submit" name="submit">Create Event</button>
        </form>
    </div>
    <?php
    if(isset($_GET["error"]))
    {
        if($_GET["error"] == "emptyinput")
        {
            echo "<p>Fill in all fields</p>";
        }
        else if($_GET["error"] == "invalidemail")
        {
            echo "<p>Type email in correct format: example@email.com</p>";
        }
        else if($_GET["error"] == "none")
        {
            echo "<p>Event creation successful!</p>";
        }
    }
    ?>
</section>

<?php include_once 'footer.php' ?>