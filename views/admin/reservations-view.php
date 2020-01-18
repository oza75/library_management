<?php
require_once 'partials/header.php';
?>
    <div class="users-page">
        <h1 class="admin-page-title">Réservations</h1>
        <p class="admin-page-description">La liste de toutes les réservations</p>

        <?php
        admin_component('list_table',
            [
                'columns' => [
                    'r_id' => 'ID',
                    'u_first_name' => 'Prénom',
                    'u_last_name' => 'Nom',
                    'b_title' => 'Tire du livre',
                    'r_created_at' => 'Date de réservation'
                ],
                'items' => $items,
                "query" => $query,
                'primaryKey' => 'r_id',
                'collection_name' => 'reservations',
                'sort_by' => $sort_by ?? 'r_id',
                'sort_type' => $sort_type ?? 'asc',
                'totalPage' => 1,
                'currentPage' => 1,
                'edit_url' => '/admin/reservation/edit.php',
                'show_url' => '/admin/reservation/show.php',
                'create_url' => '/admin/reservation/create.php',
                'delete_url' => '/admin/reservation/delete.php',
            ]);
        ?>
    </div>
<?php
require_once 'partials/footer.php';