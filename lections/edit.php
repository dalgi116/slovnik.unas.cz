<?php
include '../inc/sessionData.php';
include '../inc/modules.php';
include_once '../inc/dbh.php';

forAdmin($userRole);
$pushNameOld = $_POST['nameOld'];
$pushNameNew = $_POST['nameNew'];

$trySql = "SELECT * FROM lections WHERE name = '$pushNameNew';";
$tryResult = $conn->query($trySql);

if ($pushNameOld == '') {
    header('Location: index.php?lectionEdit=errorEmptyArgument');
} 
else {
    if ($pushNameNew == '') {
        header('Location: index.php?lectionEdit=errorEmptyArgument');
    }
    else {
        if (strlen($pushNameOld) > 20) {
            header('Location: index.php?lectionEdit=errorTooLongArgument');
        }
        else {
            if (strlen($pushNameNew) > 20) {
                header('Location: index.php?lectionEdit=errorTooLongArgument');
            }
            else {
                if ($tryResult->num_rows > 0) {
                    header('Location: index.php?lectionEdit=errorNameAlreadyUsed');
                }
                else {
                    $trySql = "SELECT * FROM lections WHERE name = '$pushNameOld';";
                    $tryResult = $conn->query($trySql);
                    if ($tryResult->num_rows == 0) {
                        header('Location: index.php?lectionEdit=errorLectionNotFound');
                    }
                    else {
                        $mainSql1 = "UPDATE lections SET name='$pushNameNew' WHERE name='$pushNameOld';";
                        $mainSql2 = "UPDATE words SET lection='$pushNameNew' WHERE lection='$pushNameOld';";
                        $conn->query($mainSql1);
                        $conn->query($mainSql2);
                        header('Location: index.php?lectionEdit=success');
                    }
                }
            }
        }
    }   
}