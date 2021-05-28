<?php 

if(isset($_GET['vkey']) && isset($_GET['new-quantity'])){
    $CART->updateCartQuantity($_GET['vkey'], $_GET['new-quantity'], $uid);
}

if(isset($_GET['vkey']) && isset($_GET['delete'])){
    $CART->deleteCartItem($_GET['vkey'], $uid);
}

?>

<div class="wrapper">
    <main class="products-wrapper" style="margin-bottom: 10vw">
    <h1 style="font-size: 3.5vw; margin-bottom: 0.3em">KOSZYK</h1>
        <article class="content-wrapper">
            <?php 
                $CART->displayCartItems($uid);

                if($CART->getItemQuantity($uid)){
                    ?>
                    <div class="goto-checkout-wrapper">
                            <div class="goto-checkout-info">
                                <h1>ŁĄCZNIE: <?php echo $CART->getTotalPrice($uid); ?> zł</h1>
                                <a href="checkout.php"><button class="button-link"><span>DO KASY</span></button></a>
                            </div>
                    </div>
                    <?php
                }
            ?>

        </article>
    </main>
</div>
