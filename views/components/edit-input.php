<tr>
    <td class="label-holder"><label for="<?= $name ?>"><?= $label ?></label></td>
    <td class="input-holder">
        <input type="<?= $type ?? 'text' ?>" placeholder="<?= $placeholder ?? '' ?>" value="<?= session_old_value($name, $value ?? '')?>"
               name="<?= $name ?>"
               id="<?= $name ?>">
    </td>
</tr>
