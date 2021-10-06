<?php
include_once 'inc/dbh.php';
// add isset statment to GET function
$pushUser = $_GET['user'];
$pushCzech = $_GET['czech'];
$pushEnglish = $_GET['english'];
$pushDescription = $_GET['description'];

$trySql = 'SELECT * FROM words WHERE cz = $pushCzech AND en = $pushEnglish;';
$tryResult = mysqli_query($conn, $trySql);

if ($pushCzech == '') {
    header('Location: /list.php?dataPush=errorEmptyArgument');
} 
else {
    if ($pushEnglish == '') {
        header('Location: /list.php?dataPush=errorEmptyArgument');
    }
    else {
        if (mysqli_num_rows($tryResult) > 0) {
            header('Location: /list.php?dataPush=errorWordAlreadyUsed');
        }
        else {
            if (strlen($pushCzech) > 20) {
                header('Location: /list.php?dataPush=errorTooLongArgument');
            }
            else {
                if (strlen($pushEnglish) > 20) {
                    header('Location: /list.php?dataPush=errorTooLongArgument');
                }
                else {
                    $mainSql = 'INSERT INTO words (user, cz, en, des, date) VALUES ($pushUser, $pushCzech, $pushEnglish, $pushDescription, now());';
                    $mainResult = mysqli_query($conn, $mainSql);
                    header('Location: /list.php?dataPush=sucess');
                }
            }
        }
    }
}