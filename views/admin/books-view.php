<?php
require_once 'partials/header.php';
?>
    <div class="users-page">
        <h1 class="admin-page-title">Livres</h1>
        <p class="admin-page-description">La liste de tous les livres de la biblothèque</p>

        <?php
        admin_component('list_table',
            [
                'columns' => [
                    'id' => 'ID',
                    'title' => 'Titre',
                    'author' => 'Auteur',
                    'created_at' => 'Date de création'
                ],
                'items' => $items,
                "query" => $query,
                'primaryKey' => 'id',
                'collection_name' => 'livres',
                'sort_by' => $sort_by ?? 'id',
                'sort_type' => $sort_type ?? 'asc',
                'totalPage' => $totalPage,
                'currentPage' => $currentPage,
                'show_url' => '/admin/book/show.php',
                'edit_url' => '/admin/book/edit.php',
                'create_url' => '/admin/book/create.php',
                'delete_url' => "/admin/book/delete.php",
            ]);
        ?>
    </div>
<?php
require_once 'partials/footer.php';