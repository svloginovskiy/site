<div class="container overflow-hidden">
    <?php include 'posts_list_template.php'; ?>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="/">&laquo;</a>
            </li>
            <li class="page-item <?= $prevActive ? 'active' : ''; ?>"><a class="page-link"
                                                                         href="/<?= $prev; ?>"><?= $prev; ?></a></li>
            <li class="page-item <?= $curActive ? 'active' : ''; ?>"><a class="page-link"
                                                                        href="/<?= $current; ?>"><?= $current; ?></a>
            </li>
            <li class="page-item <?= $nextActive ? 'active' : ''; ?>"><a class="page-link"
                                                                         href="/<?= $next; ?>"><?= $next; ?></a></li>
            <li class="page-item">
                <a class="page-link" href="/<?= $last; ?>">&raquo;</a>
            </li>
        </ul>
    </nav>
</div>