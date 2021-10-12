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
        $sqlGetUser = "SELECT * FROM users WHERE user = '$user' AND pwd = '$pwd'";
        $usersFromDb = $conn->query($sqlGetUser);
        if ($usersFromDb->num_rows == 0) {
            header('Location: /index.php?login=errorIncorrectArguments');
            exit;
        }
        else {
            $sqlGetRole = "SELECT * FROM users WHERE user = '$user';";
            $userDb = $conn->query($sqlGetRole);
            $userParams = $userDb->fetch_assoc();
            $userRole = $userParams['role'];

            $_SESSION['userRole'] = $userRole;
            $_SESSION['user'] = $user;
            header('Location: words/index.php?login=success');
            exit;
        }
    }
}
?>