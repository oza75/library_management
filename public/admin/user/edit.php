<?php
require_once '../../../session.php';
require_once '../../../functions/helpers.php';
require_once '../../../database.php';
if (!admin_is_logged()) redirect('/admin/login.php?redirect_url=' . $_SERVER['REQUEST_URI']);

$id = $_GET['id'] ?? null;

if (empty($id) || $id == null) {
    session_flash('error', 'Une erreur inattendue s\'est produite');
    redirect_to_previous_page();
}

if (!empty($_POST)) {
    $first_name = $_POST['first_name'] ?? null;
    $last_name = $_POST['last_name'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $password_confirmation = $_POST['password_confirmation'] ?? null;

    if ($user = selectWithSql('select * from users where email = ? and id != ?', [$email, $id])) {
        session_flash('error', 'Un autre utilisateur a déjà cette adresse email');
        redirect($_SERVER['REQUEST_URI'], ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email]);
    }

    if ($password && ($password !== $password_confirmation)) {
        session_flash('error', "Les deux mots de passe doivent être egaux !");
        redirect($_SERVER['REQUEST_URI'], ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email]);
    }

    $attributes = ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email];
    if ($password) $attributes['password'] = password_hash($password, PASSWORD_ARGON2ID);

    if (updateRow('users', "where id = $id", $attributes)) {
        session_flash('success', "L'utilisateur a été bien modifié !");
    } else {
        session_flash('error', "Une erreur s'est produite");
    }

//    redirect($_SERVER['PHP_SELF']);

}
$user = selectWithSql('select * from users where id = ?', [$id]);

admin_view('edit-user', ['user' => $user], '/..');