<tr>
    <td class="label-holder"><label for="<?= $name ?>"><?= $label ?></label></td>
    <td class="input-holder">
        <div class="select-container">
            <select name="<?= $name ?>" id="<?= $name ?>" value="<?= session_old_value($name, $value ?? '') ?>">
                <option value=""><?= $placeholder ?? '' ?></option>
                <?php foreach ($options as $option) { ?>
                    <option value="<?= $option[$valueKey] ?>"
                            <?= $option[$valueKey] == ($value ?? null) ? 'selected' : '' ?>><?= is_callable($textKey) ? $textKey($option) : $option[$textKey] ?></option>
                <?php } ?>
            </select>
            <div class="select-icon">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
    </td>
</tr>
