<script src="/js/posts_lists.js"></script>
<div onload="initElement();" hidden></div>
<?php foreach ($posts as $post) : ?>
    <div class="row justify-content-md-center">
        <div class="border rounded m-3 shadow postCard" id="<?=$post['id']; ?>" style="width: 40rem;">
            <article style="cursor: pointer;">
                <a href="/posts/<?= $post['id']; ?>"></a>
                <div class="d-flex"> <h6 class="small" "><a href="/<?=$post['category']; ?>"><?=$post['category']; ?></a></h6></div>
                <h2><?= $post['title']; ?></h2>
                <?= $post['text']; ?>
            </article>
            <div class="d-flex mb-2">
                <div class="ms-auto d-flex rateDiv">
                    <div class="<?= $isLoggedIn  ? 'rateUpDiv' : 'rateUpDivDisabled'; ?>"  >
                        <i class="bi <?= isset($post['isUpvoted']) && $post['isUpvoted'] ? 'bi-arrow-up-square-fill' : 'bi-arrow-up-square'; ?>"></i>
                    </div>
                    <div class="rating">
                        <?= $post['rating']; ?>
                    </div>
                    <div class="<?= $isLoggedIn  ? 'rateDownDiv' : 'rateDownDivDisabled'; ?>">
                        <i class="bi <?= isset($post['isUpvoted']) ? ($post['isUpvoted'] ? 'bi-arrow-down-square' : 'bi-arrow-down-square-fill') : 'bi-arrow-down-square'; ?>"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
