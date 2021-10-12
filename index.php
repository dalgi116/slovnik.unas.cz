<?php
include 'inc/sessionData.php';
include 'inc/modules.php';

resetSession();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta lang="en">
        <title>Welcome</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <section class="hero">
            <h1>WELCOME</h1>

            <div class="container">
                <p>Some text will be here...</p>
            </div>
        </section>

        <section class="sign-in">
            <h2>Sign in</h2>
            <form action="words/list.php" method="POST">
                <label for="user">Username: </label><br>
                <input type="text" name="user" id="user"><br>
                <label for="pwd">Password: </label><br>
                <input type="password" name="pwd" id="pwd"><br>
                <input type="submit" class="main-btn">
            </form>
            <p>OR</p>
            <form action="words/list.php">
                <input type="submit" class="btn" value="Sign as guest">
            </form>
        </section>
    </body>
</html>