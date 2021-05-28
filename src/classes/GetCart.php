<?php

class GetCart {

    private $DB;

    function __construct($DB){
        $this->DB = $DB;
    }

    public function displayCartItems($uid){
        $CART_QUERY = "SELECT *, c.product_quantity AS current_quantity, p.product_quantity AS limit_quantity FROM cart c INNER JOIN categories USING(category_id) INNER JOIN products p USING(product_id) WHERE user_id=$uid";
        $CART_RESULT = $this->DB->query($CART_QUERY);

        if(!$uid){
            ?>
                <h1 class="blank-cart">Zaloguj się, aby korzystać z koszyka!</h1>
            <?php
            return false;
        }

        if($CART_RESULT->num_rows > 0){
            while($CART_ROW = $CART_RESULT->fetch_object()){
                ?>
                        <div class="product" style="margin-top: 2em">
                            <div style="display: flex; justfiy-content: space-between; align-items: center">
                                <a href="viewproduct.php?vkey=<?php echo $CART_ROW->product_id; ?>"><h2 class="product-title"><?php echo $CART_ROW->product_name;?></h2></a>
                                <span style="padding: 0.5em; margin-left: 0.5em"><?php echo $CART_ROW->product_price * $CART_ROW->current_quantity; ?> zł</span>
                            </div>
                            <div class="cart-info-wrapper">
                                <div class="inner-info-wrapper">
                                    <form action="cart.php">
                                        <input type="hidden" name="vkey" value="<?php echo $CART_ROW->product_id;?>">
                                        <select name="new-quantity" style="margin-left: 0.5em" onchange="this.form.submit()">
                                            <?php
                                                for ($i=1; $i <= $CART_ROW->limit_quantity; $i++) { 
                                                    ?>
                                                        <option <?php if($i == $CART_ROW->current_quantity){echo 'selected="selected"' ;} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </form>
                                    <span class="info-inner" style="padding: 0.5em; margin-left: 0.5em"><?php echo $CART_ROW->category_name; ?></span>
                                </div>
                                <div>
                                    <a href="cart.php?vkey=<?php echo $CART_ROW->product_id; ?>&delete=1"><button class="button-link"><span>USUŃ</span></button></a>
                                </div>
                            </div>
                        </div>
                <?php
            }
        } else {
            ?>
                <h1 class="blank-cart">Koszyk jest pusty!</h1>
            <?php
        }
    }

    public function updateCartQuantity($vkey, $new_quantity, $uid){
        $QUANTITY_QUERY = "UPDATE cart SET product_quantity=$new_quantity WHERE product_id=$vkey AND user_id=$uid";
        $QUANTITY_RESULT = $this->DB->query($QUANTITY_QUERY);
        header('Location: cart.php');
    }

    public function deleteCartItem($vkey, $uid){
        $DELETE_QUERY = "DELETE FROM cart WHERE product_id=$vkey AND user_id=$uid";
        $DELETE_RESULT = $this->DB->query($DELETE_QUERY);
        header('Location: cart.php');
    }

    public function getItemQuantity($uid){
        if(!$uid){
            return 0;
        }

        $IQUANTITY_QUERY = "SELECT * FROM cart WHERE user_id=$uid";
        $IQUANTITY_RESULT = $this->DB->query($IQUANTITY_QUERY);
        if($IQUANTITY_RESULT){
            if($IQUANTITY_RESULT->num_rows > 9){
                return '9+';
            } else {
                return $IQUANTITY_RESULT->num_rows;
            }
        } else {
            return 0;
        }
    }

    public function getTotalPrice($uid){
        $TOTALPRICE_QUERY = "SELECT product_price, c.product_quantity FROM cart c INNER JOIN products USING(product_id) WHERE user_id=$uid";
        $TOTALPRICE_RESULT = $this->DB->query($TOTALPRICE_QUERY);

        $total_price = 0;
        while($TOTALPRICE_ROW = $TOTALPRICE_RESULT->fetch_object()){
            $total_price = $total_price + ($TOTALPRICE_ROW->product_price * $TOTALPRICE_ROW->product_quantity);
        }
        return $total_price;
    }

    public function getTotalPriceFromArchive($uid, $oid){
        $TOTALPRICE_QUERY = "SELECT *, c.product_quantity AS quantity FROM cart_archive c INNER JOIN products USING(product_id) INNER JOIN orders_middleground m USING(archive_id) WHERE m.user_id=$uid AND order_id=$oid";
        $TOTALPRICE_RESULT = $this->DB->query($TOTALPRICE_QUERY);

        $total_price = 0;
        while($TOTALPRICE_ROW = $TOTALPRICE_RESULT->fetch_object()){
            $total_price = $total_price + ($TOTALPRICE_ROW->product_price * $TOTALPRICE_ROW->quantity);
        }
        return $total_price;
    }

    public function getCartList($uid){
            $CART_QUERY = "SELECT *, c.product_quantity AS current_quantity, p.product_quantity AS limit_quantity FROM cart c INNER JOIN categories USING(category_id) INNER JOIN products p USING(product_id) WHERE user_id=$uid";
            $CART_RESULT = $this->DB->query($CART_QUERY);
    
            ?>
            <ul>
            <?php
                if($CART_RESULT->num_rows > 0){
                    while($CART_ROW = $CART_RESULT->fetch_object()){
                        ?>
                            <li style="margin-bottom: 2em;">
                                <h3><?php echo strtoupper($CART_ROW->product_name); ?></h3>
                                <div style="display: flex;">
                                    <p><span class="info-inner" style="padding: 0.2em; font-weight: normal;"><?php echo $CART_ROW->category_name; ?></span></p>
                                    <p><span class="info-inner" style="padding: 0.2em; font-weight: normal;"><?php echo $CART_ROW->product_price; ?> zł</span></p>
                                </div>
                            </li>
                        <?php
                    }
                } else {
                    header('Location: products.php');
                }
                    ?>
            </ul>
            <?php
        }

        public function getPaymentOptions(){
            $PAYMENT_QUERY = "SELECT * FROM payments";
            $PAYMENT_RESULT = $this->DB->query($PAYMENT_QUERY);

            while($PAYMENT_ROW = $PAYMENT_RESULT->fetch_object()){
               ?>
                    <option value="<?php echo $PAYMENT_ROW->payment_id; ?>"><?php echo $PAYMENT_ROW->payment_name; ?></option>
               <?php
            }
        }

        public function getManufacturers(){
            $MANUFACTURER_QUERY = "SELECT manufacturer_id, manufacturer_name, manufacturer_surname FROM manufacturers";
            $MANUFACTURER_RESULT = $this->DB->query($MANUFACTURER_QUERY);

            while($MANUFACTURER_ROW = $MANUFACTURER_RESULT->fetch_object()){
               ?>
                    <option value="<?php echo $MANUFACTURER_ROW->manufacturer_id; ?>"><?php echo $MANUFACTURER_ROW->manufacturer_name.' '.$MANUFACTURER_ROW->manufacturer_surname; ?></option>
               <?php
            }
        }

        public function getCategories(){
            $CATEGORY_QUERY = "SELECT category_id, category_name FROM categories";
            $CATEGORY_RESULT = $this->DB->query($CATEGORY_QUERY);

            while($CATEGORY_ROW = $CATEGORY_RESULT->fetch_object()){
                ?>
                <option value="<?php echo $CATEGORY_ROW->category_id; ?>">
                    <?php echo $CATEGORY_ROW->category_name; ?>
                </option>
                <?php
               }
        }

        public function commitOrder($uid, $payment){
            $ORDER_QUERY = "INSERT INTO orders (user_id, status_id, payment_id) VALUES ($uid, 1, $payment)";
            $ORDER_RESULT = $this->DB->query($ORDER_QUERY);
            $LAST_ORDER_ID = $this->DB->insert_id;
            $CARTS_QUERY = "SELECT * FROM cart WHERE user_id=$uid";
            $CARTS_RESULT = $this->DB->query($CARTS_QUERY);

            $FLAG = true;

            while($CARTS_ROW = $CARTS_RESULT->fetch_object()){
                $CART_ID = $CARTS_ROW->cart_id;
                $QUANTITY = $CARTS_ROW->product_quantity;

                $UPDATEQUANTITY_QUERY = "UPDATE products SET product_quantity=(product_quantity-$QUANTITY) WHERE product_id=$CARTS_ROW->product_id";

                $ARCHIVE_QUERY = "INSERT INTO cart_archive (archive_id, product_id, user_id, product_quantity, category_id) VALUES ($CARTS_ROW->cart_id, $CARTS_ROW->product_id, $CARTS_ROW->user_id, $CARTS_ROW->product_quantity, $CARTS_ROW->category_id)";

                $MIDDLEGROUND_QUERY = "INSERT INTO orders_middleground (order_id, archive_id, user_id) VALUES ($LAST_ORDER_ID, $CART_ID, $uid)";

                $CLEANCART_QUERY = "DELETE FROM cart WHERE user_id=$uid";

                $UPDATEQUANTITY_RESULT = $this->DB->query($UPDATEQUANTITY_QUERY);
                $ARCHIVE_RESULT = $this->DB->query($ARCHIVE_QUERY);
                $MIDDLEGROUND_RESULT = $this->DB->query($MIDDLEGROUND_QUERY);
                $CLEANCART_RESULT = $this->DB->query($CLEANCART_QUERY);
                
                if($UPDATEQUANTITY_RESULT && $ARCHIVE_RESULT && $MIDDLEGROUND_RESULT && $CLEANCART_RESULT){
                    $FLAG = true;
                } else {
                    $FLAG = false;
                }
            }
            if($FLAG){
                return true;
            } else {
                return false;
            }
        }

        public function getArchiveOrders($uid, $oid){
            $ARCHIVE_QUERY = "SELECT *, a.product_quantity AS quantity FROM orders_middleground m INNER JOIN cart_archive a USING(archive_id) INNER JOIN products USING(product_id) INNER JOIN orders o USING(order_id) INNER JOIN status USING(status_id) WHERE a.user_id=$uid AND order_id=$oid";
            $ARCHIVE_RESULT = $this->DB->query($ARCHIVE_QUERY);

            $COUNTER = 0;
                while($ARCHIVE_ROW = $ARCHIVE_RESULT->fetch_object()){
                    $ARCHIVE_ID = $ARCHIVE_ROW->order_id;
                            if($COUNTER == 0){
                                ?>
                                    <span class="info-inner">#<?php echo $ARCHIVE_ROW->order_id; ?></span>
                                    <span class="info-inner"><?php echo $ARCHIVE_ROW->status_name; ?></span>
                                    <span class="info-inner"><?php echo $this->getTotalPriceFromArchive($uid, $ARCHIVE_ID); ?> zł</span>
                                <?php
                                $COUNTER++;
                            }
                            ?>
                                <div class="order">
                                    <h1 class="order-title"><?php echo strtoupper($ARCHIVE_ROW->product_name); ?></h1>
                                    <h1>ILOŚĆ: <?php echo $ARCHIVE_ROW->quantity; ?></h1>
                                </div>
                            <?php
                }   
        }

        public function getArchive($uid){
            $ARCHIVE_QUERY = "SELECT DISTINCT m.order_id FROM orders_middleground m WHERE m.user_id=$uid ORDER BY order_id DESC";
            $ARCHIVE_RESULT = $this->DB->query($ARCHIVE_QUERY);

            if($ARCHIVE_RESULT->num_rows > 0 ){
                while($ARCHIVE_ROW = $ARCHIVE_RESULT->fetch_object()){
                    $ARCHIVE_ID = $ARCHIVE_ROW->order_id;
                            ?>  
                            <article class="order-wrapper">
                                <?php $this->getArchiveOrders($uid, $ARCHIVE_ROW->order_id) ?>
                            </article>
                            <?php
                }
            } else {
                ?>
                    <h1 class="blank-cart">Historia zamówień jest pusta!</h1>
                <?php
            }

        }

        public function editProductsList(){
            $PRODINFO_QUERY = "SELECT * FROM products INNER JOIN manufacturers USING (manufacturer_id) INNER JOIN categories USING(category_id) ORDER BY product_id";
            $PRODINFO_RESULT = $this->DB->query($PRODINFO_QUERY);

            while($PRODINFO_ROW = $PRODINFO_RESULT->fetch_object()){
                ?>
                        <div class="product">
                                <div style="display: flex; align-items: center">
                                    <span class="info-inner" style="padding: 0.5em 2em;">EDYTUJ #<?php echo $PRODINFO_ROW->product_id; ?></span>
                                    <a href="adminpanel.php?del-product=<?php echo $PRODINFO_ROW->product_id;?>"><button type="submit" class="button-link login-button" style="padding: 0.9em 2em 1em 2em; color: #ebebeb; background-color: rgb(202, 21, 21);"><span>USUŃ</span></button></a>
                                </div>
                            <form action="adminpanel.php" class="product-form" method="POST" enctype="multipart/form-data">
                                <div class="product-edit-inputs">
                                    <div>
                                        <div>
                                            <label class="login-label" for="product-name">NAZWA PRODUKTU</label><br>
                                            <input type="text" name="product-name" maxlength="30" value="<?php echo $PRODINFO_ROW->product_name; ?>"/>
                                        </div>
                                        <div>
                                            <label class="login-label" for="product-desc">OPIS PRODUKTU</label><br>
                                            <textarea class="product-desc" name="product-desc"><?php echo $PRODINFO_ROW->product_desc ?></textarea>
                                        </div>
                                        <div>
                                            <label class="login-label" for="image">ZDJĘCIE [500x500px, png]</label><br>
                                            <input type="file" name="image" class="image">
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <label class="login-label" for="product-manufacturer">AUTOR</label><br>
                                            <select name="product-manufacturer">
                                                <?php $this->getManufacturers(); ?>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="login-label" for="product-category">KATEGORIA</label><br>
                                            <select name="product-category">
                                                <?php 
                                                $CATEGORIES_QUERY = "SELECT * FROM categories";
                                                $CATEGORIES_RESULT = $this->DB->query($CATEGORIES_QUERY);
                                                while($CATEGORIES_ROW = $CATEGORIES_RESULT->fetch_object()){
                                                    ?>
                                                        <option <?php if($PRODINFO_ROW->category_id == $CATEGORIES_ROW->category_id){echo 'selected';} ?> value="<?php echo $CATEGORIES_ROW->category_id; ?>">
                                                        <?php echo $CATEGORIES_ROW->category_name; ?>
                                                        </option>
                                                    <?php 
                                                }
                                                
                                                ?>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="login-label" for="product-price">CENA</label><br>
                                            <input type="text" name="product-price" maxlength="30" value="<?php echo $PRODINFO_ROW->product_price; ?>"/>
                                        </div>
                                        <div>
                                            <label class="login-label" for="product-quantity">ILOŚĆ</label><br>
                                            <input type="text" name="product-quantity" maxlength="30" value="<?php echo $PRODINFO_ROW->product_quantity; ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex;">
                                    <button class="button-link login-button" style="padding: 1em 2em; margin-top: 1.5em;"><span>EDYTUJ</span></button>
                                </div>
                                <input type="hidden" name="commit-edit-product" value="true">
                                <input type="hidden" name="product-id" value="<?php echo $PRODINFO_ROW->product_id;?>">
                            </form>
                        </div>
                <?php
            };
        }

        public function editCategoryList(){
            $CATEGORY_QUERY = "SELECT * FROM categories ORDER BY category_id";
            $CATEGORY_RESULT = $this->DB->query($CATEGORY_QUERY);

            while($CATEGORY_ROW = $CATEGORY_RESULT->fetch_object()){
                ?>
                        <div class="product">
                                <div style="display: flex; align-items: center">
                                    <span class="info-inner" style="padding: 0.5em 2em;">EDYTUJ #<?php echo $CATEGORY_ROW->category_id; ?></span>
                                    <a href="adminpanel.php?del-category=<?php echo $CATEGORY_ROW->category_id;?>"><button type="submit" class="button-link login-button" style="padding: 0.9em 2em 1em 2em; color: #ebebeb; background-color: rgb(202, 21, 21);"><span>USUŃ</span></button></a>
                                </div>
                            <form action="adminpanel.php" class="product-form" method="POST">
                                <div>
                                    <div>
                                        <label class="login-label" for="edit-category-name">NAZWA KATEGORII</label><br>
                                        <input type="text" name="edit-category-name" maxlength="30" value="<?php echo $CATEGORY_ROW->category_name; ?>"/>
                                    </div>
                                </div>
                                    <input type="hidden" name="commit-edit-category" value="true">
                                    <input type="hidden" name="edit-category-id" value="<?php echo $CATEGORY_ROW->category_id; ?>">
                                    <button type="submit" class="button-link login-button" style="padding: 1em 2em; margin-top: 1.5em;"><span>EDYTUJ</span></button>
                            </form>
                        </div>
                <?php
            };
        }

        public function addCategory($category){

            $category = mysqli_real_escape_string($this->DB, $category);
            $category = htmlentities($category, ENT_QUOTES, "UTF-8");

            $categoryRegex = '/^[A-Za-z]{3,30}$/';

            if(!preg_match($categoryRegex, $category)){return false;};

            $ADDCATEGORY_QUERY = "INSERT INTO categories (category_name) VALUES ('$category')";
            if($ADDCATEGORY_RESULT = $this->DB->query($ADDCATEGORY_QUERY)){
                return true;
            } else {
                return false;
            }
        }

        public function editCategory($category_id, $name){
            $CATEGORYINFO_QUERY = "SELECT * FROM categories WHERE category_id=$category_id";
            $CATEGORYINFO_RESULT = $this->DB->query($CATEGORYINFO_QUERY);

            $name = mysqli_real_escape_string($this->DB, $name);
            $name = htmlentities($name, ENT_QUOTES, "UTF-8");

            $categoryRegex = '/^[A-Za-z]{3,30}$/';

            if(!preg_match($categoryRegex, $name)){return false;};

            while($CATEGORYINFO_ROW = $CATEGORYINFO_RESULT->fetch_object()){
                if($name == $CATEGORYINFO_ROW->category_name){$new_name = $CATEGORYINFO_ROW->category_name;} else {$new_name = $name;};

                $UPDATE_QUERY = "UPDATE categories SET category_name='$new_name' WHERE category_id=$category_id";

                if($UPDATE_RESULT = $this->DB->query($UPDATE_QUERY)){
                    return true;
                } else {
                    return false;
                }
            }

        }

        public function addProduct($name, $desc, $manufacturer, $category, $price, $quantity){

            $name = mysqli_real_escape_string($this->DB, $name);
            $name = htmlentities($name, ENT_QUOTES, "UTF-8");

            $desc = mysqli_real_escape_string($this->DB, $desc);
            $desc = htmlentities($desc, ENT_QUOTES, "UTF-8");

            $price = mysqli_real_escape_string($this->DB, $price);
            $price = htmlentities($price, ENT_QUOTES, "UTF-8");

            $quantity = mysqli_real_escape_string($this->DB, $quantity);
            $quantity = htmlentities($quantity, ENT_QUOTES, "UTF-8");

            $nameRegex = '/^[A-Za-ząłężźćśóĄŁĘŻŹĆŚŁÓ ]{3,30}$/';
            $descRegex = '/^[A-Za-ząłężźćśóĄŁĘŻŹĆŚŁÓ ,.!?]{3,255}$/';
            $priceRegex = '/^[0-9]{1,4}$/';
            $quantityRegex = '/^[0-9]{1,2}$/';

            if(!preg_match($nameRegex, $name)){return false;};
            if(!preg_match($descRegex, $desc)){return false;};
            if(!preg_match($priceRegex, $price)){return false;};
            if(!preg_match($quantityRegex, $quantity)){return false;};

            $target_dir = '../src/product-images/';
            $target_file = $target_dir.basename($_FILES['image']['name']);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $fileinfo = @getimagesize($_FILES['image']['tmp_name']);
            $width = $fileinfo[0];
            $height = $fileinfo[1];

            if($imageFileType != 'png'){return false;};
            if(file_exists($target_file)){return false;};
            if($_FILES['image']['size'] > 500000){return false;};
            if($width > '500' || $width < '500'){return false;};
            if($height > '500' || $height < '500'){return false;};

            $ADDPRODUCT_QUERY = "INSERT INTO products (product_name, product_desc, product_price, product_quantity, manufacturer_id, category_id, image_path) VALUES ('$name', '$desc', $price, $quantity
            , $manufacturer, $category, '$target_file')";

            if($ADDPRODUCT_RESULT = $this->DB->query($ADDPRODUCT_QUERY)){
                if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function editProduct($product_id, $name, $desc, $manufacturer, $category, $price, $quantity){
            $PRODUCTINFO_QUERY = "SELECT * FROM products WHERE product_id=$product_id";
            $PRODUCTINFO_RESULT = $this->DB->query($PRODUCTINFO_QUERY);

            $name = mysqli_real_escape_string($this->DB, $name);
            $name = htmlentities($name, ENT_QUOTES, "UTF-8");

            $desc = mysqli_real_escape_string($this->DB, $desc);
            $desc = htmlentities($desc, ENT_QUOTES, "UTF-8");

            $price = mysqli_real_escape_string($this->DB, $price);
            $price = htmlentities($price, ENT_QUOTES, "UTF-8");

            $quantity = mysqli_real_escape_string($this->DB, $quantity);
            $quantity = htmlentities($quantity, ENT_QUOTES, "UTF-8");

            $nameRegex = '/^[A-Za-ząłężźćśóĄŁĘŻŹĆŚŁÓ ]{3,30}$/';
            $descRegex = '/^[A-Za-ząłężźćśóĄŁĘŻŹĆŚŁÓ ,.!?]{3,255}$/';
            $priceRegex = '/^[0-9]{1,4}$/';
            $quantityRegex = '/^[0-9]{1,2}$/';

            if(!preg_match($nameRegex, $name)){return false;};
            if(!preg_match($descRegex, $desc)){return false;};
            if(!preg_match($priceRegex, $price)){return false;};
            if(!preg_match($quantityRegex, $quantity)){return false;};

            if($_FILES['image']['tmp_name']){
                $target_dir = '../src/product-images/';
                $target_file = $target_dir.basename($_FILES['image']['name']);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                $fileinfo = @getimagesize($_FILES['image']['tmp_name']);
                $width = $fileinfo[0];
                $height = $fileinfo[1];

                if($imageFileType != 'png'){return false;};
                if(file_exists($target_file)){return false;};
                if($_FILES['image']['size'] > 500000){return false;};
                if($width > '500' || $width < '500'){return false;};
                if($height > '500' || $height < '500'){return false;};
            }

            while($PRODUCTINFO_ROW = $PRODUCTINFO_RESULT->fetch_object()){
                if($name == $PRODUCTINFO_ROW->product_name){$new_name = $PRODUCTINFO_ROW->product_name;} else {$new_name = $name;};
                if($desc == $PRODUCTINFO_ROW->product_desc){$new_desc = $PRODUCTINFO_ROW->product_desc;} else {$new_desc = $desc;};
                if($manufacturer == $PRODUCTINFO_ROW->manufacturer_id){$new_manufacturer = $PRODUCTINFO_ROW->manufacturer_id;} else {$new_manufacturer = $manufacturer;};
                if($category == $PRODUCTINFO_ROW->category_id){$new_category = $PRODUCTINFO_ROW->category_id;} else {$new_category = $category;};
                if($price == $PRODUCTINFO_ROW->product_price){$new_price = $PRODUCTINFO_ROW->product_price;} else {$new_price = $price;};
                if($quantity == $PRODUCTINFO_ROW->product_quantity){$new_quantity = $PRODUCTINFO_ROW->product_quantity;} else {$new_quantity = $quantity;};
                if($_FILES['image']['tmp_name']){
                    if($target_file == $PRODUCTINFO_ROW->image_path){
                        $new_target_file = $PRODUCTINFO_ROW->image_path;
                    } else {
                        $new_target_file = $target_file;
                    }
                } else {
                    $new_target_file=$PRODUCTINFO_ROW->image_path;
                };

                $UPDATE_QUERY = "UPDATE products
                    SET product_name='$new_name',
                        product_desc='$new_desc',
                        product_price=$new_price,
                        product_quantity=$new_quantity,
                        manufacturer_id=$new_manufacturer,
                        category_id=$new_category,
                        image_path='$new_target_file'
                        WHERE product_id=$product_id";

                if($UPDATE_RESULT = $this->DB->query($UPDATE_QUERY)){
                    if($_FILES['image']['tmp_name']){
                        if(move_uploaded_file($_FILES['image']['tmp_name'], $new_target_file)){
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return true;
                    }
                } else {
                    return false;
                }
            }

        }

        public function deleteItem($target, $item_id_name, $item_id){
            $DELETE_QUERY = "DELETE FROM $target WHERE $item_id_name=$item_id";
            if($DELETE_RESULT = $this->DB->query($DELETE_QUERY)){
                return true;
            } else {
                return false;
            }
        }

}

?>