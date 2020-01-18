<?php
require_once 'partials/header.php';
?>
    <div class="edit-user-page edit-page">
        <h1 class="">Création d'une reservation</h1>
        <form action="/admin/reservation/create.php" method="post">
            <table class="edit-table">
                <tbody>
                <?php
                admin_component('edit-select', ['name' => 'book_id', 'placeholder' => 'Selectionnez un livre', 'label' => 'Livre', 'valueKey' => 'id', 'textKey' => function ($item) {
                    return substr($item['title'], 0, 50) . '... (#' . $item['id'] . ')';
                }, 'options' => $books], '/..');
                admin_component('edit-select', ['name' => 'user_id','placeholder' => 'Selectionnez un utilisateur', 'label' => 'Pour', 'valueKey' => 'id', 'textKey' => function ($item) {
                    return $item['first_name'] . ' ' . $item['last_name'];
                }, 'options' => $users], '/..');
                ?>
                <tr>
                    <td class="label-holder">
                        <label for="confirm">Confirmer </label>
                    </td>
                    <td class="input-holder">
                        <label class="checkbox-container">
                            <input type="checkbox"
                                   name="confirmed"
                                   class="select-all-checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                </tr

                </tbody>
            </table>
            <div class="button-container">
                <button class="btn btn-primary">Créer</button>
            </div>
        </form>
    </div>
<?php
require_once 'partials/footer.php';
