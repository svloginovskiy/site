<script src="/js/posts_lists.js"></script>
<div onload="initElement()" hidden></div>
<?php foreach ($posts as $post) : ?>
    <div class="row justify-content-md-center">
        <div class="border rounded m-3 shadow postCard" style="width: 40rem; cursor: pointer;">
            <article>
                <a href="/posts/<?= $post['id']; ?>"></a>
                <h1><?= $post['title']; ?></h1>
                <?= $post['text']; ?>
            </article>
            <div class="d-flex mb-2">
                <div class="ms-auto d-flex" id="rateDiv">
                    <div class id="<?= $isLoggedIn  ? 'rateUpDiv' : 'rateUpDivDisabled'; ?>"  >
                        <i class="bi <?= $post['isUpvoted'] ? 'bi-arrow-up-square-fill' : 'bi-arrow-up-square'; ?>"></i>
                    </div>
                    <div id="rating">
                        <?= $post['rating']; ?>
                    </div>
                    <div id="<?= $isLoggedIn  ? 'rateDownDiv' : 'rateDownDivDisabled'; ?>">
                        <i class="bi <?= isset($post['isUpvoted']) ? ($post['isUpvoted'] ? 'bi-arrow-down-square' : 'bi-arrow-down-square-fill') : 'bi-arrow-down-square'; ?>"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
