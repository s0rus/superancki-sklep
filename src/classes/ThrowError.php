<?php 

    class ThrowError {

        private $errorMessage;
        private $styledError;

        function __construct($errorMessage, $styledError){
            $this->errorMessage = $errorMessage;
            $this->styledError = $styledError;
        }

        public function displayError($value) {
            if($this->styledError) {
                ?>
                    <div class="error-wrapper">
                        <?php 
                        if($value) {
                            ?>
                                <svg class="success-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            <?php
                        } else {
                            ?>
                                <svg class="error-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="crimson">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>    
                            <?php
                        }
                        ?>
                        <p><?php echo $this->errorMessage; ?></p>
                    </div>
                <?php
            } else {
                echo $this->errorMessage;
            }
        }
    }

?>