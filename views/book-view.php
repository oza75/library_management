<?php
require_once 'partials/header.php';
?>
    <main class="main-topbar-padding book-page">
        <?php if ($reserved) { ?>
            <?php if ($reserved['confirmed']) { ?>
                <section class="container-1 take-book-section">
                    Vous avez déjà prix ce livre, veuillez le retourner avant
                    le <?= date('d-m-Y', strtotime($reserved['return_date'])) ?>
                </section>
            <?php } else { ?>
                <?php if ($last_reservation && $reserved['id'] == $last_reservation['id']) { ?>
                    <section class="container-1 reserved-section">
                        Vous avez réservé ce livre, passez à la bibliothèque avant
                        le <?= date('d-m-Y', strtotime($reserved['created_at'] . ' + 14 days')) ?> pour le récupérez
                    </section>
                <?php } else { ?>
                    <section class="container-1 reserved-section">
                        Vous avez réservé ce livre, passez à la bibliothèque entre
                        le <?= $available_at ?>
                        et <?= date('d-m-Y', strtotime($reserved['created_at'] . ' + 14 days')) ?>
                        pour le récupérez
                    </section>
                <?php } ?>
            <?php } ?>
        <?php } ?>
        <section class="container-1 wrapper">
            <div class="image">
                <img src="<?= imageUrl('/books/' . $book['image']) ?>" alt="">
            </div>
            <div class="content">
                <div class="title-container">
                    <h1 class="title"><?= $book['title'] ?></h1>
                </div>
                <p class="categories"><?= implode(', ', array_map(function ($item) {
                        return "<a href='search.php?category_id=" . $item['id'] . "'>" . $item['title'] . "</a>";
                    }, $book['categories'])) ?></p>
                <span class="author"><?= $book['author'] ?></span>
                <?php if ($available_at && !$reserved) { ?>
                    <span class="label">Disponible à partir du <?= $available_at ?></span>
                    <?php
                } ?>
                <p class="description"><?= $book['description'] ?></p>
                <div class="actions-container">
<!--                    <a class="btn btn-orange" style="margin-bottom: 20px">Disponible en version PDF</a>-->
                    <?php if (!$reserved) { ?>
                        <a href="reservation.php?book_id=<?= $book['id'] ?>" class="btn btn-primary"
                           style="text-decoration: none">Réserver <?= $available_at ? "dès qu'il est disponible" : "maintenant" ?></a>
                    <?php } ?>
                </div>
            </div>
        </section>
    </main>
<?php
require_once 'partials/footer.php';
