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

$user = selectWithSql('select * from users where id = ?', [$id]);
$books = admin_list_table_with_sql("select * from books where id in (select book_id from user_reservations where user_id = ?)", [$id],  ['slug', 'title', 'author', 'description'], 15, true, true);

admin_view('show-user', ['user' => $user, 'books' => $books], '/..');