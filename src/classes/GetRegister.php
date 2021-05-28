<?php 

class GetRegister {

    private $DB;

    function __construct($DB){
        $this->DB = $DB;
    }

    public function registerUser($login, $password, $name, $surname, $address, $city, $postcode, $province, $phonenumber){

        if($login == '' || $password == '' || $name == '' || $surname == '' || $address == '' || $city == '' || $postcode == '' || $province == '' || $phonenumber == ''){
            return false;
        }

        $emailRegex = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
        $passwordRegex = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';
        $addressRegex = "/[\w',-\\/.\s]/";
        $postcodeRegex = '/^[0-9]{2}-[0-9]{3}$/';
        $phonenumberRegex = '/^[0-9]{9}$/';
        

        if(!preg_match($emailRegex, $login)){return false;};
        if(!preg_match($passwordRegex, $password)){return false;};
        if(!preg_match($addressRegex, $address)){return false;};
        if(!preg_match($postcodeRegex, $postcode)){return false;};
        if(!preg_match($phonenumberRegex, $phonenumber)){return false;};

        $login = mysqli_real_escape_string($this->DB, $login);
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");

        if($this->emailCheck($login) > 0){return false;}

        /* $password = mysqli_real_escape_string($this->DB, $password);
        $password = htmlentities($password, ENT_QUOTES, "UTF-8"); */
        $password = md5($password);

        $name = mysqli_real_escape_string($this->DB, $name);
        //$name = htmlentities($name, ENT_QUOTES, "UTF-8");

        $surname = mysqli_real_escape_string($this->DB, $surname);
        //$surname = htmlentities($surname, ENT_QUOTES, "UTF-8");

        $address = mysqli_real_escape_string($this->DB, $address);
        $address = htmlentities($address, ENT_QUOTES, "UTF-8");

        $city = mysqli_real_escape_string($this->DB, $city);
        $city = htmlentities($city, ENT_QUOTES, "UTF-8");

        $postcode = mysqli_real_escape_string($this->DB, $postcode);
        $postcode = htmlentities($postcode, ENT_QUOTES, "UTF-8");

        $province = mysqli_real_escape_string($this->DB, $province);
        $province = htmlentities($province, ENT_QUOTES, "UTF-8");

        $phonenumber = mysqli_real_escape_string($this->DB, $phonenumber);
        $phonenumber = htmlentities($phonenumber, ENT_QUOTES, "UTF-8");


        $REGISTER_QUERY = "INSERT INTO users (user_name, user_surname, user_login, user_password, user_address, user_city, user_postcode, province_id, user_phonenumber, user_isadmin) VALUES ('$name', '$surname', '$login', '$password', '$address', '$city', '$postcode', $province, $phonenumber, 0)";

        if($REGISTER_RESULT = $this->DB->query($REGISTER_QUERY)){

            $_SESSION['LOGGED_IN'] = true;
            $_SESSION['USER_ID'] = $this->getUserId($login);
            $_SESSION['IS_ADMIN'] = $this->getUserPermissions($login);
            
            return true;
        } else {
            return false;
        }
    }

    public function getUserId($login){
        $GETID_QUERY = "SELECT user_id FROM users WHERE user_login='$login'";
        $GETID_RESULT = $this->DB->query($GETID_QUERY);

        while($GETID_ROW = $GETID_RESULT->fetch_object()){
            return $GETID_ROW->user_id;
        }
    }

    private function getUserPermissions($login){
        $GETPERMISSIONS_QUERY = "SELECT user_isadmin FROM users WHERE user_login='$login'";
        $GETPERMISSIONS_RESULT = $this->DB->query($GETPERMISSIONS_QUERY);

        while($GETPERMISSIONS_ROW = $GETPERMISSIONS_RESULT->fetch_object()){
            return $GETPERMISSIONS_ROW->user_isadmin;
        }
    }

    private function emailCheck($login){
        $EMAILCHECK_QUERY = "SELECT * FROM users WHERE user_login='$login'";
        $EMAILCHECK_RESULT = $this->DB->query($EMAILCHECK_QUERY);

        return $EMAILCHECK_RESULT->num_rows;
    }

    public function getProvinces(){
        $GETPROVINCES_QUERY = "SELECT * FROM provinces ORDER BY province_name";
        $GETPROVINCES_RESULT = $this->DB->query($GETPROVINCES_QUERY);

        while($GETPROVINCES_ROW = $GETPROVINCES_RESULT->fetch_object()){
            ?>
                <option value="<?php echo $GETPROVINCES_ROW->province_id; ?>"><?php echo $GETPROVINCES_ROW->province_name; ?></option>
            <?php
        }
    }

    
    public function getUserInfo($uid){
        $USERINFO_QUERY = "SELECT * FROM users INNER JOIN provinces USING(province_id) WHERE user_id='$uid'";
        $USERINFO_RESULT = $this->DB->query($USERINFO_QUERY);

        while($USERINFO_ROW = $USERINFO_RESULT->fetch_object()){
            ?>
            <div style="display: flex; margin-top: 1em;">
                <h3>Imię i nazwisko: </h3><p style="margin-left: 0.5em;"><?php echo $USERINFO_ROW->user_name.' '.$USERINFO_ROW->user_surname; ?></p>
            </div>
            <div style="display: flex;">
                <h3>Adres: </h3><p style="margin-left: 0.5em;"><?php echo $USERINFO_ROW->user_address;?></p><br />
            </div>
            <div style="display: flex;">
                <h3>Poczta: </h3><p style="margin-left: 0.5em;"><?php echo $USERINFO_ROW->user_postcode.' '.$USERINFO_ROW->user_city; ?></p>
            </div>
            <div style="display: flex;">
                <h3>Województwo: </h3><p style="margin-left: 0.5em;"><?php echo $USERINFO_ROW->province_name;?></p><br />
            </div>
            <div style="display: flex;">
                <h3>Nr telefonu: </h3><p style="margin-left: 0.5em;"><?php echo $USERINFO_ROW->user_phonenumber;?></p><br />
            </div>
            <?php
        }
    }

}

?>