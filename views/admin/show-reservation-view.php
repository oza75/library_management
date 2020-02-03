<?php
require_once 'partials/header.php';
?>
    <div class="show-user-page show-page">
        <div class="reservation-header">
            <h1 class="">Reservation #<?= $reservation['r_id'] ?></h1>
            <a href="/admin/reservation/delete.php?id=<?= $reservation['r_id'] ?>" class="btn btn-danger"
               title="Supprimer la reservation">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.003 20C5.003 21.103 5.9 22 7.003 22H17.003C18.106 22 19.003 21.103 19.003 20V8H21.003V6H17.003V4C17.003 2.897 16.106 2 15.003 2H9.003C7.9 2 7.003 2.897 7.003 4V6H3.003V8H5.003V20ZM9.003 4H15.003V6H9.003V4ZM8.003 8H17.003L17.004 20H7.003V8H8.003Z"
                          fill="currentColor"/>
                    <path d="M9.003 10H11.003V18H9.003V10ZM13.003 10H15.003V18H13.003V10Z" fill="currentColor"/>
                </svg>
            </a>
        </div>
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
