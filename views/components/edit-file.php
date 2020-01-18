<tr>
    <td class="label-holder"><label for="<?= $name ?>"><?= $label ?></label></td>
    <td class="input-holder">
        <div style="margin-bottom: 12px">
            <input type="file" placeholder="<?= $placeholder ?? '' ?>"
                   name="<?= $name ?>"
                   id="<?= $name ?>">
        </div>

        <?php if (isset($value) && $value) { ?>
            <img src="<?= imageUrl("books/" .$value ) ?>" alt="">
        <?php } ?>

    </td>
</tr>
