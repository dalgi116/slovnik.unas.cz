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
        <title>Správa kategorií</title>
        <link rel="stylesheet" href="../main.css">
    </head>
    <body>
        <h1>Kategorie</h1>
        <section class="list">
            <div class="left-bar">
                <div class="add">
                    <div>
                        <h2>Přidat kategorii</h2>
                        <?php
                        if (!isset($_GET['lectionAdd'])) {
                            echo '<img class="img-add" src="../img/itemAddEmpty.svg" alt="itemAddEmpty.svg">';
                        }
                        else {
                            if ($_GET['lectionAdd'] == 'success') {
                                echo '<img class="img-add" src="../img/itemAddSuccess.svg" alt="itemAddSuccess.svg">';
                            }
                            else {
                                echo '<img class="img-add" src="../img/itemAddFailed.svg" alt="itemAddFailed.svg">';
                            }
                        }
                        ?> 
                    </div>
                    <form action="add.php" method="POST">
                        <label for="add-lection">Název kategorie: </label><br>
                        <input name="name" type="text" id="add-name"><br>
                        <input type="submit" class="btn">
                    </form>
                </div>
                <div class="edit">
                    <h2>Přejmenovat</h2>
                    <form action="edit.php" method="POST">
                        <label for="name-old">Původní název: </label><br>
                        <select id="name-old" name="nameOld">
                            <?php
                            $sqlGetItems = "SELECT * FROM lections;";
                            $sqlResult = $conn->query($sqlGetItems);
                            while ($lection = $sqlResult->fetch_assoc()) {
                                if ($lection['name'] !== '-default-') {
                                    echo '<option value="' . $lection['name'] . '">' . $lection['name'] . '</option>';
                                }
                            }
                            ?>
                        </select><br>
                        <label for="name-new">Nový název: </label><br>
                        <input type="text" id="name-new" name="nameNew"><br>
                        <input type="submit" class="btn">
                    </form>
                </div>
            </div>
            <div class="right-bar">
                <form action="../words">
                    <input type="submit" class="btn-large" value="ZPĚT">
                </form>
            </div>
            <?php
            $sqlGetLections = "SELECT * FROM  lections;";
            $sqlResult = $conn->query($sqlGetLections);
            if ($sqlResult->num_rows > 0) {
                echo '
                <table>
                    <tr>
                        <th>Název</th>
                        <th>Datum přidání</th>
                        <th>Přidal</th>
                        <th>Smazat</th>
                ';
                while ($lection = $sqlResult->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $lection['name'] . '</td>';
                    echo '<td>' . $lection['date'] . '</td>';
                    echo '<td>' . $lection['user'] . '</td>';
                    if ($lection['name'] !== '-default-') {
                        echo '<td><a href="remove.php?itemId=' . $lection['id'] . '"><img src="../img/deleteIcon.svg" alt="Delete_item_icon" width="40em" heigh="40em"></a></td>';
                    }
                    echo '</tr>';
                }
                echo '
                </table>
                ';
            }
            else {
                echo '<i>Žádné lekce nebyly nalezeny.</i>';
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