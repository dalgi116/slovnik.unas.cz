<?php
include '../inc/sessionData.php';
include '../inc/modules.php';
include_once '../inc/dbh.php';

forAdmin($userRole);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta lang="en">
        <title>Edit user</title>
        <link rel="stylesheet" href="../main.css">
    </head>
    <body>
        <section class="right-bar">
            <form action="../words">
                <input type="submit" class="btn" value="GO BACK">
            </form>
        </section>
        <section class="middle-bar">
            <h2>Edit profile</h2>
            <form action="edit.php" method="POST">
                <label for="add-user">User: </label><br>
                <input name="user" type="text" id="add-user"><br>
                <label for="add-pwd">Password: </label><br>
                <input name="pwd" type="password" id="add-pwd"><br>
                <label for="add-pwd2">Password again: </label><br>
                <input name="pwd2" type="password" id="add-pwd2"><br>
                <input type="submit" class="btn">
            </form>
        </section>
    </body>
</html>