<?php

session_start();
require_once '../src/classes/GetDatabase.php';
require_once '../src/classes/ThrowError.php';
require_once '../src/classes/GetCategories.php';
require_once '../src/classes/GetProducts.php';
require_once '../src/classes/GetCart.php';

$DB = new GetDatabase();
$CONNECTION = $DB->connect();
$CART = new GetCart($CONNECTION);

if(isset($_SESSION['USER_ID'])){
    $uid = $_SESSION['USER_ID'];
} else {
    $uid = false;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>superanckisklep - produkty</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;900&display=swap" rel="stylesheet">
<link rel="icon" href="../src/svgs/ss-logo.svg">
<link rel="stylesheet" href="../src/styles/index.css">
<link rel="stylesheet" href="../src/styles/index-mobile.css">
<link rel="stylesheet" href="../src/styles/global-styles.css">
<link rel="stylesheet" href="../src/styles/products-styles.css">
</head>

<body style="background-color: #16161d">

<?php
    require_once '../src/components/navbar.php';
    require_once '../src/components/products-list.php';
    require_once '../src/components/footer.php';
?>

<script src="../src/scripts/index.js"></script>
</body>

</html>