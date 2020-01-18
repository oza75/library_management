<?php
require_once 'partials/header.php';
?>
    <div class="show-user-page show-page">
        <h1 class="">Utilisateur #<?= $user['id'] ?></h1>
        <div class="show-wrapper">
            <table class="show-table">
                <tbody>
                <?php
                admin_component('show-row', ['label' => 'Prénom', 'value' => $user['first_name']], '/..');
                admin_component('show-row', ['label' => 'Nom', 'value' => $user['last_name']], '/..');
                admin_component('show-row', ['label' => 'Email', 'value' => $user["email"]], '/..');
                ?>
                </tbody>
            </table>
        </div>

        <div class="users-page">
            <h1 class="admin-page-title">Livres</h1>
            <p class="admin-page-description">Tous les livres de l'utilisateur #<?= $user['id'] ?></p>

            <?php
            admin_component('list_table',
                [
                    'columns' => [
                        'id' => 'ID',
                        'title' => 'Titre',
                        'author' => 'Auteur',
                        'created_at' => 'Date de création'
                    ],
                    'disable_creation' => true,
                    'id' => $user['id'],
                    'items' => $books['items'],
                    "query" => $books['query'],
                    'primaryKey' => 'id',
                    'collection_name' => 'livres',
                    'sort_by' => $books['sort_by'] ?? 'id',
                    'sort_type' => $books['sort_type'] ?? 'asc',
                    'totalPage' => $books['totalPage'],
                    'currentPage' => $books['currentPage'],
                    'edit_url' => '/admin/book/edit.php',
                    'show_url' => '/admin/book/show.php',
                    'create_url' => '/admin/book/create.php',
                    'delete_url' => "/admin/book/delete.php",
                ], '/..');
            ?>
        </div>
    </div>
<?php
require_once 'partials/footer.php';
