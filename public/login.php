<?php

    require_once '../src/classes/ThrowError.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>superanckisklep - logowanie</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;900&display=swap" rel="stylesheet">
    <link rel="icon" href="../src/svgs/ss-logo.svg">
    <link rel="stylesheet" href="../src/styles/index.css">
    <link rel="stylesheet" href="../src/styles/index-mobile.css">
    <link rel="stylesheet" href="../src/styles/global-styles.css">
    <link rel="stylesheet" href="../src/styles/login-styles.css">

</head>

<body>
    <?php require_once '../src/components/navbar.php' ?>
    <div class="wrapper">
        <article class="login-article">
            <img src="../src/svgs/login.svg" alt="login-svg">
            <form action="login.php" method="GET">
                <h1>ZALOGUJ SIĘ</h1>
                <div>
                    <label class="login-label" for="login">LOGIN</label><br>
                    <input type="text" name="login" id="login">
                </div>
                <div>
                    <label class="password-label" for="password">HASŁO</label><br>
                    <input type="password" name="password" id="password">
                </div>
                <button class="button-link login-button"><span>ZALOGUJ SIĘ</span></button>
            </form>
        </article>
        <article class="login-waves">
        </article>
    </div>

    <script src="../src/scripts/index.js"></script>
</body>

</html>