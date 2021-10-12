<?php
include '../inc/sessionData.php';
include '../inc/modules.php';
include_once '../inc/dbh.php';

forAdmin($userRole);
$itemId = $_GET['itemId'];

$sqlRemove = "DELETE FROM words WHERE id = $itemId;";
if ($conn->query($sqlRemove) == True) {
    header('Location: list.php?dataPush=success');
}
else {
    header('Location: list.php?dataPush=error:' . $conn->error);
}