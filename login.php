<?php include_once 'header.php'; ?>

<section>
    <h1>Log In</h1>
    <div>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="username" placeholder="Username/Email..." />
            <input type="password" name="pwd" placeholder="Password..." />
            <button type="submit" name="submit">Log In</button>
        </form>
    </div>
    <?php
    if(isset($_GET["error"]))
    {
        if($_GET["error"] == "emptyinput")
        {
            echo "<p>Fill in all fields</p>";
        }
        else if($_GET["error"] == "wronglogin")
        {
            echo "<p>incorrect username or password</p>";
        }
    }
    ?>
</section>

<?php include_once 'footer.php'; ?>