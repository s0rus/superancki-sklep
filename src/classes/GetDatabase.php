<?php 

class GetDatabase {

    public function connect() {
        $DB = new mysqli('localhost', 'root', '', 'superancki_sklep');

        if(!$DB){
            $DB_ERROR = new ThrowError('Błąd połączenia z bazą danych!', true);
            $DB_ERROR->displayError();
        } else {
            return $DB;
        }
    }
}

?>
        