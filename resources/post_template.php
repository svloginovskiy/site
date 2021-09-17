<div class="container overflow-hidden">
    <div class="row justify-content-md-center">
        <div class="border rounded m-3 shadow" style="width: 40rem;">
            <article>
                <h1><?= $title; ?></h1>
                <?= $text; ?>
            </article>
            <div class="d-flex mb-3">
                <div class="ms-auto d-flex " id="rateDiv">
                    <div class id="<?= $isLoggedIn ? 'rateUpDiv' : 'rateUpDivDisabled'; ?>"  >
                        <i class="bi <?= $isUpvoted ? 'bi-arrow-up-square-fill' : 'bi-arrow-up-square'; ?>"></i>
                    </div>
                    <div id="rating">
                        <?= $rating; ?>
                    </div>
                    <div id="<?= $isLoggedIn ? 'rateDownDiv' : 'rateDownDivDisabled'; ?>">
                        <i class="bi <?= isset($isUpvoted) ? ($isUpvoted ? 'bi-arrow-down-square' : 'bi-arrow-down-square-fill') : 'bi-arrow-down-square'; ?>"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'comments_template.php' ?>
