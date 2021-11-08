<?php
session_start();
include 'inc/modules.php';

resetSession();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta lang="en">
        <title>Přihlášení</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <section class="middle-site">
            <div class="hero">
                <h1 class="no-margin">Vítejte</h1>
                <p>
                    <strong>na stránkách slovnik.unas.cz!</strong><br><br>
                    Naleznete zde česko-anglický slovník studenta Gymnázia
                    Roudnice nad Labem, jenž se o tyto stránky stará a programuje je.
                </p>
            </div>

            <div class="middle-bar">
                <h2>Přihlášení</h2>
                <form action="logIn.php" method="POST">
                    <label for="user">Přihlašovací jméno: </label><br>
                    <input type="text" name="user" id="user"><br>
                    <label for="pwd">Heslo: </label><br>
                    <input type="password" name="pwd" id="pwd"><br>
                    <input type="submit" class="main-btn">
                </form>
                <p>NEBO</p>
                <form action="words">
                    <input type="submit" class="btn" value="Přihlásit se jako host">
                </form>
            </div>
        </section>
    </body>
</html>