<?php
require_once '../session.php';
require_once "../functions/helpers.php";
require_once '../database.php';
$book_id = $_GET['book_id'] ?? null;

if (!user_is_logged()) {
    session_flash('warning', 'Veuillez vous connectez d\'abord !');
    redirect('login.php?redirect_url=' . $_SERVER['REQUEST_URI']);
}

if (!$book_id) {
    session_flash('error', 'Une erreur inattendue s\'est produite !');
    redirect_to_previous_page();
}
$book = selectWithSql('select * from books where id = ?', [$book_id]);
if (!$book) {
    session_flash('error', "Ce livre n'existe plus ! ");
    redirect_to_previous_page();
}

$user = auth_user();

$check = selectWithSql('select * from user_reservations where user_id=? and book_id=?', [$user['id'], $book_id]);
if ($check) {
    session_flash('info', 'Vous avez déjà reserver ce livre ! ');
    redirect_to_previous_page();
}

$reservation = insertInto('user_reservations', ['book_id' => $book_id, 'user_id' => $user['id']]);

if ($reservation) {
    session_flash('success', 'Vous avez réservez cet livre');
    redirect('/book.php?slug=' . $book['slug']);
}

