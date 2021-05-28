<div class="wrapper">
<?php

    if(isset($_POST['commit-add-category']) && $_POST['commit-add-category'] == true){
        if($CART->addCategory($_POST['category-name'])){
            $ADDED_CATEGORY = new ThrowError('Kategoria została dodana!', true);
            $ADDED_CATEGORY->displayError('true');
        } else {
            $ERROR_CATEGORY = new ThrowError('Kategoria nie została dodana!', true);
            $ERROR_CATEGORY->displayError(false);
        }
    }

    if(isset($_POST['commit-add-product']) && $_POST['commit-add-product'] == true){
        if($CART->addProduct($_POST['product-name'], $_POST['product-desc'], $_POST['product-manufacturer'], $_POST['product-category'], $_POST['product-price'], $_POST['product-quantity'])){
            $ADDED_PRODUCT = new ThrowError('Produkt został dodany!', true);
            $ADDED_PRODUCT->displayError('true');
        } else {
            $ERROR_PRODUCT = new ThrowError('Produkt nie został dodany!', true);
            $ERROR_PRODUCT->displayError(false);
        }
    }

    if(isset($_POST['commit-edit-category']) && $_POST['commit-edit-category'] == true){
        if($CART->editCategory($_POST['edit-category-id'], $_POST['edit-category-name'])){
            $EDITED_CATEGORY = new ThrowError('Kategoria została zmieniona!', true);
            $EDITED_CATEGORY->displayError('true');
        } else {
            $ERROR_CATEGORY = new ThrowError('Kategoria nie została zmieniona!', true);
            $ERROR_CATEGORY->displayError(false);
        }
    }

    if(isset($_POST['commit-edit-product']) && $_POST['commit-edit-product'] == true){
        if($CART->editProduct($_POST['product-id'], $_POST['product-name'], $_POST['product-desc'], $_POST['product-manufacturer'], $_POST['product-category'], $_POST['product-price'], $_POST['product-quantity'])){
            $EDITED_CATEGORY = new ThrowError('Produkt został zmieniony!', true);
            $EDITED_CATEGORY->displayError('true');
        } else {
            $ERROR_CATEGORY = new ThrowError('Produkt nie został zmieniony!', true);
            $ERROR_CATEGORY->displayError(false);
        }
    }

    if(isset($_GET['del-category'])) {
        if($CART->deleteItem('categories', 'category_id', $_GET['del-category'])){
            $DELETED_CATEGORY = new ThrowError('Kategoria została usunięta!', true);
            $DELETED_CATEGORY->displayError('true');
        } else {
            $ERROR_CATEGORY = new ThrowError('Kategoria nie została usunięta!', true);
            $ERROR_CATEGORY->displayError(false);
        }
    }

    if(isset($_GET['del-product'])) {
        if($CART->deleteItem('products', 'product_id', $_GET['del-product'])){
            $DELETED_CATEGORY = new ThrowError('Produkt został usunięty!', true);
            $DELETED_CATEGORY->displayError('true');
        } else {
            $ERROR_CATEGORY = new ThrowError('Produkt nie został usunięty!', true);
            $ERROR_CATEGORY->displayError(false);
        }
    }

    if(isset($_POST['commit-edit-user']) && $_POST['commit-edit-user'] == true){
        if($USER->editUser($_POST['user-id'], $_POST['user-name'], $_POST['user-surname'], $_POST['user-login'], $_POST['user-password'], $_POST['user-address'], $_POST['user-city'], $_POST['user-postcode'], $_POST['user-phonenumber'], $_POST['user-province'], $_POST['user-isadmin'])){
            $EDITED_USER = new ThrowError('Użytkownik został zmieniony!', true);
            $EDITED_USER->displayError('true');
        } else {
            $ERROR_USER = new ThrowError('Użytkownik nie został zmieniony!', true);
            $ERROR_USER->displayError(false);
        }
    }

