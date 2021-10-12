<?php
function forAdmin($role)
{
    if (!isset($role)) {
        header('Location: list.php');
        exit;
    }
}

function forSuperadmin($role)
{
    if ($role !== 'superadmin') {
        header('Location: ../words/list.php');
        exit;
    }
}

function resetSession()
{
    $_SESSION['user'] = NULL;
    $_SESSION['userRole'] = NULL;
}

function redirectTo($adress)
{
    header('Location: ' . $adress);
    exit;
}

function redirectToWords()
{
    $adress = '/words/list.php';
    redirectTo($adress);
}
?>