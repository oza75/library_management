<form method="get" action="<?= $_SERVER['PHP_SELF'] ?>"
      class="list-table-wrapper" data-pk="<?= $primaryKey ?>">
    <?php if(isset($id) && $id) {?>
        <input type="hidden" name="id" value="<?= $id ?>">
    <?php } ?>
    <div class="search-input-wrapper">
        <input type="search" name="query" value="<?= $query ?>" placeholder="Rechercher dans <?= $collection_name ?>">
    </div>
    <div class="group-actions-container">
        <div>
            <?php if (!isset($disable_creation) || (isset($disable_creation) && !$disable_creation)) { ?>
                <a href="<?= $create_url ?>" class="btn btn-primary">
                    Créer
                    <?= $collection_name[-1] == 's' ? substr($collection_name, 0, strlen($collection_name) - 1) : $collection_name ?></a>
            <?php } ?>
        </div>
        <div class="group-actions-wrapper">
            <button class="btn btn-danger" type="button" data-action="delete">
                Supprimer les <span class="amount"></span> <?= $collection_name ?>
            </button>
        </div>
    </div>
    <table class="list-table">
        <thead>
        <tr>
            <th>
                <label class="checkbox-container white">
                    <input type="checkbox" class="select-all-checkbox">
                    <span class="checkmark"></span>
                </label>
            </th>
            <?php foreach ($columns as $k => $column) { ?>
                <th class="sortable" data-sortKey="<?= $k == $sort_by ? 1 : 0 ?>" data-column="<?= $k ?>"
                    data-sortType="<?= $k == $sort_by ? $sort_type : 'normal' ?>">
                    <?= $column ?>
                    <i class="fas fa-sort sort-normal" style="display: none"></i>
                    <i class="fas fa-sort-up sort-up" style="display: none"></i>
                    <i class="fas fa-sort-down sort-down" style="display: none"></i>
                </th>
            <?php } ?>
            <th class="actions-column">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item) { ?>
            <tr>
                <td>
                    <label class="checkbox-container">
                        <input type="checkbox" value="<?= $item[$primaryKey] ?>">
                        <span class="checkmark"></span>
                    </label>
                </td>
                <?php foreach ($columns as $k => $column) { ?>
                    <td><?= $item[$k] ?></td>
                <?php } ?>
                <td class="actions-column">
                    <a href="<?= $show_url ?>?id=<?= $item[$primaryKey] ?>">Voir</a>
                    <a href="<?= $edit_url ?>?id=<?= $item[$primaryKey] ?>">Modifier</a>
                    <a href="<?= $delete_url ?>?id=<?= $item[$primaryKey] ?>">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if ($totalPage > 1) { ?>
        <section class="container-1 pagination-section">
            <div class="pagination-container">
                <?php
                $s = false;
                for ($i = 1;
                     $i < $totalPage;
                     $i++) {
                    $isCurrent = $i == $currentPage ? 'current' : '';
                    if (($i < $currentPage + 3 && $i > $currentPage - 3) || $i >= $totalPage - 3) {
                        echo "<a href='" . paginationPage($_SERVER['PHP_SELF'], $i) . "' class='item $isCurrent'>$i</a>";
                    } else {
                        if (!$s) {
                            echo "<a href='' class='item'>...</a>";
                            $s = true;
                        }
                    }
                }
                ?>
            </div>
        </section>
    <?php } ?>
</form>
