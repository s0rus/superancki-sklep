<?php 

class GetLogin {

    private $DB;

    function __construct($DB){
        $this->DB = $DB;
    }

    public function loginUser($login, $password){

        if($login == '' || $password == ''){
            return false;
        }

        $login = mysqli_real_escape_string($this->DB, $login);
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");

        $password = mysqli_real_escape_string($this->DB, $password);
        $password = htmlentities($password, ENT_QUOTES, "UTF-8");
        $password = md5($password);

        if($password == $this->getPasswordHash($login)){
            $LOGIN_QUERY = "SELECT * FROM users WHERE user_login='$login'";

            if($LOGIN_RESULT = $this->DB->query($LOGIN_QUERY)){
                if($LOGIN_RESULT->num_rows > 0) {
                    $_SESSION['LOGGED_IN'] = true;
                    $_SESSION['USER_ID'] = $this->getUserId($login);
                    $_SESSION['IS_ADMIN'] = $this->getUserPermissions($login);
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    private function getUserId($login){
        $GETID_QUERY = "SELECT user_id FROM users WHERE user_login='$login'";
        $GETID_RESULT = $this->DB->query($GETID_QUERY);

        while($GETID_ROW = $GETID_RESULT->fetch_object()){
            return $GETID_ROW->user_id;
        }
    }

    public function getUserLogin($uid){
        $GETLOGIN_QUERY = "SELECT user_login FROM users WHERE user_id=$uid";
        $GETLOGIN_RESULT = $this->DB->query($GETLOGIN_QUERY);

        while($GETLOGIN_ROW = $GETLOGIN_RESULT->fetch_object()){
            return $GETLOGIN_ROW->user_login;
        }
    }

    private function getPasswordHash($login){
        $HASH_QUERY = "SELECT user_password FROM users WHERE user_login='$login'";
        $HASH_RESULT = $this->DB->query($HASH_QUERY);

        while($HASH_ROW = $HASH_RESULT->fetch_object()){
            return $HASH_ROW->user_password;
        }
    }

    private function getUserPermissions($login){
        $GETPERMISSIONS_QUERY = "SELECT user_isadmin FROM users WHERE user_login='$login'";
        $GETPERMISSIONS_RESULT = $this->DB->query($GETPERMISSIONS_QUERY);

        while($GETPERMISSIONS_ROW = $GETPERMISSIONS_RESULT->fetch_object()){
            return $GETPERMISSIONS_ROW->user_isadmin;
        }
    }

    private function getProvinces($selected_province){
        $GETPROVINCES_QUERY = "SELECT * FROM provinces ORDER BY province_name";
        $GETPROVINCES_RESULT = $this->DB->query($GETPROVINCES_QUERY);

        while($GETPROVINCES_ROW = $GETPROVINCES_RESULT->fetch_object()){
            ?>
                <option <?php if($GETPROVINCES_ROW->province_id == $selected_province){echo 'selected';}; ?> value="<?php echo $GETPROVINCES_ROW->province_id; ?>"><?php echo $GETPROVINCES_ROW->province_name; ?></option>
            <?php
        }
    }

    //form without login data
    public function getEditInputs($uid){
        $EDITINPUTS_QUERY = "SELECT * FROM users WHERE user_id=$uid";
        $EDITINPUTS_RESULT = $this->DB->query($EDITINPUTS_QUERY);

        while($EDITINPUTS_ROW = $EDITINPUTS_RESULT->fetch_object()){
            ?>
            <div>
                <label class="login-label" for="name">IMIĘ</label><br>
                <input type="text" name="name" id="name" maxlength="30" value="<?php echo $EDITINPUTS_ROW->user_name; ?>" />
            </div>
            <div>
                <label class="login-label" for="surname">NAZWISKO</label><br>
                <input type="text" name="surname" id="surname" maxlength="30" value="<?php echo $EDITINPUTS_ROW->user_surname; ?>" />
            </div>
            <div>
                <label class="login-label" for="address">ADRES</label><br>
                <input type="text" name="address" id="address" maxlength="30" value="<?php echo $EDITINPUTS_ROW->user_address; ?>" />
            </div>
            <div>
                <label class="login-label" for="city">MIEJSCOWOŚĆ</label><br>
                <input type="text" name="city" id="city" maxlength="30" value="<?php echo $EDITINPUTS_ROW->user_city; ?>" />
            </div>
            <div>
                <label class="login-label" for="postcode">KOD POCZTOWY</label><br>
                <input type="text" name="postcode" id="postcode" maxlength="6" value="<?php echo $EDITINPUTS_ROW->user_postcode; ?>" />
            </div>
            <div>
                <label class="login-label" for="phonenumber">NR TELEFONU</label><br>
                <input type="text" name="phonenumber" id="phonenumber" maxlength="9" value="<?php echo $EDITINPUTS_ROW->user_phonenumber; ?>" />
            </div>
            <div>
                <label class="login-label" for="province">WOJEWÓDZTWO</label><br>
                <select name="province" id="province">
                    <?php $this->getProvinces($EDITINPUTS_ROW->province_id); ?>
                </select>
            </div>
            
            <button class="button-link login-button" style="padding: 1em 2em; margin-top: 1.5em;"><span>EDYTUJ</span></button>
            <input type="hidden" name="commit-edit-data" value="true">
            <input type="hidden" name="product-id" value="<?php $EDITINPUTS_ROW->product_id ?>">
            <?php
        }
    }

    public function updateAddressData($uid, $name, $surname, $address, $city, $postcode, $phonenumber, $province){
        $ADATA_QUERY = "SELECT * FROM users WHERE user_id=$uid";
        $ADATA_RESULT = $this->DB->query($ADATA_QUERY);

        $addressRegex = "/[\w',-\\/.\s]/";
        $postcodeRegex = '/^[0-9]{2}-[0-9]{3}$/';
        $phonenumberRegex = '/^[0-9]{9}$/';
        
        if(!preg_match($addressRegex, $address)){return false;};
        if(!preg_match($postcodeRegex, $postcode)){return false;};
        if(!preg_match($phonenumberRegex, $phonenumber)){return false;};

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

        while($ADATA_ROW = $ADATA_RESULT->fetch_object()){
            if($name == $ADATA_ROW->user_name){$new_name = $ADATA_ROW->user_name;} else {$new_name = $name;};
            if($surname == $ADATA_ROW->user_surname){$new_surname = $ADATA_ROW->user_surname;} else {$new_surname = $surname;};
            if($address == $ADATA_ROW->user_address){$new_address = $ADATA_ROW->user_address;} else {$new_address = $address;};
            if($city == $ADATA_ROW->user_city){$new_city = $ADATA_ROW->user_city;} else {$new_city = $city;};
            if($postcode == $ADATA_ROW->user_postcode){$new_postcode = $ADATA_ROW->user_postcode;} else {$new_postcode = $postcode;};
            if($phonenumber == $ADATA_ROW->user_phonenumber){$new_phonenumber = $ADATA_ROW->user_phonenumber;} else {$new_phonenumber = $phonenumber;};
            if($province == $ADATA_ROW->province_id){$new_province = $ADATA_ROW->province_id;} else {$new_province = $province;};

            $UPDATE_QUERY = "UPDATE users
                                SET user_name='$new_name',
                                user_surname='$new_surname',
                                user_address='$new_address',
                                user_city='$new_city',
                                user_postcode='$new_postcode',
                                province_id=$new_province,
                                user_phonenumber=$new_phonenumber
                                WHERE user_id=$uid
                                ";

            if($UPDATE_RESULT = $this->DB->query($UPDATE_QUERY)){
                return true;
            } else {
                return false;
            }
        }
}
        public function updatePassword($uid, $old_password, $new_password){
            $PDATA_QUERY = "SELECT user_password FROM users WHERE user_id=$uid";
            $PDATA_RESULT = $this->DB->query($PDATA_QUERY);

            $passwordRegex = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';
            if(!preg_match($passwordRegex, $new_password)){return false;};

            $new_password = md5($new_password);
            $old_password = md5($old_password);

            while($PDATA_ROW = $PDATA_RESULT->fetch_object()){
                if($PDATA_ROW->user_password == $old_password){
                    $PUPDATE_QUERY = "UPDATE users SET user_password='$new_password' WHERE user_id=$uid";
                    if($PUPDATE_RESULT = $this->DB->query($PUPDATE_QUERY)){
                        return true;
                    } else {
                        return false;
                    }
                } else {    
                   return false;
                }
            }
        }

        public function editUserList(){
            $USERS_QUERY = "SELECT * FROM users";
            $USERS_RESULT = $this->DB->query($USERS_QUERY);

            while($USERS_ROW = $USERS_RESULT->fetch_object()){
                ?>
                <div class="product users">
                                <div style="display: flex; align-items: center">
                                    <span class="info-inner" style="padding: 0.5em 2em;">EDYTUJ #<?php echo $USERS_ROW->user_id; ?></span>
                                </div>
                            <form action="adminpanel.php" class="product-form" method="POST">
                                <div class="product-edit-inputs">
                                    <div>
                                        <div>
                                            <label class="login-label" for="user-name">IMIĘ</label><br>
                                            <input type="text" name="user-name" maxlength="30" value="<?php echo $USERS_ROW->user_name; ?>"/>
                                        </div>
                                        <div>
                                            <label class="login-label" for="user-surname">NAZWISKO</label><br>
                                            <input type="text" name="user-surname" maxlength="30" value="<?php echo $USERS_ROW->user_surname; ?>"/>
                                        </div>
                                        <div>
                                            <label class="login-label" for="user-login">LOGIN</label><br>
                                            <input type="text" name="user-login" maxlength="30" value="<?php echo $USERS_ROW->user_login; ?>"/>
                                        </div>
                                        <div>
                                            <label class="login-label" for="user-password">HASŁO</label><br>
                                            <input type="password" name="user-password" maxlength="30"/>
                                        </div>
                                        <div>
                                            <label class="login-label" for="user-isadmin">UPRAWNIENIA</label><br>
                                            <select name="user-isadmin">
                                                <option value="0" <?php if($USERS_ROW->user_isadmin == 0){echo 'selected';}; ?>>Użytkownik</option>
                                                <option value="1" <?php if($USERS_ROW->user_isadmin == 1){echo 'selected';}; ?>>Administrator</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <label class="login-label" for="user-address">ADRES</label><br>
                                            <input type="text" name="user-address" maxlength="30" value="<?php echo $USERS_ROW->user_address; ?>"/>
                                        </div>
                                        <div>
                                            <label class="login-label" for="user-city">MIASTO</label><br>
                                            <input type="text" name="user-city" maxlength="30" value="<?php echo $USERS_ROW->user_city; ?>"/>
                                        </div>
                                        <div>
                                            <label class="login-label" for="user-postcode">KOD POCZTOWY</label><br>
                                            <input type="text" name="user-postcode" maxlength="6" value="<?php echo $USERS_ROW->user_postcode; ?>"/>
                                        </div>
                                        <div>
                                            <label class="login-label" for="user-phonenumber">NR TELEFONU</label><br>
                                            <input type="text" name="user-phonenumber" maxlength="9" value="<?php echo $USERS_ROW->user_phonenumber; ?>"/>
                                        </div>
                                        <div>
                                            <label class="login-label" for="user-province">WOJEWÓDZTWO</label><br>
                                            <select name="user-province">
                                                <?php $this->getProvinces($USERS_ROW->province_id); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex;">
                                    <button class="button-link login-button" style="padding: 1em 2em; margin-top: 1.5em;"><span>EDYTUJ</span></button>
                                </div>
                                <input type="hidden" name="commit-edit-user" value="true">
                                <input type="hidden" name="user-id" value="<?php echo $USERS_ROW->user_id;?>">
                            </form>
                        </div>
                <?php
        }
        }

        public function editUser($uid, $name, $surname, $login, $password, $address, $city, $postcode, $phonenumber, $province, $isadmin){
            $ADATA_QUERY = "SELECT * FROM users WHERE user_id=$uid";
            $ADATA_RESULT = $this->DB->query($ADATA_QUERY);
            
            $emailRegex = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
            $passwordRegex = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';
            $addressRegex = "/[\w',-\\/.\s]/";
            $postcodeRegex = '/^[0-9]{2}-[0-9]{3}$/';
            $phonenumberRegex = '/^[0-9]{9}$/';

            
            
            if(!preg_match($emailRegex, $login)){return false;};
            if($password != ''){if(!preg_match($passwordRegex, $password)){return false;};}
            if(!preg_match($addressRegex, $address)){return false;};
            if(!preg_match($postcodeRegex, $postcode)){return false;};
            if(!preg_match($phonenumberRegex, $phonenumber)){return false;};
    
            $name = mysqli_real_escape_string($this->DB, $name);
            //$name = htmlentities($name, ENT_QUOTES, "UTF-8");
    
            $surname = mysqli_real_escape_string($this->DB, $surname);
            //$surname = htmlentities($surname, ENT_QUOTES, "UTF-8");

            $password = md5($password);
    
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
    
            while($ADATA_ROW = $ADATA_RESULT->fetch_object()){
                if($name == $ADATA_ROW->user_name){$new_name = $ADATA_ROW->user_name;} else {$new_name = $name;};
                if($name == $ADATA_ROW->user_name){$new_name = $ADATA_ROW->user_name;} else {$new_name = $name;};
                if($password == $ADATA_ROW->user_password){$new_password = $ADATA_ROW->user_password;} else {$new_password = $password;};
                if($surname == $ADATA_ROW->user_surname){$new_surname = $ADATA_ROW->user_surname;} else {$new_surname = $surname;};
                if($address == $ADATA_ROW->user_address){$new_address = $ADATA_ROW->user_address;} else {$new_address = $address;};
                if($city == $ADATA_ROW->user_city){$new_city = $ADATA_ROW->user_city;} else {$new_city = $city;};
                if($postcode == $ADATA_ROW->user_postcode){$new_postcode = $ADATA_ROW->user_postcode;} else {$new_postcode = $postcode;};
                if($phonenumber == $ADATA_ROW->user_phonenumber){$new_phonenumber = $ADATA_ROW->user_phonenumber;} else {$new_phonenumber = $phonenumber;};
                if($province == $ADATA_ROW->province_id){$new_province = $ADATA_ROW->province_id;} else {$new_province = $province;};
                if($isadmin == $ADATA_ROW->user_isadmin){$new_isadmin = $ADATA_ROW->user_isadmin;} else {$new_isadmin = $isadmin;};
    
                $UPDATE_QUERY = "UPDATE users
                                    SET user_name='$new_name',
                                    user_surname='$new_surname',
                                    user_login='$login',
                                    user_password='$password',
                                    user_address='$new_address',
                                    user_city='$new_city',
                                    user_postcode='$new_postcode',
                                    province_id=$new_province,
                                    user_phonenumber=$new_phonenumber,
                                    user_isadmin=$new_isadmin
                                    WHERE user_id=$uid
                                    ";
    
                if($UPDATE_RESULT = $this->DB->query($UPDATE_QUERY)){
                    return true;
                } else {
                    return false;
                }
        }
    }
}

?>