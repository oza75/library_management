<?php
require_once '../session.php';
require_once '../functions/helpers.php';
require_once '../database.php';
$limit = 6;
$topBooks = selectWithPivot("select * from books where id in (select book_id from user_reservations) limit $limit ", [], 'categories', 'book_category_pivot_table', 'book_id', 'category_id');
if (count($topBooks) < $limit) {
    $topBooksIds = array_map(function ($item) {
        return $item['id'];
    }, $topBooks);
    if (empty($topBooksIds)) {
        $topBooks = selectWithPivot("select * from books limit $limit ", [], 'categories', 'book_category_pivot_table', 'book_id', 'category_id');
    } else {
        $in = str_repeat('?,', count($topBooks) - 1) . '?';
        $r_limit = $limit - count($topBooks);
        $r = selectWithPivot("select * from books where id not in ($in) limit $r_limit ", $topBooksIds, 'categories', 'book_category_pivot_table', 'book_id', 'category_id');
        $topBooks = array_merge($topBooks, $r);
    }
}
$pdfBooks = selectWithPivot('select * from books order by rand() limit 6', [], 'categories', 'book_category_pivot_table', 'book_id', 'category_id');
//var_dump($topBooks);
//die();
view('index', ['home' => true, 'topBooks' => $topBooks, 'pdfBooks' => $pdfBooks]);