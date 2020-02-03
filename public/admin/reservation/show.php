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

$reservation = selectWithSql('select r.id as r_id,r.return_date as r_return_date, r.confirmed as r_confirmed, r.created_at as r_created_at, u.first_name as u_first_name, u.id as u_id, u.last_name as u_last_name, b.id as b_id, b.title as b_title from user_reservations r inner join users u on u.id = r.user_id inner join books b on r.book_id = b.id where r.id = ?
', [$id]);
if(!$reservation) {
    redirect('/admin/reservations.php');
}
admin_view('show-reservation', ['reservation' => $reservation], '/..');