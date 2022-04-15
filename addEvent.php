<?php include_once 'header.php'; ?>

<section>
    <h1>Add Event</h1>
    <div>
        <form action="includes/addEvent.inc.php" method="post">
            <input type="text" name="name" placeholder="Event name..." />
            <label for="category">Choose a category:</label>
            <select id="category" name="category">
              <option value="RSO">RSO</option>
              <option value="Private">Private</option>
              <option value="Public">Public</option>
            </select><br />
            <input type="text" name="description" placeholder="Description..." />
            <input type="time" name="time" placeholder="Time..." />
            <input type="date" name="date" placeholder="Date..." />
            <input type="tel" name="phone" placeholder="Contact phone num..." />
            <input type="email" name="email" placeholder="Contact email..." /><br />
            <label for="university">Choose a University:</label>
            <select id="university" name="university">
              <option value="UCF">UCF</option>
              <option value="USF">USF</option>
            </select><br />
            <input type="text" name="rsoname" placeholder="RSO name..." />
            <input type="text" name="location" placeholder="Location..." />
            <input type="number" name="latitude" placeholder="Latitude..." />
            <input type="number" name="longitude" placeholder="Longitude..." /><br />
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

<?php include_once 'footer.php'; ?>