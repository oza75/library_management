<?php
require_once "partials/header.php";
?>
<main class="my-books-page main-topbar-padding">
    <div class="container-1">
        <?php if (empty($reservedBooks) && empty($confirmedReservedBooks)) { ?>
            <div class="empty-books">
                <div>
                    <img src="/assets/images/empty-search-state.svg" alt="">
                    <h2>Vous n'avez pas encore réserver un livre</h2>
                    <button class="btn btn-primary" style="display: inline-block">Réserver un livre</button>
                </div>
            </div>
        <?php } ?>
        <?php if (!empty($reservedBooks)) { ?>
            <div>
                <h1>Les livres que j'ai réservés</h1>
                <div class="book-grid">
                    <?php
                    foreach ($reservedBooks as $book) {
                        component('book', [
                            'title' => $book['title'],
                            'author' => $book['author'],
                            "slug" => $book['slug'],
                            'categories' => $book['categories'],
                            "image" => imageUrl('/books/' . $book['image'])
                        ]);
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
        <?php if (!empty($confirmedReservedBooks)) { ?>
            <hr color="#ededed" style="margin: 10px 0">
            <div>
                <h1>Les livres que je dois rendre</h1>
                <div class="book-grid">
                    <?php
                    foreach ($confirmedReservedBooks as $book) {
                        component('book', [
                            'title' => $book['title'],
                            'author' => $book['author'],
                            "slug" => $book['slug'],
                            'categories' => $book['categories'],
                            "image" => imageUrl('/books/' . $book['image'])
                        ]);
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
    </div>
</main>
<?php
require_once "partials/footer.php";
?>
