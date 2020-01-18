<?php
require_once '../../session.php';
require_once '../../functions/helpers.php';
require_once '../../database.php';

if (admin_is_logged()) {
    session_flash('info', "Vous êtes dejà connecter. Veuillez vous deconnecter d\'abord ! ");
    redirect('/admin/');
}

if (!empty($_POST)) {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if (!$email || !$password) {
        session_flash('error', 'Veuillez bien remplir le formulaire');
        redirect_to_previous_page(['email' => $email]);
    }

    $user = selectWithSql('select * from users where email = ?', [$email]);
    if (!$user || !password_verify($password, $user['password'])) {
        session_flash('error', 'Ces identifiants ne correspondent pas à nos enregistrements');
        redirect('/admin/login.php', ['email' => $email]);
    }

    session_set('user', $user);

    $hasAbility = selectWithSql('select exists(select * from roles where id in (select role_id from user_roles where user_id = ?) and name = ?) as admin', [$user['id'], 'ADMIN']);

    if (!((bool)$hasAbility['admin'])) {
        session_flash('error', "Vous n'avez pas les permissions necessaires !!");
        redirect('/');
    }

    session_set('admin_user', $user);
    session_flash('success', 'Bienvenue, ' . $user['first_name']);
    redirect('/admin/');
}

admin_view('login', ['disable_nav' => true]);
