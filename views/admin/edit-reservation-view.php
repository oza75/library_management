<?php
require_once 'partials/header.php';
?>
    <div class="edit-user-page edit-page">
        <h1 class="">Modification de la reservation #<?= $reservation['r_id'] ?></h1>
        <form action="/admin/reservation/edit.php?id=<?= $reservation['r_id'] ?>" method="post">
            <table class="edit-table">
                <tbody>
                <tr>
                    <td class="label-holder">
                        <label for="number">N°</label>
                    </td>
                    <td class="input-holder">
                        <input type="text" readonly disabled value="<?= $reservation['r_id'] ?>">
                    </td>
                </tr>
                <tr>
                    <td class="label-holder">
                        <label for="title">Titre du livre</label>
                    </td>
                    <td class="input-holder">
                        <input type="text" readonly disabled value="<?= $reservation['b_title'] ?>">
                    </td>
                </tr>
                <tr>
                    <td class="label-holder">
                        <label for="for">Pour</label>
                    </td>
                    <td class="input-holder">
                        <input type="text" readonly disabled
                               value="<?= $reservation['u_first_name'] . ' ' . $reservation['u_last_name'] . ' (#' . $reservation['u_id'] . ')' ?>">
                    </td>
                </tr>
                <tr>
                    <td class="label-holder">
                        <label for="confirm">Confirmer </label>
                    </td>
                    <td class="input-holder">
                        <label class="checkbox-container">
                            <input type="checkbox" <?= $reservation['r_confirmed'] == 1 ? 'checked' : '' ?>
                                   name="confirmed"
                                   class="select-all-checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                </tr
                <?php if ($reservation['r_return_date']) { ?>
                    <tr>
                        <td class="label-holder">
                            <label for="for">Date de retour</label>
                        </td>
                        <td class="input-holder">
                            <input type="text" readonly disabled
                                   value="<?= date('d-m-Y', strtotime($reservation['r_return_date'])) ?>">
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="button-container">
                <button class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
<?php
require_once 'partials/footer.php';
