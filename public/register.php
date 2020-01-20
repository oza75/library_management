<?php
require_once '../session.php';
require_once '../functions/helpers.php';
require_once '../database.php';
$redirect_url = $_GET['redirect_url'] ?? null;
if (!empty($_POST)) {
    $first_name = $_POST['first_name'] ?? null;
    $last_name = $_POST['last_name'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $password_confirmation = $_POST['password_confirmation'] ?? null;

    if (!$first_name || !$last_name || !$email || !$password || !$password_confirmation) {
        echo "Veuillez bien remplir les champs";
        return;
    }

    if ($password !== $password_confirmation) {
        echo "Les deux mots mot de passe doivent être egaux!";
        return;
    }

    if ($user = selectWithSql('select * from users where lower(email) = ?', [strtolower($email)])) {
        echo "Vous avez deja un compte veuillez vous connecter";
        return;
    }

    $user = insertInto('users', ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'password' => password_hash($password, PASSWORD_ARGON2I)]);
    session_set('user', $user);
    session_flash('success', 'Votre compte à été bien créé !');
    redirect($redirect_url ? $redirect_url : '/');
}
view('register', []);