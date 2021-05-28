<?php

session_start();
require_once '../src/classes/GetDatabase.php';
require_once '../src/classes/GetRegister.php';
require_once '../src/classes/ThrowError.php';
require_once '../src/classes/GetCategories.php';
require_once '../src/classes/GetProducts.php';
require_once '../src/classes/GetCart.php';

$DB = new GetDatabase();
$CONNECTION = $DB->connect();
$CART = new GetCart($CONNECTION);
$USER = new GetRegister($CONNECTION);

if(isset($_SESSION['LOGGED_IN'])){
    header('Location: index.php');
}

if(isset($_POST['commit-registration']) && $_POST['commit-registration'] == true){

    $login = $_POST['login'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $province = $_POST['province'];
    $phonenumber = $_POST['phonenumber'];

    if($USER->registerUser($login, $password, $name, $surname, $address, $city, $postcode, $province, $phonenumber)){
        header('Location: index.php');
    } else {
        $ERROR = new ThrowError('Rejestracja nie powiodła się, spróbuj ponownie później.', true);
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
    <?php require_once '../src/components/navbar.php';
    if(isset($ERROR) && $ERROR){
        $ERROR->displayError(false);
    }
    ?>
    <div class="wrapper" style="margin-bottom: 5em">
        <article class="login-article">
            <img src="../src/svgs/login.svg" alt="login-svg">
            <form action="register.php" method="POST" id="register-form">
                <h1>ZAREJESTRUJ SIĘ</h1>
                <div >
                    <label class="login-label" for="login">E-MAIL</label><br>
                    <input type="text" name="login" id="login" />
                </div>
                <div>
                    <label class="login-label" for="password">HASŁO</label><br>
                    <input type="password" name="password" id="password">
                </div>
                <div>
                    <label class="login-label" for="name">IMIĘ</label><br>
                    <input type="text" name="name" id="name" maxlength="30">
                </div>
                <div>
                    <label class="login-label" for="surname">NAZWISKO</label><br>
                    <input type="text" name="surname" id="surname" maxlength="30">
                </div>
                <div>
                    <label class="login-label" for="address">ADRES</label><br>
                    <input type="text" name="address" id="address" maxlength="30">
                </div>
                <div>
                    <label class="login-label" for="city">MIEJSCOWOŚĆ</label><br>
                    <input type="text" name="city" id="city" maxlength="30">
                </div>
                <div>
                    <label class="login-label" for="postcode">KOD POCZTOWY</label><br>
                    <input type="text" name="postcode" id="postcode" maxlength="6">
                </div>
                <div>
                    <label class="login-label" for="phonenumber">NR TELEFONU</label><br>
                    <input type="text" name="phonenumber" id="phonenumber" maxlength="9">
                </div>
                <div>
                    <label class="login-label" for="province">WOJEWÓDZTWO</label><br>
                    <select name="province" id="province">
                        <?php 
                            $USER->getProvinces();
                        ?>
                    </select>
                </div>
                <div>
                    <h1 style="margin: 0.8em 0.5em">Masz już konto? Zaloguj się <u><a style="color: #b86bff" href="login.php">tutaj</a></u></h1>
                </div>
                <button class="button-link login-button" style="padding: 1em 0.8em"><span>ZAREJETRUJ SIĘ</span></button>
                <input type="hidden" name="commit-registration" value="true">
            </form>
        </article>
        <article class="login-waves">
        </article>
    </div>
    <script type="module" src="../src/scripts/Validation.js"></script>
    <script src="../src/scripts/index.js"></script>
</body>

</html>