<?php

require_once '../../session.php';
require_once '../../functions/helpers.php';
require_once '../../database.php';

if (!admin_is_logged()) redirect('/admin/login.php?redirect_url=/admin/reservations.php');
$action = $_GET['action'] ?? null;
if ($action && $action == "delete") {
    if ($selected = ($_GET['selected'] ?? null)) {
        $ids = explode(",", $selected);
        $_ids = array_map(function ($id) {return '?';}, $ids);
        $_ids = implode(",", $_ids);
        if(sql_delete("delete from user_reservations where id in ($_ids)", $ids)) {
//                    session_flash("success", "Les enregistrements selectionnés ont été supprimé");
        };
    }
}
$data = admin_list_table_with_sql("select r.id as r_id, r.created_at as r_created_at, u.first_name as u_first_name, u.last_name as u_last_name, b.id as b_id, b.title as b_title from user_reservations r inner join users u on u.id = r.user_id inner join books b on r.book_id = b.id", [], ['u.first_name', 'u.last_name', 'b.title'], 18, true);

admin_view('reservations', $data);