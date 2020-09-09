<?php 

    class ThrowError {

        private $errorMessage;
        private $styledError;

        function __construct($errorMessage, $styledError){
            $this->errorMessage = $errorMessage;
            $this->styledError = $styledError;
        }

        public function displayError() {
            if($this->styledError) {
                echo <<< errorDiv
                <div class="error-wrapper">
                    <svg class="error-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="crimson">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p>$this->errorMessage</p>
                </div>
                errorDiv;
            } else {
                echo $this->errorMessage;
            }
        }
    }

?>