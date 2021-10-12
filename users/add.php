<?php
include_once '../inc/dbh.php';

$pushUser = $_POST['user'];
$pushPwd = $_POST['pwd'];
$Pwd2 = $_POST['pwd2'];

$trySql = "SELECT * FROM users WHERE user = '$pushUser';";
$tryResult = $conn->query($trySql);

if ($pushUser == '') {
    header('Location: list.php?dataPush=errorEmptyArgument');
} 
else {
    if ($pushPwd == '') {
        header('Location: list.php?dataPush=errorEmptyArgument');
    }
    else {
        if ($Pwd2 == '') {
            header('Location: list.php?dataPush=errorEmptyArgument');
        }
        else {
            if ($pushPwd !== $Pwd2) {
                header('Location: list.php?dataPush=errorPasswordsNotMatch');
            }
            else {
                if (strlen($pushUser) > 20) {
                    header('Location: list.php?dataPush=errorTooLongArgument');
                }
                else {
                    if ($tryResult->num_rows > 0) {
                        header('Location: list.php?dataPush=errorNameAlreadyUsed');
                    }
                    else {
                        $mainSql = "INSERT INTO users (user, pwd, role) VALUES ('$pushUser', '$pushPwd', 'admin')";
                        $conn->query($mainSql);
                        header('Location: list.php?dataPush=sucess');
                    }
                }
            }
        }
    }
}