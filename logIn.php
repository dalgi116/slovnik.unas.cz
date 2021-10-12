<?php
include 'inc/sessionData.php';
include_once 'inc/dbh.php';

if (!isset($_POST['user']) or !isset($_POST['pwd'])) {
    header('Location: /index.php?login=errorEmtpyArgument');
    exit;
}
else {
    $user = $_POST['user'];
    $pwd = $_POST['pwd'];
    if ($user == '' or $pwd == '') {
        header('Location: /index.php?login=errorEmtpyArgument');
        exit;
    }
    else {
        $sqlGetUser = "SELECT * FROM users WHERE user = '$user';";
        $userDb = $conn->query($sqlGetUser);
        $userParams = $userDb->fetch_assoc();
        $hashedPwd = $userParams['pwd'];
        if (!password_verify($pwd, $hashedPwd)) {
            header('Location: /index.php?login=errorIncorrectArguments');
            exit;
        }
        else {
            echo 'nok';
            $_SESSION['userRole'] = $userParams['role'];
            $_SESSION['user'] = $user;
            header('Location: words/index.php?login=success');
            exit;
        }
    }
}
?>