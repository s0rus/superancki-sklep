<div class="wrapper">

    
<?php 
        
        if(isset($_SESSION['ORDER_COMMITED']) && $_SESSION['ORDER_COMMITED'] == true){
            $SUCCESS = new ThrowError('Zamówienie zostało złożone!', true);
            $SUCCESS->displayError(true);
            $_SESSION['ORDER_COMMITED'] = false;
        }

        if(isset($_SESSION['ORDER_FAILED']) && $_SESSION['ORDER_FAILED'] == true){
            $ERROR = new ThrowError('Wystąpił błąd, spróbuj ponownie później!', true);
            $ERROR->displayError(false);
            $_SESSION['ORDER_FAILED'] = false;
        }

?>


    <main class="products-wrapper">
        <h1 class="styled-h1">NASZE PRODUKTY</h1>
        <article class="content-wrapper">
            <p class="styled-p">Filtruj po kategorii: </p>
            <section class="categories-list">
                <?php
                    $CATEGORIES = new GetCategories($CONNECTION);
                    $CATEGORIES->displayCategories();
                ?>
            </section>
            <section class="products-list">
                <?php
                    $PRODUCTS = new GetProducts($CONNECTION);
                    if(isset($_GET['category']) && $category = $_GET['category']){
                        $PRODUCTS->displayProducts($category);
                    } else {
                        $PRODUCTS->displayProducts('ALL');
                    }
                    ?>
            </section>
        </article>
        
    </main>

</div>