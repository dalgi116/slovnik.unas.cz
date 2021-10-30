<?php
include '../inc/sessionData.php';
include_once '../inc/dbh.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta lang="en">
        <title>List of words</title>
        <link rel="stylesheet" href="../main.css">
    </head>
    <body>
        <h1>English - Czech vocabulary</h1>
        <section class="right-bar">
            <?php
            if (isset($user)) {
                echo '<p><b>Active user: </b>' . $user . '</p>';

                if ($userRole == 'superadmin') {
                    echo '
                    <form action="../users" method="POST">
                        <input type="submit" class="btn" name="confirm" value="Manage users">
                    </form>';
                }
            }
            else {
                echo '<p><b>Active user: </b>guest</p>';   
            }
            ?>
            <form action="../index.php">
                <input type="submit" class="log-out-btn" value="Log out">
            </form>
        </section>
        <section class="left-bar">
           <?php
            if (isset($user)) {
                echo '
                <div class="add">
                    <h2>Add words</h2>
                    <form action="add.php" method="POST">
                        <input name="user" type="hidden" value="' . $user . '">
                        <label for="add-english">English: </label><br>
                        <input name="english" type="text" id="add-english"><br>
                        <label for="add-czech">Czech: </label><br>
                        <input name="czech" type="text" id="add-czech"><br>
                        <label for="add-description">Description: </label><br>
                        <input name="description" id="add-description"><br>
                        <input type="submit" class="btn">
                    </form>
                </div>';
            }
            ?>
            <div class="search">
                <h2>Search words</h2>
                <form action="/words">
                    <input type="text" name="search"><br>
                    <input type="submit" class="btn">
                </form>
            </div>
            <div class="sort">
                <h2>Sort words</h2>
                <form action="/words">
                    <p>
                    <input type="radio" id="sort-name-en" name="sortBy" value="en">
                    <label for="sort-name-en">Name-EN</label> | 
                    <input type="radio" id="sort-name-cz" name="sortBy" value="cz">
                    <label for="sort-name-cz">Name-CZ</label> | 
                    <input type="radio" id="sort-date" name="sortBy" value="date">
                    <label for="sort-date">Date</label>
                    <br>
                    <input type="radio" id="sort-ascending" name="sortOrder" value="asc">
                    <label for="sort-ascending">Ascending</label> | 
                    <input type="radio" id="sort-descending" name="sortOrder" value="desc">
                    <label for="sort-descending">Descending</label><br>
                    <input type="submit" class="btn">
                    </p>
                </form>
            </div>
            <div class="restore">
                <form action="/words">
                    <input type="submit" class="btn" value="RESTORE ORIGINAL">
                </form>
            </div>
        </section>

        <section class="list">
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
                    $sortBy = 'date';
                    $sortOrder = 'asc';
                }

                $sqlGetItems = "SELECT * FROM  words ORDER BY " . $sortBy . " " . $sortOrder . ";";
                
            }
            $sqlResult = $conn->query($sqlGetItems);
            if ($sqlResult->num_rows > 0) {
                echo '
                <table>
                    <tr>
                        <th>English</th>
                        <th>Czech</th>
                        <th>Description</th>
                        <th>Date of add</th>
                ';
                if ($userRole == 'superadmin') {
                    echo '<th>Added by</th>';
                }
                if (isset($user)) {
                    echo '<th>DEL</th>';
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
                        echo '<td><a href="remove.php?itemId=' . $word['id'] . '"><img src="../img/delete_icon.svg" alt="Delete_item_icon" width="40em" heigh="40em"></a></td>';
                    }
                    echo '</tr>';
                }
                echo '
                </table>
                ';
            }
            else {
                echo '<i style="text-align: center;">No words has been found.</i>';
            }
            ?>
        </section>
    </body>
</html>