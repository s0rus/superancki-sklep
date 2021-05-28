<?php 

    class GetProducts {

        private $DB;

        function __construct($DB){
            $this->DB = $DB;
        }

        public function displayProducts($category) {
            if($category == 'ALL'){
                $PRODUCTS_QUERY  = "SELECT * FROM products INNER JOIN manufacturers USING(manufacturer_id) INNER JOIN categories USING(category_id)";
            } else {
                $PRODUCTS_QUERY  = "SELECT * FROM products INNER JOIN manufacturers USING(manufacturer_id) INNER JOIN categories USING(category_id) WHERE category_id=$category";
            }
            $PRODUCTS_RESULT = $this->DB->query($PRODUCTS_QUERY);

            while($PRODUCTS_ROW = $PRODUCTS_RESULT->fetch_object()){
                ?>
                    <a href="viewproduct.php?vkey=<?php echo $PRODUCTS_ROW->product_id; ?>">
                        <div class="product">
                            <div class="product-info-wrapper">
                                <div style="flex: 2">
                                    <h2><?php echo $PRODUCTS_ROW->product_name;?></h2>
                                    <p><?php echo $PRODUCTS_ROW->manufacturer_name.' '.$PRODUCTS_ROW->manufacturer_surname ;?></p>
                                    <div class="product-info">
                                        <span class="info-inner"><?php echo $PRODUCTS_ROW->category_name; ?></span>
                                        <span class="info-inner">ILOŚĆ: <?php echo $PRODUCTS_ROW->product_quantity; ?></span>
                                        <span class="info-inner"><?php echo $PRODUCTS_ROW->product_price; ?> zł</span>
                                    </div>
                                </div>
                                <div>
                                    <img style="width: 250px;" src="<?php echo $PRODUCTS_ROW->image_path; ?>">
                                </div>
                            </div>
                        </div>
                    </a>
                <?php
            }
        }

        public function displayProduct($vkey, $uid){
            $PRODUCT_QUERY = "SELECT * FROM products INNER JOIN manufacturers USING(manufacturer_id) INNER JOIN categories USING(category_id) WHERE product_id=$vkey";
            $PRODUCT_RESULT = $this->DB->query($PRODUCT_QUERY);

            while($PRODUCT_ROW = $PRODUCT_RESULT->fetch_object()){
                ?>
                    <div class="product-view-wrapper">
                        <section class="product-info">
                            <span class="info-inner">#<?php echo $PRODUCT_ROW->product_id; ?></span>
                            <span class="info-inner"><?php echo $PRODUCT_ROW->category_name; ?></span>
                            <span class="info-inner">ILOŚĆ: <?php echo $PRODUCT_ROW->product_quantity; ?></span>
                            <article style="margin-top: 0.5em; margin-right: 0.5em;">
                                <h3><?php echo $PRODUCT_ROW->product_desc ?></h3>
                            </article>
                            <article style="margin-top: 0.5em;">
                                <h2>AUTOR: <?php echo $PRODUCT_ROW->manufacturer_name.' '.$PRODUCT_ROW->manufacturer_surname ?></h2>
                            </article>
                            <article style="margin-top: 3em;">
                            <h1 style="font-size: 4em; margin-bottom: 0.5em;"><?php echo $PRODUCT_ROW->product_price; ?> zł</h1>
                            </article>
                            <article class="tocart-form">
                                <?php 
                                    if($uid){
                                        ?>
                                            <form action="viewproduct.php?vkey=<?php echo $vkey; ?>" method="POST">
                                                <input type="hidden" name="addtocart" value="1">
                                                <button class="button-link" style="margin-top: 3em" <?php if($PRODUCT_ROW->product_quantity == 0){echo 'disabled';}; ?>><span>Do koszyka</span></button>
                                                <?php if($PRODUCT_ROW->product_quantity > 0){ ?>
                                                <select name="quantity" style="margin-left: 0.5em">
                                                    <?php
                                                        
                                                            for ($i=1; $i <= $PRODUCT_ROW->product_quantity; $i++) { 
                                                                ?>
                                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                <?php
                                                            }
                                                        
                                                    ?>
                                                </select>
                                                <?php } ?>
                                            </form>
                                        <?php
                                    } else {
                                        ?>
                                            <p>Zaloguj się, aby dodać produkt do koszyka</p>
                                        <?php
                                    }
                                ?>
                            </article>
                        </section>
                        <div style="display: flex; justify-content: center; align-items: center;">
                            <img style="width: 100%;" src="<?php echo $this->getImage($vkey);?>">
                        </div>
                    </div>
                    <a href="products.php"><button style="margin-top: 2em" class="button-link"><span>WRÓĆ</span></button></a>
                <?php
            }
        }

        public function getProductName($vkey){
            $TITLE_QUERY = "SELECT product_name FROM products WHERE product_id=$vkey";
            $TITLE_RESULT = $this->DB->query($TITLE_QUERY);

            while($TITLE_ROW = $TITLE_RESULT->fetch_object()){
                return $TITLE_ROW->product_name;
            }
        }

        public function getProductQuantity($vkey){
            $QUANTITY_QUERY = "SELECT product_quantity FROM products WHERE product_id=$vkey";
            $QUANTITY_RESULT = $this->DB->query($QUANTITY_QUERY);

            while($QUANTITY_ROW = $QUANTITY_RESULT->fetch_object()){
                return $QUANTITY_ROW->product_quantity;
            }
        }

        public function getProductCategory($vkey){
            $CATEGORY_QUERY = "SELECT category_id FROM products INNER JOIN categories USING(category_id) WHERE product_id=$vkey";
            $CATEGORY_RESULT = $this->DB->query($CATEGORY_QUERY);

            while($CATEGORY_ROW = $CATEGORY_RESULT->fetch_object()){
                return $CATEGORY_ROW->category_id;
            }
        }

        public function getImage($pid){
            $IMAGE_QUERY = "SELECT image_path FROM products WHERE product_id=$pid";
            $IMAGE_RESULT = $this->DB->query($IMAGE_QUERY);

            while($IMAGE_ROW = $IMAGE_RESULT->fetch_object()){
               return $IMAGE_ROW->image_path;
            }
        }

        public function addToCart($vkey, $new_quantity, $uid){

            $category = $this->getProductCategory($vkey);

            $QUANTITY_QUERY = "SELECT * FROM cart WHERE product_id=$vkey";
            $ADDTOCART_QUERY = "INSERT INTO cart (product_id, user_id, product_quantity, category_id) VALUES ($vkey, $uid, $new_quantity, $category)";

            if($QUANTITY_RESULT = $this->DB->query($QUANTITY_QUERY)){
                if($QUANTITY_RESULT->num_rows>0){    
                    while($QUANTITY_ROW = $QUANTITY_RESULT->fetch_object()){
                        
                        $limit_quantity = $this->getProductQuantity($vkey);
                        $original_quantity = $QUANTITY_ROW->product_quantity;
                        $quantity = $original_quantity + $new_quantity;

                        if($quantity > $limit_quantity){
                            $quantity = $limit_quantity;
                        }

                        $UPDATE_QUERY = "UPDATE cart SET product_quantity=$quantity WHERE product_id=$vkey";
    
                        if($this->DB->query($UPDATE_QUERY)){
                            return true;
                        } else {
                            return false;
                        }
                    }

                } else {
                    if($this->DB->query($ADDTOCART_QUERY)){
                        return true;
                    } else {
                        return false;
                    }
                }

            } else {
                return false;
            }

        }
    }

?>