<?php
require_once '../../../session.php';
require_once '../../../functions/helpers.php';
require_once '../../../database.php';
if (!admin_is_logged()) redirect('/admin/login.php?redirect_url=' . $_SERVER['REQUEST_URI']);

if (!empty($_POST)) {
    $title = $_POST['title'] ?? null;
    $author = $_POST['author'] ?? null;
    $image = $_FILES['image'] ?? null;
    $description = $_POST['description'] ?? null;

    if ($image['error'] == UPLOAD_ERR_NO_FILE || $image['error'] !== UPLOAD_ERR_OK) {
        session_flash('error', "Un problème est survenu lors du téléversement de l'image");
        redirect($_SERVER['REQUEST_URI'], ['title' => $title, 'author' => $author, 'description' => $description]);
    }

    if (!$title || !$author || !$description) {
        session_flash('error', "Veuillez bien remplir le formulaire");
        redirect($_SERVER['REQUEST_URI'], ['title' => $title, 'author' => $author, 'description' => $description]);
    }

    $attributes = ['title' => $title, 'author' => $author, "description" => $description];
    $attributes['slug'] = slugify($title);
    $tmp_name = $image['tmp_name'];
    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $name = sha1(basename($image["name"]));
    move_uploaded_file($tmp_name, __DIR__ . "/../../../public/assets/images/books/$name.$extension");
    $attributes['image'] = $name . "." . $extension;

    if (insertInto('books', $attributes)) {
        session_flash('success', "Enregistré avec succès !");
    } else {
        session_flash("error", "Erreur lors de la modification du livre !");
    }
}

admin_view('create-book', [], '/..');