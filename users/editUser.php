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
                <label for="currentPwd">Current password: </label><br>
                <input name="currentPwd" type="password" id="currentPwd"><br>
                <br>
                <label for="newName">New username: </label><br>
                <input name="newName" type="text" id="newName" value="<?php echo $user;?>"><br>
                <label for="newPwd">New password: </label><br>
                <input name="newPwd" type="password" id="newPwd"><br>
                <label for="checkPwd">New password again: </label><br>
                <input name="checkPwd" type="password" id="checkPwd"><br>
                <input type="submit" class="btn">
            </form>
        </section>
    </body>
</html>