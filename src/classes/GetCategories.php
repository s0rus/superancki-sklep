<?php 

    class GetCategories {

        private $DB;

        function __construct($DB){
            $this->DB = $DB;
        }

        public function displayCategories() {
            $CATEGORIES_QUERY  = "SELECT * FROM categories";
            $CATEGORIES_RESULT = $this->DB->query($CATEGORIES_QUERY);

            echo '<a href="products.php"><div class="category">Wszystko</div></a>';
            while($CATEGORIES_ROW = $CATEGORIES_RESULT->fetch_object()){
                echo '<a href="products.php?category='.$CATEGORIES_ROW->category_id.'"><div class="category">'.$CATEGORIES_ROW->category_name.'</div></a>';
            }
        }
    }

?>