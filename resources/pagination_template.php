<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="<?= $CUR_PATH; ?>">&laquo;</a>
        </li>
        <li class="page-item <?= $prevActive ? 'active' : ''; ?>"><a class="page-link"
                                                                     href="<?= $CUR_PATH;?><?= $prev; ?>"><?= $prev; ?></a>
        </li>
        <li class="page-item <?= $curDisabled ? 'disabled' : ''; ?><?= $curActive ? 'active' : ''; ?>"><a class="page-link"
                                                                    href="<?= $CUR_PATH; ?><?= $current; ?>"><?= $current; ?></a>
        </li>
        <li class="page-item <?= $nextDisabled ? 'disabled' : ''; ?> <?= $nextActive ? 'active' : ''; ?>"><a class="page-link"
                                                                     href="<?= $CUR_PATH; ?><?= $next; ?>"><?= $next; ?></a>
        </li>
        <li class="page-item">
            <a class="page-link" href="<?= $CUR_PATH; ?><?= $last; ?>">&raquo;</a>
        </li>
    </ul>
</nav>