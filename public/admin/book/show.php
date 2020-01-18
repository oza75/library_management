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

$book = selectWithSql('select * from books where id = ?', [$id]);
$users = admin_list_table_with_sql("select * from users where id in (select user_id from user_reservations where book_id = ?)", [$id], ['slug', 'title', 'author', 'description'], 15, true, true);

admin_view('show-book', ['book' => $book, 'users' => $users], '/..');