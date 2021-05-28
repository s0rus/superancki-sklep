<div class="wrapper">
<?php
            if(isset($_POST['commit-edit-data']) && $_POST['commit-edit-data'] == true){
                if($USER->updateAddressData($uid, $_POST['name'],$_POST['surname'], $_POST['address'], $_POST['city'], $_POST['postcode'], $_POST['phonenumber'], $_POST['province'])){
                    $EDITED = new ThrowError('Dane adresowe zostały zmienione!', true);
                    $EDITED->displayError(true);
                } else {
                    $UNEDITED = new ThrowError('Dane adresowe nie zostały zmienione!', true);
                    $UNEDITED->displayError(false);
                }
            };

            if(isset($_POST['commit-edit-password']) && $_POST['commit-edit-password'] == true){
                if($USER->updatePassword($uid, $_POST['old-password'], $_POST['new-password'])){
                    $EDITED = new ThrowError('Hasło zostało zmienione!', true);
                    $EDITED->displayError(true);
                } else {
                    $UNEDITED = new ThrowError('Hasło nie zostało zmienione', true);
                    $UNEDITED->displayError(false);
                }
                
            };

            ?>
    <main class="user-info-wrapper" style="margin-bottom: 10vw">
            <div style="display: flex; align-items: center">
                <span class="info-inner" style="padding: 0.6em 2em 0.5em 2em"><?php echo $USER->getUserLogin($uid); ?></span>
                <a href="logout.php"><button class="button-link"><span>WYLOGUJ SIĘ</span></button></a>
                <?php if(isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN'] == true){?> <a href="adminpanel.php"><button class="button-link" style="margin-left: 0.5em;"><span>PANEL</span></button></a> <?php ;}; ?>
            </div>
            <h1 style="font-size: 3.5vw; margin-bottom: 0.3em; margin-top: 0.5em;">KONTO</h1>
        <section class="data-edit-wrapper">
            <article class="login-article content-wrapper" style="background: none;">
                <form action="user.php" method="POST" id="register-form">
                    <h1 style="margin-top: 1em;">EDYTUJ DANE</h1>
                    <?php $USER->getEditInputs($uid); ?>
                </form>
            </article>
        </section>
        <section class="password-edit-wrapper">
            <article class="login-article content-wrapper" style="background: none;">
                <form action="user.php" method="POST" id="password-form">
                    <h1 style="margin-top: 1em;">EDYTUJ HASŁO</h1>
                    <div>
                        <label class="login-label" for="old-password">STARE HASŁO</label><br>
                        <input type="password" name="old-password" id="old-password" maxlength="30"/>
                    </div>
                    <div>
                        <label class="login-label" for="new-password">NOWE HASŁO</label><br>
                        <input type="password" name="new-password" id="new-password" maxlength="30"/>
                    </div>
                    <button class="button-link login-button" style="padding: 1em 2em; margin-top: 1.5em;">
                        <span>EDYTUJ</span>
                    </button>
                    <input type="hidden" name="commit-edit-password" value="true">
                </form>
            </article>
        </section>
        <h1 style="font-size: 3.5vw; margin-bottom: 0.3em; margin-top: 2em;">HISTORIA ZAMÓWIEŃ</h1>
        <section class="order-archive-wrapper">
            <article class="content-wrapper">
                <?php 
                    $CART->getArchive($uid);
                ?>
            </article>
        </section>
    </main>
</div>