<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/fonts/metropolis/metropolis.css">
    <link rel="stylesheet" href="assets/fonts/work_sans/work_sans.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="assets/js/main.js"></script>
    <title>
        <?php echo $title ?? 'IGA Book'; ?>
    </title>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            <?php
            foreach (session_get('flash', []) as $flash) {
            ?>
            flash('<?= $flash['type']?>', '<?= $flash['value']?>');
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
<nav class="main-topbar <?= isset($home) && $home ? 'home' : '' ?>" role="presentation">
    <div class="container-1 topbar-wrapper">
        <a class="logo-brand" href="/">
            <img src="assets/images/logo.jpg" alt="Logo" class="logo">
            <span class="logo-name">IGA BOOKs</span>
        </a>
        <ul class="topbar-links">
            <li class="topbar-link active">
                <a href="/">Accueil</a>
            </li>
            <li class="topbar-link">
                <a href="">
                    Découvrir
                </a>
            </li>
            <?php if ($user = session_get('user', false)) { ?>
                <li class="dropdown">
                    <a class="topbar-link btn btn-primary"
                       style="margin-right: 0"><?= $user['first_name'] . ' ' . $user['last_name'] ?></a>
                    <div class="dropdown-content">
                        <ul>
                            <li>
                                <a class="dropdown-link" href="logout.php">
                                    Déconnexion
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php } else { ?>
                <li class="topbar-link btn btn-primary">
                    <a href="/login.php">Connexion</a>
                </li>
            <?php } ?>
        </ul>
    </div>

</nav>

<?php
}