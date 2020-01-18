<tr>
    <td class="label-holder"><label><?= $label ?></label></td>
    <td class="value-holder">
        <div>
            <?php if (!isset($image) || (isset($image) && !$image)) {
                echo $value;
            } else {
                ?>
                <img src="<?= imageUrl('books/' . $value) ?>" alt="">
                <?php
            } ?>
        </div>
    </td>
</tr>
