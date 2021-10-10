<!DOCTYPE html>

<?php
include_once 'inc/dbh.php';
?>



<html>
    <head>
        <meta charset="UTF-8">
        <meta lang="en">
        <title>List of words</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <section class="log-out">
            <form action="index.html">
                <input type="submit" class="log-out-btn" value="Log out">
            </form>
        </section>

        <section class="settings">
            <h1>English - Czech</h1>        
            <div class="search-words">
                <form action="list.php">
                    <label for="search"><b>Search: </b></label>
                    <input type="text" id="search">
                    <input type="submit" class="btn">
                </form>
            </div>
            <div class="sort-words">
                <form action="list.php">
                    <b>Sort by:</b>
                    <input type="radio" id="sort-name" name="sort" value="name">
                    <label for="sort-name">Name</label>
                    <input type="radio" id="sort-date" name="sort" value="date">
                    <label for="sort-date">Date</label>
                    <input type="submit" class="btn">
                </form>
            </div>
            <div class="add-words">
                <h2>Add words</h2>
                <form action="add.php" method="POST">
                    <input name="user" type="hidden" value="admin">
                    <label for="add-english">English: </label><br>
                    <input name="english" type="text" id="add-english"><br>
                    <label for="add-czech">Czech: </label><br>
                    <input name="czech" type="text" id="add-czech"><br>
                    <label for="add-description">Description: </label><br>
                    <input name="description" id="add-description"><br>
                    <input type="submit" class="btn">
                </form>
             </div>
        </section>

        <section class="words">
            <table>
                <tr>
                    <th>English</th>
                    <th>Czech</th>
                    <th>Description</th>
                    <th>Date of add</th>
                </tr>
            <?php
            $sqlGetItems = "SELECT * FROM  words;";
            $sqlResult = $conn->query($sqlGetItems);
            if ($sqlResult->num_rows > 0) {
                while ($word = $sqlResult->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $word['en'] . '</td>';
                    echo '<td>' . $word['cz'] . '</td>';
                    echo '<td>' . $word['des'] . '</td>';
                    echo '<td>' . $word['date'] . '</td>';
                    echo '<td><a href="remove.php?itemId=' . $word['id'] . '"><img src="img/delete_icon.svg" alt="Delete_item_icon" width="40em" heigh="40em"></a><td>';
                    echo '</tr>';
                }
            }
            ?>
            </table>
        </section>
    </body>
</html>