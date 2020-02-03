<?php
require_once "partials/header.php";
?>
    <main class="main-topbar-padding">
        <div class="container-1">
            <h2>Hello world</h2>
            <div>
                <object data="/assets/pdf/<?= $book['pdf'] ?>" type="application/pdf" style="min-height: 100vh; width: 100%">
                    <embed src="/assets/pdf/<?= $book['pdf'] ?>" type="application/pdf"/>
                </object>
            </div>
        </div>
    </main>
<?php
require_once "partials/footer.php";