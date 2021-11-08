<?php
include '../inc/sessionData.php';
include '../inc/modules.php';
include_once '../inc/dbh.php';

forAdmin($userRole);
$currentPwd = $_POST['currentPwd'];
$newName = $_POST['newName'];
$newPwd = $_POST['newPwd'];
$checkPwd = $_POST['checkPwd'];

if ($newName == '') {
    header('Location: editUser.php?userEdit=errorEmptyArgument');
}
else {
    if ($newPwd == '') {
        header('Location: editUser.php?userEdit=errorEmptyArgument');
    }
    else {
        if ($checkPwd == '') {
            header('Location: editUser.php?userEdit=errorEmptyArgument');
        }
        else {
            $sqlGetUser = "SELECT * FROM users WHERE user = '$user';";
            $userDb = $conn->query($sqlGetUser);
            $userParams = $userDb->fetch_assoc();
            $hashedPwd = $userParams['pwd'];
            if (!password_verify($currentPwd, $hashedPwd)) {
                header('Location: editUser.php?userEdit=errorInvalidPassword');
            }
            else {
                if ($newPwd !== $checkPwd) {
                    header('Location: editUser.php?userEdit=errorPasswordsNotMatch');
                }
                else {
                    if (strlen($newName) > 20) {
                        header('Location: editUser.php?userEdit=errorTooLongArgument');
                    }
                    else {
                        $sqlGetNewUser = "SELECT * FROM users WHERE user = '$newName';";
                        $newUserDb = $conn->query($sqlGetNewUser);
                        if ($newUserDb->num_rows > 0 and $newName !== $user) {
                            header('Location: editUser.php?userEdit=errorNameAlreadyUsed');
                        }
                        else {
                            $newHashedPwd = password_hash($newPwd, PASSWORD_DEFAULT);
                            $sqlEditUser = "UPDATE users SET user='$newName', pwd='$newHashedPwd' WHERE user='$user';";
                            $conn->query($sqlEditUser);
                            $_SESSION['user'] = $newName;
                            header('Location: /words/index.php?userEdit=success');
                        }
                    }
                }
            }
        }
    }
}