?>
    <main class="user-info-wrapper" style="margin-bottom: 10vw">
        <h1 style="font-size: 3.5vw; margin-bottom: 0.3em; margin-top: 2em;">PRODUKTY</h1>
        <section class="order-archive-wrapper">
            <article class="content-wrapper login-article" style="padding-top: 1em; padding-left: 0; padding-right: 0; flex-direction: column;">
                <div class="product">
                <form action="adminpanel.php" class="product-add-form" method="POST" enctype="multipart/form-data">
                    <div>
                        <span class="info-inner" style="padding: 0.5em 2em;">DODAJ PRODUKT</span>
                    </div>
                    <div class="product-edit-inputs">
                        <div>
                            <div>
                                <label class="login-label" for="product-name">NAZWA PRODUKTU</label><br>
                                <input type="text" name="product-name" id="product-name" maxlength="30" />
                            </div>
                            <div>
                                <label class="login-label" for="product-desc">OPIS PRODUKTU</label><br>
                                <textarea style="height: 9.45em;" class="product-desc" name="product-desc" id="product-desc"></textarea>
                            </div>
                            <div>
                                <label class="login-label" for="image">ZDJĘCIE [500x500px, png]</label><br>
                                <input type="file" name="image" class="image">
                            </div>
                        </div>
                        <div>
                            <div>
                                <label class="login-label" for="product-manufacturer">AUTOR</label><br>
                                <select name="product-manufacturer" id="product-manufacturer">
                                    <?php $CART->getManufacturers(); ?>
                                </select>
                            </div>
                            <div>
                                <label class="login-label" for="product-category">KATEGORIA</label><br>
                                <select name="product-category" id="product-category">
                                    <?php $CART->getCategories(); ?>
                                </select>
                            </div>
                            <div>
                                <label class="login-label" for="product-price">CENA</label><br>
                                <input type="text" name="product-price" id="product-price" maxlength="30"/>
                            </div>
                            <div>
                                <label class="login-label" for="product-quantity">ILOŚĆ</label><br>
                                <input type="text" name="product-quantity" id="product-quantity" maxlength="30"/>
                            </div>
                        </div>
                    </div>
                    <button class="button-link login-button" style="padding: 1em 2em; margin-top: 1.5em;"><span>DODAJ</span></button>
                    <input type="hidden" name="commit-add-product" value="true">
                </form>
                </div>
            </article>
        </section>
        <section class="order-archive-wrapper">
            <article class="content-wrapper login-article" style="padding-top: 1em; padding-left: 0; padding-right: 0; flex-direction: column;">
                <?php 
                    $CART->editProductsList();
                ?>
            </article>
        </section>
        <h1 style="font-size: 3.5vw; margin-bottom: 0.3em; margin-top: 0.5em;">KATEGORIE</h1>
        <section class="add-category-wrapper">
            <article class="content-wrapper login-article" style="padding-top: 1em; padding-left: 0; padding-right: 0; flex-direction: column;">
                <div class="product">
                <form action="adminpanel.php" class="product-add-form" method="POST">
                    <div>
                        <span class="info-inner" style="padding: 0.5em 2em;">DODAJ KATEGORIĘ</span>
                    </div>
                    <div class="product-edit-inputs">
                        <div>
                            <div>
                                <label class="login-label" for="category-name">NAZWA KATEGORII</label><br>
                                <input type="text" name="category-name" id="category-name" maxlength="30" />
                            </div>
                    <button class="button-link login-button" style="padding: 1em 2em; margin-top: 1.5em;"><span>DODAJ</span></button>
                    <input type="hidden" name="commit-add-category" value="true">
                </form>
                </div>
            </article>
        </section>
        <section class="edit-category-wrapper">
            <article class="content-wrapper login-article" style="padding-top: 1em; padding-left: 0; padding-right: 0; flex-direction: column;">
                <?php $CART->editCategoryList(); ?>
            </article>
        </section>
        <h1 style="font-size: 3.5vw; margin-bottom: 0.3em; margin-top: 0.5em;">UŻYTKOWNICY</h1>
        <section class="edit-users-wrapper">
            <article class="content-wrapper login-article" style="padding-top: 1em; padding-left: 0; padding-right: 0; flex-direction: column;">
                <?php $USER->editUserList() ?>    
            </article>
        </section>
    </main>
</div>