<?php
include '../inc/sessionData.php';
include '../inc/modules.php';
include_once '../inc/dbh.php';

forAdmin($userRole);
$itemId = $_GET['itemId'];

$sqlRemove = "DELETE FROM words WHERE id = $itemId;";
if ($conn->query($sqlRemove) == True) {
    header('Location: index.php?dataPush=success');
}
else {
    header('Location: index.php?dataPush=error:' . $conn->error);
}