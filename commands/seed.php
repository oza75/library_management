<?php
require_once 'database.php';
require_once 'functions/helpers.php';

$data = [];
$jsonFiles = glob(__DIR__ . '/json/*.json');
foreach ($jsonFiles as $jsonFile) {
    $json = file_get_contents($jsonFile);
    $datum = json_decode($json, true);
    $data = array_merge($data, $datum);
}
$i = 0;
foreach ($data as $datum) {
    try {
        if (!isset($datum['image']) || !isset($datum['title'])) {
            var_dump($datum);
            continue;
        }

        if (empty($datum['image'] || empty($datum['title']))) {
            var_dump('empty', $datum);
            continue;
        }
        $i++;
        $file = sha1(basename($datum['image'])) . '.' . pathinfo($datum['image'], PATHINFO_EXTENSION);
        $fileContent = file_get_contents($datum['image']);
        file_put_contents("public/assets/images/books/$file", $fileContent);
        $attributes = ['title' => $datum['title'], 'slug' => slugify($datum['title']), 'author' => $datum['author'] ?? '', 'image' => $file ?? '', 'description' => $datum['description'] ?? '', 0];
//        $book = insertIfNotExists('books', ['slug LIKE ?', [slugify($datum['title'])]], $attributes);
        if (select('books', '*', ['slug like ? ', [$attributes['slug']]])) continue;
        $book = insertInto('books', $attributes);
        $categories = $datum['categories'];

        $categories = array_map(function ($item) {
            return ['title' => $item, 'slug' => slugify($item), 'created_at' => (new DateTime())->format('Y-m-d H:i:s')];
        }, $categories);

        $categoriesAdded = [];
        foreach ($categories as $category) {
            array_push($categoriesAdded, insertIfNotExists('categories', ['slug LIKE ?', [$category['slug'] ?? '']], $category));
        }

        foreach ($categoriesAdded as $c) {
            $att = ['category_id' => $c['id'], 'book_id' => $book['id']];
            insertIfNotExists('book_category_pivot_table', ['category_id=? and book_id=?', [$c['id'], $book['id']]], $att);
        }
    } catch (\Exception $e) {
        var_dump($e);
        continue;
    }
}


var_dump('Finished ! ', $i);