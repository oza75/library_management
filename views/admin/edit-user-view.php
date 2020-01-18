<?php
require_once 'partials/header.php';
?>
    <div class="edit-user-page edit-page">
        <h1 class="">Modification de l'utilisateur #<?= $user['id'] ?></h1>
        <form action="/admin/user/edit.php?id=<?= $user['id'] ?>" method="post">
            <table class="edit-table">
                <tbody>
                <?php
                admin_component('edit-input', ['label' => 'Prénom', 'name' => 'first_name', 'value' => $user['first_name'], 'placeholder' => "Prénom de l'utilisateur"], '/..');
                admin_component('edit-input', ['label' => 'Nom', 'name' => 'last_name', 'value' => $user['last_name'], 'placeholder' => "Nom de l'utilisateur"], '/..');
                admin_component('edit-input', ['label' => 'Email', 'name' => 'email', 'value' => $user['email'], 'placeholder' => "Email de l'utilisateur", 'type' => 'email'], '/..');
                admin_component('edit-input', ['label' => "Mot de passe de l'utilisateur", 'name' => 'password', 'value' => '', 'placeholder' => "Changer le mot de passe de l'utilisateur", "type" => 'password'], '/..');
                admin_component('edit-input', ['label' => "Mot de passe (Confirmation)", 'name' => 'password_confirmation', 'value' => '', 'placeholder' => "Retapez  le mot de passe de l'utilisateur", "type" => "password"], '/..');
                ?>
                </tbody>
            </table>
            <div class="button-container">
                <button class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
<?php
require_once 'partials/footer.php';
