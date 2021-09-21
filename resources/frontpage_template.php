<div class="container overflow-hidden">
    <div class="row mt-1 justify-content-md-center">
        <div class="d-flex" style="width: 40rem;">
            <div class="ms-auto">
                <div class="align-middle d-inline-block">Sorted by</div>
                <div class="d-inline-block">
                    <select onchange="handleSelect();" class=" form-select" style="width: ">
                        <option <?= $sortedBy == 'time' ? 'selected' : ''; ?> value="time">Time</option>
                        <option <?= $sortedBy == 'rating' ? 'selected' : ''; ?> value="rating">Rating</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'posts_list_template.php'; ?>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="/<?= $sortedBy == 'rating' ? 'top/' : ''; ?>">&laquo;</a>
            </li>
            <li class="page-item <?= $prevActive ? 'active' : ''; ?>"><a class="page-link"
                                                                         href="/<?= $sortedBy == 'rating' ? 'top/' : ''; ?><?= $prev; ?>"><?= $prev; ?></a>
            </li>
            <li class="page-item <?= $curActive ? 'active' : ''; ?>"><a class="page-link"
                                                                        href="/<?= $sortedBy == 'rating' ? 'top/' : ''; ?><?= $current; ?>"><?= $current; ?></a>
            </li>
            <li class="page-item <?= $nextActive ? 'active' : ''; ?>"><a class="page-link"
                                                                         href="/<?= $sortedBy == 'rating' ? 'top/' : ''; ?><?= $next; ?>"><?= $next; ?></a>
            </li>
            <li class="page-item">
                <a class="page-link" href="/<?= $sortedBy == 'rating' ? 'top/' : ''; ?><?= $last; ?>">&raquo;</a>
            </li>
        </ul>
    </nav>
</div>