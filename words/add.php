<?php
include_once '../inc/dbh.php';

$pushUser = $_POST['user'];
$pushCzech = $_POST['czech'];
$pushEnglish = $_POST['english'];
$pushDescription = $_POST['description'];

$trySql = "SELECT * FROM words WHERE cz = '$pushCzech' AND en = '$pushEnglish';";
$tryResult = $conn->query($trySql);

if ($pushCzech == '') {
    header('Location: list.php?dataPush=errorEmptyArgument');
} 
else {
    if ($pushEnglish == '') {
        header('Location: list.php?dataPush=errorEmptyArgument');
    }
    else {
        if ($tryResult->num_rows > 0) {
            header('Location: list.php?dataPush=errorWordAlreadyUsed');
        }
        else {
            if (strlen($pushCzech) > 20) {
                header('Location: list.php?dataPush=errorTooLongArgument');
            }
            else {
                if (strlen($pushEnglish) > 20) {
                    header('Location: list.php?dataPush=errorTooLongArgument');
                }
                else {
                    $mainSql = "INSERT INTO words (user, cz, en, des, date) VALUES ('$pushUser', '$pushCzech', '$pushEnglish', '$pushDescription', now());";
                    $conn->query($mainSql);
                    header('Location: list.php?dataPush=sucess');
                }
            }
        }
    }
}