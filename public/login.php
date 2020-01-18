<?php
require_once '../session.php';
require_once "../functions/helpers.php";
require_once '../database.php';
$redirect_url = $_GET['redirect_url'] ?? null;
if (!empty($_POST)) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$email || !$password) {
        session_flash('error', 'Veuillez bien remplir le formulaire !');
        redirect('login.php', ['email' => $email]);
    }


    $user = selectWithSql("select * from users where lower(email) = ?", [strtolower($email)]);

    if (!$user || !password_verify($password, $user['password'] ?? '')) {
        session_flash('error', 'Ces identifiants ne correspondent pas à nos enregistrements');
        redirect('login.php', ['email' => $email]);
    }

    session_set('user', $user);
    session_flash('success', 'Content de vous revoir, ' . $user['first_name']);
    redirect($redirect_url ? $redirect_url : '/');
}
view('login', ["disable_nav" => true]);