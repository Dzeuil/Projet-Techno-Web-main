<?php 
    include_once("users.php");
    if(!isset($_POST["username"])) {
        header("Location: ../login.php?err=u");
    }
    if(!isset($_POST["password"])) {
        header("Location: ../login.php?err=p");
    }
    $username = $_POST["username"];
    $password = $_POST["password"];
    $log = login($username, $password);
    switch($log) {
        case -1:
            header("Location: ../login.php?err=p");
            break;
        case 0: 
            header("Location: ../login.php?err=u");
            break;
        case 1:
            session_start();
            $_SESSION["username"] = $username;
            header("Location: ../gestionnaire.php");
            break;
        default: 
            header("Location: ../login.php");
            break;
    }
?>