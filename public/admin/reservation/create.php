<?php
require_once '../../../session.php';
require_once '../../../functions/helpers.php';
require_once '../../../database.php';
if (!admin_is_logged()) redirect('/admin/login.php?redirect_url=' . $_SERVER['REQUEST_URI']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $attributes = [];

    $book_id = $_POST['book_id'];
    $user_id = $_POST['user_id'];
    if (!$book_id || !$user_id) {
        session_flash("error", "Veuillez bien remplir le formulaire");
        redirect($_SERVER['REQUEST_URI'], ['book_id' => $book_id, 'user_id' => $user_id]);
    }

    $attributes['book_id'] = $book_id;
    $attributes['user_id'] = $user_id;

    if (!isset($_POST['confirmed'])) {
        $attributes['confirmed'] = 0;
    } else {
        $attributes['confirmed'] = $_POST['confirmed'] ? ($_POST['confirmed'] == 'on' ? 1 : 0) : 0;
    }

    if ($attributes['confirmed'] == 1) {
        $attributes['return_date'] = date('Y-m-d', strtotime(date('Y-m-d') . ' + 14 days'));
    } else {
        $attributes['return_date'] = null;
    }

    $reservation = insertInto('user_reservations', $attributes);
    if($reservation) {
        session_flash('success', "Réservation enregistré avec succès !");
    } else {
        session_flash("error", "Erreur lors de la sauvagarde!");
    }
}
$books = selectWithSql('select * from books', [], true);
$users = selectWithSql('select * from users', [], true);
admin_view('create-reservation', ['books' => $books, 'users' => $users], '/..');