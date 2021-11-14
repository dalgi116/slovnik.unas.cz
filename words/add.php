<?php
include '../inc/sessionData.php';
include '../inc/modules.php';
include_once '../inc/dbh.php';

forAdmin($userRole);
$pushUser = $_POST['user'];
$pushCzech = $_POST['czech'];
$pushEnglish = $_POST['english'];
$pushDescription = $_POST['description'];
$pushLection = $_POST['lection'];

$trySql = "SELECT * FROM words WHERE cz = '$pushCzech' AND en = '$pushEnglish';";
$tryResult = $conn->query($trySql);

if ($pushCzech == '') {
    header('Location: index.php?wordAdd=errorEmptyArgument&lastLection=' . $pushLection);
} 
else {
    if ($pushEnglish == '') {
        header('Location: index.php?wordAdd=errorEmptyArgument&lastLection=' . $pushLection);
    }
    else {
        if ($tryResult->num_rows > 0) {
            header('Location: index.php?wordAdd=errorWordAlreadyUsed&lastLection=' . $pushLection);
        }
        else {
            $mainSql = "INSERT INTO words (user, cz, en, des, lection, date) VALUES ('$pushUser', '$pushCzech', '$pushEnglish', '$pushDescription', '$pushLection', now());";
            $conn->query($mainSql);
            header('Location: index.php?wordAdd=success&lastLection=' . $pushLection);
        }
    }
}