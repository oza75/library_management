<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/fonts/metropolis/metropolis.css">
    <link rel="stylesheet" href="/assets/fonts/work_sans/work_sans.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.css">
    <script src="/assets/js/admin.js"></script>
    <title>
        <?php echo $title ?? 'IGA Book Admin'; ?>
    </title>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            <?php
            foreach (session_get('flash', []) as $flash) {
            ?>
            flash("<?= $flash['type']?>", "<?= $flash['value']?>");
            <?php
            }
            ?>
        });
    </script>
</head>
<body>
<div class="flash-container" id="flash-container">
    <div class="wrapper"></div>
</div>
<?php
if (!(isset($disable_nav) && $disable_nav)) {
?>
<div class="admin-wrapper">
    <div class="sidebar-container">
        <a class="logo-brand" href="/">
            <img src="/assets/images/logo.jpg" alt="Logo" class="logo">
            <span class="logo-name">IGA BOOKS</span>
        </a>

        <ul class="sidebar-links-container">
            <li><a href="/admin/users.php" class="sidebar-link">Utilisateurs</a></li>
            <li><a href="/admin/reservations.php" class="sidebar-link">Réservation</a></li>
            <li><a href="/admin/books.php" class="sidebar-link">Livres</a></li>
        </ul>
    </div>
    <main class="admin-content"><?php
}