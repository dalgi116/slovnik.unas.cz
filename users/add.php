<?php
include '../inc/sessionData.php';
include '../inc/modules.php';
include_once '../inc/dbh.php';

forSuperadmin($userRole);
$pushUser = $_POST['user'];
$pushPwd = $_POST['pwd'];
$Pwd2 = $_POST['pwd2'];

$trySql = "SELECT * FROM users WHERE user = '$pushUser';";
$tryResult = $conn->query($trySql);

if ($pushUser == '') {
    header('Location: index.php?dataPush=errorEmptyArgument');
} 
else {
    if ($pushPwd == '') {
        header('Location: index.php?dataPush=errorEmptyArgument');
    }
    else {
        if ($Pwd2 == '') {
            header('Location: index.php?dataPush=errorEmptyArgument');
        }
        else {
            if ($pushPwd !== $Pwd2) {
                header('Location: index.php?dataPush=errorPasswordsNotMatch');
            }
            else {
                if (strlen($pushUser) > 20) {
                    header('Location: index.php?dataPush=errorTooLongArgument');
                }
                else {
                    if ($tryResult->num_rows > 0) {
                        header('Location: index.php?dataPush=errorNameAlreadyUsed');
                    }
                    else {
                        $hashedPwd = password_hash($pushPwd, PASSWORD_DEFAULT);
                        $mainSql = "INSERT INTO users (user, pwd, role) VALUES ('$pushUser', '$hashedPwd', 'admin')";
                        $conn->query($mainSql);
                        header('Location: index.php?dataPush=sucess');
                    }
                }
            }
        }
    }
}