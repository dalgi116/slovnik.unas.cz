<?php
include '../inc/sessionData.php';
include_once '../inc/dbh.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta lang="en">
        <title>Slovník</title>
        <link rel="stylesheet" href="../main.css">
    </head>
    <body>
        <h1>Česko-anglický slovník</h1>
        <section class="list">
            <div class="left-bar">
               <?php
                if (isset($user)) {
                    echo '
                    <div class="add">
                        <div>
                            <h2>Přidat slovíčka</h2> ';
                    if (!isset($_GET['wordAdd'])) {
                        echo '<img class="img-add" src="../img/itemAddEmpty.svg" alt="itemAddEmpty.svg">';
                    }
                    else {
                        if ($_GET['wordAdd'] == 'success') {
                            echo '<img class="img-add" src="../img/itemAddSuccess.svg" alt="itemAddSuccess.svg">';
                        }
                        else {
                            echo '<img class="img-add" src="../img/itemAddFailed.svg" alt="itemAddFailed.svg">';
                        }
                    }
                    echo '
                        </div>
                        <form action="add.php" method="POST">
                            <input name="user" type="hidden" value="' . $user . '">
                            <label for="add-english">Anglicky: </label><br>
                            <input name="english" type="text" id="add-english"><br>
                            <label for="add-czech">Česky: </label><br>
                            <input name="czech" type="text" id="add-czech"><br>
                            <label for="add-description">Popis: </label><br>
                            <input name="description" type="text" id="add-description"><br>
                            <input type="submit" class="btn">
                        </form>
                    </div>';
                }
                ?>
                <div class="search">
                    <h2>Vyhledat</h2>
                    <form action="/words">
                        <input type="text" name="search"><br>
                        <input type="submit" class="btn">
                    </form>
                </div>
                <div class="sort">
                    <h2>Seřadit</h2>
                    <form action="/words">
                        <p>
                        <input type="radio" id="sort-name-en" name="sortBy" value="en">
                        <label for="sort-name-en">A-Z (EN)</label> | 
                        <input type="radio" id="sort-name-cz" name="sortBy" value="cz">
                        <label for="sort-name-cz">A-Z (CZ)</label> | 
                        <input type="radio" id="sort-date" name="sortBy" value="date">
                        <label for="sort-date">Datum</label>
                        <br>
                        <input type="radio" id="sort-ascending" name="sortOrder" value="asc">
                        <label for="sort-ascending">Vzestupně</label> | 
                        <input type="radio" id="sort-descending" name="sortOrder" value="desc">
                        <label for="sort-descending">Sestupně</label><br>
                        <input type="submit" class="btn">
                        </p>
                    </form>
                </div>
                <div class="restore">
                    <form action="/words">
                        <input type="submit" class="btn-large" value="OBNOVIT PŮVODNÍ">
                    </form>
                </div>
            </div>
            <div class="right-bar">
                <?php
                if (isset($user)) {
                    echo '
                        <p><b>Aktivní uživatel: </b>' . $user . '</p>
                        <form action="../users/editUser.php" method="POST">
                            <input type="submit" class="btn" name="confirm" value="Upravit profil">
                        </form>
                    ';
    
                    if ($userRole == 'superadmin') {
                        echo '
                        <form action="../users" method="POST">
                            <input type="submit" class="btn" name="confirm" value="Spravovat uživatele">
                        </form>';
                    }
                }
                else {
                    echo '<p><b>Aktivní uživatel: </b>host</p>';   
                }
                ?>
                <form action="../index.php">
                    <input type="submit" class="btn" value="Odhlásit se">
                </form>
            </div>
            
            <?php
            if (isset($_GET['search'])) {
                $searchedWord = $_GET['search'];
                $sqlGetItems = "SELECT * FROM  words WHERE cz = '$searchedWord' OR en = '$searchedWord';";    
            }
            else {
                if (isset($_GET['sortBy'])) {
                    $sortBy = $_GET['sortBy'];
                    if (isset($_GET['sortOrder'])) {
                        $sortOrder = $_GET['sortOrder'];
                    }
                    else {
                        $sortOrder = 'asc';
                    }
                }
                else {
                    $sortBy = 'en';
                    $sortOrder = 'asc';
                }
                # Order swap for the date format
                if ($sortBy == 'date') {
                    if ($sortOrder == 'asc') {
                        $sortOrder = 'desc';
                    }
                    else if ($sortOrder == 'desc') {
                        $sortOrder = 'asc';
                    }
                }

                $sqlGetItems = "SELECT * FROM  words ORDER BY " . $sortBy . " " . $sortOrder . ";";
                
            }
            $sqlResult = $conn->query($sqlGetItems);
            if ($sqlResult->num_rows > 0) {
                echo '
                <table>
                    <tr>
                        <th>Anglicky</th>
                        <th>Česky</th>
                        <th>Popis</th>
                        <th>Datum přidání</th>
                ';
                if ($userRole == 'superadmin') {
                    echo '<th>Přidal</th>';
                }
                if (isset($user)) {
                    echo '<th>Smazat</th>';
                }
                echo '</tr>';

                while ($word = $sqlResult->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $word['en'] . '</td>';
                    echo '<td>' . $word['cz'] . '</td>';
                    echo '<td>' . $word['des'] . '</td>';
                    echo '<td>' . $word['date'] . '</td>';
                    if ($userRole == 'superadmin') {
                        echo '<td>' . $word['user'] . '</td>';
                    }
                    if (isset($user)) {
                        echo '<td><a href="remove.php?itemId=' . $word['id'] . '"><img src="../img/deleteIcon.svg" alt="Delete_item_icon" width="40em" heigh="40em"></a></td>';
                    }
                    echo '</tr>';
                }
                echo '
                </table>
                ';
            }
            else {
                echo '<i style="text-align: center;">Žádná slovíčka nebyla nalezena.</i>';
            }
            ?>
        </section>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <section class="bottom">
        <p>
                © 2021 Daniel Franc<br>
                V případě potíží zanechte feedback <a style="text-decoration: none;" href="https://github.com/dalgi116/slovnik.unas.cz/issues">ZDE</a>.
            </p>
        </section>
    </body>
</html>