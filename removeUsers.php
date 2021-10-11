<?php
include_once 'inc/dbh.php';

$itemId = $_GET['itemId'];

$sqlRemove = "DELETE FROM users WHERE id = $itemId;";
if ($conn->query($sqlRemove) == True) {
    header('Location: manageUsers.php?dataPush=success');
}
else {
    header('Location: manageUsers.php?dataPush=error:' . $conn->error);
}