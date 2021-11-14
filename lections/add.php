<?php
include '../inc/sessionData.php';
include '../inc/modules.php';
include_once '../inc/dbh.php';

forAdmin($userRole);
$pushName = $_POST['name'];

$trySql = "SELECT * FROM lections WHERE name = '$pushName';";
$tryResult = $conn->query($trySql);

if ($pushName == '') {
    header('Location: index.php?lectionAdd=errorEmptyArgument');
} 
else {
    if (strlen($pushName) > 20) {
        header('Location: index.php?lectionAdd=errorTooLongArgument');
    }
    else {
        if ($tryResult->num_rows > 0) {
            header('Location: index.php?lectionAdd=errorNameAlreadyUsed');
        }
        else {
            $mainSql = "INSERT INTO lections (name, date, user) VALUES ('$pushName', now(), '$user')";
            $conn->query($mainSql);
            header('Location: index.php?lectionAdd=success');
        }
    }   
}