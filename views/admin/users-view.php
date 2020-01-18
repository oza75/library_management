<?php
require_once 'partials/header.php';
?>
    <div class="users-page">
        <h1 class="admin-page-title">Utilisateurs</h1>
        <p class="admin-page-description">La liste de tous les utilisateurs du site</p>

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
                'items' => $items,
                "query" => $query,
                'primaryKey' => 'id',
                'collection_name' => 'utilisateurs',
                'sort_by' => $sort_by ?? 'id',
                'sort_type' => $sort_type ?? 'asc',
                'totalPage' => 1,
                'currentPage' => 1,
                'edit_url' => '/admin/user/edit.php',
                'show_url' => '/admin/user/show.php',
                'create_url' => '/admin/user/create.php',
                'delete_url' => "/admin/user/delete.php",
            ]);
        ?>
    </div>
<?php
require_once 'partials/footer.php';