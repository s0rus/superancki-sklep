<?php

    require_once '../src/classes/ThrowError.php';

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
</head>

<body>

    <div class="wrapper">
        <?php
            require_once '../src/components/navbar.php';
            require_once '../src/components/index-articles.php';
            require_once '../src/components/footer.php';
        ?>
    </div>

    <script src="../src/scripts/index.js"></script>
</body>

</html>