<a href="/book.php?slug=<?= $slug ?>" class="book-card" style="background: url(<?= $image ?>)">
    <div class="overlay">
        <div class="content">
            <h3 class="title"><?= $title ?></h3>
            <hr color="#797979" style="margin: 0; margin-top: 5px; margin-bottom: 6px">
            <p class="author"><?= $author ?></p>
            <p class="categories"><?= implode(', ', array_map(function ($item) {
                        return $item['title'];
                    }, $categories) ?? []) ?></p>
        </div>
    </div>
</a>
