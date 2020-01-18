<?php
require_once 'partials/header.php';
?>
    <main class="login-page">
        <div class="container-1 login-container">
            <form class="wrapper" action="/admin/login.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" value="<?= user_is_logged() ? auth_user()['email'] : ''?>" placeholder="Votre adresse email" id="email"
                           name="email">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" placeholder="Votre mot de passe" id="password"
                           name="password">
                </div>
                <button class="btn btn-primary" type="submit">Se connecter</button>
            </form>
        </div>
    </main>
<?php
require_once 'partials/footer.php';
