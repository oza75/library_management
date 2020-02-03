<?php
require_once '../../../session.php';
require_once '../../../functions/helpers.php';
require_once '../../../database.php';
if (!admin_is_logged()) redirect('/admin/login.php?redirect_url=' . $_SERVER['REQUEST_URI']);

$id = $_GET['id'] ?? null;

if (empty($id) || $id == null) {
    session_flash('error', 'Une erreur inattendue s\'est produite');
    redirect_to_previous_page();
}

if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? null;
    $author = $_POST['author'] ?? null;
    $image = $_FILES['image'] ?? null;
    $description = $_POST['description'] ?? null;
    $pdf = $_FILES['pdf'] ?? null;
    $categories_ids = $_POST['category_id'] ?? [];

    if ($image['error'] !== UPLOAD_ERR_NO_FILE && $image['error'] !== UPLOAD_ERR_OK) {
        session_flash('error', "Un problème est survenu lors du téléversement de l'image");
        redirect($_SERVER['REQUEST_URI'], ['title' => $title, 'author' => $author, 'description' => $description]);
    }

    if (!$title || !$author) {
        session_flash('error', "Veuillez bien remplir le formulaire");
        redirect($_SERVER['REQUEST_URI'], ['title' => $title, 'author' => $author, 'description' => $description]);
    }

    $attributes = ['title' => $title, 'author' => $author, "description" => $description];

    if ($image['error'] !== UPLOAD_ERR_NO_FILE) {
        $tmp_name = $image['tmp_name'];
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $name = sha1(basename($image["name"]));
        move_uploaded_file($tmp_name, __DIR__ . "/../../../public/assets/images/books/$name.$extension");
        $attributes['image'] = $name . "." . $extension;
    }

    if ($pdf && ($pdf['error'] == UPLOAD_ERR_NO_FILE || $pdf['error'] !== UPLOAD_ERR_OK)) {
        session_flash('error', "Un problème est survenu lors du téléversement du pdf");
        redirect($_SERVER['REQUEST_URI'], ['title' => $title, 'author' => $author, 'description' => $description]);
    }

    if ($pdf) {
        $pdf_tmp_name = $pdf['tmp_name'];
        $pdf_name = sha1(basename($pdf['name']));
        move_uploaded_file($pdf_tmp_name, __DIR__ . "/../../../public/assets/pdf/{$pdf_name}.pdf");
        $attributes['pdf'] = $pdf_name . ".pdf";
    }

    if (updateRow('books', "where id = $id", $attributes)) {
        sql_delete("delete from book_category_pivot_table where book_id = ? ", [$id]);
        foreach ($categories_ids as $categories_id) {
            insertInto('book_category_pivot_table', ['category_id' => $categories_id, 'book_id' => $id]);
        }
        session_flash('success', "Modification enregistré avec succès !");
    } else {
        session_flash("error", "Erreur lors de la modification du livre !");
    }
}
$books = selectWithPivot('select * from books where id = ?', [$id], 'categories', 'book_category_pivot_table', 'book_id', 'category_id');
$book = $books[0] ?? null;
$categories = selectWithSql("select * from categories", [], true);

admin_view('edit-book', ['book' => $book, "categories" => $categories], '/..');