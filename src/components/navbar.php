<header class="main-header">
    <section class="logo">
        <a href="index.php"><img class="logo-svg" src="../src/svgs/ss-logo.svg" alt="superanckisklep"></a>
        <h1 class="logo-title">superanckisklep</h1>
    </section>
    <nav class="main-header-nav">
        <button class="hamburger">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
        <div class="option-wrapper">
            <ul class="nav-options">
                <li><a class="nav-link" href="index.php">HOME</a></li>
                <li><a class="nav-link" href="products.php">SKLEP</a></li>
                <li><a class="cart-icon" href="cart.php"><img class="nav-svg" src="../src/svgs/shopping-cart.svg" alt="shopping-cart"><span class="cart-quantity"><?php if(isset($uid)){echo $CART->getItemQuantity($uid);} else {echo '0';}; ?></span></a></li>
                <?php 

                    if(isset($uid) && $uid){
                        ?>
                        <li><a class="nav-link" href="user.php">KONTO</a></li>
                        <?php
                    } else {
                        ?>
                        <li><a class="nav-link" href="login.php">ZALOGUJ SIĘ</a></li>
                        <?php
                    }
                ?>
            </ul>
        </div>
    </nav>
</header>