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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $attributes = [];
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

    if (updateRow('user_reservations', "where id = $id", $attributes)) {
        session_flash('success', "Réservation modifié avec succès");
    } else {
        session_flash('success', "Erreur lors de la modification");
    }

}
if (!empty($_POST)) {
//    $confirmed = $_POST['confirmed'] ? $_POST['confirmed'] == 'on' : 0;

}

$reservation = selectWithSql('select r.id as r_id,r.return_date as r_return_date, r.confirmed as r_confirmed, r.created_at as r_created_at, u.first_name as u_first_name, u.id as u_id, u.last_name as u_last_name, b.id as b_id, b.title as b_title from user_reservations r inner join users u on u.id = r.user_id inner join books b on r.book_id = b.id where r.id = ?
', [$id]);


admin_view('edit-reservation', ['reservation' => $reservation], '/..');