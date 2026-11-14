<?php
session_start();

if (isset($_SESSION['isLogin'])) {
    unset($_SESSION['isLogin']);
    unset($_SESSION['email']);
    unset($_SESSION['type']);

    session_destroy();
}

header("Location: index.php");
exit();
