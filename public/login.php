<?php

session_start();
require_once '../src/classes/GetDatabase.php';
require_once '../src/classes/ThrowError.php';
require_once '../src/classes/GetCategories.php';
require_once '../src/classes/GetProducts.php';
require_once '../src/classes/GetCart.php';
require_once '../src/classes/GetLogin.php';

$DB = new GetDatabase();
$CONNECTION = $DB->connect();
$CART = new GetCart($CONNECTION);
$USER = new GetLogin($CONNECTION);

if(isset($_SESSION['LOGGED_IN'])){
    header('Location: index.php');
}

if(isset($_POST['commit-login']) && $_POST['commit-login'] == true){

    $login = $_POST['login'];
    $password = $_POST['password'];

    if($USER->loginUser($login, $password)){
        header('Location: index.php');
    } else {
        $ERROR = new ThrowError('Logowanie nie powiodło się!', true);
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>superanckisklep - logowanie</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;900&display=swap" rel="stylesheet">
    <link rel="icon" href="../src/svgs/ss-logo.svg">
    <link rel="stylesheet" href="../src/styles/global-styles.css">
    <link rel="stylesheet" href="../src/styles/login-styles.css">

</head>

<body style="background-color: #131319">
    <?php require_once '../src/components/navbar.php' ?>
    <div class="wrapper">
    <?php if(isset($ERROR)){$ERROR->displayError(false);}; ?>
        <article class="login-article">
            <img src="../src/svgs/login.svg" alt="login-svg">
            <form action="login.php" method="POST" id="login-form">
                <h1>ZALOGUJ SIĘ</h1>
                <div>
                    <label class="login-label" for="login">E-MAIL</label><br>
                    <input type="text" name="login" id="login">
                </div>
                <div>
                    <label class="login-label" for="password">HASŁO</label><br>
                    <input type="password" name="password" id="password">
                </div>
                <div>
                    <h1 style="margin: 0.8em 0.5em">Nie masz konta? Załóż je <u><a style="color: #b86bff" href="register.php">tutaj</a></u></h1>
                </div>
                <button class="button-link login-button"><span>ZALOGUJ SIĘ</span></button>
                <input type="hidden" name="commit-login" value="true">
            </form>
        </article>
        <article class="login-waves">
        </article>
    </div>

    <script src="../src/scripts/loginValidation.js"></script>
    <script src="../src/scripts/index.js"></script>
</body>

</html>