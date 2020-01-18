<?php
require_once '../../session.php';
require_once '../../functions/helpers.php';
require_once '../../database.php';
if (!admin_is_logged()) redirect('/admin/login.php');
redirect("/admin/users.php");
