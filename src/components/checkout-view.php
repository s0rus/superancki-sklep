<div class="wrapper">
    <main class="products-wrapper" style="margin-bottom: 10vw">
    <h1 style="font-size: 3.5vw; margin-bottom: 0.3em">ZAMÓWIENIE</h1>

        <?php 
        
            if(isset($_POST['commit-order']) && $_POST['commit-order'] == true){
                if($CART->commitOrder($uid, $_POST['payment-option'])){
                    $_SESSION['ORDER_COMMITED'] = true;
                } else {
                    $_SESSION['ORDER_FAILED'] = true;
                }
            }

        ?>

        <article class="content-wrapper">
            <div class="checkout-wrapper">
                <div class="checkout-list-wrapper">
                <?php 
                    $CART->getCartList($uid);
                ?>
                </div>
                <div class="checkout-user-info-wrapper">
                    <h2>Dane zamówienia:</h2>
                        <div class="checkout-form">
                            <?php $USER->getUserInfo($uid) ?>
                            <h2 style="margin-top: 1em; border-top: 1px solid #ebebeb; padding-top: 0.5em">Do zapłaty: <?php echo $CART->getTotalPrice($uid); ?> zł</h2>
                            <form action="checkout.php" method="POST">
                                <h3 style="margin-top: 0.5em;">Metoda płatności: </h3>
                                <select style="width: 100%;" name="payment-option">
                                    <?php $CART->getPaymentOptions(); ?>
                                </select>
                                <button class="button-link" style="margin: 2em 0em;"><span>ZAMÓW</span></button>
                                <input type="hidden" name="commit-order" value="true">
                            </form>
                        </div>
                </div>
            </div>
        </article>
        <a href="cart.php"><button style="margin-top: 2em" class="button-link"><span>WRÓĆ</span></button></a>
    </main>
</div>