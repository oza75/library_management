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

if (!empty($_POST)) {
    $title = $_POST['title'] ?? null;
    $author = $_POST['author'] ?? null;
    $image = $_FILES['image'] ?? null;
    $description = $_POST['description'] ?? null;

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

    if (updateRow('books', "where id = $id", $attributes)) {
        session_flash('success', "Modification enregistré avec succès !");
    } else {
        session_flash("error", "Erreur lors de la modification du livre !");
    }
}
$book = selectWithSql('select * from books where id = ?', [$id]);

admin_view('edit-book', ['book' => $book], '/..');