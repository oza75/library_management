<?php
require_once 'partials/header.php';
$searchPlaceholderBooks = selectWithSql("select title from books where char_length (title) < 20 order by rand() limit 3", [], true);
$searchPlaceholder = "&quot;" . implode("&quot;, &quot;", array_map(function ($item) {
        return $item['title'];
    }, $searchPlaceholderBooks)) . "&quot;";
?>
    <main>
        <section class="home-hero">
            <div class="hero-figure-container">
                <figure class="hero-figure" style="opacity: 1">
                    <div class="hero-figure__image"
                         style="background: black url(/assets/images/hero-section-image.jpg) no-repeat center /cover;"></div>
                </figure>
                <figure class="hero-figure">
                    <div class="hero-figure__image"
                         style="background: black url(/assets/images/hero-section-5.jpg) no-repeat center /cover;"></div>
                </figure>
                <figure class="hero-figure">
                    <div class="hero-figure__image"
                         style="background: black url(/assets/images/hero-section-10.jpg) no-repeat center /cover;"></div>
                </figure>
                <figure class="hero-figure">
                    <div class="hero-figure__image"
                         style="background: black url(/assets/images/hero-section-1.jpg) no-repeat center /cover;"></div>
                </figure>

                <figure class="hero-figure">
                    <div class="hero-figure__image"
                         style="background: black url(/assets/images/hero-section-4.jpg) no-repeat center /cover;"></div>
                </figure>
            </div>
            <div class="overlay">
                <div class="wrapper">
                    <h1 class="title">Retrouver et réserver vos livres <br> en un seul clic !</h1>
                    <form action="search.php" method="get">
                        <div class="home-input-wrapper">
                            <div class="home-search-form">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" class="home-input" autocomplete="off" name="search"
                                       placeholder="Essayer : <?= $searchPlaceholder ?>">
                            </div>
                            <button class="btn btn-primary home-search-button" type="submit">Rechercher</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section class="top-books animate-when-visible" style="margin-top: 70px">
            <div class="container">
                <div style="text-align: center">
                    <h2 class="title">
                        <mark>Top des livres</mark>
                    </h2>
                </div>
                <div class="container-1 book-container" style="margin-top: 47px">
                    <?php
                    foreach ($topBooks as $book) {
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
        <section class="reservation-pub animate-when-visible" style="margin-top: 36px">
            <div style="text-align: center">
                <h2 class="title">
                    <mark>Réserver depuis chez vous</mark>
                </h2>
            </div>
            <div class="container-1 wrapper">
                <div class="text-wrapper">
                    <p>
                        Plus bésoin de vous déplacer pour venir prendre un livre, réserver votre livre depuis chez vous
                        et venez le recuperer dès qu’il sera disponible.
                    </p>
                    <a href="/search.php" class="btn btn-primary">Réserver votre livre</a>
                </div>
                <div>
                    <img src="assets/images/reservation-pub-image.png" alt="">
                </div>
            </div>
        </section>
        <section class="pdf-section animate-when-visible">
            <div style="text-align: center;padding-top: 53.06px">
                <h2 class="title">
                    <mark>Lisez vos livres directement en ligne</mark>
                </h2>
            </div>
            <div class="container-1 wrapper">
                <!--                <div>-->
                <!--                    <img src="assets/images/pdf-section-image.png" alt="">-->
                <!--                </div>-->
                <div class="text-wrapper">
                    <p>
                        Lisez directement vos livres préferées sur notre plateforme.
                        Bien vrai que rien ne vaut la sensation d’un livre physique il est souvent utile de pouvoir lire
                        vos livres sur n’importe lequel de vos periphériques. De plus, vos sessions de lectures sont
                        sauvegardées ce qui vous permet de reprendre votre lecture là où vous lavez laissé.
                    </p>
                </div>
            </div>
        </section>
        <section class="pdf-books animate-when-visible" style="margin-top: 20px; margin-bottom: 50px">
            <div class="container">
                <div style="text-align: center">
                    <h2 class="title">
                        <mark>Disponible en PDF</mark>
                    </h2>
                </div>
                <div class="container-1 book-container" style="margin-top: 47px">
                    <?php
                    foreach ($pdfBooks as $book) {
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
        <?php if (!user_is_logged()) { ?>
            <section class="login-section animate-when-visible">
                <?php
                include 'login-view.php'
                ?>
            </section>
        <?php } ?>
    </main>
<?php
require_once 'partials/footer.php';
