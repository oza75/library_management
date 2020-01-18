<?php
require_once '../../session.php';
require_once '../../functions/helpers.php';
require_once '../../database.php';

if (!admin_is_logged()) redirect('/admin/login.php?redirect_url=/admin/users.php');
$data = admin_list_table('users', ['first_name', 'last_name', 'email'], 18, true);

admin_view('users', $data);