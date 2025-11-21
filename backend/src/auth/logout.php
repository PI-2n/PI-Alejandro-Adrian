<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_unset();
    setcookie('user_id', '', time() - 3600, "/");
    session_destroy();

    header('Location: ../../../frontend/templates/tmp_login.php');
    exit();

}


