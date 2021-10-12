<?php
include '../inc/sessionData.php';
include '../inc/modules.php';
include_once '../inc/dbh.php';

forSuperadmin($userRole);
$itemId = $_GET['itemId'];

$sqlRemove = "DELETE FROM users WHERE id = $itemId;";
if ($conn->query($sqlRemove) == True) {
    header('Location: list.php?dataPush=success');
}
else {
    header('Location: list.php?dataPush=error:' . $conn->error);
}