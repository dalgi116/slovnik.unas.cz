<?php
include '../inc/sessionData.php';
include '../inc/modules.php';
include_once '../inc/dbh.php';

forSuperadmin($userRole);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta lang="en">
        <title>Správa uživatelů</title>
        <link rel="stylesheet" href="../main.css">
    </head>
    <body>
        <h1>Uživatelé</h1>
        <section class="list">
            <div class="left-bar">
                <div>
                    <h2>Přidat uživatele</h2>
                    <?php
                    if (!isset($_GET['userAdd'])) {
                        echo '<img class="img-add" src="../img/itemAddEmpty.svg" alt="itemAddEmpty.svg">';
                    }
                    else {
                        if ($_GET['userAdd'] == 'success') {
                            echo '<img class="img-add" src="../img/itemAddSuccess.svg" alt="itemAddSuccess.svg">';
                        }
                        else {
                            echo '<img class="img-add" src="../img/itemAddFailed.svg" alt="itemAddFailed.svg">';
                        }
                    }
                    ?> 
                </div>
                <form action="add.php" method="POST">
                    <label for="add-user">Přihlašovací jméno: </label><br>
                    <input name="user" type="text" id="add-user"><br>
                    <label for="add-pwd">Heslo: </label><br>
                    <input name="pwd" type="password" id="add-pwd"><br>
                    <label for="add-pwd2">Heslo znovu: </label><br>
                    <input name="pwd2" type="password" id="add-pwd2"><br>
                    <input type="submit" class="btn">
                </form>
            </div>
            <div class="right-bar">
                <form action="../words">
                    <input type="submit" class="btn-large" value="ZPĚT">
                </form>
            </div>
            <?php
            $sqlGetUsers = "SELECT * FROM  users;";
            $sqlResult = $conn->query($sqlGetUsers);
            if ($sqlResult->num_rows > 0) {
                echo '
                <table>
                    <tr>
                        <th>Jméno</th>
                        <th>Pozice</th>
                        <th>Smazat</th>
                ';
                while ($user = $sqlResult->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $user['user'] . '</td>';
                    echo '<td>' . $user['role'] . '</td>';
                    if ($user['role'] !== 'superadmin') {
                        echo '<td><a href="remove.php?itemId=' . $user['id'] . '"><img src="../img/deleteIcon.svg" alt="Delete_item_icon" width="40em" heigh="40em"></a></td>';
                    }
                    echo '</tr>';
                }
                echo '
                </table>
                ';
            }
            else {
                echo '<i>No users has been found.</i>';
            }
            ?>
        </section>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <section class="bottom">
            <p>
                © 2021 Daniel Franc<br>
                V případě potíží zanechte feedback na <a style="text-decoration: none;" href="https://github.com/dalgi116/slovnik.unas.cz/issues">ZDE</a>.
            </p>
        </section>
    </body>
</html>