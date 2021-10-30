<?php
function forAdmin($role)
{
    if (!isset($role)) {
        header('Location: /words');
        exit;
    }
}

function forSuperadmin($role)
{
    if ($role !== 'superadmin') {
        header('Location: ../words');
        exit;
    }
}

function resetSession()
{
    $_SESSION['user'] = NULL;
    $_SESSION['userRole'] = NULL;
}
?>