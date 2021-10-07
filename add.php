<?php
include_once 'inc/dbh.php';
// add isset statment to GET function
$pushUser = $_GET['user'];
$pushCzech = $_GET['czech'];
$pushEnglish = $_GET['english'];
$pushDescription = $_GET['description'];

$trySql = "SELECT * FROM words WHERE cz = '$pushCzech' AND en = '$pushEnglish';";
$tryResult = $conn->query($trySql);

if ($pushCzech == '') {
    header('Location: add.html?dataPush=errorEmptyArgument');
} 
else {
    if ($pushEnglish == '') {
        header('Location: add.html?dataPush=errorEmptyArgument');
    }
    else {
        if ($tryResult->num_rows > 0) {
            header('Location: add.html?dataPush=errorWordAlreadyUsed');
        }
        else {
            if (strlen($pushCzech) > 20) {
                header('Location: add.html?dataPush=errorTooLongArgument');
            }
            else {
                if (strlen($pushEnglish) > 20) {
                    header('Location: add.html?dataPush=errorTooLongArgument');
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