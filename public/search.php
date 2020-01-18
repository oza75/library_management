<?php
require_once '../session.php';
require_once '../functions/helpers.php';
require_once '../database.php';
$category_id = $_GET['category_id'] ?? null;
$search = $_GET['search'] ?? null;

$sql = "select  * from books ";
$countSql = "select COUNT(*) from books";
$currentPage = $_GET['page'] ?? 1;
$wheres = [];
$params = [];
if ($search) {
    $search = strtolower($search);
    array_push($wheres, "lower(title) LIKE ?");
    array_push($params, "%$search%");
}
if ($category_id) {
    array_push($wheres, "id in (select book_id from book_category_pivot_table where category_id=?)");
    array_push($params, (int)$category_id);
}
if (!empty($wheres)) {
    $sql .= " where " . implode(" and ", $wheres);
    $countSql .= " where " . implode(" and ", $wheres);
}
$perPage = 18;
$sql .= " limit $perPage";

if ($currentPage > 1) $sql .= " offset " . $perPage * $currentPage;
$categories = selectWithSql('select * from categories', [], true);
$books = selectWithPivot($sql, $params, 'categories', 'book_category_pivot_table', 'book_id', 'category_id');
$totals = sqlCount($countSql, $params);
$totalPage = ceil($totals / $perPage);

view('search', ['categories' => $categories, 'category_id' => $category_id, 'search' => $search, 'books' => $books, 'totalPage' => $totalPage, 'currentPage' => $currentPage]);