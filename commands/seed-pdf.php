<?php
require_once 'database.php';
require_once 'functions/helpers.php';

$data = [];
$jsonFile = __DIR__ . "/json/pdf/pdf-books-1.json";
$json = file_get_contents($jsonFile);
$data = json_decode($json, true);

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
        $image = str_replace('/home/oza/lab/js/book-scrapper/dist/Scrappers/..', __DIR__ . "/json/pdf", $datum['image']);
        $file = sha1(basename($image)) . '.' . pathinfo($image, PATHINFO_EXTENSION);
        $fileContent = file_get_contents($image);
        file_put_contents("public/assets/images/books/$file", $fileContent);
        $filename = $datum['slug'] . '.pdf';
        $pdfContent = file_get_contents($datum['url']);
        file_put_contents("public/assets/pdf/$filename", $pdfContent);
        $attributes = ['pdf' => $filename, 'title' => $datum['title'], 'slug' => slugify($datum['title']), 'author' => $datum['author'] ?? '', 'image' => $file ?? '', 'description' => $datum['description'] ?? ''];
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