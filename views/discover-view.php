<?php
require_once 'partials/header.php';
?>
    <main class="discover-page">
        <section class="hero-container discover-hero">
            <div class="hero-figure-container">
                <figure class="hero-figure" style="opacity: 1">
                    <div class="hero-figure__image"
                         style="background: var(--primary)"></div>
                </figure>
            </div>
            <div class="overlay">
                <div class="wrapper">
                    <h1 class="title">Découvrez ici toutes <br> les nouveautés du moment</h1>
                </div>
            </div>
        </section>
        <?php foreach ($items as $item) { ?>
            <section class="top-books animate-when-visible">
                <div class="container">
                    <div style="text-align: center">
                        <h2 class="title">
                            <a href="/search.php?category_id=<?= $item['id'] ?>">
                                <mark><?= $item['title'] ?></mark>
                            </a>
                        </h2>
                    </div>
                    <div class="container-1 book-container" style="margin-top: 47px">
                        <?php
                        foreach ($item['books'] as $book) {
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

            </section>
            <?php
        } ?>
    </main>
<?php
require_once 'partials/footer.php';
