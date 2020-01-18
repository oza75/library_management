<?php

require_once '../../session.php';
require_once '../../functions/helpers.php';
require_once '../../database.php';

if (!admin_is_logged()) redirect('/admin/login.php?redirect_url=/admin/books.php');
$data = admin_list_table('books', ['slug', 'title', 'author', 'description'], 18, true);
$data['items'] = array_map(function ($item) {
    $item['title'] = substr($item['title'], 0, 50). '...';
    return $item;
}, $data['items']);

admin_view('books', $data);