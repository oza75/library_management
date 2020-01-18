<?php
require_once '../../../session.php';
require_once '../../../functions/helpers.php';
require_once '../../../database.php';
if (!admin_is_logged()) redirect('/admin/login.php?redirect_url=' . $_SERVER['REQUEST_URI']);
if (!empty($_POST)) {
    $first_name = $_POST['first_name'] ?? null;
    $last_name = $_POST['last_name'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $password_confirmation = $_POST['password_confirmation'] ?? null;

    if ($user = selectWithSql('select * from users where email = ?', [$email])) {
        session_flash('error', 'Un autre utilisateur a déjà cette adresse email');
        redirect($_SERVER['REQUEST_URI'], ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email]);
    }

    if (!$first_name || !$last_name || !$email || !$password || !$password_confirmation) {
        session_flash('error', "Veuillez bien remplir les champs !");
        redirect($_SERVER['REQUEST_URI'], ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email]);
    }

    if ($password !== $password_confirmation) {
        session_flash('error', "Les deux mots de passe doivent être egaux");
        redirect($_SERVER['REQUEST_URI'], ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email]);

    }


    $attributes = ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email];
    $attributes['password'] = password_hash($password, PASSWORD_ARGON2ID);

    $user = insertInto('users', ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'password' => password_hash($password, PASSWORD_ARGON2ID)]);
    session_flash('success', "Utilisateur crée avec succès !");

}
admin_view('create-user', [], '/..');