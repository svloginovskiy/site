<div class="container overflow-hidden">
    <div class="row justify-content-md-center">
        <div class="border rounded m-3 shadow" style="width: 40rem;">
            <article>
                <h1><?= $title; ?></h1>
                <?= $text; ?>
            </article>
            <div class="d-flex">
                <div class="ms-auto d-flex">
                    <div class id="rateUpIcon">
                        <i class="bi bi-arrow-up-square"></i>
                    </div>
                    <div>
                        <?= $rating; ?>
                    </div>
                    <div id="rateDownIcon">
                        <i class="bi bi-arrow-down-square"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
