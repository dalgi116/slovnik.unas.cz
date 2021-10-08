<?php
include_once 'inc/dbh.php';

$itemId = $_GET['itemId'];

$sqlRemove = "DELETE FROM words WHERE id = $itemId;";
if ($conn->query($sqlRemove) == True) {
    header('Location: list.php?dataPush=success');
}
else {
    header('Location: list.php?dataPush=error:' . $conn->error);
}