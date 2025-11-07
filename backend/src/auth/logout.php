<?php
session_start();

session_unset();
setcookie('user_id', '', time() - 3600, "/");
session_destroy();

header('Location: ../../../frontend/templates/login.php');
exit();
