<?php
require_once '../session.php';
require_once '../functions/helpers.php';
require_once '../database.php';
$slug = $_GET['slug'];
if (!$slug) {
    session_flash('error', 'Une erreur inattendue est arrivé !');
    redirect('/');
}
$books = selectWithPivot('select * from books where slug=?', [$slug], 'categories', 'book_category_pivot_table', 'book_id', 'category_id');
if (!empty($books) && count($books) > 0) $book = $books[0];
$reserved = false;
if (user_is_logged()) {
    $reserved = selectWithSql('select * from user_reservations where user_id = ? and book_id = ?', [auth_user()['id'], $book['id']]);
}
$last_reservation = selectWithSql('select * from user_reservations where book_id = ? order by created_at desc limit 1', [$book['id']]);
$available_at = $last_reservation ? date('d-m-Y', strtotime($last_reservation['created_at'] . ' + 28 days')) : null;

view('book', ['book' => $book, 'reserved' => $reserved, 'available_at' => $available_at, 'last_reservation' => $last_reservation]);
