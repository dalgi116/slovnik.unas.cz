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
        <title>Manage users</title>
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>
        <section class="settings">
            <div class="go-back">
                <form action="../words">
                    <input type="submit" class="btn" value="GO BACK">
                </form>
            </div>
            <div class="add-users">
                <h2>Add users</h2>
                <form action="add.php" method="POST">
                    <label for="add-user">User: </label><br>
                    <input name="user" type="text" id="add-user"><br>
                    <label for="add-pwd">Password: </label><br>
                    <input name="pwd" type="password" id="add-pwd"><br>
                    <label for="add-pwd2">Password again: </label><br>
                    <input name="pwd2" type="password" id="add-pwd2"><br>
                    <input type="submit" class="btn">
                </form>
            </div>
        </section>
        <section class="words">
            <?php
            $sqlGetUsers = "SELECT * FROM  users;";
            $sqlResult = $conn->query($sqlGetUsers);
            if ($sqlResult->num_rows > 0) {
                echo '
                <table>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                    </tr>
                ';
                while ($user = $sqlResult->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $user['user'] . '</td>';
                    echo '<td>' . $user['role'] . '</td>';
                    if ($user['role'] !== 'superadmin') {
                        echo '<td><a href="remove.php?itemId=' . $user['id'] . '"><img src="../img/delete_icon.svg" alt="Delete_item_icon" width="40em" heigh="40em"></a><td>';
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
    </body>
</html>