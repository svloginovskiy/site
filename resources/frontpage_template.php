<div class="container overflow-hidden">
    <div class="row mt-1 justify-content-md-center">
        <div class="d-flex" style="width: 40rem;">
            <div class="ms-auto">
                <div class="d-inline-block">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Choose categories</button>
                </div>
                <div class="align-middle d-inline-block">Sorted by</div>
                <div class="d-inline-block">
                    <select onchange="handleSelect();" class=" form-select" style="width: ">
                        <option <?= isset($sortedBy) && $sortedBy == 'time' ? 'selected' : ''; ?> value="time">Time</option>
                        <option <?= isset($sortedBy) && $sortedBy == 'rating' ? 'selected' : ''; ?> value="rating">Rating</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'posts_list_template.php';
    include 'pagination_template.php'; ?>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Choose categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-check">
                    <input class="form-check-input categoriesCheckBox" type="checkbox" value="news" id="flexCheckDefault" <?=in_array('news', $categories ?? '') ? 'checked' : '';?>
                    <label class="form-check-label" for="flexCheckDefault">
                        News
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input categoriesCheckBox" type="checkbox" value="memes" id="flexCheckChecked" <?=in_array('memes', $categories ?? '') ? 'checked' : '';?>
                    <label class="form-check-label" for="flexCheckChecked">
                        Memes
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="handleCheckbox();">Save</button>
            </div>
        </div>
    </div>
</div>