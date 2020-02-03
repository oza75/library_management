<?php
require_once '../session.php';
require_once '../functions/helpers.php';
require_once '../database.php';
$id = $_GET['id'];
if (!$id) {
    session_flash('error', 'Une erreur inattendue est arrivé !');
    redirect('/');
}
$book = selectWithPivot('select * from books where id=?', [$id], 'categories', 'book_category_pivot_table', 'book_id', 'category_id');
view('lecture', ["book" => $book[0]]);