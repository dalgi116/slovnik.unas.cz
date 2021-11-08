<?php
include '../inc/sessionData.php';
include '../inc/modules.php';
include_once '../inc/dbh.php';

forSuperadmin($userRole);
$itemId = $_GET['itemId'];

$sqlRemove = "DELETE FROM users WHERE id = $itemId;";
if ($conn->query($sqlRemove) == True) {
    header('Location: index.php?userRemove=success');
}
else {
    header('Location: index.php?userRemove=error:' . $conn->error);
}