<?php
require_once 'partials/header.php';
?>
    <div class="edit-user-page edit-page">
        <h1 class="">Création d'un livre</h1>
        <form enctype="multipart/form-data" action="/admin/book/create.php" method="post">
            <table class="edit-table">
                <tbody>
                <?php
                admin_component('edit-input', ['label' => 'Titre', 'name' => 'title', 'value' => '', 'placeholder' => "Titre du livre"], '/..');
                admin_component('edit-input', ['label' => 'Auteur', 'name' => 'author', 'value' => '', 'placeholder' => "Auteur du livre", 'type' => 'text'], '/..');
                admin_component('edit-file', ['label' => 'Image', 'name' => 'image', 'value' => '', 'placeholder' => "Image"], '/..');
                ?>
                <tr>
                    <td class="label-holder"><label for="pdf">PDF (optionel)</label></td>
                    <td class="input-holder">
                        <input type="file" placeholder="" value="<?= session_old_value('pdf')?>" name="pdf" id="pdf">
                    </td>
                </tr>
                <?php
                admin_component('edit-select', ['name' => 'category_id','multiple' => true,'placeholder' => 'Selectionnez une catégorie', 'label' => 'Catégorie', 'valueKey' => 'id', 'textKey' => "title", 'options' => $categories], '/..');
                admin_component('edit-textarea', ['label' => "Description", 'name' => 'description', 'value' => '', 'placeholder' => "Description du livre"], '/..');
                ?>
                </tbody>
            </table>
            <div class="button-container">
                <button class="btn btn-primary">Créer</button>
            </div>
        </form>
    </div>
<?php
require_once 'partials/footer.php';
