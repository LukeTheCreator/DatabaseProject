<?php include_once 'header.php'; ?>

<section>
    <h1>Sign Up</h1>
    <div>
        <form action="includes/signup.inc.php" method="post">
            <label for="university">Choose a University:</label>
            <select id="university" name="university">
              <option value="UCF">UCF</option>
              <option value="USF">USF</option>
            </select><br />
            <input type="text" name="email" placeholder="Email..." />
            <input type="text" name="username" placeholder="Username..." />
            <input type="password" name="pwd" placeholder="Password..." />
            <input type="password" name="pwdrepeat" placeholder="Repeat Password..." /><br />
            <input type="checkbox" name="admin"/>
            <label for="admin">Admin?</label><br />
            <input type="checkbox" name="superadmin"/>
            <label for="superadmin">SuperAdmin?</label><br />
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </div>
    <?php
    if(isset($_GET["error"]))
    {
        if($_GET["error"] == "emptyinput")
        {
            echo "<p>Fill in all fields</p>";
        }
        else if($_GET["error"] == "invalidusername")
        {
            echo "<p>Choose a proper username</p>";
        }
        else if($_GET["error"] == "invalidemail")
        {
            echo "<p>Type email in correct format: example@email.com</p>";
        }
        else if($_GET["error"] == "passwordsdontmatch")
        {
            echo "<p>Passwords dont match</p>";
        }
        else if($_GET["error"] == "stmtfailed")
        {
            echo "<p>Something went wrong, please try again</p>";
        }
        else if($_GET["error"] == "usernametaken")
        {
            echo "<p>Username is already taken</p>";
        }
        else if($_GET["error"] == "adminandsuper")
        {
            echo "<p>Cannot be both an admin and superadmin</p>";
        }
        else if($_GET["error"] == "none")
        {
            echo "<p>Sign up successful!</p>";
        }
    }
    ?>
</section>

<?php include_once 'footer.php'; ?>