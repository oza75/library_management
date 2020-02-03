<?php
require_once 'partials/header.php';
?>
    <div class="edit-user-page edit-page">
        <h1 class="">Modification du livre #<?= $book['id'] ?></h1>
        <form enctype="multipart/form-data" action="/admin/book/edit.php?id=<?= $book['id'] ?>" method="post">
            <table class="edit-table">
                <tbody>
                <?php
                admin_component('edit-input', ['label' => 'Titre', 'name' => 'title', 'value' => $book['title'], 'placeholder' => "Titre du livre"], '/..');
                admin_component('edit-input', ['label' => 'Auteur', 'name' => 'author', 'value' => $book['author'], 'placeholder' => "Auteur du livre", 'type' => 'text'], '/..');
                admin_component('edit-file', ['label' => 'Image', 'name' => 'image', 'value' => $book['image'], 'placeholder' => "Image"], '/..');
                if ($book['pdf']) {
                    ?>
                    <tr>
                        <td class="label-holder"><label for="pdf">PDF</label></td>
                        <td class="input-holder">
                            <a href="/assets/pdf/<?= $book['pdf'] ?>" target="_blank" style="margin-bottom: 10px;display: block">Voir le PDF</a>
                            <input type="file" placeholder="" value="<?= session_old_value('pdf')?>" name="pdf" id="pdf">
                        </td>
                    </tr>
                    <?php
                }
                admin_component('edit-select', ['name' => 'category_id', "multiple" => true, 'placeholder' => 'Selectionnez une catégorie', 'label' => 'Catégorie', 'valueKey' => 'id', 'textKey' => "title", "value" => array_map(function ($c) {
                    return $c['id'];
                }, $book['categories']), 'options' => $categories], '/..');
                admin_component('edit-textarea', ['label' => "Description", 'name' => 'description', 'value' => $book['description'], 'placeholder' => "Description du livre"], '/..');
                ?>
                </tbody>
            </table>
            <div class="button-container">
                <button class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
<?php
require_once 'partials/footer.php';
