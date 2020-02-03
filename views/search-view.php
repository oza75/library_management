<?php
require_once 'partials/header.php';
?>
    <main class="main-topbar-padding search-page">
        <div class="container-1">
            <section class="search-input-section">
                <form class="search-input-container" id="search-form" method="get" action="search.php">
                    <div class="categories-container">
                        <select name="category_id" id="category_id">
                            <option value="">Selectionner une catégorie</option>
                            <?php foreach ($categories as $category) {
                                ?>
                                <option value="<?= $category['id'] ?>"
                                        <?= isset($category_id) && $category_id == $category['id'] ? 'selected' : '' ?>><?= $category['title'] ?></option>
                                <?php
                            } ?>
                        </select>
                        <div class="arrow">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                    <input type="search" value="<?= isset($search) && $search ? $search : '' ?>" id="search"
                           name="search" placeholder="Réchercher votre livre...">

                </form>
            </section>
        </div>
        <section class="result-container">
            <?php if (!empty($books)) { ?>
                <div class="container-1 book-grid">
                    <?php
                    foreach ($books as $book) {
                        component('book', [
                            'title' => $book['title'],
                            'author' => $book['author'],
                            'categories' => $book['categories'],
                            "slug" => $book['slug'],
                            "image" => imageUrl('/books/' . $book['image'])
                        ]);
                    }
                    ?>
                </div>
                <?php
            } else { ?>
                <div class="container-1">
                    <div class="empty-books">
                        <div>
                            <img src="/assets/images/empty-search-state.svg" alt="">
                            <h2>Aucun livre ne correspond à vos critères de recherche</h2>
                        </div>
                    </div>
                </div>
                <?php
            } ?>
        </section>
        <?php if ($totalPage > 1) { ?>
            <section class="container-1 pagination-section">
                <div class="pagination-container">
                    <?php
                    $s = false;
                    for ($i = 1; $i < $totalPage; $i++) {
                        $isCurrent = $i == $currentPage ? 'current' : '';
                        if (($i < $currentPage + 3 && $i > $currentPage - 3) || $i >= $totalPage - 3) {
                            echo "<a href='" . paginationPage('search.php', $i) . "' class='item {$isCurrent}'>{$i}</a>";
                        } else {
                            if (!$s) {
                                echo "<a href='' class='item'>...</a>";
                                $s = true;
                            }
                        }
                    }
                    ?>
                </div>
            </section>
        <?php } ?>
    </main>
<?php
require_once 'partials/footer.php';
