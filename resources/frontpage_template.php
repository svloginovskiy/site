<div class="container overflow-hidden">
    <?php foreach ($posts as $post) : ?>
    <div class="row justify-content-md-center">
        <div class="border rounded m-3 shadow postCard" style="width: 40rem;">
            <article>
                <a href="/posts/<?= $post['id']; ?>" ></a>
                <h1><?= $post['title']; ?></h1>
                <?= $post['text']; ?>
            </article>
            <div class="d-flex">
                <div class="ms-auto d-flex" id="rateDiv">
                    <div id="rating">
                        <?= $post['rating']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>