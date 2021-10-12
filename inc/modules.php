<?php
function forAdmin($role)
{
    if (!isset($role)) {
        header('Location: list.php');
    }
}

function forSuperadmin($role)
{
    if ($role !== 'superadmin') {
        header('Location: list.php');
    }
}

function resetSession()
{
    $_SESSION['user'] = NULL;
    $_SESSION['userRole'] = NULL;
}
?>