<div class="container overflow-hidden">
    <?php foreach ($posts as $post) : ?>
    <div class="row justify-content-md-center">
        <div class="border rounded m-3 shadow postCard" style="width: 40rem;">
            <article>
                <a href="/posts/<?= $post['id']; ?>" ></a>
                <h1><?= $post['title']; ?></h1>
                <?= $post['text']; ?>
            </article>
            <div class="d-flex mb-3">
                <div class="ms-auto d-flex" id="rateDiv">
                    <div id="rating">
                        <?= $post['rating']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="/">&laquo;</a>
            </li>
            <li class="page-item <?= $prevActive ? 'active' : '';?>"><a class="page-link" href="/<?=$prev;?>"><?=$prev;?></a></li>
            <li class="page-item <?= $curActive ? 'active' : '';?>"><a class="page-link" href="/<?=$current;?>"><?=$current;?></a></li>
            <li class="page-item <?= $nextActive ? 'active' : '';?>"><a class="page-link" href="/<?=$next;?>"><?=$next;?></a></li>
            <li class="page-item">
                <a class="page-link" href="/<?=$last;?>">&raquo;</a>
            </li>
        </ul>
    </nav>
</div>