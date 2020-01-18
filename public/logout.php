<?php
require_once '../session.php';
require_once '../functions/helpers.php';
$user = session_forget('user');
session_forget('admin_user');
session_flash('info', "A bientôt {$user['first_name']} !");
redirect('/');
