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

if (sql_delete('delete from users where id = ?', [$id])) {
    session_flash('success', "Utilisateur supprimé avec succès !");
} else {
    session_flash("error", "Erreur lors de la suppression du livre");
}

redirect_to_previous_page();

