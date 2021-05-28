<?php 
    if(isset($_POST['addtocart']) && $_POST['addtocart'] == 1 && isset($_POST['quantity'])) {
        if($PRODUCT->addToCart($_GET['vkey'], $_POST['quantity'], $uid)){
            $_SESSION['GOOD_OUTCOME'] = true;
        } else {
            $_SESSION['BAD_OUTCOME'] = true;
        }
    }
    
    ?>

<div class="wrapper">

    <main class="products-wrapper" style="margin-bottom: 10vw">
    <h1 style="font-size: 3.5vw; margin-bottom: 0.3em"><?php echo strtoupper($PRODUCT->getProductName($_GET['vkey'])); ?></h1>
        <article class="content-wrapper">
            <?php 
                if(isset($_SESSION['GOOD_OUTCOME']) && $_SESSION['GOOD_OUTCOME'] == true){
                    $ADDTOCART_OUTCOME = new ThrowError('Produkt został pomyślnie dodany do koszyka!', 'true');
                    $ADDTOCART_OUTCOME->displayError(true);
                    $_SESSION['GOOD_OUTCOME'] = false;
                }
                
                if(isset($_SESSION['BAD_OUTCOME']) && $_SESSION['BAD_OUTCOME'] == true){
                    $ADDTOCART_OUTCOME = new ThrowError('Wystąpił błąd, spróbuj ponownie poźniej!', 'true');
                    $ADDTOCART_OUTCOME->displayError(false);
                    $_SESSION['BAD_OUTCOME'] = false;
                }

                $PRODUCT->displayProduct($_GET['vkey'], $uid);
            ?>
        </article>
    </main>

</div>