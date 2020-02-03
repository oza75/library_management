<?php
require_once '../session.php';
require_once '../functions/helpers.php';
require_once '../database.php';
if (!user_is_logged()) {
    session_flash("warning", "Vous devez connecter pour acceder à cette page ! ");
    redirect_to_previous_page();
}
$user = auth_user();
$reservedBooks = selectWithPivot("select * from books b inner join user_reservations ur on b.id = ur.book_id where user_id = ? and confirmed = 0", [$user['id']], 'categories', 'book_category_pivot_table', 'book_id', 'category_id');
$confirmedReservedBooks = selectWithPivot("select * from books b inner join user_reservations ur on b.id = ur.book_id where user_id = ? and confirmed = 1", [$user['id']], 'categories', 'book_category_pivot_table', 'book_id', 'category_id');
view('my-books', ['home' => false, 'reservedBooks' => $reservedBooks, "confirmedReservedBooks" => $confirmedReservedBooks]);