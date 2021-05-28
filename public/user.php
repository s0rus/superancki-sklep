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


if(isset($_SESSION['USER_ID'])){
    $uid = $_SESSION['USER_ID'];
} else {
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>superanckisklep</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;900&display=swap" rel="stylesheet">
    <link rel="icon" href="../src/svgs/ss-logo.svg">
    <link rel="stylesheet" href="../src/styles/index.css">
    <link rel="stylesheet" href="../src/styles/index-mobile.css">
    <link rel="stylesheet" href="../src/styles/global-styles.css">
    <link rel="stylesheet" href="../src/styles/user-styles.css">
    <link rel="stylesheet" href="../src/styles/login-styles.css">
</head>

<body>

    <div class="wrapper">
        <?php
            require_once '../src/components/navbar.php';
            require_once '../src/components/user-view.php';
            require_once '../src/components/footer.php';
        ?>
    </div>

    <script type="module" src="../src/scripts/userValidation.js"></script>
    <script src="../src/scripts/index.js"></script>
</body>

</html>