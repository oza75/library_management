<?php
require_once 'partials/header.php';
$books = [
    [
        'title' => 'Thief River Falls',
        'author' => 'Marine Chevalier',
        'categories' => ['Faune'],
        "image" => "https://images.unsplash.com/photo-1578944032637-f09897c5233d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80"
    ]
];
?>
    <main>
        <!--        <section class="hero">-->
        <!--            <div class="hero-wrapper">-->
        <!--                <div class="hero-text-wrapper ">-->
        <!--                    <h1 class="hero-title">-->
        <!--                        Réserver votre livre en un seul clic !-->
        <!--                    </h1>-->
        <!--                    <p class="hero-description">-->
        <!--                        <span class="quote">-->
        <!--                            “ Lire, c'est aller à la rencontre d'une chose qui va exister mais dont personne ne sait encore-->
        <!--                        ce qu'elle sera. “-->
        <!--                        </span>-->
        <!--                        <strong>Italo Calvino</strong>-->
        <!--                    </p>-->
        <!--                    <div class="inputs-container">-->
        <!--                        <input type="text" class="form-input" placeholder="Rechercher votre livre...">-->
        <!--                        <button class="btn btn-primary">Se connecter</button>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="hero-image animate-when-visible">-->
        <!--                    <img src="assets/images/hero-image-2.png" alt="">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </section>-->
        <section class="home-hero">
            <div class="overlay">
                <div class="wrapper">
                    <h1 class="title">IGA BOOKS</h1>
                    <p class="description">Réserver et retrouver vos livres en un seul clic !</p>
                    <a href="search.php" class="btn btn-primary call-to-action">Réserver votre livre</a>
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
                    <button class="btn btn-primary">Réserver votre livre</button>
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
