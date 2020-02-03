<?php
require_once '../session.php';
require_once '../functions/helpers.php';
require_once '../database.php';
$items = [];
$categories = selectWithSql("select * , (select count(*) from book_category_pivot_table where category_id = c.id) as b_count from categories c having b_count > 6 order by rand() limit 20", [], true);
foreach ($categories as $category) {
    $item = $category;
    $item['books'] =  selectWithPivot("select * from books where id in (select book_id from book_category_pivot_table where category_id = ? ) order by rand() limit 6 ", [$category['id']], 'categories', 'book_category_pivot_table', 'book_id', 'category_id');
    $items[] = $item;
}

view('discover', ['home' => true, 'items' => $items]);