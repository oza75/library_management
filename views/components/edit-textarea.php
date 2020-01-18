<tr>
    <td class="label-holder"><label for="<?= $name ?>"><?= $label ?></label></td>
    <td class="input-holder">
        <textarea rows="10" cols="30" placeholder="<?= $placeholder ?? '' ?>"
                  name="<?= $name ?>"
                  id="<?= $name ?>"><?= session_old_value($name, $value ?? '') ?></textarea>
    </td>
</tr>
