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
        <title>Úprava uživatelského profilu</title>
        <link rel="stylesheet" href="../main.css">
    </head>
    <body>
        <section class="right-bar">
            <form action="../words">
                <input type="submit" class="btn-large" value="ZPĚT">
            </form>
        </section>
        <section class="middle-bar">
            <h2>Upravit profil</h2>
            <form action="edit.php" method="POST">
                <label for="currentPwd">Současné heslo: </label><br>
                <input name="currentPwd" type="password" id="currentPwd"><br>
                <br>
                <label for="newName">Nové přihlašovací jméno: </label><br>
                <input name="newName" type="text" id="newName" value="<?php echo $user;?>"><br>
                <label for="newPwd">Nové heslo: </label><br>
                <input name="newPwd" type="password" id="newPwd"><br>
                <label for="checkPwd">Nové heslo znovu: </label><br>
                <input name="checkPwd" type="password" id="checkPwd"><br>
                <input type="submit" class="btn">
            </form>
        </section>
    </body>
</html>