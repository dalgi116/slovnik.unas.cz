<?php
session_start();
include_once 'inc/dbh.php';

if (isset($_POST['user']) and isset($_POST['pwd'])) {
    $_SESSION['user'] = $_POST['user'];
    $user = $_SESSION['user'];
    $pwd = $_POST['pwd'];
    if ($user == '' or $pwd == '') {
        header('Location: index.php?login=errorEmtpyArgument');
    }
    else {
        $sqlGetUser = "SELECT * FROM users WHERE user = '$user' AND pwd = '$pwd'";
        $usersFromDb = $conn->query($sqlGetUser);
        if ($usersFromDb->num_rows == 0) {
            header('Location: index.php?login=errorIncorrectArguments');
        }
    }
}
if (!isset($user)) {
    $user = $_SESSION['user'];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta lang="en">
        <title>List of words</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <h1>English - Czech vocabulary</h1>
        <section class="log-out">
            <?php
            if (isset($user)) {
                echo '<p><b>Active user: </b>' . $user . '</p>';
            }
            ?>
            <form action="index.php">
                <input type="submit" class="log-out-btn" value="Log out">
            </form>
        </section>
        <section class="settings">
            <h2>Search words</h2>
            <div class="search-words">
                <form action="list.php">
                    <input type="text" name="search"><br>
                    <input type="submit" class="btn">
                </form>
            </div>
            <div class="sort-words">
                <form action="list.php">
                    <h2>Sort words</h2>
                    <input type="radio" id="sort-name-en" name="sortBy" value="en">
                    <label for="sort-name-en">Name-EN</label>
                    <input type="radio" id="sort-name-cz" name="sortBy" value="cz">
                    <label for="sort-name-cz">Name-CZ</label>
                    <input type="radio" id="sort-date" name="sortBy" value="date">
                    <label for="sort-date">Date</label>
                    <br>
                    <input type="radio" id="sort-ascending" name="sortOrder" value="asc">
                    <label for="sort-ascending">Ascending</label>
                    <input type="radio" id="sort-descending" name="sortOrder" value="desc">
                    <label for="sort-descending">Descending</label><br>
                    <input type="submit" class="btn">
                </form>
            </div>
            <br><br>
            <div class="restore-words">
                <form action="list.php">
                    <input type="submit" class="btn" value="RESTORE ORIGINAL">
                </form>
            </div>
            <?php
            if (isset($user)) {
                echo '
                <div class="add-words">
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
        </section>

        <section class="words">
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
                    </tr>
                ';
                while ($word = $sqlResult->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $word['en'] . '</td>';
                    echo '<td>' . $word['cz'] . '</td>';
                    echo '<td>' . $word['des'] . '</td>';
                    echo '<td>' . $word['date'] . '</td>';
                    echo '<td><a href="remove.php?itemId=' . $word['id'] . '"><img src="img/delete_icon.svg" alt="Delete_item_icon" width="40em" heigh="40em"></a><td>';
                    echo '</tr>';
                }
                echo '
                </table>
                ';
            }
            else {
                echo '<i>No words has been found.</i>';
            }
            ?>
        </section>
    </body>
</html>