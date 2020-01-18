<?php
require_once 'partials/header.php';
?>
    <div class="show-user-page show-page">
        <h1 class="">Livre #<?= $book['id'] ?></h1>
        <div class="show-wrapper">
            <table class="show-table">
                <tbody>
                <?php
                admin_component('show-row', ['label' => 'Titre', 'value' => $book['title']], '/..');
                admin_component('show-row', ['label' => 'author', 'value' => $book['author']], '/..');
                admin_component('show-row', ['label' => 'image', 'value' => $book["image"], 'image' => true], '/..');
                admin_component('show-row', ['label' => 'description', 'value' => $book['description']], '/..');
                admin_component('show-row', ['label' => 'Date de création', 'value' => $book['created_at']], '/..');

                ?>
                </tbody>
            </table>
        </div>

        <div class="users-page">
            <h1 class="admin-page-title">Utilisateurs</h1>
            <p class="admin-page-description">Tous les utilisateurs qui ont réserver le livre #<?= $book['id'] ?></p>

            <?php
            admin_component('list_table',
                [
                    'columns' => [
                        'id' => 'ID',
                        'first_name' => 'Prénom',
                        'last_name' => 'Nom',
                        'email' => 'Email',
                        'created_at' => 'Date de création'
                    ],
                    'id' => $book['id'],
                    'disable_creation' => true,
                    'items' => $users['items'],
                    "query" => $users['query'],
                    'primaryKey' => 'id',
                    'collection_name' => 'utilisateurs',
                    'sort_by' => $users['sort_by'] ?? 'id',
                    'sort_type' => $users['sort_type'] ?? 'asc',
                    'totalPage' => $users['totalPage'],
                    'currentPage' => $users['currentPage'],
                    'edit_url' => '/admin/user/edit.php',
                    'show_url' => '/admin/user/show.php',
                    'create_url' => '/admin/user/create.php',
                    'delete_url' => "/admin/user/delete.php",
                ], '/..');
            ?>
        </div>
    </div>
<?php
require_once 'partials/footer.php';
