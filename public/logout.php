<?php

    session_start();

    if($_SESSION['LOGGED_IN']){
        session_destroy();
        header('Location: index.php');
    } else {
        header('login.php');
    }

?>