<?php
require_once 'partials/header.php';
?>
    <div class="show-user-page show-page">
        <h1 class="">Reservation #<?= $reservation['r_id'] ?></h1>
        <div class="show-wrapper">
            <table class="show-table">
                <tbody>
                <?php
                admin_component('show-row', ['label' => 'Titre du livre', 'value' => $reservation['b_title']], '/..');
                admin_component('show-row', ['label' => 'Pour', 'value' => $reservation['u_first_name'] . ' ' . $reservation['u_last_name'] . '(#' . $reservation['u_id'] . ')'], '/..');

                ?>
                <tr>
                    <td class="label-holder">
                        <label for="confirm">Confirmé ? </label>
                    </td>
                    <td class="input-holder">
                        <label class="checkbox-container">
                            <input type="checkbox" readonly disabled
                                   <?= $reservation['r_confirmed'] == 1 ? 'checked' : '' ?>
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
                        <td class="value-holder">
                            <?= date('d-m-Y', strtotime($reservation['r_return_date'])) ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
require_once 'partials/footer.php';
